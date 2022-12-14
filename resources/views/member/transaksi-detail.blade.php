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
                <a href="/" class="category-menu">Beranda</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/reservasi" class="category-menu">Reservasi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data->no_transaksi }}
            </li>
        </ol>
        <hr>
        <div class="mt-5" style="min-height: 350px;">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">Detail Pesanan</p>
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
                                    <span class="font-weight-bold">Tipe Reservasi</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ ucwords($data->tipe) }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <span class="font-weight-bold">Status Reservasi</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ ucwords($data->status) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">
                                Detail {{ $data->tipe == 'penitipan' ? 'Penitipan' : 'Grooming' }}</p>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <span
                                        class="font-weight-bold">Paket {{ $data->tipe == 'penitipan' ? 'Penitipan' : 'Grooming' }}</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->paket->nama }}</span>
                                </div>
                            </div>
                            @if($data->tipe == 'penitipan')
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <span class="font-weight-bold">Check In</span>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <span class="font-weight-bold">: {{ $data->penitipan->check_in }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <span class="font-weight-bold">Check Out</span>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <span class="font-weight-bold">: {{ $data->penitipan->check_out }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <span class="font-weight-bold">Catatan</span>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <span class="font-weight-bold">: {{ $data->penitipan->catatan }}</span>
                                    </div>
                                </div>
                                @if($data->penitipan->transport == 1)
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <span class="font-weight-bold">Jemput</span>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <span class="font-weight-bold">: Ya</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <span class="font-weight-bold">Alamat</span>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <span class="font-weight-bold">: {{ $data->penitipan->alamat }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if($data->tipe == 'grooming')
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <span class="font-weight-bold">Tanggal Reservasi</span>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <span class="font-weight-bold">: {{ $data->grooming->tanggal }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <span class="font-weight-bold">Jam</span>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <span class="font-weight-bold">: {{ $data->grooming->jam }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <span class="font-weight-bold">Catatan</span>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <span class="font-weight-bold">: {{ $data->grooming->catatan }}</span>
                                    </div>
                                </div>
                                @if($data->grooming->transport == 1)
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <span class="font-weight-bold">Jemput</span>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <span class="font-weight-bold">: Ya</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <span class="font-weight-bold">Alamat</span>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <span class="font-weight-bold">: {{ $data->grooming->alamat }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="background-color: #29538d ">
                    <p class="font-weight-bold mb-0"
                       style="color: whitesmoke; font-size: 18px">Informasi Kucing</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-weight-bold">Data Kucing</p>
                                    @if($data->tipe == 'penitipan')
                                        <a target="_blank"
                                           href="{{ asset('assets/kucing')."/".$data->penitipan->kucing->foto }}">
                                            <img src="{{  asset('assets/kucing')."/".$data->penitipan->kucing->foto }}"
                                                 alt="Gambar Kucing"
                                                 style="width: 150px; height: 150px; object-fit: cover">
                                        </a>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Nama Kucing</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ $data->penitipan->kucing->nama }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Ras</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ $data->penitipan->kucing->ras }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Jenis Kelamin</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ ucwords($data->penitipan->kucing->jenis_kelamin) }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Pola</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ $data->penitipan->kucing->pola }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Usia</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span class="font-weight-bold">: {{ $data->penitipan->kucing->usia }} bulan</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if($data->tipe == 'grooming')
                                        <a target="_blank"
                                           href="{{ asset('assets/kucing')."/".$data->grooming->kucing->foto }}">
                                            <img src="{{  asset('assets/kucing')."/".$data->grooming->kucing->foto }}"
                                                 alt="Gambar Kucing"
                                                 style="width: 150px; height: 150px; object-fit: cover">
                                        </a>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Nama Kucing</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ $data->grooming->kucing->nama }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Ras</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ $data->grooming->kucing->ras }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Jenis Kelamin</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ ucwords($data->grooming->kucing->jenis_kelamin) }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Pola</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span
                                                    class="font-weight-bold">: {{ $data->grooming->kucing->pola }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <span class="font-weight-bold">Usia</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <span class="font-weight-bold">: {{ $data->grooming->kucing->usia }} bulan</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <p class="font-weight-bold">Data Kegiatan Kucing</p>
                            <table id="table-data-kegiatan" class="display w-100 table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="17%">Foto</th>
                                    <th>Waktu</th>
                                    <th width="25%">Kegiatan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->kegiatan as $k)
                                    <tr>
                                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a target="_blank"
                                               href="{{ asset('assets/kegiatan')."/".$k->foto }}">
                                                <img
                                                    src="{{ asset('assets/kegiatan')."/".$k->foto }}"
                                                    alt="Gambar Kegiatan"
                                                    style="width: 75px; height: 80px; object-fit: cover"/>
                                            </a>
                                        </td>
                                        <td>{{ $k->waktu }}</td>
                                        <td>{{ $k->kegiatan}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>
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
                        <span class="w-50 font-weight-bold">Biaya Transport</span>
                        <span class="w-50 text-right font-weight-bold"
                              id="lbl-ongkir">Rp. {{ number_format($data->transport, 0, ',', '.') }}</span>
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
