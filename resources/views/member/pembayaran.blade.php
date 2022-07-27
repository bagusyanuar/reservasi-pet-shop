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
                <div class="col-md-6 col-lg-8">
                    <img src="{{ asset('/assets/icon/payment.png') }}" width="500">
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-header" style="background-color: #117d17">
                            <p class="font-weight-bold mb-0" style="color: whitesmoke; font-size: 18px">Detail
                                Pembayaran</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="w-50">
                                    <span class="detail-info font-weight-bold" style="font-size: 18px">Total</span>
                                </div>
                                <div class="w-50 text-right">
                                    <span class="detail-info font-weight-bold" style="font-size: 18px">:</span>
                                    <span class="detail-info font-weight-bold"
                                          style="font-size: 18px">Rp.  {{ number_format($data->total, 0, ',', '.')  }}</span>
                                </div>
                            </div>
                            @if($data->waiting_payment == null)
                                <form method="post" enctype="multipart/form-data"
                                      action="/beranda/pembayaran/{{ $data->id }}/create">
                                    @csrf
                                    <div class="form-group w-100 mt-2">
                                        <label for="bank">Pembayaran Bank</label>
                                        <select class="form-control" id="bank" name="bank" required>
                                            <option value="">--pilih bank--</option>
                                            <option value="BCA">BRI</option>
                                            <option value="BCA">BCA</option>
                                            <option value="MANDIRI">MANDIRI</option>
                                        </select>
                                    </div>
                                    <div class="w-100 mb-1">
                                        <label for="no_rekening" class="form-label">No. Rekening</label>
                                        <input type="number" class="form-control" id="no_rekening"
                                               name="no_rekening" required>
                                    </div>
                                    <div class="w-100 mb-1">
                                        <label for="nama" class="form-label">Atas Nama</label>
                                        <input type="text" class="form-control" id="nama"
                                               name="nama" required>
                                    </div>
                                    <div class="w-100 mb-1">
                                        <label for="bukti" class="form-label">Gambar Bukti Transfer</label>
                                        <input type="file" class="form-control-file" id="c"
                                               placeholder="Gambar Bukti"
                                               name="bukti" required>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-order w-100" id="btn-checkout">Bayar
                                    </button>
                                </form>
                            @else
                                <hr>
                                @if($data->waiting_payment->status == 'menunggu')
                                    <p class="text-green text-justify">NB: Terima kasih, anda telah melakukan
                                        pembayaran. Silahkan
                                        menunggu konfirmasi dari admin kami.</p>
                                @elseif($data->waiting_payment->status == 'terima')
                                    <p class="text-green text-justify">NB: Terima kasih, pembayaran anda sudah kami
                                        konfirmasi. Silahkan Menunggu karyawan kami akan segera mempacking da
                                        mengirimkan barang ke tempat anda</p>
                                    <a href="/beranda/pembayaran/{{ $data->id }}/cetak" class="btn btn-order w-100" target="_blank">
                                        <i class="fa fa-print mr-2"></i>Cetak Nota
                                    </a>
                                @elseif($data->waiting_payment->status == 'tolak')
                                    <p class="text-green text-justify">NB: Maaf pembayaran anda tidak kami terima, di
                                        karenakan {{ $data->waiting_payment->keterangan }}</p>
                                @endif
                            @endif
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
        });
    </script>
@endsection
