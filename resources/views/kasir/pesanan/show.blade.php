<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $pesanan->id }} — Kasir Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-700:#6B3F22;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-300:#D4A574;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--brown-50:#FAF6F0;--cream:#FFFDF9;--text-light:#9B7550;}
        body{font-family:'Inter',sans-serif;background:var(--brown-50);color:var(--brown-900);}
        nav{background:var(--brown-800);display:flex;align-items:center;justify-content:space-between;padding:0 48px;height:64px;position:sticky;top:0;z-index:100;}
        .nav-logo{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-200);text-decoration:none;}
        .nav-link{font-size:13px;color:var(--brown-300);text-decoration:none;letter-spacing:1px;text-transform:uppercase;transition:color .2s;}
        .nav-link:hover{color:var(--cream);}

        .flash{max-width:760px;margin:16px auto 0;padding:0 32px;}
        .flash-success{background:#EAF3DE;border-left:3px solid #3B6D11;color:#3B6D11;padding:10px 16px;border-radius:2px;font-size:13px;}
        .flash-error{background:#FCEBEB;border-left:3px solid #A32D2D;color:#A32D2D;padding:10px 16px;border-radius:2px;font-size:13px;}

        .page-header{background:var(--brown-900);padding:40px 48px;}
        .page-eyebrow{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--brown-400);margin-bottom:8px;}
        .page-title{font-family:'Playfair Display',serif;font-size:32px;font-weight:700;color:var(--cream);}

        .main{max-width:760px;margin:40px auto;padding:0 32px;}

        .card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:28px;margin-bottom:20px;}
        .card-title{font-family:'Playfair Display',serif;font-size:18px;font-weight:600;color:var(--brown-900);margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--brown-100);}

        .badges{display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;}
        .badge{font-size:11px;font-weight:500;padding:5px 14px;border-radius:20px;letter-spacing:0.5px;}
        .badge-warning{background:#FAEEDA;color:#854F0B;}
        .badge-success{background:#EAF3DE;color:#3B6D11;}
        .badge-info{background:#E6F1FB;color:#185FA5;}
        .badge-danger{background:#FCEBEB;color:#A32D2D;}
        .badge-gray{background:var(--brown-100);color:var(--text-light);}

        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;}
        .info-label{font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--text-light);margin-bottom:4px;}
        .info-value{font-size:14px;font-weight:500;color:var(--brown-900);}

        .order-item{display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid var(--brown-50);}
        .order-item:last-child{border-bottom:none;}
        .order-item-name{font-size:14px;font-weight:500;color:var(--brown-900);}
        .order-item-qty{font-size:12px;color:var(--text-light);margin-top:2px;}
        .order-item-price{font-size:14px;font-weight:600;color:var(--brown-700);}
        .order-total{display:flex;justify-content:space-between;font-size:18px;font-weight:600;padding-top:16px;margin-top:8px;border-top:1px solid var(--brown-200);}
        .order-total span:last-child{font-family:'Playfair Display',serif;color:var(--brown-700);}

        .catatan-box{background:var(--brown-50);border:1px solid var(--brown-200);border-radius:4px;padding:12px 14px;font-size:13px;color:var(--brown-700);margin-top:12px;}

        .action-box{display:flex;flex-direction:column;gap:10px;}
        .btn-confirm{width:100%;background:#3B6D11;color:white;border:none;padding:13px;border-radius:2px;font-size:13px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;}
        .btn-confirm:hover{background:#2D5409;}
        .btn-struk{display:block;width:100%;text-align:center;background:var(--brown-800);color:var(--cream);padding:13px;border-radius:2px;font-size:13px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;text-decoration:none;transition:background .2s;}
        .btn-struk:hover{background:var(--brown-600);}
        .btn-status{width:100%;background:var(--brown-400);color:var(--cream);border:none;padding:13px;border-radius:2px;font-size:13px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;}
        .btn-status:hover{background:var(--brown-300);}

        .info-note{background:var(--brown-50);border:1px solid var(--brown-200);border-left:3px solid var(--brown-400);border-radius:4px;padding:13px 16px;font-size:13px;color:var(--brown-700);line-height:1.65;}

        .back-link{display:block;text-align:center;font-size:13px;color:var(--text-light);text-decoration:none;margin-top:12px;transition:color .2s;}
        .back-link:hover{color:var(--brown-700);}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;}.main{padding:0 20px;margin:24px auto;}.info-grid{grid-template-columns:1fr;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <a href="{{ route('kasir.dashboard') }}" class="nav-link">← Dashboard</a>
</nav>

@if(session('success') || session('error'))
<div class="flash">
    @if(session('success'))<div class="flash-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="flash-error">{{ session('error') }}</div>@endif
</div>
@endif

<div class="page-header">
    <div class="page-eyebrow">Panel Kasir</div>
    <h1 class="page-title">Detail Pesanan #{{ $pesanan->id }}</h1>
</div>

<div class="main">

    {{-- Status --}}
    <div class="card">
        <div class="badges">
            @php
                $statusClass = match($pesanan->status_pesanan) {
                    'selesai'    => 'badge-success',
                    'dibatalkan' => 'badge-danger',
                    'diproses'   => 'badge-info',
                    default      => 'badge-warning',
                };
            @endphp
            <span class="badge {{ $statusClass }}">{{ ucfirst($pesanan->status_pesanan) }}</span>
            <span class="badge {{ $pesanan->sudahBayar() ? 'badge-success' : 'badge-gray' }}">
                {{ $pesanan->sudahBayar() ? '✓ Sudah Bayar' : 'Belum Bayar' }}
            </span>
            <span class="badge badge-gray">{{ strtoupper($pesanan->metode_pembayaran) }}</span>
        </div>

        <div class="info-grid">
            <div>
                <div class="info-label">Pelanggan</div>
                <div class="info-value">{{ $pesanan->user->nama }}</div>
            </div>
            <div>
                <div class="info-label">Email</div>
                <div class="info-value">{{ $pesanan->user->email }}</div>
            </div>
            <div>
                <div class="info-label">Waktu Pesan</div>
                <div class="info-value">{{ $pesanan->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div>
                <div class="info-label">Metode Pembayaran</div>
                <div class="info-value">{{ strtoupper($pesanan->metode_pembayaran) }}</div>
            </div>
        </div>

        @if($pesanan->catatan)
        <div class="catatan-box">📝 {{ $pesanan->catatan }}</div>
        @endif
    </div>

    {{-- Item Pesanan --}}
    <div class="card">
        <div class="card-title">Item Pesanan</div>
        @foreach($pesanan->detailPesanans as $detail)
        <div class="order-item">
            <div>
                <div class="order-item-name">{{ $detail->menu->nama_menu }}</div>
                <div class="order-item-qty">{{ $detail->jumlah }} × Rp {{ number_format((float)$detail->harga, 0, ',', '.') }}</div>
            </div>
            <div class="order-item-price">Rp {{ number_format((float)$detail->subtotal, 0, ',', '.') }}</div>
        </div>
        @endforeach
        <div class="order-total">
            <span>Total</span>
            <span>{{ $pesanan->total_format }}</span>
        </div>
    </div>

    {{-- Aksi --}}
    <div class="card">
        <div class="card-title">Aksi Kasir</div>
        <div class="action-box">
            @if($pesanan->metode_pembayaran === 'cash' && ! $pesanan->sudahBayar())
                <form method="POST" action="{{ route('kasir.pesanan.konfirmasi', $pesanan) }}">
                    @csrf
                    <button type="submit" class="btn-confirm">✓ Konfirmasi Pembayaran Cash</button>
                </form>
            @endif

            @if($pesanan->status_pesanan === 'diproses')
                <form method="POST" action="{{ route('kasir.pesanan.status', $pesanan) }}">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status_pesanan" value="selesai">
                    <button type="submit" class="btn-status">Tandai Pesanan Selesai</button>
                </form>
            @endif

            @if($pesanan->sudahBayar())
                <a href="{{ route('kasir.struk.cetak', $pesanan) }}" class="btn-struk">🖨️ Cetak Struk</a>
            @endif

            @if(! $pesanan->sudahBayar() && $pesanan->metode_pembayaran === 'qris')
                <div class="info-note">
                    ℹ️ Pesanan ini menggunakan metode QRIS. Konfirmasi pembayaran dilakukan otomatis melalui Midtrans setelah pelanggan menyelesaikan pembayaran.
                </div>
            @endif
        </div>
    </div>

    <a href="{{ route('kasir.dashboard') }}" class="back-link">← Kembali ke Dashboard</a>
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Panel Kasir</p>
</div>
</body>
</html>
