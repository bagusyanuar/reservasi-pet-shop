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
        .footer {
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }
        .w-50 {
            width: 50%;
        }
        .font-weight-bold {
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="text-center f-bold report-title">NOTA PEMBELIAN MATERIAL TOKO KURNIA</div>
<div class="text-center">
    <span>Jl. Adi Sumarmo No. 18, Manahan, Surakarta</span>
</div>
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
<table id="my-table" class="table display">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Qty</th>
        <th scope="col">Harga (Rp.)</th>
        <th scope="col">Total (Rp.)</th>
    </tr>
    </thead>
    <tbody>
    <tbody>
    @forelse($data->cart as $v)
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $v->product->nama }}</td>
            <td>{{ $v->qty }}</td>
            <td>{{ number_format($v->harga, 0, ',', '.') }}</td>
            <td>{{ number_format($v->total, 0, ',', '.') }}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>
<hr>
<div class="row">
    <div class="col-xs-7"></div>
    <div class="col-xs-2">
        <div class="f-bold">Sub Total</div>
    </div>
    <div class="col-xs-2">
        <div class="f-bold">: Rp. {{ number_format($data->sub_total, 0, ',', '.') }}</div>
    </div>
</div>
<div class="row">
    <div class="col-xs-7"></div>
    <div class="col-xs-2">
        <div class="f-bold">Ongkir</div>
    </div>
    <div class="col-xs-2">
        <div class="f-bold">: Rp. {{ number_format($data->ongkir, 0, ',', '.') }}</div>
    </div>
</div>
<div class="row">
    <div class="col-xs-7"></div>
    <div class="col-xs-2">
        <div class="f-bold">Total</div>
    </div>
    <div class="col-xs-2">
        <div class="f-bold">: Rp. {{ number_format($data->total, 0, ',', '.') }}</div>
    </div>
</div>
</body>
</html>
