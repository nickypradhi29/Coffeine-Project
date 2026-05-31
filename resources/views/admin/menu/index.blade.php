<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu — Admin Coffeineé</title>
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

        .flash{max-width:1200px;margin:16px auto 0;padding:0 32px;}
        .flash-success{background:#EAF3DE;border-left:3px solid #3B6D11;color:#3B6D11;padding:10px 16px;border-radius:2px;font-size:13px;}

        .page-header{background:var(--brown-900);padding:40px 48px;display:flex;align-items:flex-end;justify-content:space-between;}
        .page-title{font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:var(--cream);}
        .page-sub{font-size:13px;color:var(--brown-300);margin-top:6px;}
        .btn-add{background:var(--brown-400);color:var(--cream);padding:11px 22px;border-radius:2px;text-decoration:none;font-size:12px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;transition:background .2s;white-space:nowrap;}
        .btn-add:hover{background:var(--brown-300);}

        .main{max-width:1200px;margin:0 auto;padding:36px 32px;}

        .tbl-wrap{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;overflow:hidden;}
        .tbl{width:100%;border-collapse:collapse;}
        .tbl thead{background:var(--brown-900);}
        .tbl th{text-align:left;padding:13px 16px;font-size:11px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:var(--brown-300);}
        .tbl td{padding:14px 16px;font-size:13px;color:var(--brown-900);border-top:1px solid var(--brown-50);vertical-align:middle;}
        .tbl tbody tr:hover{background:var(--brown-50);}

        .menu-thumb{width:48px;height:48px;border-radius:4px;overflow:hidden;background:var(--brown-100);display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;}
        .menu-thumb img{width:100%;height:100%;object-fit:cover;}
        .menu-name-cell{display:flex;align-items:center;gap:12px;}
        .menu-name{font-weight:600;color:var(--brown-900);}
        .menu-desc-preview{font-size:11px;color:var(--text-light);margin-top:2px;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}

        .badge{font-size:10px;font-weight:500;padding:3px 10px;border-radius:20px;letter-spacing:0.5px;}
        .badge-coffee{background:#E6F1FB;color:#185FA5;}
        .badge-noncoffee{background:#EAF3DE;color:#3B6D11;}
        .badge-aktif{background:#EAF3DE;color:#3B6D11;}
        .badge-nonaktif{background:var(--brown-100);color:var(--text-light);}

        .stok-low{color:#EF9F27;font-weight:600;}
        .stok-ok{color:#3B6D11;font-weight:600;}
        .stok-habis{color:#A32D2D;font-weight:600;}

        .btn-del{font-size:11px;color:#A32D2D;background:none;border:1px solid #F5C6C6;padding:5px 12px;border-radius:2px;cursor:pointer;font-family:'Inter',sans-serif;letter-spacing:0.5px;transition:all .2s;}
        .btn-del:hover{background:#FCEBEB;border-color:#A32D2D;}

        .pagination-wrap{margin-top:20px;display:flex;justify-content:flex-end;}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;flex-direction:column;gap:16px;align-items:flex-start;}.main{padding:24px 20px;}.tbl{font-size:12px;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <span class="nav-role">Admin</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('admin.menu.index') }}" class="nav-link active">Menu</a>
        <a href="{{ route('admin.laporan.index') }}" class="nav-link">Laporan</a>
        <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
    </div>
</nav>

@if(session('success'))
<div class="flash"><div class="flash-success">{{ session('success') }}</div></div>
@endif

<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Menu</h1>
        <p class="page-sub">{{ $menus->total() }} total menu terdaftar</p>
    </div>
    <a href="{{ route('admin.menu.create') }}" class="btn-add">+ Tambah Menu</a>
</div>

<div class="main">
    <div class="tbl-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Kategori</th>
                    <th style="text-align:right">Harga</th>
                    <th style="text-align:center">Stok</th>
                    <th style="text-align:center">Status</th>
                    <th></th>
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
                            <div>
                                <div class="menu-name">{{ $menu->nama_menu }}</div>
                                <div class="menu-desc-preview">{{ $menu->deskripsi }}</div>
                            </div>
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
                        <span class="badge {{ $menu->tersedia ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ $menu->tersedia ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.menu.destroy', $menu) }}"
                            onsubmit="return confirm('Hapus menu {{ $menu->nama_menu }}? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-del">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--text-light);padding:48px">
                        Belum ada menu. <a href="{{ route('admin.menu.create') }}" style="color:var(--brown-600)">Tambah sekarang →</a>
                    </td>
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
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Panel Admin</p>
</div>
</body>
</html>
