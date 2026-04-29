<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;

class KelasController extends Controller
{
    public function index()
    {
        return view('siswa.kelas');
    }

    // CREATE
    public function daftarProgram(Request $request)
    {
        $data = Pembayaran::create([
            'user_id' => auth()->id(),
            'program' => $request->program,
            'harga' => $request->harga
        ]);

        return redirect('/sukses/' . $data->id);
    }

    // SUKSES
    public function sukses($id)
    {
        $data = Pembayaran::with('user')->findOrFail($id);
        return view('siswa.sukses', compact('data'));
    }

    // ======================
    // PDF
    // ======================
    public function cetakStruk($id)
    {
        $data = Pembayaran::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('siswa.struk', compact('data'));

        return $pdf->download('struk_'.$id.'.pdf');
    }

    // ======================
    // EXCEL (BARU)
    // ======================
    public function exportExcel($id)
    {
        $data = Pembayaran::with('user')->findOrFail($id);

        $filename = "struk_$id.xls";

        return response()->view('siswa.struk', compact('data'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', "attachment; filename=$filename");
    }

    // ======================
    // READ
    // ======================
    public function riwayat()
    {
        $data = Pembayaran::where('user_id', auth()->id())->get();
        return view('siswa.riwayat', compact('data'));
    }

    // EDIT FORM
    public function edit($id)
    {
        $data = Pembayaran::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('siswa.edit', compact('data'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $data = Pembayaran::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $data->update([
            'program' => $request->program,
            'harga' => $request->harga
        ]);

        return redirect('/riwayat')->with('success', 'Berhasil update');
    }

    // DELETE
    public function hapus($id)
    {
        $data = Pembayaran::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $data->delete();

        return redirect('/riwayat')->with('success', 'Berhasil hapus');
    }
}