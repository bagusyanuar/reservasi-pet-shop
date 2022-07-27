@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    <div class="container-fluid pt-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Detail Pesanan Selesai</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/pesanan-selesai">Pesanan Selesai</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"> Detail Pesanan Selesai
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">Detail Pesanan Di Proses</p>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <span class="font-weight-bold">No. Transaksi</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->no_transaksi }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <span class="font-weight-bold">Tanggal</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->tanggal }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <span class="font-weight-bold">Customer</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->user->member->nama }}</span>
                                </div>
                            </div>
                            @if($data->keterangan != '')
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <span class="font-weight-bold">Lokasi Pengiriman</span>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <span class="font-weight-bold">: {{ $data->keterangan }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <p class="font-weight-bold">Detail Keranjang Pesanan</p>
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>Nama Prduk</th>
                    <th width="15%">Qty</th>
                    <th width="15%">Harga (Rp.)</th>
                    <th width="15%">Total (Rp.)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->cart as $v)
                    <tr>
                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $v->product->nama }}</td>
                        <td>{{ $v->qty }}</td>
                        <td>{{ number_format($v->harga, 0, ',', '.') }}</td>
                        <td>{{ number_format($v->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-8">

                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <span class="font-weight-bold">Total</span>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <span class="font-weight-bold">
                                        : Rp. {{ number_format($data->sub_total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <span class="font-weight-bold">Ongkir</span>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <span class="font-weight-bold">
                                        : Rp. {{ number_format($data->ongkir, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <span class="font-weight-bold">Total</span>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <span class="font-weight-bold">
                                        : Rp. {{ number_format($data->total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table-data').DataTable();
            $('#status').on('change', function () {
                let val = this.value;
                if (val === 'tolak') {
                    $('#reason').removeClass('d-none')
                    $('#reason').addClass('d-block')
                } else {
                    $('#reason').removeClass('d-block')
                    $('#reason').addClass('d-none')
                }
            })
        });
    </script>
@endsection
