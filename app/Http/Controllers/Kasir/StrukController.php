<?php
 
namespace App\Http\Controllers\Kasir;
 
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Struk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class StrukController extends Controller
{
    /**
     * Cetak / tampilkan struk untuk pesanan
     */
    public function cetak(Pesanan $pesanan)
    {
        $pesanan->load(['user', 'detailPesanans.menu', 'pembayaran', 'struk']);
 
        // Buat struk jika belum ada
        $struk = $pesanan->struk ?? Struk::create([
            'pesanan_id'  => $pesanan->id,
            'nomor_struk' => Struk::generateNomor(),
            'kasir_id'    => Auth::id(),
            'printed_at'  => now(),
        ]);
 
        return view('kasir.struk.cetak', compact('pesanan', 'struk'));
    }
}
 