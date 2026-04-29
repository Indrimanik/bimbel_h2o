@extends('layouts.app')

@section('page-title', 'Pengajar')

@section('content')

<!-- HEADER -->
<div style="margin-bottom:32px;">
    <h1 style="font-size:22px;font-weight:800;color:var(--text-primary);">Tim Pengajar</h1>
    <p style="color:var(--text-secondary);margin-top:5px;font-size:14px;">Kenali para pengajar berpengalaman yang siap membimbingmu meraih impian.</p>
</div>

<!-- STATS STRIP -->
<div style="display:flex;gap:16px;flex-wrap:wrap;margin-bottom:32px;">
    <div style="display:flex;align-items:center;gap:10px;background:white;border:1px solid var(--border);border-radius:12px;padding:12px 18px;box-shadow:var(--shadow);">
        <div style="width:36px;height:36px;border-radius:9px;background:#eff2ff;display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:16px;">
            <i class="fa fa-chalkboard-user"></i>
        </div>
        <div>
            <div style="font-size:18px;font-weight:800;color:var(--text-primary);">{{ count($data) }}</div>
            <div style="font-size:12px;color:var(--text-secondary);font-weight:500;">Pengajar Aktif</div>
        </div>
    </div>
    <div style="display:flex;align-items:center;gap:10px;background:white;border:1px solid var(--border);border-radius:12px;padding:12px 18px;box-shadow:var(--shadow);">
        <div style="width:36px;height:36px;border-radius:9px;background:#dcfce7;display:flex;align-items:center;justify-content:center;color:#16a34a;font-size:16px;">
            <i class="fa fa-book-open"></i>
        </div>
        <div>
            <div style="font-size:18px;font-weight:800;color:var(--text-primary);">2</div>
            <div style="font-size:12px;color:var(--text-secondary);font-weight:500;">Program Tersedia</div>
        </div>
    </div>
    <div style="display:flex;align-items:center;gap:10px;background:white;border:1px solid var(--border);border-radius:12px;padding:12px 18px;box-shadow:var(--shadow);">
        <div style="width:36px;height:36px;border-radius:9px;background:#fef3c7;display:flex;align-items:center;justify-content:center;color:#d97706;font-size:16px;">
            <i class="fa fa-star"></i>
        </div>
        <div>
            <div style="font-size:18px;font-weight:800;color:var(--text-primary);">4.9</div>
            <div style="font-size:12px;color:var(--text-secondary);font-weight:500;">Rating Rata-rata</div>
        </div>
    </div>
</div>

<!-- GRID PENGAJAR -->
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:24px;">

    @foreach($data as $item)
    <div class="teacher-card">

        <!-- FOTO -->
        <div class="teacher-photo-wrap">
            <img src="{{ asset('images/'.$item->foto) }}" alt="{{ $item->nama }}" class="teacher-photo">
            <div class="teacher-badge">
                <i class="fa fa-circle-check"></i> Aktif
            </div>
        </div>

        <!-- INFO -->
        <div class="teacher-body">
            <h3 class="teacher-name">{{ $item->nama }}</h3>
            <div class="teacher-mapel">
                <i class="fa fa-book" style="font-size:11px;"></i>
                {{ $item->mapel }}
            </div>

            <!-- STARS -->
            <div style="display:flex;align-items:center;gap:6px;margin-top:10px;">
                <div style="display:flex;gap:2px;">
                    @for($s=1;$s<=5;$s++)
                    <i class="fa fa-star" style="font-size:12px;color:{{ $s<=4 ? '#f59e0b' : '#d1d5db' }};"></i>
                    @endfor
                </div>
                <span style="font-size:12px;color:var(--text-secondary);font-weight:500;">4.8 (24 ulasan)</span>
            </div>

            <!-- DIVIDER -->
            <div style="height:1px;background:var(--border);margin:14px 0;"></div>

            <!-- META -->
            <div style="display:flex;flex-direction:column;gap:7px;">
                <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text-secondary);">
                    <i class="fa fa-graduation-cap" style="width:14px;color:var(--primary);"></i>
                    <span>S1 Pendidikan — Univ. HKBP Nommensen</span>
                </div>
                <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text-secondary);">
                    <i class="fa fa-clock" style="width:14px;color:var(--primary);"></i>
                    <span>3+ tahun pengalaman mengajar</span>
                </div>
            </div>

            <!-- CTA -->
            <a href="/kelas" class="teacher-cta">
                <i class="fa fa-calendar-plus"></i> Daftar Kelas
            </a>
        </div>

    </div>
    @endforeach

    <!-- EMPTY STATE -->
    @if(count($data) === 0)
    <div style="grid-column:1/-1;text-align:center;padding:60px 20px;">
        <div style="font-size:48px;margin-bottom:16px;">👨‍🏫</div>
        <h3 style="font-size:18px;font-weight:700;color:var(--text-primary);margin-bottom:8px;">Belum ada data pengajar</h3>
        <p style="color:var(--text-secondary);font-size:14px;">Data pengajar akan segera ditambahkan.</p>
    </div>
    @endif

</div>

<!-- CALL TO ACTION BANNER -->
<div style="margin-top:40px;background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:var(--radius);padding:28px 32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;overflow:hidden;position:relative;">
    <div style="position:absolute;right:-40px;top:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.07);"></div>
    <div style="position:relative;z-index:1;">
        <h3 style="font-size:18px;font-weight:800;color:white;margin-bottom:6px;">Siap belajar bersama kami?</h3>
        <p style="font-size:14px;color:rgba(255,255,255,0.75);margin:0;">Bergabung sekarang dan mulai perjalanan belajarmu bersama pengajar terbaik.</p>
    </div>
    <a href="/kelas" style="background:white;color:var(--primary);padding:12px 24px;border-radius:10px;font-size:14px;font-weight:700;text-decoration:none;white-space:nowrap;flex-shrink:0;transition:all 0.2s;position:relative;z-index:1;display:inline-flex;align-items:center;gap:8px;">
        <i class="fa fa-arrow-right"></i> Daftar Sekarang
    </a>
</div>

<style>
/* ── Teacher card ── */
.teacher-card {
    background: white;
    border-radius: 18px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: all 0.25s ease;
}
.teacher-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(26,63,196,0.14);
    border-color: #c7d2fe;
}

/* ── Photo ── */
.teacher-photo-wrap {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: linear-gradient(135deg, #eff2ff, #e0e7ff);
}
.teacher-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.teacher-card:hover .teacher-photo { transform: scale(1.05); }

.teacher-badge {
    position: absolute;
    top: 12px; right: 12px;
    background: rgba(22,163,74,0.9);
    color: white;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    backdrop-filter: blur(6px);
    display: flex; align-items: center; gap: 5px;
}

/* ── Body ── */
.teacher-body { padding: 18px; }
.teacher-name {
    font-size: 16px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 6px;
    line-height: 1.3;
}
.teacher-mapel {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #eff2ff;
    color: var(--primary);
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
}

/* ── CTA ── */
.teacher-cta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 16px;
    padding: 11px;
    background: var(--primary);
    color: white;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
}
.teacher-cta:hover { background: var(--primary-dark); }
</style>

@endsection
