<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajar::query();

        // Filter: hanya aktif (default) atau semua
        $query->aktif();

        // Search by nama atau mapel
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('mapel', 'like', "%{$search}%");
            });
        }

        // Filter by mapel
        if ($request->filled('mapel')) {
            $query->where('mapel', $request->mapel);
        }

        // Sort
        $sort = $request->get('sort', 'rating');
        match ($sort) {
            'nama'        => $query->orderBy('nama'),
            'pengalaman'  => $query->orderByDesc('pengalaman'),
            'siswa'       => $query->orderByDesc('total_siswa'),
            default       => $query->orderByDesc('rating'),
        };

        $data = $query->get();

        // Statistik untuk stats strip
        $stats = [
            'aktif'         => Pengajar::aktif()->count(),
            'mapel_unik'    => Pengajar::aktif()->distinct('mapel')->count('mapel'),
            'rating_avg'    => Pengajar::aktif()->avg('rating') ?? 0,
            'total_siswa'   => Pengajar::aktif()->sum('total_siswa'),
        ];

        // Daftar mapel unik untuk filter dropdown
        $mapelList = Pengajar::aktif()->distinct()->pluck('mapel')->filter()->sort()->values();

        return view('siswa.pengajar', compact('data', 'stats', 'mapelList'));
    }
}
