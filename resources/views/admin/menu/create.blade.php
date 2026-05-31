<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu — Admin Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-700:#6B3F22;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-300:#D4A574;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--brown-50:#FAF6F0;--cream:#FFFDF9;--text-light:#9B7550;}
        body{font-family:'Inter',sans-serif;background:var(--brown-50);color:var(--brown-900);}
        nav{background:var(--brown-800);display:flex;align-items:center;justify-content:space-between;padding:0 48px;height:64px;position:sticky;top:0;z-index:100;}
        .nav-logo{font-family:'Playfair Display',serif;font-size:22px;font-weight:600;color:var(--brown-200);text-decoration:none;}
        .nav-links{display:flex;align-items:center;gap:20px;}
        .nav-link{font-size:12px;color:var(--brown-300);text-decoration:none;letter-spacing:1px;text-transform:uppercase;}
        .nav-link:hover{color:var(--cream);}

        .flash{max-width:700px;margin:16px auto 0;padding:0 32px;}
        .flash-error{background:#FCEBEB;border-left:3px solid #A32D2D;color:#A32D2D;padding:10px 16px;border-radius:2px;font-size:13px;margin-bottom:6px;}

        .page-header{background:var(--brown-900);padding:40px 48px;}
        .page-title{font-family:'Playfair Display',serif;font-size:32px;font-weight:700;color:var(--cream);}
        .page-sub{font-size:13px;color:var(--brown-300);margin-top:6px;}

        .main{max-width:700px;margin:40px auto;padding:0 32px;}

        .form-card{background:var(--cream);border:1px solid var(--brown-100);border-radius:6px;padding:32px;}
        .form-section{margin-bottom:24px;}
        .form-section-title{font-size:11px;font-weight:500;letter-spacing:2px;text-transform:uppercase;color:var(--text-light);margin-bottom:16px;padding-bottom:8px;border-bottom:1px solid var(--brown-100);}

        .form-group{margin-bottom:18px;}
        .form-label{font-size:13px;font-weight:500;color:var(--brown-800);display:block;margin-bottom:6px;}
        .form-label span{color:#A32D2D;}
        .form-input,.form-select,.form-textarea{width:100%;border:1px solid var(--brown-200);border-radius:4px;padding:10px 14px;font-size:14px;font-family:'Inter',sans-serif;background:var(--cream);color:var(--brown-900);transition:border-color .2s;}
        .form-input:focus,.form-select:focus,.form-textarea:focus{outline:none;border-color:var(--brown-400);}
        .form-input::placeholder,.form-textarea::placeholder{color:var(--brown-300);}
        .form-textarea{resize:vertical;min-height:80px;}
        .form-hint{font-size:11px;color:var(--text-light);margin-top:4px;}

        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

        /* Toggle tersedia */
        .toggle-wrap{display:flex;align-items:center;gap:12px;}
        .toggle{position:relative;width:44px;height:24px;flex-shrink:0;}
        .toggle input{opacity:0;width:0;height:0;}
        .toggle-slider{position:absolute;inset:0;background:var(--brown-200);border-radius:24px;cursor:pointer;transition:.3s;}
        .toggle-slider::before{content:'';position:absolute;width:18px;height:18px;left:3px;top:3px;background:white;border-radius:50%;transition:.3s;}
        .toggle input:checked + .toggle-slider{background:var(--brown-600);}
        .toggle input:checked + .toggle-slider::before{transform:translateX(20px);}
        .toggle-label{font-size:14px;color:var(--brown-900);}

        /* File upload */
        .file-upload{border:2px dashed var(--brown-200);border-radius:4px;padding:24px;text-align:center;cursor:pointer;transition:all .2s;position:relative;}
        .file-upload:hover{border-color:var(--brown-400);background:var(--brown-50);}
        .file-upload-icon{font-size:28px;margin-bottom:8px;}
        .file-upload-text{font-size:13px;color:var(--text-light);}
        .file-upload-text strong{color:var(--brown-600);}
        .file-input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}

        /* Preview */
        .img-preview{width:100%;max-height:180px;object-fit:cover;border-radius:4px;margin-top:10px;display:none;}

        .form-actions{display:flex;gap:12px;margin-top:8px;}
        .btn-submit{flex:1;background:var(--brown-800);color:var(--cream);border:none;padding:13px;border-radius:2px;font-size:13px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;}
        .btn-submit:hover{background:var(--brown-600);}
        .btn-cancel{flex:1;background:transparent;color:var(--brown-700);border:1px solid var(--brown-300);padding:13px;border-radius:2px;font-size:13px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;text-decoration:none;display:flex;align-items:center;justify-content:center;transition:all .2s;}
        .btn-cancel:hover{border-color:var(--brown-600);color:var(--brown-800);}

        .page-footer{background:var(--brown-900);padding:24px 48px;text-align:center;margin-top:48px;}
        .footer-copy{font-size:12px;color:var(--brown-600);}

        @media(max-width:768px){nav{padding:0 20px;}.page-header{padding:32px 20px;}.main{padding:0 20px;margin:24px auto;}.form-row{grid-template-columns:1fr;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="nav-logo">Coffeineé</a>
    <div class="nav-links">
        <a href="{{ route('admin.menu.index') }}" class="nav-link">← Daftar Menu</a>
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
    </div>
</nav>

@if($errors->any())
<div class="flash">
    @foreach($errors->all() as $error)
    <div class="flash-error">{{ $error }}</div>
    @endforeach
</div>
@endif

<div class="page-header">
    <h1 class="page-title">Tambah Menu Baru</h1>
    <p class="page-sub">Isi detail menu yang akan ditampilkan kepada pelanggan</p>
</div>

<div class="main">
    <div class="form-card">
        <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Info Dasar --}}
            <div class="form-section">
                <div class="form-section-title">Informasi Menu</div>
                <div class="form-group">
                    <label class="form-label">Nama Menu <span>*</span></label>
                    <input type="text" name="nama_menu" class="form-input" value="{{ old('nama_menu') }}" placeholder="Contoh: Caramel Latte" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori <span>*</span></label>
                        <select name="kategori" class="form-select" required>
                            <option value="">Pilih kategori</option>
                            <option value="coffee"     {{ old('kategori') === 'coffee'     ? 'selected' : '' }}>☕ Coffee</option>
                            <option value="non-coffee" {{ old('kategori') === 'non-coffee' ? 'selected' : '' }}>🍵 Non-Coffee</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga (Rp) <span>*</span></label>
                        <input type="number" name="harga" class="form-input" value="{{ old('harga') }}" placeholder="Contoh: 35000" min="0" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-textarea" placeholder="Contoh: Espresso dengan susu steamed dan sirup karamel premium.">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            {{-- Stok & Status --}}
            <div class="form-section">
                <div class="form-section-title">Stok & Ketersediaan</div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Stok Awal <span>*</span></label>
                        <input type="number" name="stok" class="form-input" value="{{ old('stok', 50) }}" min="0" required>
                        <div class="form-hint">Jumlah porsi yang tersedia</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="toggle-wrap" style="margin-top:10px">
                            <label class="toggle">
                                <input type="checkbox" name="tersedia" value="1" {{ old('tersedia', true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Tersedia untuk dipesan</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gambar --}}
            <div class="form-section">
                <div class="form-section-title">Foto Menu</div>
                <div class="file-upload" onclick="document.getElementById('gambarInput').click()">
                    <input type="file" id="gambarInput" name="gambar" accept="image/jpeg,image/png,image/webp" class="file-input" onchange="previewImg(this)">
                    <div class="file-upload-icon">🖼️</div>
                    <div class="file-upload-text"><strong>Klik untuk upload</strong> atau drag & drop</div>
                    <div class="file-upload-text" style="margin-top:4px">JPG, PNG, WEBP — maks. 2MB</div>
                </div>
                <img id="imgPreview" class="img-preview" alt="Preview">
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan Menu</button>
                <a href="{{ route('admin.menu.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

<div class="page-footer">
    <p class="footer-copy">&copy; {{ date('Y') }} Coffeineé — Panel Admin</p>
</div>

<script>
function previewImg(input) {
    const preview = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
