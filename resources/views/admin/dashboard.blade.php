@extends('layouts.app')

@section('page-title', 'Dashboard Admin')

@section('content')

<h1 style="font-size:24px;font-weight:800;">Dashboard Admin 👑</h1>

<div style="margin-top:20px;">
    <a href="/admin/pendaftaran">📋 Data Pendaftaran</a><br><br>
    <a href="/admin/kelas">📚 Kelola Kelas</a>
</div>

@endsection