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
                            <form method="post" action="/kucing/create" enctype="multipart/form-data">
                                @csrf
                                <div class="w-100 mb-1">
                                    <label for="nama" class="form-label">Nama Kucing</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Kucing"
                                           name="nama">
                                </div>
                                <div class="form-group w-100 mb-1">
                                    <label for="pemilik">Pemilik</label>
                                    <select class="form-control" id="pemilik" name="pemilik">
                                        <option value="">--pilih pemilik--</option>
                                        @foreach($data as $v)
                                            <option value="{{ $v->id }}">{{ $v->member->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="ras" class="form-label">Ras</label>
                                    <input type="text" class="form-control" id="ras" placeholder="Ras"
                                           name="ras">
                                </div>
                                <div class="form-group w-100 mb-1">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="jantan">Jantan</option>
                                        <option value="betina">Betina</option>
                                    </select>
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="pola" class="form-label">Pola</label>
                                    <input type="text" class="form-control" id="pola" placeholder="Pola"
                                           name="pola">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="usia" class="form-label">Usia</label>
                                    <input type="number" class="form-control" id="usia" placeholder="Usia"
                                           name="usia" value="1">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="foto" class="form-label">Foto Kucing</label>
                                    <input type="file" class="form-control" id="foto" placeholder="Foto Kucing"
                                           name="foto">
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
@endsection
