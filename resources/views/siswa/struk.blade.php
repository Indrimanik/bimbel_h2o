<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk</title>
</head>
<body>

<h2>STRUK PEMBAYARAN</h2>

<table border="1">
    <tr>
        <th>Nama</th>
        <td>{{ $data->user->name }}</td>
    </tr>
    <tr>
        <th>Program</th>
        <td>{{ $data->program }}</td>
    </tr>
    <tr>
        <th>Total</th>
        <td>Rp {{ number_format($data->harga,0,',','.') }}</td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>{{ date('d-m-Y') }}</td>
    </tr>
</table>

<br>
<p>Terima kasih telah bergabung 🎓</p>

</body>
</html>