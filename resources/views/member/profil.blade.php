@extends('member.layout')

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
    <div class="container-fluid mt-2" style="padding-left: 50px; padding-right: 50px; padding-top: 10px;">
        <ol class="breadcrumb breadcrumb-transparent mb-2">
            <li class="breadcrumb-item">
                <a href="/" class="category-menu">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Profil
            </li>
        </ol>
        <hr>
        <div class="mt-5" style="min-height: 350px;">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 col-sm-11">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="w-100 mb-1">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username"
                                           name="username" value="{{ $data->username }}">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                           name="password">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap"
                                           name="nama" value="{{ $data->member->nama }}">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="no_hp" class="form-label">No. Hp</label>
                                    <input type="number" class="form-control" id="no_hp" placeholder="No. Hp"
                                           name="no_hp" value="{{ $data->member->no_hp }}">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea rows="3" class="form-control" id="alamat" placeholder="Alamat"
                                              name="alamat">{{ $data->member->alamat }}</textarea>
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
        <hr>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#table-data').DataTable();
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
        });
    </script>
@endsection
