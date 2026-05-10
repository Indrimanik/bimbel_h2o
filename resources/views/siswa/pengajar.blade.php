@extends('layouts.app')

@section('page-title', 'Pengajar')

@section('content')

<!-- HEADER -->
<div class="pg-header">
    <div>
        <h1 class="pg-title">Tim Pengajar</h1>
        <p class="pg-subtitle">Kenali para pengajar berpengalaman yang siap membimbingmu meraih impian.</p>
    </div>
</div>

<!-- STATS STRIP -->
<div class="stats-strip">
    <div class="stat-card">
        <div class="stat-icon" style="background:#eff2ff;color:var(--primary);">
            <i class="fa fa-chalkboard-user"></i>
        </div>
        <div>
            <div class="stat-value">{{ $stats['aktif'] }}</div>
            <div class="stat-label">Pengajar Aktif</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#dcfce7;color:#16a34a;">
            <i class="fa fa-book-open"></i>
        </div>
        <div>
            <div class="stat-value">{{ $stats['mapel_unik'] }}</div>
            <div class="stat-label">Mata Pelajaran</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fef3c7;color:#d97706;">
            <i class="fa fa-star"></i>
        </div>
        <div>
            <div class="stat-value">{{ number_format($stats['rating_avg'], 1) }}</div>
            <div class="stat-label">Rating Rata-rata</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fce7f3;color:#db2777;">
            <i class="fa fa-users"></i>
        </div>
        <div>
            <div class="stat-value">{{ number_format($stats['total_siswa']) }}</div>
            <div class="stat-label">Siswa Dibimbing</div>
        </div>
    </div>
</div>

<!-- FILTER BAR -->
<form method="GET" action="{{ url()->current() }}" class="filter-bar">
    <div class="search-wrap">
        <i class="fa fa-search search-icon"></i>
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama atau mata pelajaran..."
            class="search-input"
        >
        @if(request('search'))
            <a href="{{ url()->current() }}" class="clear-search"><i class="fa fa-times"></i></a>
        @endif
    </div>

    <select name="mapel" class="filter-select" onchange="this.form.submit()">
        <option value="">Semua Mata Pelajaran</option>
        @foreach($mapelList as $m)
            <option value="{{ $m }}" @selected(request('mapel') == $m)>{{ $m }}</option>
        @endforeach
    </select>

    <select name="sort" class="filter-select" onchange="this.form.submit()">
        <option value="rating"     @selected(request('sort','rating') == 'rating')>Rating Tertinggi</option>
        <option value="nama"       @selected(request('sort') == 'nama')>Nama A-Z</option>
        <option value="pengalaman" @selected(request('sort') == 'pengalaman')>Pengalaman Terbanyak</option>
        <option value="siswa"      @selected(request('sort') == 'siswa')>Siswa Terbanyak</option>
    </select>

    <button type="submit" class="btn-search-submit">
        <i class="fa fa-search"></i> Cari
    </button>
</form>

@if(count($data) > 0)
<div class="result-meta">
    Menampilkan <strong>{{ count($data) }}</strong> pengajar
    @if(request('search')) untuk "<em>{{ request('search') }}</em>"@endif
</div>
@endif

<!-- GRID PENGAJAR -->
<div class="teachers-grid">
    @forelse($data as $item)
    <div class="teacher-card" onclick="openModal({{ $item->id }})">

        <div class="card-photo-wrap">
            <img
                src="{{ $item->foto_url }}"
                alt="{{ $item->nama }}"
                class="card-photo"
                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=1a3fc4&color=fff&size=300'"
            >
            <div class="rating-badge">
                <i class="fa fa-star"></i> {{ number_format($item->rating, 1) }}
            </div>
            <div class="status-badge">
                <span class="status-dot"></span> Aktif
            </div>
            <div class="card-overlay">
                <span class="overlay-hint"><i class="fa fa-eye"></i> Lihat Profil</span>
            </div>
        </div>

        <div class="card-body">
            <h3 class="card-name">{{ $item->nama }}</h3>

            <div class="card-mapel">
                <i class="fa fa-book" style="font-size:10px;"></i>
                {{ $item->mapel ?? 'Pengajar' }}
            </div>

            <div class="stars-row">
                @for($s = 1; $s <= 5; $s++)
                    @if($s <= floor($item->rating))
                        <i class="fa fa-star star-filled"></i>
                    @elseif($s == ceil($item->rating) && ($item->rating - floor($item->rating)) >= 0.5)
                        <i class="fa fa-star-half-stroke star-filled"></i>
                    @else
                        <i class="fa fa-star star-empty"></i>
                    @endif
                @endfor
                <span class="stars-count">({{ $item->total_ulasan }} ulasan)</span>
            </div>

            <div class="card-divider"></div>

            <div class="card-meta">
                <div class="meta-item">
                    <i class="fa fa-graduation-cap meta-icon"></i>
                    <span>{{ $item->pendidikan ?? 'S1' }} - {{ $item->universitas ?? '-' }}</span>
                </div>
                <div class="meta-item">
                    <i class="fa fa-clock meta-icon"></i>
                    <span>{{ $item->pengalaman ?? 0 }}+ tahun pengalaman</span>
                </div>
                <div class="meta-item">
                    <i class="fa fa-users meta-icon"></i>
                    <span>{{ number_format($item->total_siswa) }} siswa dibimbing</span>
                </div>
            </div>

            @if($item->jadwal && count($item->jadwal) > 0)
            <div class="jadwal-tags">
                @foreach($item->jadwal as $hari)
                    <span class="jadwal-tag">{{ $hari }}</span>
                @endforeach
            </div>
            @endif

            <a href="/kelas" class="card-cta" onclick="event.stopPropagation()">
                <i class="fa fa-calendar-plus"></i> Daftar Kelas
            </a>
        </div>

    </div>
    @empty
    <div class="empty-state">
        <div class="empty-emoji">&#x1F9D1;&#x200D;&#x1F3EB;</div>
        <h3 class="empty-title">
            @if(request('search') || request('mapel'))
                Pengajar tidak ditemukan
            @else
                Belum ada data pengajar
            @endif
        </h3>
        <p class="empty-sub">
            @if(request('search') || request('mapel'))
                Coba kata kunci atau filter yang berbeda.
                <br><a href="{{ url()->current() }}" style="color:var(--primary);font-weight:600;">Reset pencarian</a>
            @else
                Data pengajar akan segera ditambahkan.
            @endif
        </p>
    </div>
    @endforelse
</div>

<!-- CTA BANNER -->
<div class="cta-banner">
    <div class="cta-deco cta-deco-1"></div>
    <div class="cta-deco cta-deco-2"></div>
    <div class="cta-text">
        <h3 class="cta-title">Siap belajar bersama kami?</h3>
        <p class="cta-sub">Bergabung sekarang dan mulai perjalanan belajarmu bersama pengajar terbaik Bimbel H2O.</p>
    </div>
    <a href="/kelas" class="cta-btn">
        <i class="fa fa-arrow-right"></i> Daftar Sekarang
    </a>
</div>

<!-- MODAL DETAIL PENGAJAR -->
<div id="modal-overlay" class="modal-overlay" onclick="closeModal()">
    <div class="modal-box" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal()"><i class="fa fa-times"></i></button>
        <div id="modal-content" class="modal-content"></div>
    </div>
</div>

@php
$pengajarJson = $data->map(function($p) {
    return [
        'id'           => $p->id,
        'nama'         => $p->nama,
        'foto_url'     => $p->foto_url,
        'mapel'        => $p->mapel,
        'pendidikan'   => $p->pendidikan,
        'universitas'  => $p->universitas,
        'pengalaman'   => $p->pengalaman,
        'bio'          => $p->bio,
        'rating'       => $p->rating,
        'total_ulasan' => $p->total_ulasan,
        'total_siswa'  => $p->total_siswa,
        'email'        => $p->email,
        'no_hp'        => $p->no_hp,
        'sertifikasi'  => $p->sertifikasi ?? [],
        'jadwal'       => $p->jadwal ?? [],
    ];
});
@endphp

<script>
const pengajarData = {!! json_encode($pengajarJson) !!};

function openModal(id) {
    const p = pengajarData.find(function(x) { return x.id == id; });
    if (!p) return;

    const stars = Array.from({length: 5}, function(_, i) {
        const v = i + 1;
        if (v <= Math.floor(p.rating)) return '<i class="fa fa-star" style="color:#f59e0b;font-size:15px;"></i>';
        if (v == Math.ceil(p.rating) && (p.rating % 1) >= 0.5) return '<i class="fa fa-star-half-stroke" style="color:#f59e0b;font-size:15px;"></i>';
        return '<i class="fa fa-star" style="color:#e2e8f0;font-size:15px;"></i>';
    }).join('');

    const sertList = p.sertifikasi || [];
    const jadwalList = p.jadwal || [];

    const sertHTML = sertList.map(function(s) {
        return '<span class="badge-sert"><i class="fa fa-certificate"></i> ' + s + '</span>';
    }).join('');

    const jadwalHTML = jadwalList.map(function(h) {
        return '<span class="jadwal-tag">' + h + '</span>';
    }).join('');

    const noHpClean = p.no_hp ? p.no_hp.replace(/\D/g, '').replace(/^0/, '62') : '';

    let html = '<div class="modal-hero">';
    html += '<img src="' + p.foto_url + '" alt="' + p.nama + '" class="modal-photo" onerror="this.src=\'https://ui-avatars.com/api/?name=' + encodeURIComponent(p.nama) + '&background=1a3fc4&color=fff&size=300\'">';
    html += '<div class="modal-hero-info">';
    html += '<div class="card-mapel" style="margin-bottom:8px;"><i class="fa fa-book" style="font-size:10px;"></i> ' + (p.mapel || 'Pengajar') + '</div>';
    html += '<h2 class="modal-name">' + p.nama + '</h2>';
    html += '<div class="stars-row" style="margin-top:6px;">' + stars + '<span class="stars-count">' + parseFloat(p.rating).toFixed(1) + ' (' + p.total_ulasan + ' ulasan)</span></div>';
    html += '<div class="modal-stats">';
    html += '<div class="mstat"><div class="mstat-val">' + p.pengalaman + '+</div><div class="mstat-lbl">Tahun Pengalaman</div></div>';
    html += '<div class="mstat"><div class="mstat-val">' + Number(p.total_siswa).toLocaleString() + '</div><div class="mstat-lbl">Siswa Dibimbing</div></div>';
    html += '<div class="mstat"><div class="mstat-val">' + parseFloat(p.rating).toFixed(1) + '</div><div class="mstat-lbl">Rating</div></div>';
    html += '</div></div></div>';

    if (p.bio) {
        html += '<div class="modal-section"><h4 class="modal-section-title"><i class="fa fa-user"></i> Tentang</h4><p class="modal-bio">' + p.bio + '</p></div>';
    }

    html += '<div class="modal-section"><h4 class="modal-section-title"><i class="fa fa-graduation-cap"></i> Pendidikan</h4><p class="modal-detail-text">' + (p.pendidikan || 'S1') + ' - ' + (p.universitas || '-') + '</p></div>';

    if (sertHTML) {
        html += '<div class="modal-section"><h4 class="modal-section-title"><i class="fa fa-award"></i> Sertifikasi</h4><div class="sert-list">' + sertHTML + '</div></div>';
    }

    if (jadwalHTML) {
        html += '<div class="modal-section"><h4 class="modal-section-title"><i class="fa fa-calendar"></i> Jadwal Tersedia</h4><div class="jadwal-tags">' + jadwalHTML + '</div></div>';
    }

    html += '<div class="modal-section modal-contact">';
    if (p.email) {
        html += '<a href="mailto:' + p.email + '" class="contact-btn contact-email"><i class="fa fa-envelope"></i> ' + p.email + '</a>';
    }
    if (p.no_hp) {
        html += '<a href="https://wa.me/' + noHpClean + '" target="_blank" class="contact-btn contact-wa"><i class="fab fa-whatsapp"></i> ' + p.no_hp + '</a>';
    }
    html += '</div>';

    html += '<div style="padding:0 24px 24px;"><a href="/kelas" class="card-cta" style="display:flex;align-items:center;justify-content:center;gap:8px;"><i class="fa fa-calendar-plus"></i> Daftar Kelas Sekarang</a></div>';

    document.getElementById('modal-content').innerHTML = html;
    document.getElementById('modal-overlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modal-overlay').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>

<style>
.pg-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 28px;
}
.pg-title {
    font-size: 22px;
    font-weight: 800;
    color: var(--text-primary);
}
.pg-subtitle {
    color: var(--text-secondary);
    margin-top: 5px;
    font-size: 14px;
}
.stats-strip {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 28px;
}
.stat-card {
    display: flex;
    align-items: center;
    gap: 12px;
    background: white;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 20px;
    box-shadow: var(--shadow);
    flex: 1 1 160px;
}
.stat-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}
.stat-value {
    font-size: 20px;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1.1;
}
.stat-label {
    font-size: 12px;
    color: var(--text-secondary);
    font-weight: 500;
    margin-top: 2px;
}
.filter-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
    background: white;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 12px 16px;
    box-shadow: var(--shadow);
}
.search-wrap {
    position: relative;
    flex: 1 1 220px;
    min-width: 180px;
}
.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
    font-size: 13px;
    pointer-events: none;
}
.search-input {
    width: 100%;
    padding: 9px 36px 9px 34px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 13px;
    font-family: inherit;
    color: var(--text-primary);
    background: var(--bg);
    outline: none;
    transition: border-color 0.2s;
}
.search-input:focus { border-color: var(--primary); }
.clear-search {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
    font-size: 13px;
    text-decoration: none;
}
.clear-search:hover { color: #ef4444; }
.filter-select {
    padding: 9px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 13px;
    font-family: inherit;
    color: var(--text-primary);
    background: var(--bg);
    outline: none;
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color 0.2s;
}
.filter-select:focus { border-color: var(--primary); }
.btn-search-submit {
    display: none;
    padding: 9px 18px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    gap: 6px;
    align-items: center;
    transition: background 0.2s;
}
.btn-search-submit:hover { background: var(--primary-dark); }
@media (max-width: 600px) {
    .btn-search-submit { display: flex; }
}
.result-meta {
    font-size: 13px;
    color: var(--text-secondary);
    margin-bottom: 16px;
    padding-left: 2px;
}
.teachers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 22px;
    margin-bottom: 36px;
}
.teacher-card {
    background: white;
    border-radius: 20px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s;
    position: relative;
}
.teacher-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 48px rgba(26,63,196,0.16);
    border-color: #c7d2fe;
}
.card-photo-wrap {
    position: relative;
    height: 210px;
    overflow: hidden;
    background: linear-gradient(135deg, #eff2ff, #e0e7ff);
}
.card-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: transform 0.45s ease;
}
.teacher-card:hover .card-photo { transform: scale(1.06); }
.rating-badge {
    position: absolute;
    bottom: 10px; right: 10px;
    background: rgba(245,158,11,0.92);
    color: white;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    backdrop-filter: blur(6px);
    display: flex; align-items: center; gap: 4px;
}
.status-badge {
    position: absolute;
    top: 10px; right: 10px;
    background: rgba(22,163,74,0.9);
    color: white;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    backdrop-filter: blur(6px);
    display: flex; align-items: center; gap: 5px;
}
.status-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #86efac;
    animation: pulse-dot 2s infinite;
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}
.card-overlay {
    position: absolute;
    inset: 0;
    background: rgba(13,27,75,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}
.teacher-card:hover .card-overlay { opacity: 1; }
.overlay-hint {
    background: white;
    color: var(--primary);
    font-size: 13px;
    font-weight: 700;
    padding: 8px 18px;
    border-radius: 20px;
    display: flex; align-items: center; gap: 7px;
}
.card-body { padding: 18px; }
.card-name {
    font-size: 15px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 7px;
    line-height: 1.3;
}
.card-mapel {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #eff2ff;
    color: var(--primary);
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.stars-row {
    display: flex;
    align-items: center;
    gap: 3px;
    margin-top: 10px;
}
.star-filled { color: #f59e0b; font-size: 12px; }
.star-empty  { color: #e2e8f0; font-size: 12px; }
.stars-count {
    font-size: 11px;
    color: var(--text-secondary);
    font-weight: 500;
    margin-left: 3px;
}
.card-divider {
    height: 1px;
    background: var(--border);
    margin: 13px 0;
}
.card-meta {
    display: flex;
    flex-direction: column;
    gap: 7px;
}
.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--text-secondary);
}
.meta-icon {
    width: 14px;
    color: var(--primary);
    font-size: 11px;
    flex-shrink: 0;
}
.jadwal-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-top: 11px;
}
.jadwal-tag {
    font-size: 11px;
    font-weight: 600;
    background: #f0f9ff;
    color: #0369a1;
    border: 1px solid #bae6fd;
    padding: 3px 9px;
    border-radius: 20px;
}
.card-cta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 14px;
    padding: 11px;
    background: var(--primary);
    color: white;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
}
.card-cta:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 70px 20px;
}
.empty-emoji { font-size: 52px; margin-bottom: 16px; }
.empty-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}
.empty-sub {
    color: var(--text-secondary);
    font-size: 14px;
    line-height: 1.7;
}
.cta-banner {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border-radius: var(--radius);
    padding: 28px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    overflow: hidden;
    position: relative;
    margin-top: 8px;
}
.cta-deco {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
    pointer-events: none;
}
.cta-deco-1 { width: 200px; height: 200px; right: -50px; top: -50px; }
.cta-deco-2 { width: 120px; height: 120px; left: 40%; bottom: -40px; }
.cta-text { position: relative; z-index: 1; }
.cta-title {
    font-size: 18px;
    font-weight: 800;
    color: white;
    margin-bottom: 6px;
}
.cta-sub {
    font-size: 14px;
    color: rgba(255,255,255,0.75);
    margin: 0;
}
.cta-btn {
    position: relative; z-index: 1;
    background: white;
    color: var(--primary);
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
}
.cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(13,27,75,0.55);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
}
.modal-overlay.open {
    opacity: 1;
    pointer-events: auto;
}
.modal-box {
    background: white;
    border-radius: 24px;
    width: 100%;
    max-width: 560px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    transform: scale(0.94) translateY(16px);
    transition: transform 0.3s;
    box-shadow: 0 32px 80px rgba(13,27,75,0.3);
}
.modal-overlay.open .modal-box {
    transform: scale(1) translateY(0);
}
.modal-close {
    position: absolute;
    top: 16px; right: 16px;
    width: 34px; height: 34px;
    border-radius: 50%;
    border: 1px solid var(--border);
    background: white;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    color: var(--text-secondary);
    z-index: 10;
    transition: background 0.2s, color 0.2s;
}
.modal-close:hover { background: #fef2f2; color: #ef4444; }
.modal-hero {
    display: flex;
    gap: 20px;
    padding: 24px 24px 0;
    align-items: flex-start;
}
.modal-photo {
    width: 100px; height: 100px;
    border-radius: 18px;
    object-fit: cover;
    object-position: top center;
    flex-shrink: 0;
    border: 3px solid #e0e7ff;
}
.modal-name {
    font-size: 18px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 2px;
    line-height: 1.3;
}
.modal-stats {
    display: flex;
    gap: 14px;
    margin-top: 14px;
    flex-wrap: wrap;
}
.mstat {
    text-align: center;
    background: var(--bg);
    border-radius: 10px;
    padding: 8px 14px;
    flex: 1 1 70px;
}
.mstat-val {
    font-size: 16px;
    font-weight: 800;
    color: var(--primary);
}
.mstat-lbl {
    font-size: 10px;
    color: var(--text-secondary);
    font-weight: 500;
    margin-top: 1px;
}
.modal-section {
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    margin-top: 16px;
}
.modal-section-title {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.7px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 7px;
}
.modal-bio {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.7;
}
.modal-detail-text {
    font-size: 14px;
    color: var(--text-primary);
    font-weight: 500;
}
.sert-list {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
}
.badge-sert {
    font-size: 11px;
    font-weight: 600;
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
    padding: 4px 10px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.modal-contact {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding-bottom: 20px;
}
.contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.2s;
    flex: 1 1 140px;
    justify-content: center;
}
.contact-btn:hover { opacity: 0.85; }
.contact-email { background: #eff2ff; color: var(--primary); }
.contact-wa { background: #dcfce7; color: #15803d; }
.modal-box::-webkit-scrollbar { width: 5px; }
.modal-box::-webkit-scrollbar-track { background: transparent; }
.modal-box::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 3px; }
</style>

@endsection