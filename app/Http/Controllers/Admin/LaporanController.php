<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanPenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
 
class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari  = $request->dari  ?? now()->startOfMonth()->toDateString();
        $sampai = $request->sampai ?? now()->toDateString();
 
        $pesanans = Pesanan::with(['user', 'detailPesanans.menu', 'pembayaran'])
            ->whereBetween('created_at', [$dari . ' 00:00:00', $sampai . ' 23:59:59'])
            ->where('status_pembayaran', 'sudah_bayar')
            ->latest()
            ->get();
 
        $totalPendapatan = $pesanans->sum('total_harga');
        $totalTransaksi  = $pesanans->count();

        $grafikPenjualan = Pesanan::selectRaw(
            'DATE(created_at) as tanggal,
             SUM(total_harga) as total'
        )
        ->whereBetween(
            'created_at',
            [$dari . ' 00:00:00', $sampai . ' 23:59:59']
        )
        ->where('status_pembayaran', 'sudah_bayar')
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();

        $rataRataTransaksi =
        $totalTransaksi > 0
        ? $totalPendapatan / $totalTransaksi
        : 0;


        return view('admin.laporan.index', compact(
            'pesanans', 'totalPendapatan', 'totalTransaksi', 'dari', 'sampai', 'grafikPenjualan', 'rataRataTransaksi'
        ));
    }

    public function exportExcel()
    {
    return Excel::download(
        new LaporanPenjualanExport(),
        'laporan_penjualan.xlsx'
    );
    }
 
    public function dashboard()
    {
        $totalPendapatanBulanIni = Pesanan::whereMonth('created_at', now()->month)
            ->where('status_pembayaran', 'sudah_bayar')
            ->sum('total_harga');
 
        $totalPesananHariIni = Pesanan::whereDate('created_at', today())->count();
 
        $menuTerlaris = \App\Models\DetailPesanan::with('menu')
            ->selectRaw('menu_id, SUM(jumlah) as total_terjual')
            ->groupBy('menu_id')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();
 
        return view('admin.dashboard', compact(
            'totalPendapatanBulanIni',
            'totalPesananHariIni',
            'menuTerlaris'
        ));
    }
 
    public function userManagement()
    {
        $users = \App\Models\User::orderBy('role')->paginate(20);
        return view('admin.users.index', compact('users'));
    }
 
    public function ubahRole(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'role' => 'required|in:member,kasir,admin',
        ]);
 
        $user->update(['role' => $request->role]);
 
        return back()->with('success', "Role {$user->nama} berhasil diubah menjadi {$request->role}.");
    }

    
}