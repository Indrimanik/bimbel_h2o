<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function pendaftaran()
    {
        return view('admin.pendaftaran');
    }

    public function verifikasi($id)
    {
        // nanti kita isi logic verifikasi
        return back();
    }

    public function kelas()
    {
        return view('admin.kelas');
    }

    public function tambahKelas(Request $request)
    {
        // nanti kita isi
        return back();
    }

    public function updateKelas(Request $request, $id)
    {
        // nanti kita isi
        return back();
    }

    public function hapusKelas($id)
    {
        // nanti kita isi
        return back();
    }
}