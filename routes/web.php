<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── Member Controllers ────────────────────────────────────────────────────
use App\Http\Controllers\Member\MenuController      as MemberMenuController;
use App\Http\Controllers\Member\PesananController   as MemberPesananController;
use App\Http\Controllers\Member\PembayaranController;

// ─── Kasir Controllers ─────────────────────────────────────────────────────
use App\Http\Controllers\Kasir\PesananController    as KasirPesananController;
use App\Http\Controllers\Kasir\StrukController;

// ─── Admin Controllers ─────────────────────────────────────────────────────
use App\Http\Controllers\Admin\MenuController       as AdminMenuController;
use App\Http\Controllers\Admin\LaporanController;

// ===========================================================================
// BREEZE DEFAULT ROUTES (jangan hapus)
// ===========================================================================
Route::get('/', function () {
    return redirect()->route('login');
});

// Redirect /dashboard sesuai role
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return match($role) {
        'admin'  => redirect()->route('admin.dashboard'),
        'kasir'  => redirect()->route('kasir.dashboard'),
        default  => redirect()->route('member.menu'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes dari Breeze (biarkan)
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes Breeze (login, register, dll)
require __DIR__.'/auth.php';

// ===========================================================================
// MIDTRANS WEBHOOK (tanpa CSRF)
// ===========================================================================
Route::post('/pembayaran/midtrans-callback', [PembayaranController::class, 'midtransCallback'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// ===========================================================================
// MEMBER ROUTES
// ===========================================================================
Route::middleware(['auth', 'role:member,kasir,admin'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {
        Route::get('/menu',                          [MemberMenuController::class, 'index'])->name('menu');
        Route::get('/keranjang',                     [MemberPesananController::class, 'keranjang'])->name('keranjang');
        Route::post('/keranjang/tambah',             [MemberPesananController::class, 'tambahKeKeranjang'])->name('keranjang.tambah');
        Route::delete('/keranjang/{key}',            [MemberPesananController::class, 'hapusDariKeranjang'])->name('keranjang.hapus');
        Route::post('/checkout',                     [MemberPesananController::class, 'checkout'])->name('checkout');
        Route::get('/pesanan/{pesanan}',             [MemberPesananController::class, 'show'])->name('pesanan.show');
        Route::get('/riwayat',                       [MemberPesananController::class, 'riwayat'])->name('riwayat');
        Route::get('/pembayaran/qris/{pesanan}',     [PembayaranController::class, 'qris'])->name('pembayaran.qris');
    });

// ===========================================================================
// KASIR ROUTES
// ===========================================================================
Route::middleware(['auth', 'role:kasir,admin'])
    ->prefix('kasir')
    ->name('kasir.')
    ->group(function () {
        Route::get('/dashboard',                         [KasirPesananController::class, 'dashboard'])->name('dashboard');
        Route::get('/pesanan/{pesanan}',                 [KasirPesananController::class, 'show'])->name('pesanan.show');
        Route::post('/pesanan/{pesanan}/konfirmasi',     [KasirPesananController::class, 'konfirmasiPembayaran'])->name('pesanan.konfirmasi');
        Route::patch('/pesanan/{pesanan}/status',        [KasirPesananController::class, 'updateStatus'])->name('pesanan.status');
        Route::get('/menu',                              [KasirPesananController::class, 'editMenu'])->name('menu.index');
        Route::patch('/menu/{menu}',                     [KasirPesananController::class, 'updateMenu'])->name('menu.update');
        Route::get('/struk/{pesanan}',                   [StrukController::class, 'cetak'])->name('struk.cetak');
    });

// ===========================================================================
// ADMIN ROUTES
// ===========================================================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard',              [LaporanController::class, 'dashboard'])->name('dashboard');
        Route::get('/laporan',                [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/users',                  [LaporanController::class, 'userManagement'])->name('users.index');
        Route::patch('/users/{user}/role',    [LaporanController::class, 'ubahRole'])->name('users.role');
        Route::get('/menu',                   [AdminMenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/create',            [AdminMenuController::class, 'create'])->name('menu.create');
        Route::post('/menu',                  [AdminMenuController::class, 'store'])->name('menu.store');
        Route::delete('/menu/{menu}',         [AdminMenuController::class, 'destroy'])->name('menu.destroy');
    });