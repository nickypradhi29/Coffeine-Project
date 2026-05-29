<?php
 
namespace App\Http\Controllers\Member;
 
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
 
class PembayaranController extends Controller
{
    /**
     * Tampilkan halaman pembayaran QRIS (Midtrans)
     */
    public function qris(Pesanan $pesanan)
    {
        abort_if($pesanan->user_id !== Auth::id(), 403);
 
        // Cek / buat record pembayaran
        $pembayaran = $pesanan->pembayaran ?? $this->buatPembayaranMidtrans($pesanan);
 
        return view('member.pembayaran.qris', compact('pesanan', 'pembayaran'));
    }
 
    /**
     * Buat transaksi Midtrans dan simpan token/URL
     */
    private function buatPembayaranMidtrans(Pesanan $pesanan): Pembayaran
    {
        $serverKey = config('midtrans.server_key');
        $isProduction = config('midtrans.is_production');
 
        $baseUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
 
        $payload = [
            'transaction_details' => [
                'order_id'     => 'COFF-' . $pesanan->id . '-' . time(),
                'gross_amount' => (int) $pesanan->total_harga,
            ],
            'customer_details' => [
                'first_name' => $pesanan->user->nama,
                'email'      => $pesanan->user->email,
            ],
            'item_details' => $pesanan->detailPesanans->map(fn ($d) => [
                'id'       => $d->menu_id,
                'price'    => (int) $d->harga,
                'quantity' => $d->jumlah,
                'name'     => $d->menu->nama_menu,
            ])->toArray(),
            'payment_type' => 'qris',   // hanya tampilkan QRIS
        ];
 
        $response = Http::withBasicAuth($serverKey, '')
            ->post($baseUrl, $payload);
 
        $body = $response->json();
 
        return Pembayaran::create([
            'pesanan_id'      => $pesanan->id,
            'metode'          => 'qris',
            'payment_gateway' => 'Midtrans',
            'payment_ref'     => $body['token'] ?? null,
            'snap_token'      => $body['token'] ?? null,
            'payment_url'     => $body['redirect_url'] ?? null,
            'status'          => 'pending',
        ]);
    }
 
    /**
     * Webhook / Notification dari Midtrans
     * Route: POST /pembayaran/midtrans-callback (tidak perlu auth)
     */
    public function midtransCallback(Request $request)
    {
        $notif = $request->all();
 
        // Verifikasi signature
        $signatureKey = hash('sha512',
            $notif['order_id'] .
            $notif['status_code'] .
            $notif['gross_amount'] .
            config('midtrans.server_key')
        );
 
        if ($signatureKey !== $notif['signature_key']) {
            Log::warning('Midtrans: Signature tidak valid', $notif);
            return response()->json(['message' => 'Signature tidak valid'], 403);
        }
 
        // Ambil pesanan dari order_id (format: COFF-{pesanan_id}-{timestamp})
        $pesananId = explode('-', $notif['order_id'])[1] ?? null;
        $pesanan   = Pesanan::find($pesananId);
 
        if (! $pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }
 
        $pembayaran = $pesanan->pembayaran;
 
        if (in_array($notif['transaction_status'], ['capture', 'settlement'])) {
            $pembayaran?->markAsBerhasil();
            $pesanan->update(['status_pesanan' => 'diproses']);
        } elseif (in_array($notif['transaction_status'], ['cancel', 'deny', 'expire'])) {
            $pembayaran?->update(['status' => 'gagal']);
        }
 
        return response()->json(['message' => 'OK']);
    }
}