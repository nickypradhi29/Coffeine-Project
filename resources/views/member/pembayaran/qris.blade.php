<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-300:#D4A574;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--cream:#FFFDF9;--text-light:#9B7550;}
        body{font-family:'Inter',sans-serif;background:var(--brown-100);min-height:100vh;display:flex;flex-direction:column;}
        nav{background:var(--brown-800);display:flex;align-items:center;justify-content:space-between;padding:0 48px;height:64px;}
        .nav-logo{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-200);text-decoration:none;}
        .nav-link{font-size:13px;color:var(--brown-300);text-decoration:none;letter-spacing:1px;text-transform:uppercase;}
        .nav-link:hover{color:var(--cream);}
        .main{max-width:520px;margin:48px auto;padding:0 24px;flex:1;}
        .card{background:var(--cream);border:1px solid var(--brown-200);border-radius:8px;overflow:hidden;}
        .card-header{background:var(--brown-900);padding:28px 32px;text-align:center;}
        .card-header-eyebrow{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--brown-400);margin-bottom:8px;}
        .card-header-title{font-family:'Playfair Display',serif;font-size:28px;font-weight:700;color:var(--cream);}
        .card-header-amount{font-size:22px;font-weight:600;color:var(--brown-300);margin-top:4px;}
        .card-body{padding:28px 32px;}
        .summary-row{display:flex;justify-content:space-between;font-size:13px;color:var(--text-light);margin-bottom:8px;}
        .summary-row:last-child{font-weight:600;color:var(--brown-800);border-top:1px solid var(--brown-200);padding-top:10px;margin-top:6px;}
        .info-note{background:var(--brown-100);border:1px solid var(--brown-200);border-left:3px solid var(--brown-400);border-radius:4px;padding:14px 16px;font-size:13px;color:var(--brown-700);line-height:1.65;margin-bottom:20px;}
        .pay-btn{display:block;width:100%;background:var(--brown-800);color:var(--cream);border:none;padding:14px;border-radius:4px;font-size:14px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;text-align:center;text-decoration:none;margin-bottom:12px;}
        .pay-btn:hover{background:var(--brown-600);}
        .back-link{display:block;text-align:center;font-size:13px;color:var(--text-light);text-decoration:none;margin-top:14px;}
        .back-link:hover{color:var(--brown-700);}
        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:auto;}
        .footer-copy{font-size:12px;color:var(--brown-600);}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <a href="{{ route('member.pesanan.show', $pesanan) }}" class="nav-link">← Detail Pesanan</a>
</nav>

<div class="main">
    <div class="card">
        <div class="card-header">
            <div class="card-header-eyebrow">Pembayaran Online</div>
            <div class="card-header-title">Pesanan #{{ $pesanan->id }}</div>
            <div class="card-header-amount">{{ $pesanan->total_format }}</div>
        </div>
        <div class="card-body">

            {{-- Ringkasan --}}
            <div style="margin-bottom:20px">
                @foreach($pesanan->detailPesanans as $detail)
                <div class="summary-row">
                    <span>{{ $detail->menu->nama_menu }} ×{{ $detail->jumlah }}</span>
                    <span>Rp {{ number_format((float)$detail->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <div class="summary-row">
                    <span>Total</span>
                    <span>{{ $pesanan->total_format }}</span>
                </div>
            </div>

            <div class="info-note">
                ℹ️ Kamu akan diarahkan ke halaman pembayaran Midtrans. Tersedia berbagai metode pembayaran seperti transfer bank, e-wallet, kartu kredit, dan lainnya.
            </div>

            {{-- Tombol bayar → langsung redirect --}}
            <a href="{{ route('member.pembayaran.qris', $pesanan) }}" class="pay-btn">
                Lanjutkan ke Pembayaran →
            </a>

            <a href="{{ route('member.pesanan.show', $pesanan) }}" class="back-link">
                ← Kembali ke detail pesanan
            </a>
        </div>
    </div>
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Nikmati kopi terbaikmu.</p>
</div>

</body>
</html>