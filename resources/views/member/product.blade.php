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
            <li class="breadcrumb-item active" aria-current="page">{{ $data->nama }}
            </li>
        </ol>
        <div class="w-100 row product-detail">
            <div class="col-lg-4 col-md-4">
                <div style="border: solid 1px #117d17; border-radius: 5px; padding: 5px 5px">
                    <img src="{{ asset('/assets/barang'). '/' . $data->gambar }}" height="400"
                         alt="Gambar Produk" class="mr-3 w-100" style="border-radius: 5px">
                </div>

            </div>
            <div class="col-lg-5 col-md-5">
                <div class="flex-grow-1">
                    <div class="font-weight-bold text-green" style="font-size: 24px">{{ $data->nama }}</div>
                    <div style="font-size: 14px; color: #777777">{{ $data->category->nama }}</div>
                    <div class="font-weight-bold text-green" id="lbl-harga" data-harga="{{ $data->harga }}" style="font-size: 24px">
                        Rp. {{ number_format($data->harga, 0, ',', '.') }}</div>
                    <div style="text-align: justify">{{ $data->deskripsi }}</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div style="border: solid 1px #777777; border-radius: 5px; padding: 10px;">
                    <p class="font-weight-bold">Atur Jumlah</p>
                    <div class="d-flex justify-content-between align-items-start w-100">
                        <div style="font-size: 14px; font-weight: bold; color: #777777" class="w-50"
                             data-qty="{{$data->qty}}" id="lbl-stock">Sisa {{ $data->qty }}</div>
                        <div class="d-flex mb-2 align-items-center">
                            <a href="#" class="btn btn-minus btn-min mr-1"><i class="fa fa-minus"
                                                                              style="font-size: 14px"></i></a>
                            <input class="form-control form-control-sm text-right" type="number" id="qty" name="qty"
                                   value="1">
                            <a href="#" class="btn btn-plus ml-1 btn-add"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">

                        <div class="mr-1" style="color: #777777">Subtotal</div>
                        <div id="lbl-sub-total" class="flex-grow-1 text-right text-green" style="font-size: 20px; font-weight: bold">
                            Rp. {{ number_format($data->harga, 0, ',', '.') }}</div>
                    </div>
                    <div class="w-100 mt-2 mb-1">
                        <a href="#" class="btn btn-order w-100" id="btn-add-cart">Tambah Keranjang</a>
                    </div>
                    <div class="w-100">
                        <a href="#" class="btn btn-order-outline w-100" id="btn-buy">Beli Sekarang</a>
                    </div>
                </div>
            </div>


        </div>
        <div class="mt-3 mb-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="font-weight-bold text-green mb-0" style="font-size: 20px;">Rekomendasi Produk</p>
                @if(count($recommend) > 0)
                    <a href="/beranda/category/{{ $recommend[0]->id }}" class="category-menu">
                        Lihat Lainnya
                    </a>
                @endif
            </div>

            <div class="row product-detail">
                @forelse($recommend as $v)
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card card-item" data-id="{{ $v->id }}"
                             style="cursor: pointer; height: 400px; border-color: #117d17">
                            <img class="card-img-top" src="{{ asset('/assets/barang'). "/" . $v->gambar }}"
                                 alt="Card image cap" height="200">
                            <div class="card-body" style="height: 200px">
                                <p class="card-title font-weight-bold elipsis-one text-green">{{ $v->nama }}</p>
                                <p class="text-green elipsis-two mb-0"
                                   style="color: #535961; font-size: 12px; height: 35px">{{ $v->deskripsi }}</p>
                                <p class="font-weight-bold text-green" style="font-size: 20px;">
                                    Rp. {{ number_format($v->harga, 0, ',', '.') }}</p>
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <p class="text-green mb-0" style="color: #535961; font-size: 12px;">Stock
                                        : {{ $v->qty }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="font-weight-bold text-green" style="font-size: 20px">
                            Tidak Ada Rekomendasi
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var barang_id = '{{$data->id}}';

        async function addToCart(direct = false) {
            try {
                blockLoading(true);
                let response = await $.post('/beranda/cart/create', {
                    barang: barang_id,
                    qty: $('#qty').val()
                });
                blockLoading(false);
                if (response.status === 202) {
                    window.location.href = '/login-member';
                } else {
                    if (direct === true) {
                        window.location.href = '/beranda/cart';
                    } else {
                        SuccessAlert('Berhasil', 'Berhasil menambah data ke keranjang belanja');
                        window.location.reload();
                    }
                }
            } catch (e) {
                ErrorAlert('Error', 'terjadi kesalahan')
            }
        }

        $(document).ready(function () {
            $('#qty').on('change', function (e) {
                let val = parseInt(this.value);
                let stock = parseInt($('#lbl-stock').attr('data-qty'));
                let price = parseInt($('#lbl-harga').attr('data-harga'));
                if (stock < val) {
                    e.preventDefault();
                    $('#qty').val(stock);
                    let qty = parseInt($('#qty').val());
                    let total = price * qty;
                    $('#lbl-sub-total').html('Rp. '+formatUang(total))
                } else if (val < 1) {
                    e.preventDefault();
                    $('#qty').val('1');
                    let qty = parseInt($('#qty').val());
                    let total = price * qty;
                    $('#lbl-sub-total').html('Rp. '+formatUang(total))
                } else {
                    let qty = parseInt($('#qty').val());
                    let total = price * qty;
                    $('#lbl-sub-total').html('Rp. '+formatUang(total))
                }
            });
            $('.btn-add').on('click', function (e) {
                e.preventDefault();
                let currentQty = parseInt($('#qty').val());
                let stock = parseInt($('#lbl-stock').attr('data-qty'));
                let price = parseInt($('#lbl-harga').attr('data-harga'));
                if (stock > currentQty) {
                    let qty = currentQty + 1
                    $('#qty').val(qty);
                    let total = price * qty;
                    $('#lbl-sub-total').html('Rp. '+formatUang(total))
                }
            });
            $('.btn-min').on('click', function (e) {
                e.preventDefault();
                let currentQty = parseInt($('#qty').val());
                let qty = currentQty - 1;
                let price = parseInt($('#lbl-harga').attr('data-harga'));
                if (qty > 0) {
                    let total = price * qty;
                    $('#qty').val(qty);
                    $('#lbl-sub-total').html('Rp. '+formatUang(total))
                }
            });
            $('#btn-add-cart').on('click', function (e) {
                e.preventDefault();
                addToCart();
            })
            $('#btn-buy').on('click', function (e) {
                e.preventDefault();
                addToCart(true);
            })

            $('.card-item').on('click', function () {
                let id = this.dataset.id;
                window.location.href = '/beranda/product/' + id + '/detail';
            });
        });
    </script>
@endsection
