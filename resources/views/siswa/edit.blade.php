<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit</title>

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
    max-width:500px;
    margin:auto;
}

input,select {
    width:100%;
    padding:10px;
    margin:10px 0;
}

button {
    width:100%;
    padding:10px;
    background:#2a5298;
    color:white;
    border:none;
}
</style>
</head>

<body>

<div class="container">
<h2>Edit Data</h2>

<form action="/update/{{ $data->id }}" method="POST">
@csrf
@method('PUT')

<label>Program</label>
<select name="program">
<option value="Kedinasan" {{ $data->program=='Kedinasan'?'selected':'' }}>Kedinasan</option>
<option value="UTBK PTN" {{ $data->program=='UTBK PTN'?'selected':'' }}>UTBK PTN</option>
</select>

<label>Harga</label>
<input type="number" name="harga" value="{{ $data->harga }}">

<button>Update</button>
</form>

<br>
<a href="/riwayat">← Kembali</a>

</div>

</body>
</html>