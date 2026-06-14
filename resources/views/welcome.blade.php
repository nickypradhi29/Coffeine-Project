<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffeineé — Coffee Shop Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --brown-900: #2C1A0E;
            --brown-800: #4A2C1A;
            --brown-700: #6B3F22;
            --brown-600: #8B5A2B;
            --brown-500: #A0522D;
            --brown-400: #C47C3E;
            --brown-300: #D4A574;
            --brown-200: #E8D5B7;
            --brown-100: #F5EDE0;
            --brown-50:  #FAF6F0;
            --cream:     #FFFDF9;
            --text-dark: #1C110A;
            --text-mid:  #5C3D20;
            --text-light:#9B7550;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--cream); color: var(--text-dark); overflow-x: hidden; }
 
        /* ── NAVBAR ─────────────────────────────────────────────── */
        nav {
            position: sticky; top: 0; z-index: 100;
            background: var(--brown-800);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 48px; height: 64px;
        }
        .nav-logo { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 600; color: var(--brown-200); letter-spacing: 0.5px; text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 32px; }
        .nav-link { font-size: 13px; font-weight: 400; color: var(--brown-300); letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: color .2s; text-decoration: none; }
        .nav-link:hover { color: var(--cream); }
        .nav-cta { background: var(--brown-400); color: var(--cream); border: none; padding: 9px 22px; border-radius: 2px; font-size: 12px; font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: background .2s; text-decoration: none; }
        .nav-cta:hover { background: var(--brown-300); }
 
        /* ── HERO ───────────────────────────────────────────────── */
        .hero {
            min-height: 560px;
            background: var(--brown-900);
            display: grid; grid-template-columns: 1fr 1fr;
            overflow: hidden; position: relative;
        }
        .hero-left { display: flex; flex-direction: column; justify-content: center; padding: 64px 56px; z-index: 2; }
        .hero-eyebrow { font-size: 11px; font-weight: 500; letter-spacing: 3px; text-transform: uppercase; color: var(--brown-400); margin-bottom: 20px; }
        .hero-title { font-family: 'Playfair Display', serif; font-size: 52px; font-weight: 700; line-height: 1.1; color: var(--cream); margin-bottom: 20px; }
        .hero-title span { color: var(--brown-300); }
        .hero-desc { font-size: 15px; line-height: 1.85; color: var(--brown-200); margin-bottom: 36px; max-width: 400px; }
        .hero-btns { display: flex; gap: 14px; }
        .btn-primary { background: var(--brown-400); color: var(--cream); border: none; padding: 13px 30px; font-size: 13px; font-weight: 500; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border-radius: 2px; transition: background .2s; text-decoration: none; display: inline-block; }
        .btn-primary:hover { background: var(--brown-300); }
        .btn-outline { background: transparent; color: var(--brown-200); border: 1px solid var(--brown-600); padding: 13px 30px; font-size: 13px; font-weight: 500; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border-radius: 2px; transition: all .2s; text-decoration: none; display: inline-block; }
        .btn-outline:hover { border-color: var(--brown-300); color: var(--brown-300); }
        .hero-right { position: relative; overflow: hidden; }
        .hero-img-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3px; height: 100%; min-height: 560px; }
        .hero-img {
            overflow: hidden;
            min-height: 280px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .hero-img-1 { background-color: #3D2010; }
        .hero-img-2 { background-color: #5A3020; }
        .hero-img-3 { background-color: #4A2818; }
        .hero-img-4 { background-color: #6B3A22; }
        .hero-badge {
            position: absolute; bottom: 32px; left: -20px;
            background: var(--brown-400); color: var(--cream);
            padding: 14px 24px; border-radius: 2px; z-index: 3;
        }
        .hero-badge-num { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; line-height: 1; }
        .hero-badge-txt { font-size: 10px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--brown-100); margin-top: 3px; }
 
        /* ── STRIP ──────────────────────────────────────────────── */
        .strip { background: var(--brown-700); padding: 16px 0; display: flex; justify-content: center; }
        .strip-item { width: 75%; max-width: 880px; font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; color: var(--brown-200); display: flex; align-items: center; justify-content: center; gap: 12px; margin: 0 auto; }
        .strip-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--brown-400); flex-shrink: 0; }
 
        /* ── SECTIONS ───────────────────────────────────────────── */
        .section { padding: 80px 48px; }
        .section-alt { background: var(--brown-50); }
        .section-center { text-align: center; }
        .tag { font-size: 11px; font-weight: 500; letter-spacing: 3px; text-transform: uppercase; color: var(--brown-400); margin-bottom: 12px; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 38px; font-weight: 600; color: var(--brown-900); line-height: 1.2; margin-bottom: 12px; }
        .section-sub { font-size: 14px; color: var(--text-light); line-height: 1.85; max-width: 520px; margin: 0 auto 48px; }
 
        /* ── MENU ───────────────────────────────────────────────── */
        .menu-tabs { display: flex; justify-content: center; gap: 6px; margin-bottom: 40px; flex-wrap: wrap; }
        .menu-tab { padding: 8px 24px; border: 1px solid var(--brown-200); background: transparent; font-size: 12px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-light); cursor: pointer; border-radius: 2px; transition: all .2s; font-family: 'Inter', sans-serif; }
        .menu-tab.active, .menu-tab:hover { background: var(--brown-800); color: var(--cream); border-color: var(--brown-800); }
        .menu-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .menu-card { background: var(--cream); border: 1px solid var(--brown-100); border-radius: 4px; overflow: hidden; transition: transform .25s, box-shadow .25s; display: flex; flex-direction: column; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(44,26,14,.12); }
        .menu-card-img { height: 170px; display: flex; align-items: center; justify-content: center; font-size: 56px; position: relative; overflow: hidden; background: var(--brown-100); }
        .menu-card-img img { width: 100%; height: 100%; object-fit: cover; }
        .menu-card-badge { position: absolute; top: 10px; right: 10px; background: var(--brown-800); color: var(--cream); font-size: 9px; letter-spacing: 1px; text-transform: uppercase; padding: 3px 9px; border-radius: 2px; }
        .menu-card-body { padding: 16px; display: flex; flex-direction: column; flex: 1; }
        .menu-card-name { font-family: 'Playfair Display', serif; font-size: 17px; font-weight: 500; color: var(--brown-900); margin-bottom: 5px; }
        .menu-card-desc { font-size: 12px; color: var(--text-light); line-height: 1.65; margin-bottom: 20px; flex: 1; }
        .menu-card-bottom { display: flex; align-items: center; justify-content: space-between; margin-top: auto; }
        .menu-card-price { font-size: 15px; font-weight: 600; color: var(--brown-600); }
        .menu-card-btn { background: var(--brown-800); color: var(--cream); border: none; padding: 7px 16px; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border-radius: 2px; transition: background .2s; font-family: 'Inter', sans-serif; text-decoration: none; display: inline-block; }
        .menu-card-btn:hover { background: var(--brown-600); }
        .menu-cta { margin-top: 40px; }
 
        /* ── ABOUT ──────────────────────────────────────────────── */
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }
        .about-img-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .about-img { border-radius: 4px; overflow: hidden; background: var(--brown-200); display: flex; align-items: center; justify-content: center; font-size: 48px; background-size: cover; background-position: center; }
        .about-img:first-child { grid-row: span 2; min-height: 320px; font-size: 72px; }
        .about-img-sm { min-height: 150px; }
        .about-tag { font-size: 11px; font-weight: 500; letter-spacing: 3px; text-transform: uppercase; color: var(--brown-400); margin-bottom: 16px; }
        .about-title { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 600; color: var(--brown-900); line-height: 1.25; margin-bottom: 16px; }
        .about-desc { font-size: 14px; color: var(--text-light); line-height: 1.95; margin-bottom: 32px; }
        .about-features { display: flex; flex-direction: column; gap: 18px; }
        .about-feat { display: flex; gap: 16px; align-items: flex-start; }
        .feat-line { width: 2px; background: var(--brown-400); flex-shrink: 0; margin-top: 3px; height: 40px; border-radius: 2px; }
        .feat-title { font-size: 13px; font-weight: 600; color: var(--brown-800); letter-spacing: 0.3px; margin-bottom: 3px; }
        .feat-desc { font-size: 12px; color: var(--text-light); line-height: 1.6; }
 
        /* ── CARA PESAN ─────────────────────────────────────────── */
        .steps-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .step-card { background: var(--cream); border: 1px solid var(--brown-100); border-radius: 4px; padding: 36px 28px; }
        .step-num { font-family: 'Playfair Display', serif; font-size: 52px; font-weight: 700; color: var(--brown-100); line-height: 1; margin-bottom: 16px; }
        .step-icon { font-size: 30px; margin-bottom: 12px; }
        .step-title { font-size: 16px; font-weight: 600; color: var(--brown-900); margin-bottom: 10px; }
        .step-desc { font-size: 13px; color: var(--text-light); line-height: 1.75; }
 
        /* ── CTA BANNER ─────────────────────────────────────────── */
        .cta-banner { background: var(--brown-800); padding: 80px 48px; text-align: center; }
        .cta-title { font-family: 'Playfair Display', serif; font-size: 40px; font-weight: 700; color: var(--cream); margin-bottom: 12px; }
        .cta-sub { font-size: 15px; color: var(--brown-300); margin-bottom: 36px; }
        .cta-btns { display: flex; justify-content: center; gap: 14px; flex-wrap: wrap; }
 
        /* ── FOOTER ─────────────────────────────────────────────── */
        footer { background: var(--brown-900); padding: 56px 48px; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 56px; }
        .footer-brand { font-family: 'Playfair Display', serif; font-size: 22px; color: var(--brown-200); margin-bottom: 12px; }
        .footer-desc { font-size: 12px; color: var(--brown-400); line-height: 1.85; max-width: 240px; }
        .footer-col-title { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: var(--brown-400); margin-bottom: 18px; font-weight: 500; }
        .footer-link { display: block; font-size: 13px; color: var(--brown-300); margin-bottom: 10px; cursor: pointer; transition: color .2s; text-decoration: none; }
        .footer-link:hover { color: var(--cream); }
        .footer-bottom { background: var(--brown-900); border-top: 1px solid var(--brown-800); padding: 18px 48px; display: flex; justify-content: space-between; align-items: center; }
        .footer-copy { font-size: 11px; color: var(--brown-600); }
 
        /* ── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 768px) {
            nav { padding: 0 20px; }
            .nav-links { gap: 16px; }
            .nav-link { display: none; }
            .hero { grid-template-columns: 1fr; }
            .hero-right { display: none; }
            .hero-left { padding: 48px 24px; }
            .hero-title { font-size: 36px; }
            .section { padding: 56px 24px; }
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
            .about-grid { grid-template-columns: 1fr; }
            .about-img-grid { display: none; }
            .steps-grid { grid-template-columns: 1fr; }
            footer { grid-template-columns: 1fr; gap: 32px; padding: 40px 24px; }
            .footer-bottom { padding: 16px 24px; flex-direction: column; gap: 6px; text-align: center; }
        }
    </style>
</head>
<body>
 
{{-- ── NAVBAR ──────────────────────────────────────────────────────── --}}
<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <a href="#menu" class="nav-link">Menu</a>
        <a href="#about" class="nav-link">About</a>
        @auth
            <a href="{{ route('dashboard') }}" class="nav-cta">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <a href="{{ route('register') }}" class="nav-cta">Pesan Sekarang</a>
        @endauth
    </div>
</nav>
 
{{-- ── HERO ─────────────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-left">
        <div class="hero-eyebrow">Coffee Shop Digital · Jambi</div>
        <h1 class="hero-title">
            Setiap Tegukan,<br>
            <span>Sebuah Cerita</span>
        </h1>
        <p class="hero-desc">
            Dibuat dengan Passion, Disajikan dengan Cinta.
        </p>
        <div class="hero-btns">
            <a href="#menu" class="btn-primary">Lihat Menu</a>
            <a href="{{ route('register') }}" class="btn-outline">Pesan Online</a>
        </div>
    </div>
    <div class="hero-right">
        <div class="hero-img-grid">
            <div class="hero-img hero-img-1" style="background-image: url('{{ asset('images/coffe.webp') }}');"></div>
            <div class="hero-img hero-img-2" style="background-image: url('{{ asset('images/beans.webp') }}');"></div>
            <div class="hero-img hero-img-3" style="background-image: url('{{ asset('images/tea.webp') }}');"></div>
            <div class="hero-img hero-img-4" style="background-image: url('{{ asset('images/pastry.webp') }}');"></div>
        </div>
    </div>
</section>
 
{{-- ── STRIP ────────────────────────────────────────────────────────── --}}
<div class="strip">
    <div class="strip-item"><div class="strip-dot"></div>Premium Beans</div>
</div>
 
{{-- ── MENU ─────────────────────────────────────────────────────────── --}}
<section class="section section-center" id="menu">
    <div class="tag">Our Selection</div>
    <h2 class="section-title">Menu Pilihan Kami</h2>
    <p class="section-sub">
        Dari biji kopi pilihan hingga minuman non-coffee yang menyegarkan —
        ada sesuatu untuk setiap selera.
    </p>
 
    <div class="menu-tabs">
        <button class="menu-tab active" onclick="filterMenu('semua', this)">Semua</button>
        <button class="menu-tab" onclick="filterMenu('coffee', this)">Coffee</button>
        <button class="menu-tab" onclick="filterMenu('non-coffee', this)">Non-Coffee</button>
    </div>
 
    <div class="menu-grid" id="menuGrid">
        @forelse($menus as $menu)
        <div class="menu-card" data-kategori="{{ $menu->kategori }}">
            <div class="menu-card-img">
                @if($menu->gambar)
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                @endif
                @if($loop->first)
                    <div class="menu-card-badge">Bestseller</div>
                @endif
            </div>
            <div class="menu-card-body">
                <div class="menu-card-name">{{ $menu->nama_menu }}</div>

                {{-- Rating --}}
                <div style="font-size:13px;color:#8B5A2B;margin-top:5px;margin-bottom:10px;">

                    @php
                        $avg = $menu->ratings_avg_rating ?? 0;
                        $count = $menu->ratings_count ?? 0;
                    @endphp

                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($avg))
                            ⭐
                        @else
                            ☆
                        @endif
                    @endfor

                    <span>
                        ({{ number_format($avg, 1) }}) · {{ $count }} review
                    </span>

                </div>

                <div class="menu-card-desc">{{ $menu->deskripsi }}</div>

                <div class="menu-card-bottom">
                    <span class="menu-card-price">Rp {{ number_format((float)$menu->harga, 0, ',', '.') }}</span>
                    @auth
                        <a href="{{ route('member.menu') }}" class="menu-card-btn">+ Pesan</a>
                    @else
                        <a href="{{ route('register') }}" class="menu-card-btn">+ Pesan</a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:span 4; text-align:center; color:var(--text-light); padding: 48px 0;">
            Menu belum tersedia. Cek lagi nanti!
        </div>
        @endforelse
    </div>
 
    <div class="menu-cta">
        <a href="{{ route('member.menu') }}" class="btn-primary">Lihat Semua Menu</a>
    </div>
</section>
 
{{-- ── ABOUT ────────────────────────────────────────────────────────── --}}
<section class="section section-alt" id="about">
    <div class="about-grid">
        <div class="about-img-grid">
            <div class="about-img" style="background-image: url('{{ asset('images/susu.webp') }}');"></div>
            <div class="about-img about-img-sm" style="background-image: url('{{ asset('images/karamel.webp') }}');"></div>
            <div class="about-img about-img-sm" style="background-image: url('{{ asset('images/kopi.webp') }}');"></div>
        </div>
        <div>
            <div class="about-tag">Tentang Kami</div>
            <h2 class="about-title">Kopi Berkualitas,<br>Pengalaman Digital</h2>
            <p class="about-desc">
                Coffeineé hadir sebagai coffee shop berbasis digital yang menggabungkan
                cita rasa kopi premium dengan kemudahan teknologi. Pesan online,
                bayar mudah, nikmati di tempat.
            </p>
            <div class="about-features">
                <div class="about-feat">
                    <div class="feat-line"></div>
                    <div>
                        <div class="feat-title">Premium Beans</div>
                        <div class="feat-desc">Biji kopi pilihan dari daerah terbaik Indonesia</div>
                    </div>
                </div>
                <div class="about-feat">
                    <div class="feat-line"></div>
                    <div>
                        <div class="feat-title">Pembayaran Digital</div>
                        <div class="feat-desc">Pembayaran lebih mudah</div>
                    </div>
                </div>
                <div class="about-feat">
                    <div class="feat-line"></div>
                    <div>
                        <div class="feat-title">Barista Terlatih</div>
                        <div class="feat-desc">Barista berpengalaman yang terlatih dalam menyajikan kopi berkualitas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
{{-- ── CARA PESAN ───────────────────────────────────────────────────── --}}
<section class="section section-center">
    <div class="tag">How It Works</div>
    <h2 class="section-title">Cara Pesan Mudah</h2>
    <p class="section-sub">Tiga langkah simpel untuk menikmati kopi favoritmu.</p>
    <div class="steps-grid">
        <div class="step-card">
            <div class="step-num">01</div>
            <div class="step-icon"></div>
            <div class="step-title">Pilih Menu</div>
            <div class="step-desc">Jelajahi menu coffee dan non-coffee kami. Tambahkan item favorit ke keranjang dengan mudah.</div>
        </div>
        <div class="step-card">
            <div class="step-num">02</div>
            <div class="step-icon"></div>
            <div class="step-title">Pilih Pembayaran</div>
            <div class="step-desc">Bayar via QRIS (Midtrans) langsung di website, atau pilih bayar di kasir saat pickup.</div>
        </div>
        <div class="step-card">
            <div class="step-num">03</div>
            <div class="step-icon"></div>
            <div class="step-title">Ambil & Nikmati</div>
            <div class="step-desc">Pesananmu diproses kasir. Struk dicetak, dan kopi siap kamu nikmati.</div>
        </div>
    </div>
</section>
 
{{-- ── CTA BANNER ───────────────────────────────────────────────────── --}}
<section class="cta-banner">
    <h2 class="cta-title">Siap Memesan Sekarang?</h2>
    <p class="cta-sub">Daftar akun gratis dan mulai nikmati kopi terbaik Coffeineé</p>
    <div class="cta-btns">
        <a href="{{ route('register') }}" class="btn-primary">Daftar Gratis</a>
        <a href="#menu" class="btn-outline">Lihat Menu</a>
    </div>
</section>
 
{{-- ── FOOTER ───────────────────────────────────────────────────────── --}}
<footer>
    <div>
        <div class="footer-brand">Coffeineé</div>
        <p class="footer-desc">
            Coffee shop berbasis digital menghadirkan pengalaman memesan kopi
            yang mudah dan menyenangkan di Jambi.
        </p>
    </div>
    <div>
        <div class="footer-col-title">Navigasi</div>
        <a href="{{ url('/') }}"        class="footer-link">Home</a>
        <a href="#menu"                 class="footer-link">Menu</a>
        <a href="#about"                class="footer-link">About</a>
    </div>
    <div>
        <div class="footer-col-title">Akun</div>
        <a href="{{ route('login') }}"    class="footer-link">Login</a>
        <a href="{{ route('register') }}" class="footer-link">Daftar</a>
        @auth
        <a href="{{ route('member.riwayat') }}" class="footer-link">Riwayat Pesanan</a>
        @endauth
    </div>
</footer>
<div class="footer-bottom">
    <span class="footer-copy">&copy; {{ date('Y') }} Coffeineé. All rights reserved.</span>
    <span class="footer-copy">Jambi, Indonesia</span>
</div>
 
<script>
function filterMenu(kategori, btn) {
    document.querySelectorAll('.menu-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
 
    document.querySelectorAll('.menu-card').forEach(card => {
        if (kategori === 'semua' || card.dataset.kategori === kategori) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
 
</body>
</html>
 