<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --brown-900: #2C1A0E;
            --brown-800: #4A2C1A;
            --brown-700: #6B3F22;
            --brown-600: #8B5A2B;
            --brown-400: #C47C3E;
            --brown-300: #D4A574;
            --brown-200: #E8D5B7;
            --brown-100: #F5EDE0;
            --brown-50:  #FAF6F0;
            --cream:     #FFFDF9;
            --text-light:#9B7550;
        }
        body { font-family: 'Inter', sans-serif; background: var(--brown-50); color: var(--brown-900); }

        /* ── NAVBAR ── */
        nav {
            background: var(--brown-800); position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 48px; height: 64px;
        }
        .nav-logo { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 600; color: var(--brown-200); text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 24px; }
        .nav-link { font-size: 13px; color: var(--brown-300); text-decoration: none; letter-spacing: 1px; text-transform: uppercase; transition: color .2s; }
        .nav-link:hover { color: var(--cream); }
        .nav-cart {
            display: flex; align-items: center; gap: 8px;
            background: var(--brown-400); color: var(--cream);
            padding: 8px 18px; border-radius: 2px; text-decoration: none;
            font-size: 12px; font-weight: 500; letter-spacing: 1px; text-transform: uppercase;
            transition: background .2s;
        }
        .nav-cart:hover { background: var(--brown-300); }
        .cart-count {
            background: var(--cream); color: var(--brown-800);
            font-size: 10px; font-weight: 700;
            width: 18px; height: 18px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── FLASH ── */
        .flash { max-width: 1200px; margin: 16px auto 0; padding: 0 32px; }
        .flash-success { background: #EAF3DE; border-left: 3px solid #3B6D11; color: #3B6D11; padding: 10px 16px; border-radius: 2px; font-size: 13px; }
        .flash-error   { background: #FCEBEB; border-left: 3px solid #A32D2D; color: #A32D2D; padding: 10px 16px; border-radius: 2px; font-size: 13px; }

        /* ── PAGE HEADER ── */
        .page-header {
            background: var(--brown-900); padding: 48px;
            display: flex; align-items: flex-end; justify-content: space-between;
        }
        .page-header-left {}
        .page-eyebrow { font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: var(--brown-400); margin-bottom: 8px; }
        .page-title { font-family: 'Playfair Display', serif; font-size: 40px; font-weight: 700; color: var(--cream); }
        .page-sub { font-size: 14px; color: var(--brown-300); margin-top: 8px; }

        /* ── FILTER TABS ── */
        .filter-bar {
            background: var(--cream); border-bottom: 1px solid var(--brown-100);
            padding: 0 48px; display: flex; align-items: center; gap: 0;
            position: sticky; top: 64px; z-index: 90;
        }
        .filter-tab {
            padding: 16px 28px; font-size: 12px; font-weight: 500;
            letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--text-light); border: none; background: transparent;
            cursor: pointer; border-bottom: 2px solid transparent;
            transition: all .2s; font-family: 'Inter', sans-serif;
        }
        .filter-tab:hover { color: var(--brown-700); }
        .filter-tab.active { color: var(--brown-800); border-bottom-color: var(--brown-600); }

        /* ── MAIN CONTENT ── */
        .main { max-width: 1200px; margin: 0 auto; padding: 48px 32px; }

        /* ── SECTION HEADER ── */
        .section-header { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--brown-200); }
        .section-title-text {
            font-family: 'Playfair Display', serif;
            font-size: 28px; font-weight: 600; color: var(--brown-900);
        }
        .section-count { font-size: 13px; color: var(--text-light); margin-top: 4px; }

        /* ── MENU GRID ── */
        .menu-section { margin-bottom: 56px; }
        .menu-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

        /* ── MENU CARD ── */
        .menu-card {
            background: var(--cream); border-radius: 6px;
            border: 1px solid var(--brown-100); overflow: hidden;
            transition: transform .25s, box-shadow .25s;
            display: flex; flex-direction: column;
        }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(44,26,14,.13); }

        /* Foto */
        .card-img-wrap { position: relative; height: 200px; overflow: hidden; background: var(--brown-100); flex-shrink: 0; }
        .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
        .menu-card:hover .card-img-wrap img { transform: scale(1.05); }
        .card-img-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 56px; background: var(--brown-100); }

        /* Badge harga */
        .price-badge {
            position: absolute; top: 12px; right: 12px;
            background: var(--brown-800); color: var(--cream);
            font-size: 14px; font-weight: 600;
            padding: 6px 12px; border-radius: 4px;
            font-family: 'Inter', sans-serif;
        }

        /* Badge kategori */
        .cat-badge {
            position: absolute; top: 12px; left: 12px;
            font-size: 9px; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 600;
            padding: 3px 10px; border-radius: 2px;
        }
        .cat-coffee    { background: rgba(74,44,26,.85); color: var(--brown-200); }
        .cat-noncoffee { background: rgba(59,109,17,.85); color: #C0DD97; }

        /* Body */
        .card-body { padding: 16px 18px 18px; display: flex; flex-direction: column; flex: 1; }
        .card-name { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 600; color: var(--brown-900); margin-bottom: 6px; }
        .card-desc { font-size: 13px; color: var(--text-light); line-height: 1.65; flex: 1; margin-bottom: 16px; }

        /* Stok info */
        .card-stok { font-size: 11px; color: var(--text-light); margin-bottom: 12px; display: flex; align-items: center; gap: 5px; }
        .stok-dot { width: 6px; height: 6px; border-radius: 50%; background: #3B6D11; flex-shrink: 0; }
        .stok-dot.low { background: #EF9F27; }

        /* Form tambah keranjang */
        .card-form { display: flex; gap: 8px; align-items: center; }
        .qty-wrap { display: flex; align-items: center; border: 1px solid var(--brown-200); border-radius: 2px; overflow: hidden; }
        .qty-btn { width: 30px; height: 36px; background: var(--brown-100); border: none; color: var(--brown-700); font-size: 16px; cursor: pointer; transition: background .15s; display: flex; align-items: center; justify-content: center; }
        .qty-btn:hover { background: var(--brown-200); }
        .qty-input { width: 36px; height: 36px; border: none; border-left: 1px solid var(--brown-200); border-right: 1px solid var(--brown-200); text-align: center; font-size: 14px; font-family: 'Inter', sans-serif; color: var(--brown-900); background: var(--cream); }
        .qty-input:focus { outline: none; }
        .add-btn {
            flex: 1; background: var(--brown-800); color: var(--cream);
            border: none; height: 36px; border-radius: 2px;
            font-size: 12px; font-weight: 500; letter-spacing: 1px; text-transform: uppercase;
            cursor: pointer; transition: background .2s; font-family: 'Inter', sans-serif;
        }
        .add-btn:hover { background: var(--brown-600); }

        /* Habis */
        .habis-label { width: 100%; height: 36px; background: var(--brown-100); color: var(--text-light); border: 1px solid var(--brown-200); border-radius: 2px; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: flex; align-items: center; justify-content: center; }

        /* ── EMPTY STATE ── */
        .empty { text-align: center; padding: 80px 0; color: var(--text-light); }
        .empty-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-text { font-size: 15px; }

        /* ── FOOTER ── */
        .page-footer { background: var(--brown-900); padding: 24px 48px; text-align: center; }
        .footer-copy { font-size: 12px; color: var(--brown-600); }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) { .menu-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) {
            nav { padding: 0 20px; }
            .page-header { padding: 32px 20px; }
            .filter-bar { padding: 0 20px; overflow-x: auto; }
            .main { padding: 32px 20px; }
            .menu-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
        }
        @media (max-width: 480px) { .menu-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
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
        <a href="{{ route('member.keranjang') }}" class="nav-cart">
            🛒 Keranjang
            @php $jumlahKeranjang = count(session('keranjang', [])); @endphp
            @if($jumlahKeranjang > 0)
                <span class="cart-count">{{ $jumlahKeranjang }}</span>
            @endif
        </a>
    </div>
</nav>

{{-- FLASH MESSAGES --}}
@if(session('success') || session('error') || $errors->any())
<div class="flash">
    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash-error">{{ session('error') }}</div>
    @endif
    @foreach($errors->all() as $error)
        <div class="flash-error">{{ $error }}</div>
    @endforeach
</div>
@endif

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-left">
        <div class="page-eyebrow">Our Selection</div>
        <h1 class="page-title">Menu Kami</h1>
        <p class="page-sub">Pilih minuman dan makanan favoritmu, pesan dengan mudah.</p>
    </div>
</div>

{{-- FILTER TABS --}}
<div class="filter-bar">
    <button class="filter-tab active" onclick="filterMenu('semua', this)">Semua</button>
    <button class="filter-tab" onclick="filterMenu('coffee', this)">☕ Coffee</button>
    <button class="filter-tab" onclick="filterMenu('non-coffee', this)">🍵 Non-Coffee</button>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- COFFEE --}}
    <div class="menu-section" id="section-coffee">
        <div class="section-header">
            <div class="section-title-text">☕ Coffee</div>
            <div class="section-count">{{ $coffeeMenus->count() }} item tersedia</div>
        </div>

        @if($coffeeMenus->count() > 0)
        <div class="menu-grid">
            @foreach($coffeeMenus as $menu)
            <div class="menu-card" data-kategori="coffee">
                {{-- Foto --}}
                <div class="card-img-wrap">
                    @if($menu->gambar)
                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                    @else
                        <div class="card-img-placeholder">☕</div>
                    @endif
                    <span class="price-badge">Rp {{ number_format((float)$menu->harga, 0, ',', '.') }}</span>
                    <span class="cat-badge cat-coffee">Coffee</span>
                </div>

                {{-- Body --}}
                <div class="card-body">
                    <div class="card-name">{{ $menu->nama_menu }}</div>
                    <div class="card-desc">{{ $menu->deskripsi ?? 'Minuman kopi pilihan berkualitas tinggi.' }}</div>

                    {{-- Stok --}}
                    <div class="card-stok">
                        <div class="stok-dot {{ $menu->stok <= 5 ? 'low' : '' }}"></div>
                        @if($menu->stok <= 5)
                            Sisa {{ $menu->stok }} porsi
                        @else
                            Tersedia
                        @endif
                    </div>

                    {{-- Tambah ke keranjang --}}
                    @if($menu->stok > 0)
                    <form method="POST" action="{{ route('member.keranjang.tambah') }}" class="card-form">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="qty-wrap">
                            <button type="button" class="qty-btn" onclick="decrementQty(this)">−</button>
                            <input type="number" name="jumlah" value="1" min="1" max="{{ $menu->stok }}" class="qty-input" readonly>
                            <button type="button" class="qty-btn" onclick="incrementQty(this, {{ $menu->stok }})">+</button>
                        </div>
                        <button type="submit" class="add-btn">+ Keranjang</button>
                    </form>
                    @else
                        <div class="habis-label">Stok Habis</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
            <div class="empty">
                <div class="empty-icon">☕</div>
                <div class="empty-text">Belum ada menu coffee tersedia.</div>
            </div>
        @endif
    </div>

    {{-- NON-COFFEE --}}
    <div class="menu-section" id="section-noncoffee">
        <div class="section-header">
            <div class="section-title-text">🍵 Non-Coffee</div>
            <div class="section-count">{{ $nonCoffeeMenus->count() }} item tersedia</div>
        </div>

        @if($nonCoffeeMenus->count() > 0)
        <div class="menu-grid">
            @foreach($nonCoffeeMenus as $menu)
            <div class="menu-card" data-kategori="non-coffee">
                {{-- Foto --}}
                <div class="card-img-wrap">
                    @if($menu->gambar)
                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                    @else
                        <div class="card-img-placeholder">🍵</div>
                    @endif
                    <span class="price-badge">Rp {{ number_format((float)$menu->harga, 0, ',', '.') }}</span>
                    <span class="cat-badge cat-noncoffee">Non-Coffee</span>
                </div>

                {{-- Body --}}
                <div class="card-body">
                    <div class="card-name">{{ $menu->nama_menu }}</div>
                    <div class="card-desc">{{ $menu->deskripsi ?? 'Minuman non-coffee pilihan yang menyegarkan.' }}</div>

                    {{-- Stok --}}
                    <div class="card-stok">
                        <div class="stok-dot {{ $menu->stok <= 5 ? 'low' : '' }}"></div>
                        @if($menu->stok <= 5)
                            Sisa {{ $menu->stok }} porsi
                        @else
                            Tersedia
                        @endif
                    </div>

                    {{-- Tambah ke keranjang --}}
                    @if($menu->stok > 0)
                    <form method="POST" action="{{ route('member.keranjang.tambah') }}" class="card-form">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="qty-wrap">
                            <button type="button" class="qty-btn" onclick="decrementQty(this)">−</button>
                            <input type="number" name="jumlah" value="1" min="1" max="{{ $menu->stok }}" class="qty-input" readonly>
                            <button type="button" class="qty-btn" onclick="incrementQty(this, {{ $menu->stok }})">+</button>
                        </div>
                        <button type="submit" class="add-btn">+ Keranjang</button>
                    </form>
                    @else
                        <div class="habis-label">Stok Habis</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
            <div class="empty">
                <div class="empty-icon">🍵</div>
                <div class="empty-text">Belum ada menu non-coffee tersedia.</div>
            </div>
        @endif
    </div>

</div>{{-- end .main --}}

{{-- FOOTER --}}
<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Nikmati kopi terbaikmu.</p>
</div>

<script>
    // ── Filter tab ──────────────────────────────────────────
    function filterMenu(kategori, btn) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        const sectionCoffee    = document.getElementById('section-coffee');
        const sectionNoncoffee = document.getElementById('section-noncoffee');

        if (kategori === 'semua') {
            sectionCoffee.style.display    = 'block';
            sectionNoncoffee.style.display = 'block';
        } else if (kategori === 'coffee') {
            sectionCoffee.style.display    = 'block';
            sectionNoncoffee.style.display = 'none';
        } else {
            sectionCoffee.style.display    = 'none';
            sectionNoncoffee.style.display = 'block';
        }
    }

    // ── Qty counter ─────────────────────────────────────────
    function incrementQty(btn, maxStok) {
        const input = btn.parentElement.querySelector('.qty-input');
        const val   = parseInt(input.value);
        if (val < maxStok) input.value = val + 1;
    }

    function decrementQty(btn) {
        const input = btn.parentElement.querySelector('.qty-input');
        const val   = parseInt(input.value);
        if (val > 1) input.value = val - 1;
    }
</script>

</body>
</html>
