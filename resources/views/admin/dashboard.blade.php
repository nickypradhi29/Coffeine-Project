<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-700:#6B3F22;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-300:#D4A574;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--brown-50:#FAF6F0;--cream:#FFFDF9;--text-light:#9B7550;}
        body{font-family:'Inter',sans-serif;background:var(--brown-50);color:var(--brown-900);}

        nav{background:var(--brown-800);display:flex;align-items:center;justify-content:space-between;padding:0 48px;height:64px;position:sticky;top:0;z-index:100;}
        .nav-logo{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-200);text-decoration:none;}
        .nav-links{display:flex;align-items:center;gap:20px;}
        .nav-link{font-size:12px;color:var(--brown-300);text-decoration:none;letter-spacing:1px;text-transform:uppercase;transition:color .2s;}
        .nav-link:hover,.nav-link.active{color:var(--cream);}
        .nav-role{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--brown-400);background:rgba(196,124,62,.15);padding:4px 10px;border-radius:20px;}

        .page-header{background:var(--brown-900);padding:40px 48px;}
        .page-eyebrow{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--brown-400);margin-bottom:8px;}
        .page-title{font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:var(--cream);}
        .page-sub{font-size:13px;color:var(--brown-300);margin-top:6px;}

        .main{max-width:1200px;margin:0 auto;padding:36px 32px;}

        /* Stats */
        .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:32px;}
        .stat-card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:24px;display:flex;flex-direction:column;gap:4px;}
        .stat-label{font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--text-light);}
        .stat-val{font-family:'Playfair Display',serif;font-size:30px;font-weight:600;color:var(--brown-800);}
        .stat-sub{font-size:12px;color:var(--text-light);}

        /* Quick links */
        .quick-links{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:32px;}
        .quick-card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:20px;text-decoration:none;display:flex;align-items:center;gap:14px;transition:all .2s;}
        .quick-card:hover{border-color:var(--brown-400);box-shadow:0 4px 16px rgba(44,26,14,.08);transform:translateY(-2px);}
        .quick-icon{font-size:24px;width:44px;height:44px;background:var(--brown-50);border-radius:4px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .quick-title{font-size:14px;font-weight:600;color:var(--brown-900);}
        .quick-sub{font-size:12px;color:var(--text-light);margin-top:2px;}

        /* Table */
        .section-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;}
        .section-title{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-900);}
        .tbl-wrap{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;overflow:hidden;}
        .tbl{width:100%;border-collapse:collapse;}
        .tbl thead{background:var(--brown-900);}
        .tbl th{text-align:left;padding:12px 16px;font-size:11px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:var(--brown-300);}
        .tbl td{padding:13px 16px;font-size:13px;color:var(--brown-900);border-top:1px solid var(--brown-50);}
        .tbl tbody tr:hover{background:var(--brown-50);}
        .badge{font-size:10px;font-weight:500;padding:3px 10px;border-radius:20px;letter-spacing:0.5px;}
        .badge-coffee{background:#E6F1FB;color:#185FA5;}
        .badge-noncoffee{background:#EAF3DE;color:#3B6D11;}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;}.main{padding:24px 20px;}.stats,.quick-links{grid-template-columns:1fr;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <span class="nav-role">Admin</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-link active">Dashboard</a>
        <a href="{{ route('admin.menu.index') }}" class="nav-link">Menu</a>
        <a href="{{ route('admin.laporan.index') }}" class="nav-link">Laporan</a>
        <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button style="background:none;border:none;cursor:pointer;font-size:12px;color:var(--brown-300);letter-spacing:1px;text-transform:uppercase;font-family:inherit;" type="submit">Keluar</button>
        </form>
    </div>
</nav>

<div class="page-header">
    <div class="page-eyebrow">Panel Admin</div>
    <h1 class="page-title">Dashboard</h1>
    <p class="page-sub">{{ now()->format('l, d F Y') }}</p>
</div>

<div class="main">

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card">
            <div class="stat-label">Pendapatan Bulan Ini</div>
            <div class="stat-val" style="font-size:22px">Rp {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}</div>
            <div class="stat-sub">Dari pesanan yang sudah dibayar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pesanan Hari Ini</div>
            <div class="stat-val">{{ $totalPesananHariIni }}</div>
            <div class="stat-sub">Total pesanan masuk hari ini</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Menu Tersedia</div>
            <div class="stat-val">{{ \App\Models\Menu::tersedia()->count() }}</div>
            <div class="stat-sub">Menu aktif dan stok tersedia</div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="quick-links" style="margin-bottom:32px">
        <a href="{{ route('admin.menu.create') }}" class="quick-card">
            <div class="quick-icon">➕</div>
            <div><div class="quick-title">Tambah Menu</div><div class="quick-sub">Tambahkan item menu baru</div></div>
        </a>
        <a href="{{ route('admin.laporan.index') }}" class="quick-card">
            <div class="quick-icon">📊</div>
            <div><div class="quick-title">Laporan Penjualan</div><div class="quick-sub">Lihat data transaksi lengkap</div></div>
        </a>
        <a href="{{ route('admin.users.index') }}" class="quick-card">
            <div class="quick-icon">👥</div>
            <div><div class="quick-title">Kelola Pengguna</div><div class="quick-sub">Atur role kasir & admin</div></div>
        </a>
    </div>

    {{-- Menu Terlaris --}}
    <div class="section-header">
        <div class="section-title">Menu Terlaris</div>
        <a href="{{ route('admin.menu.index') }}" style="font-size:13px;color:var(--brown-600);text-decoration:none;">Lihat semua →</a>
    </div>
    <div class="tbl-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th style="text-align:right">Total Terjual</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menuTerlaris as $i => $item)
                <tr>
                    <td style="color:var(--text-light);font-weight:500">{{ $i + 1 }}</td>
                    <td style="font-weight:600">{{ $item->menu->nama_menu }}</td>
                    <td><span class="badge {{ $item->menu->kategori === 'coffee' ? 'badge-coffee' : 'badge-noncoffee' }}">{{ $item->menu->kategori }}</span></td>
                    <td>Rp {{ number_format((float)$item->menu->harga, 0, ',', '.') }}</td>
                    <td style="text-align:right;font-weight:600;color:var(--brown-700)">{{ $item->total_terjual }} porsi</td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:var(--text-light);padding:32px">Belum ada data penjualan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Panel Admin</p>
</div>
</body>
</html>
