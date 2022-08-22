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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Detail Reservasi Di Tolak</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/reservasi-tolak">Reservasi Di Tolak</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Reservasi Di Tolak
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">Detail Reservasi</p>
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
                                    <span class="font-weight-bold">Alasan</span>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <span class="font-weight-bold">: {{ $data->payment->keterangan}}</span>
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
                        <div class="col-lg-6 col-md-6">
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            AjaxPost('/reservasi-ongoing/kegiatan/delete', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data-kegiatan').DataTable();
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

            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah anda yakin menghapus kegiatan?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                    destroy(id);
                })
            });
        });
    </script>
@endsection
