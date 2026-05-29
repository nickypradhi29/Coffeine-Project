<?php
 
namespace App\Http\Controllers\Kasir;
 
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Struk;
use Illuminate\Http\Request;
 
class PesananController extends Controller
{
    public function dashboard()
    {
        $pesananMasuk = Pesanan::with(['user', 'detailPesanans.menu'])
            ->whereIn('status_pesanan', ['menunggu', 'diproses'])
            ->latest()
            ->get();
 
        return view('kasir.dashboard', compact('pesananMasuk'));
    }
 
    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['user', 'detailPesanans.menu', 'pembayaran']);
        return view('kasir.pesanan.show', compact('pesanan'));
    }
 
    /**
     * Konfirmasi pembayaran cash (langsung di kasir)
     */
    public function konfirmasiPembayaran(Request $request, Pesanan $pesanan)
    {
        if ($pesanan->metode_pembayaran !== 'cash') {
            return back()->with('error', 'Hanya pesanan cash yang bisa dikonfirmasi manual.');
        }
 
        // Update pembayaran
        $pembayaran = $pesanan->pembayaran;
        if ($pembayaran) {
            $pembayaran->markAsBerhasil();
        } else {
            Pembayaran::create([
                'pesanan_id' => $pesanan->id,
                'metode'     => 'cash',
                'status'     => 'berhasil',
                'paid_at'    => now(),
            ]);
            $pesanan->update(['status_pembayaran' => 'sudah_bayar']);
        }
 
        $pesanan->update(['status_pesanan' => 'diproses']);
 
        return redirect()->route('kasir.struk.cetak', $pesanan)
            ->with('success', 'Pembayaran dikonfirmasi.');
    }
 
    /**
     * Update status pesanan (diproses → selesai)
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status_pesanan' => 'required|in:diproses,selesai,dibatalkan',
        ]);
 
        $pesanan->update(['status_pesanan' => $request->status_pesanan]);
 
        return back()->with('success', 'Status pesanan diperbarui.');
    }
 
    /**
     * Edit menu (kasir bisa mengubah stok & ketersediaan)
     */
    public function editMenu()
    {
        $menus = Menu::latest()->paginate(15);
        return view('kasir.menu.index', compact('menus'));
    }
 
    public function updateMenu(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'stok'     => 'required|integer|min:0',
            'tersedia' => 'boolean',
        ]);
 
        $menu->update($data);
 
        return back()->with('success', 'Menu diperbarui.');
    }
}