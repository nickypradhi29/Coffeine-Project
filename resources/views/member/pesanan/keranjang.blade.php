<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --brown-900:#2C1A0E; --brown-800:#4A2C1A; --brown-700:#6B3F22;
            --brown-600:#8B5A2B; --brown-400:#C47C3E; --brown-300:#D4A574;
            --brown-200:#E8D5B7; --brown-100:#F5EDE0; --brown-50:#FAF6F0;
            --cream:#FFFDF9; --text-light:#9B7550;
        }
        body { font-family:'Inter',sans-serif; background:var(--brown-50); color:var(--brown-900); min-height:100vh; }

        nav { background:var(--brown-800); display:flex; align-items:center; justify-content:space-between; padding:0 48px; height:64px; position:sticky; top:0; z-index:100; }
        .nav-logo { font-family:'Playfair Display',serif; font-size:22px; font-weight:600; color:var(--brown-200); text-decoration:none; }
        .nav-links { display:flex; align-items:center; gap:24px; }
        .nav-link { font-size:13px; color:var(--brown-300); text-decoration:none; letter-spacing:1px; text-transform:uppercase; transition:color .2s; }
        .nav-link:hover { color:var(--cream); }

        .flash { max-width:1100px; margin:16px auto 0; padding:0 32px; }
        .flash-success { background:#EAF3DE; border-left:3px solid #3B6D11; color:#3B6D11; padding:10px 16px; border-radius:2px; font-size:13px; margin-bottom:8px; }
        .flash-error { background:#FCEBEB; border-left:3px solid #A32D2D; color:#A32D2D; padding:10px 16px; border-radius:2px; font-size:13px; margin-bottom:8px; }

        .page-header { background:var(--brown-900); padding:40px 48px; }
        .page-eyebrow { font-size:11px; letter-spacing:3px; text-transform:uppercase; color:var(--brown-400); margin-bottom:8px; }
        .page-title { font-family:'Playfair Display',serif; font-size:36px; font-weight:700; color:var(--cream); }

        .main { max-width:1100px; margin:0 auto; padding:40px 32px; display:grid; grid-template-columns:1fr 340px; gap:28px; align-items:start; }

        /* ── CART ITEMS ── */
        .cart-section-title { font-family:'Playfair Display',serif; font-size:20px; font-weight:600; color:var(--brown-900); margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid var(--brown-200); }
        .cart-items { display:flex; flex-direction:column; gap:12px; }
        .cart-item { background:var(--cream); border:1px solid var(--brown-100); border-radius:6px; padding:16px 18px; display:grid; grid-template-columns:80px 1fr auto; gap:16px; align-items:center; transition:box-shadow .2s; }
        .cart-item:hover { box-shadow:0 4px 16px rgba(44,26,14,.08); }
        .cart-item-img { width:80px; height:80px; border-radius:4px; background:var(--brown-100); overflow:hidden; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:32px; }
        .cart-item-img img { width:100%; height:100%; object-fit:cover; }
        .cart-item-info {}
        .cart-item-name { font-family:'Playfair Display',serif; font-size:16px; font-weight:600; color:var(--brown-900); margin-bottom:4px; }
        .cart-item-meta { font-size:12px; color:var(--text-light); margin-bottom:10px; }
        .cart-item-del { background:none; border:none; color:#A32D2D; font-size:12px; letter-spacing:1px; text-transform:uppercase; cursor:pointer; font-family:'Inter',sans-serif; padding:0; transition:opacity .2s; }
        .cart-item-del:hover { opacity:.7; }
        .cart-item-right { text-align:right; }
        .cart-item-subtotal { font-size:16px; font-weight:600; color:var(--brown-700); font-family:'Playfair Display',serif; white-space:nowrap; }

        .cart-empty { text-align:center; padding:80px 0; background:var(--cream); border:1px solid var(--brown-100); border-radius:6px; }
        .cart-empty-icon { font-size:52px; margin-bottom:12px; }
        .cart-empty-text { font-size:15px; color:var(--text-light); margin-bottom:20px; }
        .back-menu-btn { display:inline-block; background:var(--brown-800); color:var(--cream); padding:10px 24px; border-radius:2px; font-size:13px; letter-spacing:1px; text-transform:uppercase; text-decoration:none; transition:background .2s; }
        .back-menu-btn:hover { background:var(--brown-600); }

        /* ── CHECKOUT CARD ── */
        .checkout-card { background:var(--cream); border:1px solid var(--brown-100); border-radius:6px; padding:24px; position:sticky; top:80px; }
        .checkout-title { font-family:'Playfair Display',serif; font-size:20px; font-weight:600; color:var(--brown-900); margin-bottom:20px; padding-bottom:12px; border-bottom:1px solid var(--brown-200); }
        .summary-rows { margin-bottom:16px; }
        .summary-row { display:flex; justify-content:space-between; font-size:13px; color:var(--text-light); margin-bottom:8px; }
        .summary-row span:last-child { font-weight:500; color:var(--brown-800); }
        .summary-total { display:flex; justify-content:space-between; font-size:16px; font-weight:600; border-top:1px solid var(--brown-200); padding-top:14px; margin-bottom:24px; }
        .summary-total span:last-child { font-family:'Playfair Display',serif; color:var(--brown-700); font-size:18px; }

        .payment-label { font-size:11px; font-weight:500; letter-spacing:2px; text-transform:uppercase; color:var(--text-light); margin-bottom:10px; }
        .payment-options { display:flex; flex-direction:column; gap:8px; margin-bottom:16px; }
        .payment-opt { border:1px solid var(--brown-200); border-radius:4px; padding:12px 14px; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:12px; }
        .payment-opt:hover { border-color:var(--brown-400); }
        .payment-opt input[type=radio] { accent-color:var(--brown-600); width:15px; height:15px; flex-shrink:0; }
        .payment-opt.selected { border-color:var(--brown-600); background:var(--brown-50); }
        .payment-opt-info {}
        .payment-opt-title { font-size:13px; font-weight:600; color:var(--brown-900); }
        .payment-opt-sub { font-size:11px; color:var(--text-light); margin-top:2px; }

        .catatan-label { font-size:11px; font-weight:500; letter-spacing:2px; text-transform:uppercase; color:var(--text-light); margin-bottom:8px; display:block; }
        .catatan-input { width:100%; border:1px solid var(--brown-200); border-radius:4px; padding:10px 12px; font-size:13px; font-family:'Inter',sans-serif; background:var(--cream); color:var(--brown-900); resize:none; transition:border-color .2s; margin-bottom:16px; }
        .catatan-input:focus { outline:none; border-color:var(--brown-400); }
        .catatan-input::placeholder { color:var(--brown-300); }

        .order-btn { width:100%; background:var(--brown-800); color:var(--cream); border:none; padding:13px; border-radius:2px; font-size:13px; font-weight:500; letter-spacing:1.5px; text-transform:uppercase; cursor:pointer; font-family:'Inter',sans-serif; transition:background .2s; }
        .order-btn:hover { background:var(--brown-600); }

        .continue-link { display:block; text-align:center; font-size:12px; color:var(--text-light); text-decoration:none; margin-top:12px; transition:color .2s; }
        .continue-link:hover { color:var(--brown-700); }

        .page-footer { background:var(--brown-900); padding:24px 48px; text-align:center; margin-top:48px; }
        .footer-copy { font-size:12px; color:var(--brown-600); }

        @media (max-width:768px) {
            nav { padding:0 20px; }
            .page-header { padding:32px 20px; }
            .main { grid-template-columns:1fr; padding:24px 20px; }
            .checkout-card { position:static; }
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <a href="{{ route('member.menu') }}" class="nav-link">← Menu</a>
        <a href="{{ route('member.riwayat') }}" class="nav-link">Riwayat</a>
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

@if(session('success') || session('error'))
<div class="flash">
    @if(session('success'))<div class="flash-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="flash-error">{{ session('error') }}</div>@endif
</div>
@endif

<div class="page-header">
    <div class="page-eyebrow">Checkout</div>
    <h1 class="page-title">Keranjang Kamu</h1>
</div>

<div class="main">
    {{-- KIRI: Item List --}}
    <div>
        <div class="cart-section-title">Item Pesanan</div>

        @if(empty($keranjang))
            <div class="cart-empty">
                <div class="cart-empty-icon">🛒</div>
                <div class="cart-empty-text">Keranjangmu masih kosong.</div>
                <a href="{{ route('member.menu') }}" class="back-menu-btn">Lihat Menu</a>
            </div>
        @else
            <div class="cart-items">
                @foreach($keranjang as $key => $item)
                <div class="cart-item">
                    <div class="cart-item-img">
                        @if(isset($item['gambar']) && $item['gambar'])
                            <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama_menu'] }}">
                        @else
                            ☕
                        @endif
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">{{ $item['nama_menu'] }}</div>
                        <div class="cart-item-meta">{{ $item['jumlah'] }} × Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                        <form method="POST" action="{{ route('member.keranjang.hapus', $key) }}">
                            @csrf @method('DELETE')
                            <button class="cart-item-del" type="submit">Hapus</button>
                        </form>
                    </div>
                    <div class="cart-item-right">
                        <div class="cart-item-subtotal">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- KANAN: Checkout Form --}}
    @if(!empty($keranjang))
    <div>
        <div class="checkout-card">
            <div class="checkout-title">Ringkasan Pesanan</div>

            <div class="summary-rows">
                @foreach($keranjang as $item)
                <div class="summary-row">
                    <span>{{ $item['nama_menu'] }} ×{{ $item['jumlah'] }}</span>
                    <span>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <div class="summary-total">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <form method="POST" action="{{ route('member.checkout') }}">
                @csrf

                <div class="payment-label">Metode Pembayaran</div>
                <div class="payment-options">
                    <label class="payment-opt" id="opt-qris">
                        <input type="radio" name="metode_pembayaran" value="qris" required onchange="selectPayment('qris')">
                        <div class="payment-opt-info">
                            <div class="payment-opt-title">QRIS / Online</div>
                            <div class="payment-opt-sub">Bayar via Midtrans</div>
                        </div>
                    </label>
                    <label class="payment-opt" id="opt-cash">
                        <input type="radio" name="metode_pembayaran" value="cash" onchange="selectPayment('cash')">
                        <div class="payment-opt-info">
                            <div class="payment-opt-title">Bayar di Kasir</div>
                            <div class="payment-opt-sub">Bayar langsung saat pickup</div>
                        </div>
                    </label>
                </div>

                <label class="catatan-label">Catatan (opsional)</label>
                <textarea name="catatan" class="catatan-input" rows="2" placeholder="Contoh: less sugar, no ice, dll...">{{ old('catatan') }}</textarea>

                <button type="submit" class="order-btn">Pesan Sekarang</button>
            </form>

            <a href="{{ route('member.menu') }}" class="continue-link">← Tambah item lain</a>
        </div>
    </div>
    @endif
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Nikmati kopi terbaikmu.</p>
</div>

<script>
function selectPayment(val) {
    document.getElementById('opt-qris').classList.toggle('selected', val === 'qris');
    document.getElementById('opt-cash').classList.toggle('selected', val === 'cash');
}
</script>
</body>
</html>
