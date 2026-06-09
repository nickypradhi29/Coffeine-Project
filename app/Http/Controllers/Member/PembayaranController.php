<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PembayaranController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans config
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    /**
     * Tampilkan halaman pembayaran QRIS
     */
    public function qris(Pesanan $pesanan)
    {
        abort_if($pesanan->user_id !== Auth::id(), 403);

        // Kalau sudah ada pembayaran pending, pakai yang lama
        $pembayaran = $pesanan->pembayaran;

        if (! $pembayaran || ! $pembayaran->snap_token) {
            $pembayaran = $this->buatSnapToken($pesanan);
        }

        return view('member.pembayaran.qris', compact('pesanan', 'pembayaran'));
    }

    /**
     * Buat Snap Token dari Midtrans
     */
    private function buatSnapToken(Pesanan $pesanan): Pembayaran
    {
        $params = [
            'transaction_details' => [
                'order_id'     => 'COFF-' . $pesanan->id . '-' . time(),
                'gross_amount' => (int) $pesanan->total_harga,
            ],
            'customer_details' => [
                'first_name' => $pesanan->user->nama,
                'email'      => $pesanan->user->email,
            ],
            'item_details' => $pesanan->detailPesanans->map(fn($d) => [
                'id'       => (string) $d->menu_id,
                'price'    => (int) $d->harga,
                'quantity' => $d->jumlah,
                'name'     => substr($d->menu->nama_menu, 0, 50),
            ])->toArray(),
            'enabled_payments' => ['qris'], // hanya tampilkan QRIS
        ];

        $snapToken  = Snap::getSnapToken($params);
        $snapResult = Snap::getSnapUrl($params);

        return Pembayaran::updateOrCreate(
            ['pesanan_id' => $pesanan->id],
            [
                'metode'          => 'qris',
                'payment_gateway' => 'Midtrans',
                'snap_token'      => $snapToken,
                'payment_url'     => $snapResult,
                'status'          => 'pending',
            ]
        );
    }

    /**
     * Webhook dari Midtrans (otomatis dipanggil setelah bayar)
     */
    public function midtransCallback(Request $request)
    {
        try {
            $notif = new Notification();

            $orderId           = $notif->order_id;
            $transactionStatus = $notif->transaction_status;
            $fraudStatus       = $notif->fraud_status;

            // Ambil pesanan_id dari order_id (format: COFF-{id}-{timestamp})
            $pesananId = explode('-', $orderId)[1] ?? null;
            $pesanan   = Pesanan::find($pesananId);

            if (! $pesanan) {
                return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
            }

            $pembayaran = $pesanan->pembayaran;

            if ($transactionStatus === 'capture') {
                if ($fraudStatus === 'accept') {
                    $pembayaran?->markAsBerhasil();
                    $pesanan->update(['status_pesanan' => 'diproses']);
                }
            } elseif ($transactionStatus === 'settlement') {
                $pembayaran?->markAsBerhasil();
                $pesanan->update(['status_pesanan' => 'diproses']);
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $pembayaran?->update(['status' => 'gagal']);
                $pesanan->update(['status_pesanan' => 'dibatalkan']);
            } elseif ($transactionStatus === 'pending') {
                $pembayaran?->update(['status' => 'pending']);
            }

            return response()->json(['message' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage());
            return response()->json(['message' => 'Error'], 500);
        }
    }
}