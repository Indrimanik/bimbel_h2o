@extends('layouts.app')

@section('content')

<div style="background:white;padding:25px;border-radius:15px;max-width:500px;">

<h2 style="color:#0d6efd;">✅ Pembayaran Berhasil!</h2>

<p><b>Nama:</b> {{ $data->user->name }}</p>
<p><b>Program:</b> {{ $data->program }}</p>
<p><b>Total:</b> Rp {{ number_format($data->harga,0,',','.') }}</p>

<hr>

<h3>Jadwal:</h3>

@if($data->program == 'PTN')
    <p>Senin, Selasa, Rabu</p>
@else
    <p>Kamis, Jumat, Sabtu</p>
@endif

<p>Jam: 15.00 - 19.00</p>

<hr>

<!-- TOMBOL CETAK -->
<div style="display:flex; gap:10px;">

    <!-- PDF -->
    <a href="{{ route('struk.pdf', $data->id) }}" 
       style="background:#dc3545;color:white;padding:10px 15px;border-radius:8px;text-decoration:none;">
        📄 Cetak PDF
    </a>

    <!-- EXCEL -->
    <a href="{{ route('struk.excel', $data->id) }}" 
       style="background:#198754;color:white;padding:10px 15px;border-radius:8px;text-decoration:none;">
        📊 Cetak Excel
    </a>

</div>

</div>

@endsection