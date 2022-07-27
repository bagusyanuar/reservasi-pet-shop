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
            <li class="breadcrumb-item active" aria-current="page">Keranjang
            </li>
        </ol>
        <hr>
        <div class="mt-2">
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $v)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>
                            <a target="_blank"
                               href="{{ asset('assets/barang')."/".$v->product->gambar }}">
                                <img
                                    src="{{ asset('assets/barang')."/".$v->product->gambar }}"
                                    alt="Gambar Produk"
                                    style="width: 75px; height: 80px; object-fit: cover"/>
                            </a>
                        </td>
                        <td>{{ $v->product->nama }}</td>
                        <td>{{ $v->qty }}</td>
                        <td>{{ number_format($v->harga, 0, ',', '.') }}</td>
                        <td>{{ number_format($v->total, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-lg-3 col-md-6">
                <div class="form-check">
                    <input type="checkbox" checked="checked" class="form-check-input" id="pengiriman">
                    <label class="form-check-label" for="pengiriman">Gunakan Jasa Pengiriman</label>
                </div>
                <div id="panel-pengiriman" class="mt-2 d-block">
                    <div class="form-group w-100 mb-1">
                        <label for="kota">Kota</label>
                        <select class="form-control" id="kota" name="kota">
                            @foreach($kota as $v)
                                <option value="{{ $v->id }}"
                                        data-harga="{{ $v->ongkir->total }}">{{ $v->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 mb-1">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat" placeholder="Alamat"
                                  name="alamat" rows="3"></textarea>
                    </div>
                </div>

            </div>
            <div class="col-lg-5 col-md-1"></div>
            <div class="col-lg-4 col-md-5">
                <div class="d-flex justify-content-between align-items-center mb-0">
                    <span class="w-50 font-weight-bold">Sub Total</span>
                    <span class="w-50 text-right font-weight-bold" id="lbl-sub-total"
                          data-sub="{{ $data->sum('total') }}">Rp.  {{ number_format($data->sum('total'), 0, ',', '.')  }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="w-50 font-weight-bold">Biaya Kirim</span>
                    <span class="w-50 text-right font-weight-bold" id="lbl-ongkir">Rp. 0</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="w-50 font-weight-bold">Total</span>
                    <span class="w-50 text-right font-weight-bold"
                          id="lbl-total">Rp. {{  number_format($data->sum('total'), 0, ',', '.') }}</span>
                </div>
                <hr>
                <a href="#" class="btn btn-outline-primary w-100" id="btn-checkout">Checkout</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var ongkir = 0;

        async function checkout() {
            try {
                blockLoading(true);
                let response = await $.post('/beranda/cart/checkout', {
                    ongkir: ongkir,
                    keterangan: $('#alamat').val(),
                    kota: $( "#kota option:selected" ).text(),
                });
                blockLoading(false);
                let payload = response['payload'];
                window.location.href = '/beranda/pembayaran/' + payload + '/detail';
            } catch (e) {
                alert('Terjadi Kesalahan');
            }
        }

        async function delete_keranjang(id) {
            try {
                blockLoading(true);
                let response = await $.post('/beranda/cart/destroy', {
                    id: id
                });
                blockLoading(false);
                window.location.reload()
            } catch (e) {
                alert('Terjadi Kesalahan');
            }
        }

        function setongkir() {
            ongkir = parseInt($('#kota').find("option:selected").attr('data-harga'));
            $('#lbl-ongkir').html('Rp. ' + formatUang(ongkir.toString()));
        }

        function setTotal(ongkir) {
            let sub_total = parseInt($('#lbl-sub-total').attr('data-sub'));
            let total = sub_total + ongkir;
            $('#lbl-total').html('Rp. '+formatUang(total.toString()));
        }
        $(document).ready(function () {
            setongkir();
            setTotal(ongkir);
            $('#table-data').DataTable();
            $('#duration').on('change', function () {
                let qty = parseInt(this.value);
                let sub = parseInt($('#lbl-sub-total').attr('data-sub'));
                let total = qty * sub;
                $('#lbl-total').html('RP. ' + total);
                console.log(total);
            });
            $('#btn-checkout').on('click', function (e) {
                e.preventDefault();
                checkout();
            });
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah anda yakin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                    delete_keranjang(id);
                });
            })
            $('#pengiriman').on('change', function () {
                if ($('#pengiriman').is(":checked")) {
                    $('#panel-pengiriman').removeClass('d-none');
                    $('#panel-pengiriman').addClass('d-block');
                    setongkir();
                } else {
                    $('#panel-pengiriman').removeClass('d-block');
                    $('#panel-pengiriman').addClass('d-none');
                    ongkir = 0;
                    $('#lbl-ongkir').html('Rp. ' + formatUang(ongkir.toString()));
                    setTotal(ongkir);
                    $('#alamat').val('')
                }
            });

            $('#kota').on('change', function () {
                setongkir();
                setTotal(ongkir);
            });
        });
    </script>
@endsection
