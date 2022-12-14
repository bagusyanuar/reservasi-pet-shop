<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap3.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }
        .f-bold {
            font-weight: bold;
        }
        .footer{
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }
    </style>
</head>
<body>
<div class="text-center f-bold report-title">BUKTI DATA RESERVASI OMO CATS</div>
<hr>
<div class="row">
    <div class="col-xs-2 f-bold">No. Transaksi</div>
    <div class="col-xs-3 f-bold">: {{ $data->no_transaksi }}</div>
    <div class="col-xs-2">Tanggal</div>
    <div class="col-xs-3">: {{ $data->tanggal }}</div>
</div>
<div class="row">
    <div class="col-xs-2">Nama</div>
    <div class="col-xs-3">: {{ $data->user->member->nama }}</div>
</div>
<hr>
<p class="f-bold report-title">Detail Reservasi</p>
<div class="row">
    <div class="col-xs-2">Tipe Reservasi</div>
    <div class="col-xs-3">: {{ ucwords($data->tipe) }}</div>
</div>
<div class="row">
    <div class="col-xs-2">Paket Reservasi</div>
    <div class="col-xs-3">: {{ $data->paket->nama }}</div>
</div>
@if($data->tipe == 'penitipan')
    <div class="row">
        <div class="col-xs-2">Check In</div>
        <div class="col-xs-3">: {{ $data->penitipan->check_in }}</div>
        <div class="col-xs-2">Check Out</div>
        <div class="col-xs-3">: {{ $data->penitipan->check_out }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Nama Kucing</div>
        <div class="col-xs-3">: {{ $data->penitipan->kucing->nama }}</div>
        <div class="col-xs-2">Ras</div>
        <div class="col-xs-3">: {{ $data->penitipan->kucing->ras }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Jenis Kelamin</div>
        <div class="col-xs-3">: {{ ucwords($data->penitipan->kucing->jenis_kelamin) }}</div>
        <div class="col-xs-2">Pola</div>
        <div class="col-xs-3">: {{ $data->penitipan->kucing->pola }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Usia</div>
        <div class="col-xs-3">: {{ $data->penitipan->kucing->usia }} bulan</div>
    </div>
@endif

@if($data->tipe == 'grooming')
    <div class="row">
        <div class="col-xs-2">Tanggal</div>
        <div class="col-xs-3">: {{ $data->grooming->tanggal }}</div>
        <div class="col-xs-2">Jam</div>
        <div class="col-xs-3">: {{ $data->grooming->jam }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Nama Kucing</div>
        <div class="col-xs-3">: {{ $data->grooming->kucing->nama }}</div>
        <div class="col-xs-2">Ras</div>
        <div class="col-xs-3">: {{ $data->grooming->kucing->ras }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Jenis Kelamin</div>
        <div class="col-xs-3">: {{ ucwords($data->grooming->kucing->jenis_kelamin) }}</div>
        <div class="col-xs-2">Pola</div>
        <div class="col-xs-3">: {{ $data->grooming->kucing->pola }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Usia</div>
        <div class="col-xs-3">: {{ $data->grooming->kucing->usia }} bulan</div>
    </div>
@endif
<hr>
<p class="f-bold">Detail Kegiatan</p>
<table id="my-table" class="table display">
    <thead>
    <tr>
        <th width="5%" class="text-center">#</th>
        <th width="25%">Waktu</th>
        <th>Kegiatan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data->kegiatan as $v)
        <tr>
            <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
            <td>{{ $v->waktu }}</td>
            <td>{{ $v->kegiatan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<hr>
<div class="row">
    <div class="col-xs-8"></div>
    <div class="col-xs-3">
        <div class="text-center">Admin</div>
        <br>
        <br>
        <br>
        <div class="text-center">(..............)</div>
    </div>
</div>
</body>
</html>
