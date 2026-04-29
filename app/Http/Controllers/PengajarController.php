<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;

class PengajarController extends Controller
{
    public function index()
    {
        $data = Pengajar::all();
        return view('siswa.pengajar', compact('data'));
    }
}