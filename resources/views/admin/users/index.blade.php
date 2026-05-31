<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna — Admin Coffeineé</title>
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

        .page-header{background:var(--brown-900);padding:40px 48px;}
        .page-title{font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:var(--cream);}
        .page-sub{font-size:13px;color:var(--brown-300);margin-top:6px;}

        .main{max-width:1200px;margin:0 auto;padding:36px 32px;}

        /* Info box */
        .info-box{background:var(--cream);border:1px solid var(--brown-200);border-left:3px solid var(--brown-400);border-radius:4px;padding:14px 18px;font-size:13px;color:var(--brown-700);line-height:1.65;margin-bottom:24px;}

        .tbl-wrap{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;overflow:hidden;}
        .tbl{width:100%;border-collapse:collapse;}
        .tbl thead{background:var(--brown-900);}
        .tbl th{text-align:left;padding:13px 16px;font-size:11px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:var(--brown-300);}
        .tbl td{padding:14px 16px;font-size:13px;color:var(--brown-900);border-top:1px solid var(--brown-50);vertical-align:middle;}
        .tbl tbody tr:hover{background:var(--brown-50);}

        /* Avatar */
        .user-cell{display:flex;align-items:center;gap:12px;}
        .avatar{width:36px;height:36px;border-radius:50%;background:var(--brown-200);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:600;color:var(--brown-800);flex-shrink:0;}
        .user-name{font-weight:600;color:var(--brown-900);}
        .user-email{font-size:11px;color:var(--text-light);margin-top:2px;}

        /* Role badges */
        .badge{font-size:10px;font-weight:500;padding:4px 12px;border-radius:20px;letter-spacing:0.5px;}
        .badge-admin{background:#FCEBEB;color:#A32D2D;}
        .badge-kasir{background:#E6F1FB;color:#185FA5;}
        .badge-member{background:var(--brown-100);color:var(--text-light);}

        /* Role change form */
        .role-form{display:flex;align-items:center;gap:8px;}
        .role-select{border:1px solid var(--brown-200);border-radius:4px;padding:6px 10px;font-size:12px;font-family:'Inter',sans-serif;background:var(--cream);color:var(--brown-900);transition:border-color .2s;}
        .role-select:focus{outline:none;border-color:var(--brown-400);}
        .role-btn{background:var(--brown-800);color:var(--cream);border:none;padding:6px 14px;border-radius:2px;font-size:11px;font-weight:500;letter-spacing:0.5px;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;}
        .role-btn:hover{background:var(--brown-600);}
        .self-label{font-size:12px;color:var(--text-light);font-style:italic;}

        .pagination-wrap{margin-top:20px;display:flex;justify-content:flex-end;}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;}.main{padding:24px 20px;}.tbl{font-size:12px;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <span class="nav-role">Admin</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('admin.menu.index') }}" class="nav-link">Menu</a>
        <a href="{{ route('admin.laporan.index') }}" class="nav-link">Laporan</a>
        <a href="{{ route('admin.users.index') }}" class="nav-link active">Users</a>
    </div>
</nav>

@if(session('success'))
<div class="flash"><div class="flash-success">{{ session('success') }}</div></div>
@endif

<div class="page-header">
    <h1 class="page-title">Kelola Pengguna</h1>
    <p class="page-sub">Atur hak akses dan role setiap pengguna</p>
</div>

<div class="main">

    <div class="info-box">
        💡 <strong>Cara memberikan akses kasir:</strong> Pilih role <strong>Kasir</strong> pada dropdown pengguna yang ingin diberikan akses, lalu klik <strong>Ubah</strong>. Pengguna akan otomatis mendapat akses dashboard kasir saat login berikutnya.
    </div>

    <div class="tbl-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Role Saat Ini</th>
                    <th>Bergabung</th>
                    <th>Ubah Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="avatar">{{ strtoupper(substr($user->nama, 0, 1)) }}</div>
                            <div>
                                <div class="user-name">{{ $user->nama }}</div>
                                <div class="user-email">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td style="color:var(--text-light)">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="role-form">
                            @csrf @method('PATCH')
                            <select name="role" class="role-select">
                                <option value="member" {{ $user->role === 'member' ? 'selected' : '' }}>Member</option>
                                <option value="kasir"  {{ $user->role === 'kasir'  ? 'selected' : '' }}>Kasir</option>
                                <option value="admin"  {{ $user->role === 'admin'  ? 'selected' : '' }}>Admin</option>
                            </select>
                            <button type="submit" class="role-btn">Ubah</button>
                        </form>
                        @else
                            <span class="self-label">Akun kamu sendiri</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:var(--text-light);padding:48px">Belum ada pengguna terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="pagination-wrap">{{ $users->links() }}</div>
    @endif
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Panel Admin</p>
</div>
</body>
</html>
