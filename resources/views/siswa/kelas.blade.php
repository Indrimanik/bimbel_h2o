@extends('layouts.app')

@section('page-title', 'Pendaftaran Kelas')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:14px;">
    <div>
        <h1 style="font-size:22px;font-weight:800;color:var(--text-primary);">Formulir Pendaftaran</h1>
        <p style="color:var(--text-secondary);margin-top:4px;font-size:14px;">Pilih program, lengkapi data, dan selesaikan pembayaran.</p>
    </div>
    <a href="/riwayat" class="btn-secondary" style="font-size:13px;">
        <i class="fa fa-clock-rotate-left"></i> Riwayat Saya
    </a>
</div>

@if(session('success'))
<div style="background:#dcfce7;border:1px solid #bbf7d0;border-radius:12px;padding:14px 18px;font-size:14px;color:#166534;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
    <i class="fa fa-check-circle" style="font-size:16px;"></i> {{ session('success') }}
</div>
@endif

<div class="card" style="max-width:760px;">

    <form action="/daftar-program" method="POST" enctype="multipart/form-data" id="daftarForm">
        @csrf

        <!-- ───────────── 1. PILIH PROGRAM ───────────── -->
        <div style="margin-bottom:28px;">
            <h3 class="section-title">
                <span class="step-num">1</span> Pilih Program
            </h3>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="program-card" onclick="pilihProgram(this,'Kedinasan',2000000)" id="card-kedinasan">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
                        <div class="prog-icon" style="background:#eff2ff;color:var(--primary);">🏛️</div>
                        <div class="selected-badge" style="display:none;">✓ Dipilih</div>
                    </div>
                    <h4 style="font-size:16px;font-weight:700;color:var(--text-primary);margin-bottom:4px;">Kedinasan</h4>
                    <p style="font-size:13px;color:var(--text-secondary);margin-bottom:10px;">STAN, IPDN, PKN & instansi kedinasan lainnya</p>
                    <div style="font-size:18px;font-weight:800;color:var(--primary);">Rp 2.000.000</div>
                    <div style="font-size:12px;color:var(--text-secondary);">/ 6 bulan</div>
                </div>

                <div class="program-card" onclick="pilihProgram(this,'UTBK PTN',1500000)" id="card-utbk">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
                        <div class="prog-icon" style="background:#dcfce7;color:#16a34a;">🎓</div>
                        <div class="selected-badge" style="display:none;">✓ Dipilih</div>
                    </div>
                    <h4 style="font-size:16px;font-weight:700;color:var(--text-primary);margin-bottom:4px;">UTBK PTN</h4>
                    <p style="font-size:13px;color:var(--text-secondary);margin-bottom:10px;">Persiapan SNBT masuk Perguruan Tinggi Negeri</p>
                    <div style="font-size:18px;font-weight:800;color:#16a34a;">Rp 1.500.000</div>
                    <div style="font-size:12px;color:var(--text-secondary);">/ 6 bulan</div>
                </div>
            </div>

            <input type="hidden" name="program" id="program">
            <input type="hidden" name="harga" id="harga">
            <div id="program-error" style="color:#e11d48;font-size:12px;margin-top:8px;display:none;">* Silakan pilih program terlebih dahulu</div>
        </div>

        <hr class="divider">

        <!-- ───────────── 2. DATA PRIBADI ───────────── -->
        <div style="margin-bottom:28px;">
            <h3 class="section-title">
                <span class="step-num">2</span> Data Pribadi
            </h3>

            <div class="form-group">
                <label class="form-label">Nama Lengkap <span style="color:#e11d48;">*</span></label>
                <input type="text" name="nama" class="form-control" placeholder="Nama sesuai KTP/Kartu Pelajar" required>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="form-group">
                    <label class="form-label">Kelas / Tingkat</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII IPA 1">
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jk" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tempat, Tanggal Lahir</label>
                <input type="text" name="ttl" class="form-control" placeholder="Contoh: Tarutung, 1 Januari 2005">
            </div>

            <div class="form-group">
                <label class="form-label">Asal Sekolah</label>
                <input type="text" name="sekolah" class="form-control" placeholder="Nama sekolah / universitas">
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">No HP / WhatsApp <span style="color:#e11d48;">*</span></label>
                <input type="text" name="hp" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>
        </div>

        <hr class="divider">

        <!-- ───────────── 3. DATA ORANG TUA ───────────── -->
        <div style="margin-bottom:28px;">
            <h3 class="section-title">
                <span class="step-num">3</span> Data Orang Tua / Wali
            </h3>

            <div class="form-group">
                <label class="form-label">Nama Orang Tua / Wali</label>
                <input type="text" name="ortu" class="form-control" placeholder="Nama lengkap orang tua">
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="alamat_ortu" class="form-control" rows="2" placeholder="Alamat orang tua (jika berbeda)"></textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="form-group">
                    <label class="form-label">No HP Orang Tua</label>
                    <input type="text" name="hp_ortu" class="form-control" placeholder="08xxxxxxxxxx">
                </div>
                <div class="form-group">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control" placeholder="Wiraswasta, PNS, dll">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tujuan Mengikuti Bimbel</label>
                <textarea name="tujuan" class="form-control" rows="3" placeholder="Ceritakan tujuan & motivasimu..."></textarea>
            </div>
        </div>

        <hr class="divider">

        <!-- ───────────── 4. METODE PEMBAYARAN ───────────── -->
        <div style="margin-bottom:28px;">
            <h3 class="section-title">
                <span class="step-num">4</span> Metode Pembayaran
            </h3>

            <!-- PILIH METODE -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px;">

                <!-- TUNAI -->
                <div class="pay-card" onclick="pilihMetode(this,'tunai')" id="pay-tunai">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="pay-icon" style="background:#dcfce7;color:#16a34a;">
                            <i class="fa fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <div style="font-size:14px;font-weight:700;color:var(--text-primary);">Tunai</div>
                            <div style="font-size:12px;color:var(--text-secondary);">Bayar langsung ke kantor</div>
                        </div>
                    </div>
                    <div class="pay-radio"></div>
                </div>

                <!-- TRANSFER -->
                <div class="pay-card" onclick="pilihMetode(this,'transfer')" id="pay-transfer">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="pay-icon" style="background:#eff2ff;color:var(--primary);">
                            <i class="fa fa-building-columns"></i>
                        </div>
                        <div>
                            <div style="font-size:14px;font-weight:700;color:var(--text-primary);">Transfer Bank</div>
                            <div style="font-size:12px;color:var(--text-secondary);">Mandiri, BNI, BRI</div>
                        </div>
                    </div>
                    <div class="pay-radio"></div>
                </div>
            </div>

            <input type="hidden" name="metode_bayar" id="metode_bayar">
            <div id="metode-error" style="color:#e11d48;font-size:12px;margin-top:-12px;margin-bottom:14px;display:none;">* Silakan pilih metode pembayaran</div>

            <!-- PANEL TRANSFER — muncul jika transfer dipilih -->
            <div id="panel-transfer" style="display:none;">

                <!-- INFO REKENING BANK -->
                <div style="margin-bottom:18px;">
                    <p style="font-size:13px;font-weight:600;color:var(--text-secondary);margin-bottom:12px;letter-spacing:0.3px;">PILIH BANK TUJUAN TRANSFER</p>

                    <div style="display:flex;flex-direction:column;gap:10px;">

                        <!-- MANDIRI -->
                        <label class="bank-option" for="bank-mandiri">
                            <input type="radio" name="bank" id="bank-mandiri" value="Mandiri" onchange="pilihBank('Mandiri')" style="display:none;">
                            <div class="bank-logo mandiri">
                                <span style="font-size:13px;font-weight:900;letter-spacing:-1px;">mandiri</span>
                            </div>
                            <div style="flex:1;">
                                <div style="font-size:14px;font-weight:700;color:var(--text-primary);">Bank Mandiri</div>
                                <div style="font-size:13px;color:var(--text-secondary);margin-top:2px;">
                                    No. Rek: <strong style="color:var(--text-primary);letter-spacing:1px;">1234 5678 9012</strong>
                                </div>
                                <div style="font-size:12px;color:var(--text-secondary);">a.n. Bimbel H2O Tarutung</div>
                            </div>
                            <button type="button" class="btn-copy" onclick="salin(event,'1234567890 12')">
                                <i class="fa fa-copy"></i> Salin
                            </button>
                            <div class="bank-check"><i class="fa fa-check"></i></div>
                        </label>

                        <!-- BNI -->
                        <label class="bank-option" for="bank-bni">
                            <input type="radio" name="bank" id="bank-bni" value="BNI" onchange="pilihBank('BNI')" style="display:none;">
                            <div class="bank-logo bni">
                                <span style="font-size:13px;font-weight:900;">BNI</span>
                            </div>
                            <div style="flex:1;">
                                <div style="font-size:14px;font-weight:700;color:var(--text-primary);">Bank BNI</div>
                                <div style="font-size:13px;color:var(--text-secondary);margin-top:2px;">
                                    No. Rek: <strong style="color:var(--text-primary);letter-spacing:1px;">0987 6543 210</strong>
                                </div>
                                <div style="font-size:12px;color:var(--text-secondary);">a.n. Bimbel H2O Tarutung</div>
                            </div>
                            <button type="button" class="btn-copy" onclick="salin(event,'098765 43210')">
                                <i class="fa fa-copy"></i> Salin
                            </button>
                            <div class="bank-check"><i class="fa fa-check"></i></div>
                        </label>

                        <!-- BRI -->
                        <label class="bank-option" for="bank-bri">
                            <input type="radio" name="bank" id="bank-bri" value="BRI" onchange="pilihBank('BRI')" style="display:none;">
                            <div class="bank-logo bri">
                                <span style="font-size:13px;font-weight:900;">BRI</span>
                            </div>
                            <div style="flex:1;">
                                <div style="font-size:14px;font-weight:700;color:var(--text-primary);">Bank BRI</div>
                                <div style="font-size:13px;color:var(--text-secondary);margin-top:2px;">
                                    No. Rek: <strong style="color:var(--text-primary);letter-spacing:1px;">1122 3344 5566</strong>
                                </div>
                                <div style="font-size:12px;color:var(--text-secondary);">a.n. Bimbel H2O Tarutung</div>
                            </div>
                            <button type="button" class="btn-copy" onclick="salin(event,'1122334455 66')">
                                <i class="fa fa-copy"></i> Salin
                            </button>
                            <div class="bank-check"><i class="fa fa-check"></i></div>
                        </label>

                    </div>
                </div>

                <!-- UPLOAD BUKTI -->
                <div id="upload-section" style="display:none;">
                    <div style="background:var(--bg);border-radius:12px;padding:18px;border:1.5px dashed #c7d2fe;">
                        <div style="font-size:13px;font-weight:600;color:var(--text-primary);margin-bottom:12px;display:flex;align-items:center;gap:8px;">
                            <i class="fa fa-upload" style="color:var(--primary);"></i>
                            Upload Bukti Transfer — <span id="label-bank" style="color:var(--primary);">Bank</span>
                        </div>

                        <!-- DROP ZONE -->
                        <div class="drop-zone" id="dropZone" onclick="document.getElementById('buktiBayar').click()">
                            <div id="drop-placeholder">
                                <i class="fa fa-cloud-arrow-up" style="font-size:28px;color:#a5b4fc;margin-bottom:8px;display:block;"></i>
                                <div style="font-size:14px;font-weight:600;color:var(--text-primary);margin-bottom:4px;">Klik atau seret file ke sini</div>
                                <div style="font-size:12px;color:var(--text-secondary);">Format JPG, PNG, PDF · Maks 2MB</div>
                            </div>
                            <div id="drop-preview" style="display:none;text-align:center;">
                                <img id="preview-img" src="" style="max-height:160px;border-radius:8px;margin-bottom:8px;display:block;margin:0 auto 8px;">
                                <div id="preview-name" style="font-size:13px;font-weight:600;color:var(--text-primary);"></div>
                                <button type="button" onclick="hapusFile(event)" style="font-size:12px;color:#e11d48;background:none;border:none;cursor:pointer;margin-top:6px;font-family:inherit;">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>

                        <input type="file" name="bukti_bayar" id="buktiBayar" accept="image/*,.pdf" style="display:none;" onchange="previewFile(this)">

                        <div style="margin-top:12px;display:flex;align-items:flex-start;gap:8px;background:#fef3c7;border-radius:8px;padding:10px 12px;">
                            <i class="fa fa-circle-info" style="color:#d97706;margin-top:1px;"></i>
                            <p style="font-size:12px;color:#92400e;line-height:1.6;margin:0;">
                                Pastikan nominal transfer sesuai dengan program yang dipilih. Pembayaran akan diverifikasi dalam <strong>1×24 jam</strong> kerja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PANEL TUNAI INFO -->
            <div id="panel-tunai" style="display:none;">
                <div style="background:#f0fdf4;border:1.5px solid #bbf7d0;border-radius:12px;padding:16px 18px;display:flex;gap:14px;align-items:flex-start;">
                    <i class="fa fa-circle-info" style="color:#16a34a;font-size:18px;margin-top:2px;"></i>
                    <div>
                        <div style="font-size:14px;font-weight:700;color:#166534;margin-bottom:4px;">Pembayaran Tunai</div>
                        <p style="font-size:13px;color:#166534;line-height:1.7;margin:0;">
                            Silakan datang langsung ke <strong>Kantor Bimbel H2O Tarutung</strong> dengan membawa formulir ini. Pembayaran dilakukan pada saat pendaftaran awal bersama staf kami.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- ───────────── RINGKASAN & SUBMIT ───────────── -->
        <div style="background:var(--bg);border-radius:14px;padding:20px;border:1.5px solid var(--border);">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;">
                <div>
                    <div id="summary-text" style="font-size:13px;color:var(--text-secondary);">Belum ada program dipilih</div>
                    <div id="summary-metode" style="font-size:12px;color:var(--text-secondary);margin-top:2px;"></div>
                    <div id="summary-price" style="font-size:22px;font-weight:800;color:var(--primary);margin-top:4px;">Rp —</div>
                </div>
                <button type="submit" class="btn-primary" style="font-size:15px;padding:14px 30px;" id="submitBtn">
                    <i class="fa fa-paper-plane"></i> Daftar & Bayar
                </button>
            </div>
        </div>

    </form>
</div>

<!-- TOAST COPY -->
<div id="toast" style="position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(60px);background:#0d1b4b;color:white;padding:10px 20px;border-radius:10px;font-size:13px;font-weight:600;opacity:0;transition:all 0.3s;z-index:999;pointer-events:none;">
    <i class="fa fa-check"></i> Nomor rekening disalin!
</div>

<style>
/* ── Section header ── */
.section-title { font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:20px;display:flex;align-items:center;gap:8px; }
.step-num { width:28px;height:28px;background:var(--primary);color:white;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0; }
.divider { border:none;border-top:1px solid var(--border);margin:0 0 28px; }

/* ── Program cards ── */
.prog-icon { width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:20px; }
.selected-badge { background:var(--primary);color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px; }
.program-card { border:2px solid var(--border);border-radius:14px;padding:18px;cursor:pointer;transition:all 0.2s;background:white; }
.program-card:hover { border-color:var(--primary);box-shadow:0 4px 16px rgba(26,63,196,0.12);transform:translateY(-2px); }
.program-card.selected { border-color:var(--primary);background:#fafbff;box-shadow:0 4px 20px rgba(26,63,196,0.15); }

/* ── Payment method cards ── */
.pay-card { border:2px solid var(--border);border-radius:12px;padding:14px 16px;cursor:pointer;transition:all 0.2s;background:white;display:flex;align-items:center;justify-content:space-between;gap:10px; }
.pay-card:hover { border-color:var(--primary);background:#fafbff; }
.pay-card.selected { border-color:var(--primary);background:#fafbff;box-shadow:0 4px 16px rgba(26,63,196,0.12); }
.pay-icon { width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0; }
.pay-radio { width:18px;height:18px;border-radius:50%;border:2px solid #cbd5e1;flex-shrink:0;transition:all 0.2s; }
.pay-card.selected .pay-radio { border-color:var(--primary);background:var(--primary);box-shadow:inset 0 0 0 3px white; }

/* ── Bank options ── */
.bank-option { display:flex;align-items:center;gap:12px;padding:14px 16px;border:2px solid var(--border);border-radius:12px;cursor:pointer;transition:all 0.2s;background:white;position:relative; }
.bank-option:has(input:checked) { border-color:var(--primary);background:#fafbff;box-shadow:0 2px 10px rgba(26,63,196,0.1); }
.bank-logo { width:56px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
.bank-logo.mandiri { background:#003d82;color:white; }
.bank-logo.bni { background:#f15a23;color:white; }
.bank-logo.bri { background:#00529c;color:white; }
.bank-check { width:22px;height:22px;border-radius:50%;border:2px solid #cbd5e1;display:flex;align-items:center;justify-content:center;font-size:11px;color:white;flex-shrink:0;transition:all 0.2s; }
.bank-option:has(input:checked) .bank-check { background:var(--primary);border-color:var(--primary); }

/* ── Copy button ── */
.btn-copy { background:var(--bg);border:1px solid var(--border);color:var(--text-secondary);border-radius:8px;padding:6px 10px;font-size:12px;cursor:pointer;font-family:inherit;font-weight:600;transition:all 0.2s;white-space:nowrap; }
.btn-copy:hover { background:var(--primary);color:white;border-color:var(--primary); }

/* ── Drop zone ── */
.drop-zone { border:2px dashed #c7d2fe;border-radius:10px;padding:28px 20px;text-align:center;cursor:pointer;transition:all 0.2s;background:white; }
.drop-zone:hover { border-color:var(--primary);background:#fafbff; }
.drop-zone.dragover { border-color:var(--primary);background:#eff2ff; }
</style>

<script>
/* ── Program pilihan ── */
function pilihProgram(el, nama, harga) {
    document.querySelectorAll('.program-card').forEach(c => {
        c.classList.remove('selected');
        c.querySelector('.selected-badge').style.display = 'none';
    });
    el.classList.add('selected');
    el.querySelector('.selected-badge').style.display = 'block';
    document.getElementById('program').value = nama;
    document.getElementById('harga').value = harga;
    document.getElementById('program-error').style.display = 'none';
    updateSummary();
}

/* ── Metode bayar ── */
function pilihMetode(el, tipe) {
    document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('metode_bayar').value = tipe;
    document.getElementById('metode-error').style.display = 'none';

    document.getElementById('panel-transfer').style.display = tipe === 'transfer' ? 'block' : 'none';
    document.getElementById('panel-tunai').style.display   = tipe === 'tunai'    ? 'block' : 'none';

    if (tipe !== 'transfer') {
        // reset bank & upload jika kembali ke tunai
        document.querySelectorAll('input[name="bank"]').forEach(r => r.checked = false);
        document.querySelectorAll('.bank-option').forEach(o => o.style.borderColor = '');
        document.getElementById('upload-section').style.display = 'none';
    }
    updateSummary();
}

/* ── Pilih bank ── */
function pilihBank(nama) {
    document.getElementById('label-bank').textContent = 'Bank ' + nama;
    document.getElementById('upload-section').style.display = 'block';
    document.getElementById('upload-section').scrollIntoView({behavior:'smooth', block:'nearest'});
}

/* ── Copy rekening ── */
function salin(e, no) {
    e.stopPropagation();
    navigator.clipboard.writeText(no.replace(/\s/g,'')).then(() => {
        const t = document.getElementById('toast');
        t.style.opacity = '1';
        t.style.transform = 'translateX(-50%) translateY(0)';
        setTimeout(() => {
            t.style.opacity = '0';
            t.style.transform = 'translateX(-50%) translateY(60px)';
        }, 2000);
    });
}

/* ── Preview upload ── */
function previewFile(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        if (file.type.startsWith('image/')) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-img').style.display = 'block';
        } else {
            document.getElementById('preview-img').style.display = 'none';
        }
        document.getElementById('preview-name').textContent = file.name;
        document.getElementById('drop-placeholder').style.display = 'none';
        document.getElementById('drop-preview').style.display = 'block';
    };
    reader.readAsDataURL(file);
}

function hapusFile(e) {
    e.stopPropagation();
    document.getElementById('buktiBayar').value = '';
    document.getElementById('drop-placeholder').style.display = 'block';
    document.getElementById('drop-preview').style.display = 'none';
}

/* ── Drag & drop ── */
const dz = document.getElementById('dropZone');
dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('dragover'); });
dz.addEventListener('dragleave', () => dz.classList.remove('dragover'));
dz.addEventListener('drop', e => {
    e.preventDefault();
    dz.classList.remove('dragover');
    const input = document.getElementById('buktiBayar');
    input.files = e.dataTransfer.files;
    previewFile(input);
});

/* ── Ringkasan ── */
function updateSummary() {
    const prog  = document.getElementById('program').value;
    const harga = document.getElementById('harga').value;
    const met   = document.getElementById('metode_bayar').value;
    document.getElementById('summary-text').textContent = prog ? 'Program: ' + prog : 'Belum ada program dipilih';
    document.getElementById('summary-price').textContent = harga ? 'Rp ' + parseInt(harga).toLocaleString('id-ID') : 'Rp —';
    const metLabel = { tunai:'Metode: Tunai (bayar di kantor)', transfer:'Metode: Transfer Bank' };
    document.getElementById('summary-metode').textContent = metLabel[met] || '';
}

/* ── Validasi submit ── */
document.getElementById('daftarForm').addEventListener('submit', function(e) {
    let ok = true;
    if (!document.getElementById('program').value) {
        document.getElementById('program-error').style.display = 'block';
        document.getElementById('program-error').scrollIntoView({behavior:'smooth'});
        ok = false;
    }
    if (!document.getElementById('metode_bayar').value) {
        document.getElementById('metode-error').style.display = 'block';
        if (ok) document.getElementById('metode-error').scrollIntoView({behavior:'smooth'});
        ok = false;
    }
    if (!ok) e.preventDefault();
});
</script>

@endsection
