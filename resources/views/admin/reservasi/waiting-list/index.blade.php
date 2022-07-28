@extends('admin.layout')

@section('css')
    <style>
        .nav-pills-custom .nav-link:not(.active) {
            background-color: inherit !important;
            color: #29538d !important;
        }


        /* active (faded) */
        .nav-pills-custom .nav-link {
            background-color: #29538d !important;
            color: white !important;
        }

        a.nav-link.active {
            background-color: #29538d !important;
            color: white !important;
        }

    </style>
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="container-fluid pt-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Waiting List Reservasi</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Waiting List Reservasi
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <ul class="nav nav-pills nav-pills-custom mb-3" id="myTab" role="tablist">
                <li class="nav-item mr-2">
                    <a class="nav-link active" id="pills-tab-grooming"
                       data-toggle="tab"
                       href="#tab-grooming" role="tab"
                       aria-controls="tab-grooming" aria-selected="true">Grooming</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-tab-penitipan"
                       data-toggle="tab"
                       href="#tab-penitipan" role="tab"
                       aria-controls="tab-penitipan" aria-selected="true">Penitipan</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-grooming"
                     role="tabpanel" aria-labelledby="tab-grooming">
                    <table id="table-data-grooming" class="display w-100 table table-bordered">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="20%">No. Transaksi</th>
                            <th>Customer</th>
                            <th>Paket</th>
                            <th width="12%" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data_grooming as $g)
                            <tr>
                                <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                                <td>{{ $g->no_transaksi }}</td>
                                <td>{{ $g->user->member->nama }}</td>
                                <td>{{ $g->paket->nama }}</td>
                                <td class="text-center">
                                    <a href="/reservasi-waiting-list/{{ $g->id }}/detail"
                                       class="btn btn-sm btn-info btn-edit"
                                       data-id="{{ $g->id }}"><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab-penitipan"
                     role="tabpanel" aria-labelledby="tab-penitipan">
                    <table id="table-data-penitipan" class="display w-100 table table-bordered">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="20%">No. Transaksi</th>
                            <th>Customer</th>
                            <th>Paket</th>
                            <th width="12%" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data_penitipan as $p)
                            <tr>
                                <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                                <td>{{ $p->no_transaksi }}</td>
                                <td>{{ $p->user->member->nama }}</td>
                                <td>{{ $p->paket->nama }}</td>
                                <td class="text-center">
                                    <a href="/reservasi-waiting-list/{{ $p->id }}/detail"
                                       class="btn btn-sm btn-info btn-edit"
                                       data-id="{{ $p->id }}"><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table-data-grooming').DataTable();
            $('#table-data-penitipan').DataTable();
        });
    </script>
@endsection
