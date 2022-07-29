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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Kucing</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/kucing">Kucing</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 col-sm-11">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/kucing/patch" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="w-100 mb-1">
                                    <label for="nama" class="form-label">Nama Kucing</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Kucing"
                                           name="nama" value="{{ $data->nama }}">
                                </div>


                                <div class="form-group w-100 mb-1">
                                    <label for="pemilik">Pemilik</label>
                                    <select class="form-control" id="pemilik" name="pemilik">
                                        <option value="">--pilih pemilik--</option>
                                        @foreach($pemilik as $v)
                                            <option value="{{ $v->id }}" {{ $data->user !== null ? ($v->id === $data->user->id ? 'selected' : '') : '' }}>{{ $v->member->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="ras" class="form-label">Ras</label>
                                    <input type="text" class="form-control" id="ras" placeholder="Ras"
                                           name="ras" value="{{ $data->ras }}">
                                </div>

                                <div class="form-group w-100 mb-1">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="jantan" {{ $data->jenis_kelamin == 'jantan' ? 'selected' : '' }}>Jantan</option>
                                        <option value="betina" {{ $data->jenis_kelamin == 'betina' ? 'selected' : '' }}>Betina</option>
                                    </select>
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="pola" class="form-label">Pola</label>
                                    <input type="text" class="form-control" id="pola" placeholder="Pola"
                                           name="pola" value="{{ $data->pola }}">
                                </div>

                                <div class="w-100 mb-1">
                                    <label for="usia" class="form-label">Usia</label>
                                    <input type="number" class="form-control" id="usia" placeholder="Usia"
                                           name="usia" value="{{ $data->usia }}">
                                </div>
                                <div class="w-100 mb-1 {{ $data->foto === null ? 'd-none' : '' }}" id="panel-gambar">
                                    <label for="foto" class="form-label d-block">Foto Kucing</label>
                                    <div class="d-flex align-items-end">
                                        <a target="_blank"
                                           href="{{ asset('assets/kucing') .'/'. $data->foto }}">
                                            <img
                                                class="mr-2"
                                                src="{{ asset('assets/kucing') .'/'. $data->foto }}"
                                                alt="Gambar Kucing"
                                                style="width: 100px; height: 100px; object-fit: cover"/>
                                        </a>
                                        <a href="#" class="btn-ganti" id="btn-ganti">Ganti</a>
                                    </div>
                                </div>
                                <div class="w-100 mb-1 {{ $data->foto === null ? '' : 'd-none' }}" id="panel-input-gambar">
                                    <label for="foto" class="form-label">Foto Kucing</label>
                                    <input type="file" class="form-control" id="foto" placeholder="Foto Kucing"
                                           name="foto">
                                    <a href="#" class="btn-batal" id="btn-batal">Batal</a>
                                </div>
                                <div class="w-100 mb-2 mt-3 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

        $(document).ready(function () {

            $('#btn-ganti').on('click', function (e) {
                e.preventDefault();
                $('#panel-gambar').addClass('d-none');
                $('#panel-input-gambar').removeClass('d-none');
            });
            $('#btn-batal').on('click', function (e) {
                e.preventDefault();
                $('#gambar').val('');
                $('#panel-input-gambar').addClass('d-none');
                $('#panel-gambar').removeClass('d-none');
            })
        });
    </script>
@endsection
