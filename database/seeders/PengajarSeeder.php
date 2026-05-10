<?php

namespace Database\Seeders;

use App\Models\Pengajar;
use Illuminate\Database\Seeder;

class PengajarSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dulu
        Pengajar::truncate();

        $pengajars = [
            [
                'nama'         => 'Endang Histaurina Sitanggang',
                'foto'         => 'pengajar/endang_historina.jpeg',
                'mapel'        => 'Bahasa Indonesia',
                'pendidikan'   => 'S1',
                'universitas'  => 'Universitas Negeri Medan',
                'pengalaman'   => 5,
                'bio'          => 'Pengajar Bahasa Indonesia berpengalaman yang berdedikasi membantu siswa menguasai kemampuan literasi dan komunikasi untuk menghadapi ujian nasional maupun SNBT.',
                'rating'       => 4.9,
                'total_ulasan' => 64,
                'total_siswa'  => 180,
                'email'        => null,
                'no_hp'        => null,
                'status'       => 'aktif',
                'sertifikasi'  => ['Sertifikasi Guru Profesional', 'Pelatihan Kurikulum Merdeka'],
                'jadwal'       => ['Senin', 'Rabu', 'Jumat'],
            ],
            [
                'nama'         => 'Heriady Gultom, M.Pd.',
                'foto'         => 'pengajar/Heriady_Gultom_M_Pd_.jpeg',
                'mapel'        => 'Matematika',
                'pendidikan'   => 'S2',
                'universitas'  => 'Universitas Sumatera Utara',
                'pengalaman'   => 7,
                'bio'          => 'Magister Pendidikan Matematika dengan pengalaman luas membimbing siswa dalam persiapan SNBT dan Olimpiade Matematika tingkat regional maupun nasional.',
                'rating'       => 5.0,
                'total_ulasan' => 91,
                'total_siswa'  => 240,
                'email'        => null,
                'no_hp'        => null,
                'status'       => 'aktif',
                'sertifikasi'  => ['Magister Pendidikan Matematika', 'Pelatihan Olimpiade Sains'],
                'jadwal'       => ['Selasa', 'Kamis', 'Sabtu'],
            ],
            [
                'nama'         => 'Elfransco Sinaga, S.Pd.',
                'foto'         => 'pengajar/Elfransco_Sinaga__S_Pd.jpeg',
                'mapel'        => 'TWK',
                'pendidikan'   => 'S1',
                'universitas'  => 'Universitas Sumatera Utara',
                'pengalaman'   => 4,
                'bio'          => 'Pengajar Tes Wawasan Kebangsaan (TWK) yang fokus mempersiapkan siswa dalam seleksi CPNS dan ujian kedinasan dengan metode belajar yang sistematis dan efektif.',
                'rating'       => 4.8,
                'total_ulasan' => 47,
                'total_siswa'  => 130,
                'email'        => null,
                'no_hp'        => null,
                'status'       => 'aktif',
                'sertifikasi'  => ['Sertifikasi Pendidikan Kewarganegaraan'],
                'jadwal'       => ['Senin', 'Selasa', 'Kamis'],
            ],
        ];

        foreach ($pengajars as $p) {
            Pengajar::create($p);
        }
    }
}