@extends('member.layout')

@section('content')
    <div class="container-fluid mt-2" style="padding-left: 50px; padding-right: 50px; padding-top: 10px;">
        <ol class="breadcrumb breadcrumb-transparent mb-2">
            <li class="breadcrumb-item">
                <a href="/" class="category-menu">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Kucing
            </li>
        </ol>
        <hr>
        <div class="mt-5" style="min-height: 350px;">
            <div class="text-right mb-2 pr-3">
                <a href="/kucing-ku/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                        class="font-weight-bold">Tambah</span></a>
            </div>
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>Nama</th>
                    <th width="12%">Ras</th>
                    <th width="12%">Jenis Kelamin</th>
                    <th>Pola</th>
                    <th>Usia</th>
                    <th>Foto</th>
                    <th width="15%" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $v->nama }}</td>
                        <td>{{ $v->ras }}</td>
                        <td>{{ $v->jenis_kelamin }}</td>
                        <td>{{ $v->pola }}</td>
                        <td>{{ $v->usia }}</td>
                        <td>
                            @if($v->foto !== null)
                                <a target="_blank"
                                   href="{{ asset('assets/kucing')."/".$v->foto }}">
                                    <img
                                        src="{{ asset('assets/kucing')."/".$v->foto }}"
                                        alt="Gambar Kucing"
                                        style="width: 75px; height: 80px; object-fit: cover"/>
                                </a>
                            @else
                                Belum Ada Gambar
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="/kucing-ku/edit/{{ $v->id }}" class="btn btn-sm btn-warning btn-edit"
                               data-id="{{ $v->id }}"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <hr>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            AjaxPost('/kucing-ku/delete', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah anda yakin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                    destroy(id);
                })
            });
        });
    </script>
@endsection
