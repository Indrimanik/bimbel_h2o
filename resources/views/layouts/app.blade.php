<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbel H2O Tarutung</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #1a3fc4;
            --primary-dark: #0f2a8a;
            --primary-light: #3b5fe8;
            --accent: #f59e0b;
            --bg: #f0f4ff;
            --sidebar-bg: #0d1b4b;
            --card-bg: #ffffff;
            --text-primary: #0d1b4b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --shadow: 0 4px 24px rgba(26,63,196,0.10);
            --radius: 16px;
            --sidebar-width: 260px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text-primary); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: var(--sidebar-width); background: var(--sidebar-bg); height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 100; transition: transform 0.3s ease; overflow: hidden; }
        .sidebar::before { content: ''; position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(91,113,255,0.25) 0%, transparent 70%); pointer-events: none; }
        .sidebar-header { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-icon { width: 44px; height: 44px; background: linear-gradient(135deg, var(--primary-light), var(--accent)); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; box-shadow: 0 4px 12px rgba(91,113,255,0.4); }
        .brand-name { font-size: 15px; font-weight: 800; color: white; letter-spacing: -0.3px; }
        .brand-sub { font-size: 11px; font-weight: 500; color: rgba(255,255,255,0.45); letter-spacing: 0.5px; }
        .sidebar-nav { flex: 1; padding: 20px 16px; overflow-y: auto; }
        .nav-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; color: rgba(255,255,255,0.3); text-transform: uppercase; padding: 0 8px; margin: 8px 0; }
        .sidebar a.nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 14px; margin-bottom: 4px; border-radius: 12px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s ease; position: relative; }
        .sidebar a.nav-item .nav-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 15px; background: rgba(255,255,255,0.06); transition: all 0.2s; flex-shrink: 0; }
        .sidebar a.nav-item:hover { color: white; background: rgba(255,255,255,0.08); }
        .sidebar a.nav-item:hover .nav-icon { background: rgba(255,255,255,0.15); }
        .sidebar a.nav-item.active { background: rgba(255,255,255,0.12); color: white; }
        .sidebar a.nav-item.active .nav-icon { background: linear-gradient(135deg, var(--primary-light), #5b71ff); box-shadow: 0 4px 10px rgba(91,113,255,0.45); color: white; }
        .sidebar a.nav-item.active::before { content: ''; position: absolute; left: 0; top: 25%; bottom: 25%; width: 3px; background: var(--primary-light); border-radius: 0 3px 3px 0; }
        .sidebar-footer { padding: 16px; border-top: 1px solid rgba(255,255,255,0.08); }
        .user-card { display: flex; align-items: center; gap: 12px; padding: 12px; border-radius: 12px; background: rgba(255,255,255,0.06); margin-bottom: 12px; }
        .user-avatar { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, var(--primary-light), var(--accent)); display: flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 700; color: white; flex-shrink: 0; }
        .user-name { font-size: 13px; font-weight: 600; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.4); }
        .btn-logout { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 10px; background: rgba(239,68,68,0.12); color: #fca5a5; border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit; transition: all 0.2s; }
        .btn-logout:hover { background: rgba(239,68,68,0.25); color: #f87171; }

        /* MAIN */
        .main { margin-left: var(--sidebar-width); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: white; border-bottom: 1px solid var(--border); padding: 0 40px; height: 68px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .btn-menu { display: none; width: 38px; height: 38px; border-radius: 10px; border: 1px solid var(--border); background: white; cursor: pointer; align-items: center; justify-content: center; font-size: 16px; color: var(--text-secondary); transition: all 0.2s; }
        .btn-menu:hover { background: var(--bg); }
        .page-title { font-size: 18px; font-weight: 700; color: var(--text-primary); }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-badge { display: flex; align-items: center; gap: 8px; padding: 7px 14px; background: var(--bg); border-radius: 10px; border: 1px solid var(--border); font-size: 13px; font-weight: 600; color: var(--text-primary); }
        .topbar-badge i { color: var(--primary); }
        .page-content { padding: 36px 40px; flex: 1; }

        /* COMPONENTS */
        .card { background: var(--card-bg); border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--border); padding: 28px; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 28px; }
        .stat-box { background: white; border-radius: var(--radius); padding: 24px; border: 1px solid var(--border); box-shadow: var(--shadow); display: flex; align-items: center; gap: 18px; }
        .stat-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
        .stat-icon.blue { background: #eff2ff; color: var(--primary); }
        .stat-icon.amber { background: #fef3c7; color: #d97706; }
        .stat-icon.green { background: #dcfce7; color: #16a34a; }
        .stat-icon.rose { background: #ffe4e6; color: #e11d48; }
        .stat-info h3 { font-size: 28px; font-weight: 800; color: var(--text-primary); line-height: 1; }
        .stat-info p { font-size: 13px; color: var(--text-secondary); margin-top: 4px; font-weight: 500; }

        table { width: 100%; border-collapse: collapse; }
        thead th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: var(--text-secondary); border-bottom: 1px solid var(--border); }
        tbody td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f1f5f9; color: var(--text-primary); }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #fafbff; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-blue { background: #eff2ff; color: var(--primary); }
        .badge-green { background: #dcfce7; color: #16a34a; }
        .badge-amber { background: #fef3c7; color: #d97706; }
        .badge-red { background: #ffe4e6; color: #e11d48; }

        .btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 11px 22px; background: var(--primary); color: white; border: none; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; font-family: inherit; text-decoration: none; transition: all 0.2s; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,63,196,0.3); }
        .btn-secondary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: white; color: var(--text-primary); border: 1px solid var(--border); border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; font-family: inherit; text-decoration: none; transition: all 0.2s; }
        .btn-secondary:hover { background: var(--bg); }

        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 7px; }
        .form-control { width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: 10px; font-size: 14px; font-family: inherit; color: var(--text-primary); background: white; transition: all 0.2s; outline: none; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,63,196,0.12); }
        .form-control::placeholder { color: #94a3b8; }

        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 90; backdrop-filter: blur(2px); }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .main { margin-left: 0; }
            .btn-menu { display: flex; }
            .topbar { padding: 0 20px; }
            .page-content { padding: 24px 20px; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="/dashboard" class="brand">
            <div class="brand-icon">💧</div>
            <div>
                <div class="brand-name">Bimbel H2O</div>
                <div class="brand-sub">TARUTUNG</div>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>
        <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa fa-house"></i></span> Dashboard
        </a>
        <a href="/kelas" class="nav-item {{ request()->is('kelas') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa fa-book-open"></i></span> Kelas
        </a>
        <a href="/riwayat" class="nav-item {{ request()->is('riwayat') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa fa-clock-rotate-left"></i></span> Riwayat
        </a>
        <a href="/pengajar" class="nav-item {{ request()->is('pengajar') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa fa-chalkboard-user"></i></span> Pengajar
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
            <div style="overflow:hidden">
                <div class="user-name">{{ auth()->user()->name ?? 'Pengguna' }}</div>
                <div class="user-role">Siswa</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-logout" type="submit"><i class="fa fa-right-from-bracket"></i> Keluar</button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <button class="btn-menu" onclick="toggleSidebar()"><i class="fa fa-bars"></i></button>
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><i class="fa fa-graduation-cap"></i> Bimbel H2O</div>
        </div>
    </header>
    <div class="page-content">
        @yield('content')
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('open');
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('open');
}
</script>
</body>
</html>
