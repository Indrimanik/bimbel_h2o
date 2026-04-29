<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Bimbel H2O Tarutung</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; min-height: 100vh; background: #f0f4ff; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .register-wrap { width: 100%; max-width: 500px; }
        .register-top { text-align: center; margin-bottom: 24px; }
        .brand-badge { display: inline-flex; align-items: center; gap: 10px; background: #0d1b4b; border-radius: 14px; padding: 10px 18px; margin-bottom: 20px; }
        .brand-badge .icon { font-size: 22px; }
        .brand-badge .name { font-size: 15px; font-weight: 800; color: white; }
        .brand-badge .sub { font-size: 11px; color: rgba(255,255,255,0.5); letter-spacing: 1px; }
        .register-card { background: white; border-radius: 20px; padding: 36px; box-shadow: 0 20px 60px rgba(26,63,196,0.12); }
        .card-header { margin-bottom: 28px; }
        .card-header h2 { font-size: 22px; font-weight: 800; color: #0d1b4b; }
        .card-header p { color: #64748b; font-size: 14px; margin-top: 4px; }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #0d1b4b; margin-bottom: 7px; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; }
        .form-control { width: 100%; padding: 11px 14px 11px 40px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; font-family: inherit; color: #0d1b4b; outline: none; transition: all 0.2s; }
        .form-control:focus { border-color: #1a3fc4; box-shadow: 0 0 0 3px rgba(26,63,196,0.12); }
        .form-control::placeholder { color: #94a3b8; }
        .field-error { color: #e11d48; font-size: 12px; margin-top: 5px; }
        .btn-register { width: 100%; padding: 14px; background: #1a3fc4; color: white; border: none; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; font-family: inherit; transition: all 0.2s; margin-top: 8px; }
        .btn-register:hover { background: #0f2a8a; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(26,63,196,0.35); }
        .card-login { text-align: center; margin-top: 18px; font-size: 14px; color: #64748b; }
        .card-login a { color: #1a3fc4; font-weight: 600; text-decoration: none; }
        .card-login a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="register-wrap">
    <div class="register-top">
        <a href="/" style="text-decoration:none;">
            <div class="brand-badge">
                <span class="icon">💧</span>
                <div>
                    <div class="name">Bimbel H2O</div>
                    <div class="sub">TARUTUNG</div>
                </div>
            </div>
        </a>
    </div>

    <div class="register-card">
        <div class="card-header">
            <h2>Buat Akun Baru</h2>
            <p>Daftarkan dirimu untuk mulai belajar bersama kami.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-wrap">
                    <i class="fa fa-user input-icon"></i>
                    <input type="text" name="name" class="form-control" placeholder="Nama lengkapmu" value="{{ old('name') }}" required autofocus>
                </div>
                @error('name')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrap">
                    <i class="fa fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="email@kamu.com" value="{{ old('email') }}" required>
                </div>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <i class="fa fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
                </div>
                @error('password')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-wrap">
                    <i class="fa fa-shield input-icon"></i>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="btn-register">Buat Akun</button>
        </form>

        <div class="card-login">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>

</body>
</html>
