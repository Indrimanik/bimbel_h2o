<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Bimbel H2O Tarutung</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0d1b4b;
        }

        /* LEFT PANEL */
        .left-panel {
            flex: 1;
            background: linear-gradient(145deg, #0d1b4b 0%, #1a3fc4 60%, #3b5fe8 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            bottom: -100px; left: -100px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245,158,11,0.2) 0%, transparent 70%);
        }
        .left-panel::after {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(91,113,255,0.3) 0%, transparent 70%);
        }
        .panel-content { position: relative; z-index: 1; }
        .panel-logo {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 60px;
        }
        .panel-logo-icon {
            width: 50px; height: 50px;
            background: rgba(255,255,255,0.15);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            backdrop-filter: blur(10px);
        }
        .panel-logo-text { color: white; }
        .panel-logo-text strong { display: block; font-size: 18px; font-weight: 800; }
        .panel-logo-text span { font-size: 12px; opacity: 0.6; letter-spacing: 1px; }

        .panel-heading {
            font-size: 38px; font-weight: 800;
            color: white; line-height: 1.2;
            margin-bottom: 20px;
        }
        .panel-heading span { color: #f59e0b; }
        .panel-desc { color: rgba(255,255,255,0.6); font-size: 15px; line-height: 1.7; margin-bottom: 40px; }

        .feature-list { display: flex; flex-direction: column; gap: 14px; }
        .feature-item {
            display: flex; align-items: center; gap: 12px;
            color: rgba(255,255,255,0.8); font-size: 14px; font-weight: 500;
        }
        .feature-dot {
            width: 32px; height: 32px;
            border-radius: 9px;
            background: rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 14px;
        }

        /* RIGHT PANEL */
        .right-panel {
            width: 480px;
            background: #f0f4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(26,63,196,0.12);
        }
        .card-header { text-align: center; margin-bottom: 32px; }
        .card-header h2 { font-size: 24px; font-weight: 800; color: #0d1b4b; margin-bottom: 6px; }
        .card-header p { color: #64748b; font-size: 14px; }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #0d1b4b; margin-bottom: 7px; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 15px; }
        .form-control {
            width: 100%; padding: 12px 14px 12px 42px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px; font-family: inherit;
            color: #0d1b4b; background: white;
            outline: none; transition: all 0.2s;
        }
        .form-control:focus { border-color: #1a3fc4; box-shadow: 0 0 0 3px rgba(26,63,196,0.12); }
        .form-control::placeholder { color: #94a3b8; }

        .form-footer { display: flex; justify-content: flex-end; margin-top: 6px; }
        .forgot-link { font-size: 13px; color: #1a3fc4; text-decoration: none; font-weight: 500; }
        .forgot-link:hover { text-decoration: underline; }

        .alert-error {
            background: #ffe4e6; border: 1px solid #fecdd3;
            color: #be123c; border-radius: 10px; padding: 12px 14px;
            font-size: 13px; margin-bottom: 18px;
        }

        .btn-login {
            width: 100%; padding: 14px;
            background: #1a3fc4;
            color: white; border: none; border-radius: 10px;
            font-size: 15px; font-weight: 700; cursor: pointer;
            font-family: inherit; transition: all 0.2s;
            margin-top: 8px;
        }
        .btn-login:hover { background: #0f2a8a; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(26,63,196,0.35); }

        .card-register { text-align: center; margin-top: 20px; font-size: 14px; color: #64748b; }
        .card-register a { color: #1a3fc4; font-weight: 600; text-decoration: none; }
        .card-register a:hover { text-decoration: underline; }

        @media (max-width: 900px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 24px; }
            body { background: #f0f4ff; }
        }
    </style>
</head>
<body>

<div class="left-panel">
    <div class="panel-content">
        <div class="panel-logo">
            <div class="panel-logo-icon">💧</div>
            <div class="panel-logo-text">
                <strong>Bimbel H2O</strong>
                <span>TARUTUNG</span>
            </div>
        </div>

        <h1 class="panel-heading">Raih Mimpi<br>Bersama <span>H2O</span></h1>
        <p class="panel-desc">Platform bimbingan belajar terpercaya untuk persiapan Seleksi Kedinasan & UTBK PTN di Tarutung.</p>

        <div class="feature-list">
            <div class="feature-item">
                <div class="feature-dot">🎯</div>
                Materi terstruktur & fokus
            </div>
            <div class="feature-item">
                <div class="feature-dot">👨‍🏫</div>
                Pengajar berpengalaman
            </div>
            <div class="feature-item">
                <div class="feature-dot">📊</div>
                Pantau progres belajarmu
            </div>
        </div>
    </div>
</div>

<div class="right-panel">
    <div class="login-card">
        <div class="card-header">
            <h2>Masuk ke Akun</h2>
            <p>Selamat datang kembali di Bimbel H2O</p>
        </div>

        @if(session('status'))
            <div class="alert-error">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrap">
                    <i class="fa fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="email@kamu.com" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')<div style="color:#e11d48;font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <i class="fa fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                @error('password')<div style="color:#e11d48;font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
            </div>

            @if (Route::has('password.request'))
            <div class="form-footer">
                <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
            </div>
            @endif

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        @if (Route::has('register'))
        <div class="card-register">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
        @endif
    </div>
</div>

</body>
</html>
