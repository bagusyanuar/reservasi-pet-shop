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
            <li class="breadcrumb-item active" aria-current="page">Transaksi
            </li>
        </ol>
        <hr>
        <div class="mt-5" style="min-height: 350px;">
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">No. Transaksi</th>
                    <th scope="col">Sub Total (Rp.)</th>
                    <th scope="col">Ongkir (Rp.)</th>
                    <th scope="col">Total (Rp.)</th>
                    <th scope="col">Status</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $v)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $v->tanggal }}</td>
                        <td>
                            {{ $v->no_transaksi }}
                        </td>
                        <td>{{ number_format($v->sub_total, 0, ',', '.') }}</td>
                        <td>{{ number_format($v->ongkir, 0, ',', '.') }}</td>
                        <td>{{ number_format($v->total, 0, ',', '.') }}</td>
                        <td>
                            @if($v->status == 'selesai-packing')
                                {{ $v->keterangan != '' ? 'Barang Di Kirim' : 'Menunggu Di Ambil' }}
                            @else
                                {{ ucwords($v->status) }}
                            @endif
                        </td>
                        <td>
                            <a href="/beranda/transaksi/{{ $v->id }}/detail" class="btn btn-sm btn-info btn-edit"
                            ><i class="fa fa-info"></i></a>
                            <a href="/beranda/pembayaran/{{ $v->id }}/detail" class="btn btn-sm btn-success"><i
                                    class="fa fa-credit-card"></i></a></td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
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
