<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan — Admin Coffeineé</title>
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
        .page-title{font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:var(--cream);}
        .page-sub{font-size:13px;color:var(--brown-300);margin-top:6px;}

        .main{max-width:1200px;margin:0 auto;padding:36px 32px;}

        /* Filter */
        .filter-card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:20px 24px;margin-bottom:24px;display:flex;align-items:flex-end;gap:16px;flex-wrap:wrap;}
        .filter-group{display:flex;flex-direction:column;gap:6px;}
        .filter-label{font-size:11px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:var(--text-light);}
        .filter-input{border:1px solid var(--brown-200);border-radius:4px;padding:9px 14px;font-size:13px;font-family:'Inter',sans-serif;background:var(--cream);color:var(--brown-900);transition:border-color .2s;}
        .filter-input:focus{outline:none;border-color:var(--brown-400);}
        .filter-btn{background:var(--brown-800);color:var(--cream);border:none;padding:9px 22px;border-radius:2px;font-size:12px;font-weight:500;letter-spacing:1px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;}
        .filter-btn:hover{background:var(--brown-600);}

        /* Stats */
        .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;}
        .stat-card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:20px 24px;}
        .stat-label{font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--text-light);margin-bottom:6px;}
        .stat-val{font-family:'Playfair Display',serif;font-size:26px;font-weight:600;color:var(--brown-800);}
        .stat-sub{font-size:12px;color:var(--text-light);margin-top:3px;}

        /* Table */
        .tbl-wrap{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;overflow:hidden;}
        .tbl{width:100%;border-collapse:collapse;}
        .tbl thead{background:var(--brown-900);}
        .tbl th{text-align:left;padding:13px 16px;font-size:11px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:var(--brown-300);}
        .tbl td{padding:13px 16px;font-size:13px;color:var(--brown-900);border-top:1px solid var(--brown-50);vertical-align:middle;}
        .tbl tbody tr:hover{background:var(--brown-50);}

        .badge{font-size:10px;font-weight:500;padding:3px 10px;border-radius:20px;letter-spacing:0.5px;}
        .badge-qris{background:#EAF3DE;color:#3B6D11;}
        .badge-cash{background:#E6F1FB;color:#185FA5;}

        .detail-items{font-size:11px;color:var(--text-light);margin-top:3px;}

        .empty-row td{text-align:center;color:var(--text-light);padding:48px;}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;}.main{padding:24px 20px;}.stats{grid-template-columns:1fr;}.filter-card{flex-direction:column;align-items:stretch;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <span class="nav-role">Admin</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('admin.menu.index') }}" class="nav-link">Menu</a>
        <a href="{{ route('admin.laporan.index') }}" class="nav-link active">Laporan</a>
        <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
    </div>
</nav>

<div class="page-header">
    <h1 class="page-title">Laporan Penjualan</h1>
    <p class="page-sub">Data transaksi yang sudah lunas</p>
</div>

<div class="main">

    {{-- Filter --}}
    <form method="GET" class="filter-card">
        <div class="filter-group">
            <label class="filter-label">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ $dari }}" class="filter-input">
        </div>
        <div class="filter-group">
            <label class="filter-label">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ $sampai }}" class="filter-input">
        </div>
        <button type="submit" class="filter-btn">Terapkan Filter</button>
    </form>

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-val">{{ $totalTransaksi }}</div>
            <div class="stat-sub">Dalam rentang tanggal ini</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-val" style="font-size:20px">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <div class="stat-sub">Semua metode pembayaran</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Rata-rata / Transaksi</div>
            <div class="stat-val" style="font-size:20px">
                Rp {{ $totalTransaksi > 0 ? number_format($totalPendapatan / $totalTransaksi, 0, ',', '.') : '0' }}
            </div>
            <div class="stat-sub">Nilai rata-rata pesanan</div>
        </div>
    </div>

    {{-- Table --}}
    <div class="tbl-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelanggan</th>
                    <th>Item</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                    <th style="text-align:right">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans as $pesanan)
                <tr>
                    <td style="color:var(--text-light);font-weight:500">#{{ $pesanan->id }}</td>
                    <td style="font-weight:600">{{ $pesanan->user->nama }}</td>
                    <td>
                        <div>{{ $pesanan->detailPesanans->count() }} item</div>
                        <div class="detail-items">
                            {{ $pesanan->detailPesanans->take(2)->map(fn($d) => $d->menu->nama_menu)->join(', ') }}
                            @if($pesanan->detailPesanans->count() > 2)
                                & {{ $pesanan->detailPesanans->count() - 2 }} lainnya
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $pesanan->metode_pembayaran === 'qris' ? 'badge-qris' : 'badge-cash' }}">
                            {{ strtoupper($pesanan->metode_pembayaran) }}
                        </span>
                    </td>
                    <td style="color:var(--text-light)">{{ $pesanan->created_at->format('d M Y, H:i') }}</td>
                    <td style="text-align:right;font-weight:600;font-family:'Playfair Display',serif;color:var(--brown-700)">
                        {{ $pesanan->total_format }}
                    </td>
                </tr>
                @empty
                <tr class="empty-row">
                    <td colspan="6">Tidak ada transaksi dalam rentang tanggal ini.</td>
                </tr>
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
