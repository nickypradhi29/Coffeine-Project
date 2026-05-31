<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-700:#6B3F22;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-300:#D4A574;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--brown-50:#FAF6F0;--cream:#FFFDF9;--text-light:#9B7550;}
        body{font-family:'Inter',sans-serif;background:var(--brown-50);color:var(--brown-900);min-height:100vh;display:flex;flex-direction:column;}
        nav{background:var(--brown-800);display:flex;align-items:center;justify-content:space-between;padding:0 48px;height:64px;}
        .nav-logo{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-200);text-decoration:none;}
        .nav-link{font-size:13px;color:var(--brown-300);text-decoration:none;letter-spacing:1px;text-transform:uppercase;}
        .nav-link:hover{color:var(--cream);}

        .main{max-width:560px;margin:48px auto;padding:0 24px;flex:1;}
        .card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;overflow:hidden;}

        .card-header{background:var(--brown-900);padding:28px 32px;text-align:center;}
        .card-header-eyebrow{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--brown-400);margin-bottom:8px;}
        .card-header-title{font-family:'Playfair Display',serif;font-size:28px;font-weight:700;color:var(--cream);}
        .card-header-amount{font-size:22px;font-weight:600;color:var(--brown-300);margin-top:4px;}

        .card-body{padding:28px 32px;}

        .order-summary{background:var(--brown-50);border-radius:4px;padding:16px;margin-bottom:24px;}
        .summary-title{font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--text-light);margin-bottom:12px;}
        .summary-row{display:flex;justify-content:space-between;font-size:13px;color:var(--brown-800);margin-bottom:6px;}
        .summary-row:last-child{margin-bottom:0;font-weight:600;border-top:1px solid var(--brown-200);padding-top:10px;margin-top:6px;}

        .pay-btn{display:block;width:100%;background:var(--brown-800);color:var(--cream);border:none;padding:15px;border-radius:2px;font-size:14px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;text-align:center;text-decoration:none;margin-bottom:12px;}
        .pay-btn:hover{background:var(--brown-600);}

        .snap-btn{display:block;width:100%;background:var(--brown-400);color:var(--cream);border:none;padding:15px;border-radius:2px;font-size:14px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;text-align:center;margin-bottom:20px;}
        .snap-btn:hover{background:var(--brown-300);}

        .divider{display:flex;align-items:center;gap:12px;margin-bottom:20px;}
        .divider-line{flex:1;height:1px;background:var(--brown-100);}
        .divider-text{font-size:12px;color:var(--text-light);letter-spacing:1px;text-transform:uppercase;}

        .info-note{background:var(--brown-50);border:1px solid var(--brown-200);border-left:3px solid var(--brown-400);border-radius:4px;padding:14px 16px;font-size:13px;color:var(--brown-700);line-height:1.65;margin-bottom:20px;}

        .back-link{display:block;text-align:center;font-size:13px;color:var(--text-light);text-decoration:none;transition:color .2s;}
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
            <div class="card-header-eyebrow">Pembayaran</div>
            <div class="card-header-title">QRIS / Online</div>
            <div class="card-header-amount">{{ $pesanan->total_format }}</div>
        </div>
        <div class="card-body">

            {{-- Ringkasan pesanan --}}
            <div class="order-summary">
                <div class="summary-title">Ringkasan Pesanan #{{ $pesanan->id }}</div>
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

            @if($pembayaran->payment_url)
                {{-- Tombol ke Midtrans --}}
                <a href="{{ $pembayaran->payment_url }}" target="_blank" class="pay-btn">
                    Buka Halaman Pembayaran Midtrans →
                </a>

                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">atau</div>
                    <div class="divider-line"></div>
                </div>

                {{-- Snap inline --}}
                <button id="snap-btn" class="snap-btn">
                    Bayar Langsung di Sini (Snap)
                </button>
            @else
                <div class="info-note">
                    ⚠️ Gagal membuat link pembayaran. Silakan hubungi kasir untuk melakukan pembayaran secara langsung.
                </div>
            @endif

            <div class="info-note">
                ℹ️ Setelah pembayaran berhasil, status pesanan akan otomatis diperbarui dalam beberapa saat. Simpan bukti pembayaran kamu.
            </div>

            <a href="{{ route('member.pesanan.show', $pesanan) }}" class="back-link">← Kembali ke detail pesanan</a>
        </div>
    </div>
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Nikmati kopi terbaikmu.</p>
</div>

@if($pembayaran->snap_token)
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('snap-btn')?.addEventListener('click', function () {
        snap.pay('{{ $pembayaran->snap_token }}', {
            onSuccess: function (result) {
                window.location.href = '{{ route('member.pesanan.show', $pesanan) }}';
            },
            onPending: function (result) {
                alert('Pembayaran pending. Cek kembali nanti.');
            },
            onError: function (result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
            },
            onClose: function () {
                // user menutup popup tanpa bayar
            }
        });
    });
</script>
@endif
</body>
</html>
