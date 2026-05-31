<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir — Coffeineé</title>
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
        .nav-link:hover{color:var(--cream);}
        .nav-role{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--brown-400);background:rgba(196,124,62,.15);padding:4px 10px;border-radius:20px;}

        .flash{max-width:1200px;margin:16px auto 0;padding:0 32px;}
        .flash-success{background:#EAF3DE;border-left:3px solid #3B6D11;color:#3B6D11;padding:10px 16px;border-radius:2px;font-size:13px;}

        .page-header{background:var(--brown-900);padding:40px 48px;display:flex;align-items:flex-end;justify-content:space-between;}
        .page-title{font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:var(--cream);}
        .page-sub{font-size:13px;color:var(--brown-300);margin-top:6px;}
        .header-btn{background:var(--brown-400);color:var(--cream);padding:10px 20px;border-radius:2px;text-decoration:none;font-size:12px;font-weight:500;letter-spacing:1px;text-transform:uppercase;transition:background .2s;}
        .header-btn:hover{background:var(--brown-300);}

        .main{max-width:1200px;margin:0 auto;padding:36px 32px;}

        /* Stats strip */
        .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:32px;}
        .stat-card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:20px 24px;}
        .stat-label{font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--text-light);margin-bottom:6px;}
        .stat-val{font-family:'Playfair Display',serif;font-size:28px;font-weight:600;color:var(--brown-800);}
        .stat-sub{font-size:12px;color:var(--text-light);margin-top:3px;}

        .section-title{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-900);margin-bottom:16px;}

        /* Pesanan cards */
        .pesanan-list{display:flex;flex-direction:column;gap:14px;}
        .pesanan-card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:20px 24px;transition:box-shadow .2s;}
        .pesanan-card:hover{box-shadow:0 4px 16px rgba(44,26,14,.08);}
        .pesanan-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:14px;}
        .pesanan-id{font-family:'Playfair Display',serif;font-size:17px;font-weight:600;color:var(--brown-900);}
        .pesanan-meta{font-size:12px;color:var(--text-light);margin-top:3px;}
        .pesanan-right{text-align:right;}
        .pesanan-total{font-family:'Playfair Display',serif;font-size:18px;font-weight:600;color:var(--brown-700);}
        .pesanan-method{font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;margin-top:4px;}
        .method-cash{color:#185FA5;}
        .method-qris{color:#3B6D11;}

        .pesanan-items{font-size:13px;color:var(--text-light);margin-bottom:14px;line-height:1.8;background:var(--brown-50);border-radius:4px;padding:10px 14px;}
        .pesanan-catatan{font-size:12px;color:var(--brown-600);background:#FAEEDA;border-radius:4px;padding:8px 12px;margin-bottom:14px;}

        .pesanan-actions{display:flex;gap:8px;flex-wrap:wrap;}
        .btn-detail{font-size:12px;padding:8px 16px;border-radius:2px;border:1px solid var(--brown-200);background:transparent;color:var(--brown-700);cursor:pointer;font-family:'Inter',sans-serif;letter-spacing:0.5px;text-decoration:none;transition:all .2s;}
        .btn-detail:hover{border-color:var(--brown-400);color:var(--brown-900);}
        .btn-confirm{font-size:12px;padding:8px 16px;border-radius:2px;border:none;background:#3B6D11;color:white;cursor:pointer;font-family:'Inter',sans-serif;letter-spacing:0.5px;transition:background .2s;}
        .btn-confirm:hover{background:#2D5409;}
        .btn-done{font-size:12px;padding:8px 16px;border-radius:2px;border:none;background:var(--brown-800);color:white;cursor:pointer;font-family:'Inter',sans-serif;letter-spacing:0.5px;transition:background .2s;}
        .btn-done:hover{background:var(--brown-600);}
        .btn-struk{font-size:12px;padding:8px 16px;border-radius:2px;border:none;background:var(--brown-400);color:white;cursor:pointer;font-family:'Inter',sans-serif;letter-spacing:0.5px;text-decoration:none;transition:background .2s;}
        .btn-struk:hover{background:var(--brown-300);}

        .badge{font-size:10px;font-weight:500;padding:3px 10px;border-radius:20px;letter-spacing:0.5px;display:inline-block;}
        .badge-warning{background:#FAEEDA;color:#854F0B;}
        .badge-info{background:#E6F1FB;color:#185FA5;}
        .badge-success{background:#EAF3DE;color:#3B6D11;}

        .empty{text-align:center;padding:80px 0;background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;}
        .empty-icon{font-size:48px;margin-bottom:12px;}
        .empty-text{font-size:15px;color:var(--text-light);}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;flex-direction:column;gap:16px;align-items:flex-start;}.main{padding:24px 20px;}.stats{grid-template-columns:1fr;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <span class="nav-role">Kasir</span>
        <a href="{{ route('kasir.menu.index') }}" class="nav-link">Kelola Stok</a>
        <a href="{{ route('member.menu') }}" class="nav-link">Menu</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button style="background:none;border:none;cursor:pointer;font-size:12px;color:var(--brown-300);letter-spacing:1px;text-transform:uppercase;font-family:inherit;" type="submit">Keluar</button>
        </form>
    </div>
</nav>

@if(session('success'))
<div class="flash"><div class="flash-success">{{ session('success') }}</div></div>
@endif

<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard Kasir</h1>
        <p class="page-sub">{{ now()->format('l, d F Y') }}</p>
    </div>
    <a href="{{ route('kasir.menu.index') }}" class="header-btn">📋 Kelola Stok Menu</a>
</div>

<div class="main">

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card">
            <div class="stat-label">Menunggu Konfirmasi</div>
            <div class="stat-val">{{ $pesananMasuk->where('status_pesanan', 'menunggu')->count() }}</div>
            <div class="stat-sub">Pesanan cash belum dikonfirmasi</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Sedang Diproses</div>
            <div class="stat-val">{{ $pesananMasuk->where('status_pesanan', 'diproses')->count() }}</div>
            <div class="stat-sub">Pesanan sedang dibuat</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Pesanan Aktif</div>
            <div class="stat-val">{{ $pesananMasuk->count() }}</div>
            <div class="stat-sub">Menunggu + Diproses</div>
        </div>
    </div>

    {{-- Pesanan List --}}
    <div class="section-title">Pesanan Masuk</div>

    @if($pesananMasuk->isEmpty())
        <div class="empty">
            <div class="empty-icon">✅</div>
            <div class="empty-text">Tidak ada pesanan aktif saat ini.</div>
        </div>
    @else
        <div class="pesanan-list">
            @foreach($pesananMasuk as $pesanan)
            <div class="pesanan-card">
                <div class="pesanan-top">
                    <div>
                        <div class="pesanan-id">
                            Pesanan #{{ $pesanan->id }}
                            <span class="badge {{ $pesanan->status_pesanan === 'diproses' ? 'badge-info' : 'badge-warning' }}">
                                {{ ucfirst($pesanan->status_pesanan) }}
                            </span>
                        </div>
                        <div class="pesanan-meta">{{ $pesanan->user->nama }} · {{ $pesanan->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="pesanan-right">
                        <div class="pesanan-total">{{ $pesanan->total_format }}</div>
                        <div class="pesanan-method {{ $pesanan->metode_pembayaran === 'cash' ? 'method-cash' : 'method-qris' }}">
                            {{ strtoupper($pesanan->metode_pembayaran) }}
                        </div>
                    </div>
                </div>

                <div class="pesanan-items">
                    @foreach($pesanan->detailPesanans as $detail)
                        • {{ $detail->menu->nama_menu }} ×{{ $detail->jumlah }}<br>
                    @endforeach
                </div>

                @if($pesanan->catatan)
                <div class="pesanan-catatan">📝 {{ $pesanan->catatan }}</div>
                @endif

                <div class="pesanan-actions">
                    <a href="{{ route('kasir.pesanan.show', $pesanan) }}" class="btn-detail">Detail</a>

                    @if($pesanan->metode_pembayaran === 'cash' && ! $pesanan->sudahBayar())
                        <form method="POST" action="{{ route('kasir.pesanan.konfirmasi', $pesanan) }}">
                            @csrf
                            <button type="submit" class="btn-confirm">✓ Konfirmasi Cash</button>
                        </form>
                    @endif

                    @if($pesanan->status_pesanan === 'diproses')
                        <form method="POST" action="{{ route('kasir.pesanan.status', $pesanan) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status_pesanan" value="selesai">
                            <button type="submit" class="btn-done">Tandai Selesai</button>
                        </form>
                    @endif

                    @if($pesanan->sudahBayar())
                        <a href="{{ route('kasir.struk.cetak', $pesanan) }}" class="btn-struk">🖨️ Cetak Struk</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Panel Kasir</p>
</div>
</body>
</html>
