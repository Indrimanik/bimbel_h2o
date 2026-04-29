<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat</title>

<style>
body {
    font-family: 'Poppins';
    background: linear-gradient(135deg,#1e3c72,#2a5298);
    padding:30px;
}

.container {
    background:white;
    padding:30px;
    border-radius:15px;
    max-width:900px;
    margin:auto;
}

h2 { text-align:center; }

table {
    width:100%;
    border-collapse:collapse;
}

th {
    background:#2a5298;
    color:white;
    padding:10px;
}

td {
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

.btn {
    padding:5px 10px;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.edit { background:green; }
.hapus { background:red; }

a { text-decoration:none; }
</style>
</head>

<body>

<div class="container">
<h2>📄 Riwayat</h2>

<table>
<tr>
<th>Program</th>
<th>Harga</th>
<th>Aksi</th>
</tr>

@foreach ($data as $item)
<tr>
<td>{{ $item->program }}</td>
<td>Rp {{ number_format($item->harga,0,',','.') }}</td>
<td>

<a href="/edit/{{ $item->id }}" class="btn edit">Edit</a>

<form action="/hapus/{{ $item->id }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn hapus">Hapus</button>
</form>

</td>
</tr>
@endforeach

</table>

<br>
<a href="/kelas">← Kembali</a>

</div>

</body>
</html>