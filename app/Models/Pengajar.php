<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'foto',
        'mapel',
        'pendidikan',
        'universitas',
        'pengalaman',
        'bio',
        'rating',
        'total_ulasan',
        'total_siswa',
        'email',
        'no_hp',
        'status',
        'sertifikasi',
        'jadwal',
    ];

    protected $casts = [
        'sertifikasi' => 'array',
        'jadwal'      => 'array',
        'rating'      => 'float',
    ];

    // Accessor: URL foto lengkap
    // Foto disimpan di database sebagai: "pengajar/nama_file.jpeg"
    // File fisik ada di: public/images/pengajar/nama_file.jpeg
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('images/' . $this->foto))) {
            return asset('images/' . $this->foto);
        }
        // Fallback ke avatar otomatis jika foto tidak ditemukan
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=1a3fc4&color=fff&size=300';
    }

    // Scope: hanya pengajar aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}