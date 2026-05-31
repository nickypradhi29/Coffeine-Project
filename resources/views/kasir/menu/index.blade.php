<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Stok — Kasir Coffeineé</title>
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

        .page-header{background:var(--brown-900);padding:40px 48px;}
        .page-title{font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:var(--cream);}
        .page-sub{font-size:13px;color:var(--brown-300);margin-top:6px;}

        .main{max-width:1200px;margin:0 auto;padding:36px 32px;}

        .info-box{background:var(--cream);border:1px solid var(--brown-200);border-left:3px solid var(--brown-400);border-radius:4px;padding:13px 16px;font-size:13px;color:var(--brown-700);line-height:1.65;margin-bottom:24px;}

        .tbl-wrap{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;overflow:hidden;}
        .tbl{width:100%;border-collapse:collapse;}
        .tbl thead{background:var(--brown-900);}
        .tbl th{text-align:left;padding:13px 16px;font-size:11px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:var(--brown-300);}
        .tbl td{padding:14px 16px;font-size:13px;color:var(--brown-900);border-top:1px solid var(--brown-50);vertical-align:middle;}
        .tbl tbody tr:hover{background:var(--brown-50);}

        .menu-thumb{width:44px;height:44px;border-radius:4px;overflow:hidden;background:var(--brown-100);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;}
        .menu-thumb img{width:100%;height:100%;object-fit:cover;}
        .menu-name-cell{display:flex;align-items:center;gap:12px;}
        .menu-name{font-weight:600;color:var(--brown-900);}

        .badge{font-size:10px;font-weight:500;padding:3px 10px;border-radius:20px;letter-spacing:0.5px;}
        .badge-coffee{background:#E6F1FB;color:#185FA5;}
        .badge-noncoffee{background:#EAF3DE;color:#3B6D11;}

        .stok-form{display:flex;align-items:center;gap:8px;}
        .stok-input{width:70px;border:1px solid var(--brown-200);border-radius:4px;padding:7px 10px;font-size:13px;text-align:center;font-family:'Inter',sans-serif;background:var(--cream);color:var(--brown-900);}
        .stok-input:focus{outline:none;border-color:var(--brown-400);}
        .stok-btn{background:var(--brown-800);color:var(--cream);border:none;padding:7px 14px;border-radius:2px;font-size:11px;font-weight:500;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;}
        .stok-btn:hover{background:var(--brown-600);}

        /* Toggle tersedia */
        .toggle-form{display:flex;align-items:center;justify-content:center;}
        .toggle-btn{background:none;border:none;cursor:pointer;font-size:18px;transition:opacity .2s;}
        .toggle-btn:hover{opacity:.7;}

        .stok-ok{color:#3B6D11;font-weight:600;}
        .stok-low{color:#EF9F27;font-weight:600;}
        .stok-habis{color:#A32D2D;font-weight:600;}

        .pagination-wrap{margin-top:20px;display:flex;justify-content:flex-end;}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;}.main{padding:24px 20px;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <span class="nav-role">Kasir</span>
        <a href="{{ route('kasir.dashboard') }}" class="nav-link">← Dashboard</a>
    </div>
</nav>

@if(session('success'))
<div class="flash"><div class="flash-success">{{ session('success') }}</div></div>
@endif

<div class="page-header">
    <h1 class="page-title">Kelola Stok Menu</h1>
    <p class="page-sub">Update stok dan ketersediaan menu secara real-time</p>
</div>

<div class="main">

    <div class="info-box">
        ℹ️ Kamu hanya bisa mengubah <strong>stok</strong> dan <strong>ketersediaan</strong> menu. Untuk menambah atau menghapus menu, hubungi admin.
    </div>

    <div class="tbl-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Kategori</th>
                    <th style="text-align:right">Harga</th>
                    <th style="text-align:center">Stok Sekarang</th>
                    <th style="text-align:center">Update Stok</th>
                    <th style="text-align:center">Tersedia</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>
                        <div class="menu-name-cell">
                            <div class="menu-thumb">
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                                @else
                                    {{ $menu->kategori === 'coffee' ? '☕' : '🍵' }}
                                @endif
                            </div>
                            <div class="menu-name">{{ $menu->nama_menu }}</div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $menu->kategori === 'coffee' ? 'badge-coffee' : 'badge-noncoffee' }}">
                            {{ $menu->kategori }}
                        </span>
                    </td>
                    <td style="text-align:right;font-weight:600;color:var(--brown-700)">
                        Rp {{ number_format((float)$menu->harga, 0, ',', '.') }}
                    </td>
                    <td style="text-align:center">
                        <span class="{{ $menu->stok === 0 ? 'stok-habis' : ($menu->stok <= 5 ? 'stok-low' : 'stok-ok') }}">
                            {{ $menu->stok }}
                        </span>
                    </td>
                    <td style="text-align:center">
                        <form method="POST" action="{{ route('kasir.menu.update', $menu) }}" class="stok-form">
                            @csrf @method('PATCH')
                            <input type="number" name="stok" value="{{ $menu->stok }}" min="0" class="stok-input">
                            <input type="hidden" name="tersedia" value="{{ $menu->tersedia ? 1 : 0 }}">
                            <button type="submit" class="stok-btn">Simpan</button>
                        </form>
                    </td>
                    <td style="text-align:center">
                        <form method="POST" action="{{ route('kasir.menu.update', $menu) }}" class="toggle-form">
                            @csrf @method('PATCH')
                            <input type="hidden" name="stok" value="{{ $menu->stok }}">
                            <input type="hidden" name="tersedia" value="{{ $menu->tersedia ? 0 : 1 }}">
                            <button type="submit" class="toggle-btn" title="{{ $menu->tersedia ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                {{ $menu->tersedia ? '✅' : '❌' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--text-light);padding:48px">Belum ada menu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($menus->hasPages())
    <div class="pagination-wrap">{{ $menus->links() }}</div>
    @endif
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Panel Kasir</p>
</div>
</body>
</html>
