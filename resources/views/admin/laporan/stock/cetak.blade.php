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
<div class="text-center f-bold report-title">LAPORAN STOCK TOKO MATERIAL KURNIA</div>
<div class="text-center">Periode Laporan Per Tanggal {{ date('d-m-Y') }} </div>
<hr>
<table id="my-table" class="table display">
    <thead>
    <tr>
        <th width="5%" class="text-center">#</th>
        <th width="15%">Kateogori</th>
        <th>Nama Barang</th>
        <th width="15%">Qty</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
        <tr>
            <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
            <td>{{ $v->category->nama }}</td>
            <td>{{ $v->nama }}</td>
            <td>{{ $v->qty }}</td>
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
