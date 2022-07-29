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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Detail Permintaan Reservasi</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/reservasi-baru">Permintaan Reservasi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"> Detail Permintaan Reservasi
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
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
                                    <span class="font-weight-bold">Customer</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->user->member->nama }}</span>
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
                                    <span class="font-weight-bold">Pembayaran Via</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->payment->bank }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <span class="font-weight-bold">No. Rekening</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->payment->no_rekening }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <span class="font-weight-bold">Atas Nama</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->payment->nama }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">Detail Pembayaran</p>
                            <div>
                                <p class="font-weight-bold mb-1">Bukti Pembayaran</p>
                                <a target="_blank"
                                   href="{{ asset('assets/bukti')."/".$data->payment->bukti }}">
                                    <img src="{{  asset('assets/bukti')."/".$data->payment->bukti }}" alt="Gambar Bukti"
                                         style="width: 185px; height: 185px; object-fit: cover">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="background-color: #29538d ">
                    <p class="font-weight-bold mb-0"
                       style="color: whitesmoke; font-size: 18px">Data Reservasi</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
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
                        <div class="col-lg-6 col-md-6">
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
                    </div>
                </div>
            </div>
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
                                        : Rp. {{ number_format($data->total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <form method="post">
                                @csrf
                                <div class="form-group w-100 mt-2">
                                    <label for="status">Proses Reservasi</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="terima">Terima</option>
                                        <option value="tolak">Tolak</option>
                                    </select>
                                </div>
                                <div class="form-group w-100 d-none" id="reason">
                                    <label for="keterangan">Alasan</label>
                                    <textarea class="form-control" rows="3" name="keterangan"
                                              id="keterangan"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" id="btn-submit">Submit
                                </button>
                            </form>
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
