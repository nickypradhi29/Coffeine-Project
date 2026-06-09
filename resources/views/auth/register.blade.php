<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-300:#D4A574;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--cream:#FFFDF9;--text-light:#9B7550;}
        body{font-family:'Inter',sans-serif;background:var(--brown-100);min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:24px;}
        .card{background:var(--cream);border:1px solid var(--brown-200);border-radius:8px;padding:36px 32px;width:100%;max-width:400px;}
        .brand{font-family:'Playfair Display',serif;font-size:26px;font-weight:700;color:var(--brown-800);text-align:center;margin-bottom:4px;}
        .brand-sub{font-size:12px;color:var(--text-light);text-align:center;margin-bottom:28px;letter-spacing:1px;text-transform:uppercase;}
        .form-group{margin-bottom:16px;}
        .form-label{font-size:12px;font-weight:500;color:var(--brown-800);display:block;margin-bottom:6px;}
        .form-input{width:100%;border:1px solid var(--brown-200);border-radius:4px;padding:10px 14px;font-size:14px;font-family:'Inter',sans-serif;background:var(--cream);color:var(--brown-900);transition:border-color .2s;}
        .form-input:focus{outline:none;border-color:var(--brown-400);}
        .error-msg{font-size:12px;color:#A32D2D;margin-top:4px;}
        .submit-btn{width:100%;background:var(--brown-800);color:var(--cream);border:none;padding:12px;border-radius:4px;font-size:13px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;margin-bottom:16px;}
        .submit-btn:hover{background:var(--brown-600);}
        .divider{text-align:center;font-size:12px;color:var(--text-light);margin-bottom:16px;}
        .login-btn{display:block;width:100%;text-align:center;background:transparent;color:var(--brown-700);border:1px solid var(--brown-300);padding:12px;border-radius:4px;font-size:13px;font-weight:500;letter-spacing:1px;text-transform:uppercase;text-decoration:none;transition:all .2s;}
        .login-btn:hover{border-color:var(--brown-600);color:var(--brown-800);}
    </style>
</head>
<body>

<div class="card">
    <div class="brand">Coffeineé</div>
    <div class="brand-sub">Buat akun baru</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-input"
                value="{{ old('name') }}" placeholder="Nama lengkap kamu" required autofocus>
            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input"
                value="{{ old('email') }}" placeholder="email@example.com" required>
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input"
                placeholder="Minimal 8 karakter" required>
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input"
                placeholder="Ulangi password" required>
        </div>

        <button type="submit" class="submit-btn">Daftar Sekarang</button>
    </form>

    <div class="divider">Sudah punya akun?</div>
    <a href="{{ route('login') }}" class="login-btn">Masuk</a>
</div>

</body>
</html>