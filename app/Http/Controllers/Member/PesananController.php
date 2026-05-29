<?php
 
namespace App\Http\Controllers\Member;
 
use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
 
class PesananController extends Controller
{
    /**
     * Tampilkan keranjang / form checkout
     */
    public function keranjang()
    {
        $keranjang = session('keranjang', []);
        $total     = collect($keranjang)->sum('subtotal');
 
        return view('member.pesanan.keranjang', compact('keranjang', 'total'));
    }
 
    /**
     * Tambah item ke keranjang (session)
     */
    public function tambahKeKeranjang(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah'  => 'required|integer|min:1',
        ]);
 
        $menu      = Menu::findOrFail($request->menu_id);
        $keranjang = session('keranjang', []);
        $key       = 'menu_' . $menu->id;
 
        if (isset($keranjang[$key])) {
            $keranjang[$key]['jumlah']   += $request->jumlah;
            $keranjang[$key]['subtotal']  = $keranjang[$key]['harga'] * $keranjang[$key]['jumlah'];
        } else {
            $keranjang[$key] = [
                'menu_id'   => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga'     => $menu->harga,
                'jumlah'    => $request->jumlah,
                'subtotal'  => $menu->harga * $request->jumlah,
            ];
        }
 
        session(['keranjang' => $keranjang]);
 
        return back()->with('success', "{$menu->nama_menu} ditambahkan ke keranjang.");
    }
 
    /**
     * Hapus item dari keranjang
     */
    public function hapusDariKeranjang(string $key)
    {
        $keranjang = session('keranjang', []);
        unset($keranjang[$key]);
        session(['keranjang' => $keranjang]);
 
        return back()->with('success', 'Item dihapus dari keranjang.');
    }
 
    /**
     * Buat pesanan dari keranjang
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:qris,cash',
            'catatan'           => 'nullable|string|max:500',
        ]);
 
        $keranjang = session('keranjang', []);
 
        if (empty($keranjang)) {
            return back()->with('error', 'Keranjang kamu masih kosong.');
        }
 
        DB::beginTransaction();
        try {
            $pesanan = Pesanan::create([
                'user_id'           => Auth::id(),
                'metode_pembayaran' => $request->metode_pembayaran,
                'catatan'           => $request->catatan,
                'status_pesanan'    => 'menunggu',
                'status_pembayaran' => 'belum_bayar',
            ]);
 
            foreach ($keranjang as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id'    => $item['menu_id'],
                    'jumlah'     => $item['jumlah'],
                    'harga'      => $item['harga'],
                    'subtotal'   => $item['subtotal'],
                ]);
            }
 
            $pesanan->hitungTotal();
 
            DB::commit();
            Session::forget('keranjang');
 
            // Arahkan ke pembayaran sesuai metode
            if ($request->metode_pembayaran === 'qris') {
                return redirect()->route('member.pembayaran.qris', $pesanan);
            }
 
            return redirect()->route('member.pesanan.show', $pesanan)
                ->with('success', 'Pesanan berhasil dibuat. Silakan bayar di kasir.');
 
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
 
    /**
     * Detail pesanan
     */
    public function show(Pesanan $pesanan)
    {
        abort_if($pesanan->user_id !== Auth::id(), 403);
        $pesanan->load(['detailPesanans.menu', 'pembayaran']);
 
        return view('member.pesanan.show', compact('pesanan'));
    }
 
    /**
     * Riwayat pesanan member
     */
    public function riwayat()
    {
        $pesanans = Pesanan::with(['detailPesanans.menu', 'pembayaran'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
 
        return view('member.pesanan.riwayat', compact('pesanans'));
    }
}