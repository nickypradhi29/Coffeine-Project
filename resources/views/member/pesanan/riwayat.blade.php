<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-700:#6B3F22;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-300:#D4A574;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--brown-50:#FAF6F0;--cream:#FFFDF9;--text-light:#9B7550;}
        body{font-family:'Inter',sans-serif;background:var(--brown-50);color:var(--brown-900);}
        nav{background:var(--brown-800);display:flex;align-items:center;justify-content:space-between;padding:0 48px;height:64px;position:sticky;top:0;z-index:100;}
        .nav-logo{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-200);text-decoration:none;}
        .nav-links{display:flex;align-items:center;gap:24px;}
        .nav-link{font-size:13px;color:var(--brown-300);text-decoration:none;letter-spacing:1px;text-transform:uppercase;transition:color .2s;}
        .nav-link:hover{color:var(--cream);}
        .nav-cta{background:var(--brown-400);color:var(--cream);padding:8px 18px;border-radius:2px;text-decoration:none;font-size:12px;font-weight:500;letter-spacing:1px;text-transform:uppercase;transition:background .2s;}
        .nav-cta:hover{background:var(--brown-300);}

        .page-header{background:var(--brown-900);padding:40px 48px;}
        .page-eyebrow{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--brown-400);margin-bottom:8px;}
        .page-title{font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:var(--cream);}

        .main{max-width:900px;margin:40px auto;padding:0 32px;}

        .riwayat-list{display:flex;flex-direction:column;gap:12px;}
        .riwayat-item{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:20px 24px;display:grid;grid-template-columns:1fr auto;gap:16px;align-items:center;text-decoration:none;color:inherit;transition:transform .2s,box-shadow .2s;}
        .riwayat-item:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(44,26,14,.1);}
        .riwayat-left{}
        .riwayat-id{font-family:'Playfair Display',serif;font-size:17px;font-weight:600;color:var(--brown-900);margin-bottom:4px;}
        .riwayat-meta{font-size:12px;color:var(--text-light);margin-bottom:10px;}
        .riwayat-items-preview{font-size:12px;color:var(--text-light);}
        .riwayat-right{text-align:right;display:flex;flex-direction:column;align-items:flex-end;gap:8px;}
        .riwayat-total{font-family:'Playfair Display',serif;font-size:18px;font-weight:600;color:var(--brown-700);}
        .badge{font-size:11px;font-weight:500;padding:4px 12px;border-radius:20px;letter-spacing:0.5px;}
        .badge-warning{background:#FAEEDA;color:#854F0B;}
        .badge-success{background:#EAF3DE;color:#3B6D11;}
        .badge-danger{background:#FCEBEB;color:#A32D2D;}
        .badge-info{background:#E6F1FB;color:#185FA5;}

        .empty{text-align:center;padding:80px 0;background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;}
        .empty-icon{font-size:52px;margin-bottom:12px;}
        .empty-text{font-size:15px;color:var(--text-light);margin-bottom:20px;}
        .empty-btn{display:inline-block;background:var(--brown-800);color:var(--cream);padding:10px 24px;border-radius:2px;font-size:13px;letter-spacing:1px;text-transform:uppercase;text-decoration:none;transition:background .2s;}
        .empty-btn:hover{background:var(--brown-600);}

        .pagination-wrap{margin-top:24px;display:flex;justify-content:center;}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;}.main{padding:0 20px;margin:24px auto;}.riwayat-item{grid-template-columns:1fr;}.riwayat-right{align-items:flex-start;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <a href="{{ route('member.menu') }}" class="nav-link">Menu</a>
        <a href="{{ route('member.keranjang') }}" class="nav-cta">🛒 Keranjang</a>
         <span class="nav-link" style="color:var(--brown-200)">{{ auth()->user()->nama }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;font-size:12px;color:var(--brown-300);letter-spacing:1px;text-transform:uppercase;font-family:'Inter',sans-serif;transition:color .2s;"
                onmouseover="this.style.color='#FFFDF9'"
                onmouseout="this.style.color='#D4A574'">
                Keluar
            </button>
        </form>
    </div>
</nav>

<div class="page-header">
    <div class="page-eyebrow">Akun Saya</div>
    <h1 class="page-title">Riwayat Pesanan</h1>
</div>

<div class="main">
    @forelse($pesanans as $pesanan)
    <div class="riwayat-list">
        <a href="{{ route('member.pesanan.show', $pesanan) }}" class="riwayat-item">
            <div class="riwayat-left">
                <div class="riwayat-id">Pesanan #{{ $pesanan->id }}</div>
                <div class="riwayat-meta">
                    {{ $pesanan->created_at->format('d M Y, H:i') }} &nbsp;·&nbsp;
                    {{ $pesanan->detailPesanans->count() }} item &nbsp;·&nbsp;
                    {{ strtoupper($pesanan->metode_pembayaran) }}
                </div>
                <div class="riwayat-items-preview">
                    {{ $pesanan->detailPesanans->take(2)->pluck('menu.nama_menu')->join(', ') }}
                    @if($pesanan->detailPesanans->count() > 2)
                        & {{ $pesanan->detailPesanans->count() - 2 }} lainnya
                    @endif
                </div>
            </div>
            <div class="riwayat-right">
                <div class="riwayat-total">{{ $pesanan->total_format }}</div>
                @php
                    $badgeClass = match($pesanan->status_pesanan) {
                        'selesai'    => 'badge-success',
                        'dibatalkan' => 'badge-danger',
                        'diproses'   => 'badge-info',
                        default      => 'badge-warning',
                    };
                @endphp
                <span class="badge {{ $badgeClass }}">{{ ucfirst($pesanan->status_pesanan) }}</span>
            </div>
        </a>
    </div>
    @empty
    <div class="empty">
        <div class="empty-icon">📋</div>
        <div class="empty-text">Belum ada pesanan. Yuk pesan kopi pertamamu!</div>
        <a href="{{ route('member.menu') }}" class="empty-btn">Lihat Menu</a>
    </div>
    @endforelse

    @if($pesanans->hasPages())
    <div class="pagination-wrap">{{ $pesanans->links() }}</div>
    @endif
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Nikmati kopi terbaikmu.</p>
</div>
</body>
</html>
