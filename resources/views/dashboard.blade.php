@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')

<div style="margin-bottom:28px;">
    <h1 style="font-size:24px;font-weight:800;color:var(--text-primary);">Selamat datang, {{ auth()->user()->name }} 👋</h1>
    <p style="color:var(--text-secondary);margin-top:6px;font-size:14px;">Pantau perkembangan belajarmu di Bimbel H2O Tarutung.</p>
</div>

<!-- STATS -->
<div class="stats">
    <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-users"></i></div>
        <div class="stat-info"><h3>120</h3><p>Total Siswa</p></div>
    </div>
    <div class="stat-box">
        <div class="stat-icon amber"><i class="fa fa-book-open"></i></div>
        <div class="stat-info"><h3>2</h3><p>Program Kelas</p></div>
    </div>
    <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-chalkboard-user"></i></div>
        <div class="stat-info"><h3>5</h3><p>Pengajar Aktif</p></div>
    </div>
</div>

<!-- BANNER -->
<div style="background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:var(--radius);padding:32px;color:white;margin-bottom:24px;position:relative;overflow:hidden;">
    <div style="position:absolute;right:-40px;top:-40px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.07);"></div>
    <div style="position:absolute;right:60px;bottom:-60px;width:150px;height:150px;border-radius:50%;background:rgba(255,255,255,0.05);"></div>
    <div style="position:relative;z-index:1;">
        <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);border-radius:20px;padding:5px 14px;font-size:12px;font-weight:600;margin-bottom:14px;letter-spacing:0.3px;">
            🚀 Program Unggulan
        </div>
        <h2 style="font-size:22px;font-weight:800;margin-bottom:10px;line-height:1.3;">Waktunya Naik Level!</h2>
        <p style="font-size:14px;opacity:0.85;margin-bottom:20px;line-height:1.6;">
            Persiapkan dirimu menghadapi <strong>Seleksi Kedinasan</strong> & <strong>UTBK PTN</strong> bersama pengajar berpengalaman kami.
        </p>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:500;">
                <i class="fa fa-check-circle"></i> Materi fokus & terarah
            </div>
            <div style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:500;">
                <i class="fa fa-check-circle"></i> Pantau progres belajar
            </div>
            <div style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:500;">
                <i class="fa fa-check-circle"></i> Latihan soal intensif
            </div>
        </div>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div class="card">
    <h3 style="font-size:16px;font-weight:700;margin-bottom:18px;">Akses Cepat</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;">
        <a href="/kelas" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px;border:1.5px solid var(--border);border-radius:12px;text-decoration:none;color:var(--text-primary);transition:all 0.2s;text-align:center;" onmouseover="this.style.borderColor='var(--primary)';this.style.background='#f0f4ff'" onmouseout="this.style.borderColor='var(--border)';this.style.background='white'">
            <div style="width:44px;height:44px;border-radius:12px;background:#eff2ff;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--primary);">
                <i class="fa fa-book-open"></i>
            </div>
            <span style="font-size:13px;font-weight:600;">Daftar Kelas</span>
        </a>
        <a href="/riwayat" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px;border:1.5px solid var(--border);border-radius:12px;text-decoration:none;color:var(--text-primary);transition:all 0.2s;text-align:center;" onmouseover="this.style.borderColor='var(--primary)';this.style.background='#f0f4ff'" onmouseout="this.style.borderColor='var(--border)';this.style.background='white'">
            <div style="width:44px;height:44px;border-radius:12px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:20px;color:#16a34a;">
                <i class="fa fa-clock-rotate-left"></i>
            </div>
            <span style="font-size:13px;font-weight:600;">Riwayat Saya</span>
        </a>
        <a href="/pengajar" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px;border:1.5px solid var(--border);border-radius:12px;text-decoration:none;color:var(--text-primary);transition:all 0.2s;text-align:center;" onmouseover="this.style.borderColor='var(--primary)';this.style.background='#f0f4ff'" onmouseout="this.style.borderColor='var(--border)';this.style.background='white'">
            <div style="width:44px;height:44px;border-radius:12px;background:#fef3c7;display:flex;align-items:center;justify-content:center;font-size:20px;color:#d97706;">
                <i class="fa fa-chalkboard-user"></i>
            </div>
            <span style="font-size:13px;font-weight:600;">Pengajar</span>
        </a>
        <a href="{{ route('profile.edit') }}" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px;border:1.5px solid var(--border);border-radius:12px;text-decoration:none;color:var(--text-primary);transition:all 0.2s;text-align:center;" onmouseover="this.style.borderColor='var(--primary)';this.style.background='#f0f4ff'" onmouseout="this.style.borderColor='var(--border)';this.style.background='white'">
            <div style="width:44px;height:44px;border-radius:12px;background:#ffe4e6;display:flex;align-items:center;justify-content:center;font-size:20px;color:#e11d48;">
                <i class="fa fa-user-circle"></i>
            </div>
            <span style="font-size:13px;font-weight:600;">Profil Saya</span>
        </a>
    </div>
</div>

@endsection
