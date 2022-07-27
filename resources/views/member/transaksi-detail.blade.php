@extends('member.layout')

@section('content')
    <div id="overlay-loading">
        <div class="d-flex justify-content-center align-items-center" id="overlay-loading-child">
            <p class="font-weight-bold color-white">Sedang Menambah Keranjang....</p>
        </div>
    </div>
    <div class="container-fluid mt-2" style="padding-left: 50px; padding-right: 50px; padding-top: 10px;">
        <ol class="breadcrumb breadcrumb-transparent mb-2">
            <li class="breadcrumb-item">
                <a href="/beranda" class="category-menu">Beranda</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/beranda/transaksi" class="category-menu">Transaksi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data->no_transaksi }}
            </li>
        </ol>
        <hr>
        <div class="mt-5" style="min-height: 350px;">
            <div class="row mb-3">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header" style="background-color: #117d17">
                            <p class="font-weight-bold mb-0" style="color: whitesmoke; font-size: 18px">Detail
                                Transaksi</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="w-50">
                                    <span class="detail-info">No. Transaksi</span>
                                </div>
                                <div class="w-50">
                                    <span class="detail-info">:</span>
                                    <span class="detail-info">{{ $data->no_transaksi }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="w-50">
                                    <span class="detail-info">Tanggal</span>
                                </div>
                                <div class="w-50">
                                    <span class="detail-info">:</span>
                                    <span class="detail-info">{{ $data->tanggal }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="w-50">
                                    <span class="detail-info">Status</span>
                                </div>
                                <div class="w-50">
                                    <span class="detail-info">:</span>
                                    <span class="detail-info">{{ $data->status }}

                                    </span>
                                </div>
                            </div>
                            @if($data->waiting_payment->status == 'tolak')
                                <div class="d-flex">
                                    <div class="w-50">
                                        <span class="detail-info">Alasan Di Tolak</span>
                                    </div>
                                    <div class="w-50">
                                        <span class="detail-info">:</span>
                                        <span class="detail-info">{{ $data->waiting_payment->keterangan }}

                                    </span>
                                    </div>
                                </div>
                            @endif

                            @if($data->keterangan != '')
                                <div class="d-flex">
                                    <div class="w-50">
                                        <span class="detail-info">Lokasi Pengiriman</span>
                                    </div>
                                    <div class="w-50">
                                        <span class="detail-info">:</span>
                                        <span class="detail-info">{{ $data->keterangan }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Harga (Rp.)</th>
                    <th scope="col">Total (Rp.)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data->cart as $v)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>
                            <a target="_blank"
                               href="{{ asset('assets/barang')."/".$v->product->gambar }}">
                                <img
                                    src="{{ asset('assets/barang')."/".$v->product->gambar }}"
                                    alt="Gambar Produk"
                                    style="width: 75px; height: 80px; object-fit: cover"/>
                            </a>
                        </td>
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
                <div class="col-lg-8 col-md-6"></div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <span class="w-50 font-weight-bold">Sub Total</span>
                        <span class="w-50 text-right font-weight-bold" id="lbl-sub-total"
                        >Rp.  {{ number_format($data->sub_total, 0, ',', '.')  }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="w-50 font-weight-bold">Biaya Kirim</span>
                        <span class="w-50 text-right font-weight-bold"
                              id="lbl-ongkir">Rp. {{ number_format($data->ongkir, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="w-50 font-weight-bold">Total</span>
                        <span class="w-50 text-right font-weight-bold"
                              id="lbl-total">Rp. {{  number_format($data->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#table-data').DataTable();
        });
    </script>
@endsection
