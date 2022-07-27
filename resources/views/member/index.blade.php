@extends('member.layout')

@section('css')
    <style>
        .nav-pills .nav-link:not(.active) {
            background-color: white !important;
            color: #29538d !important;
        }


        /* active (faded) */
        .nav-pills .nav-link {
            background-color: #29538d !important;
            color: white !important;
        }
    </style>
@endsection

@section('content')
    <div id="overlay-loading">
        <div class="d-flex justify-content-center align-items-center" id="overlay-loading-child">
            <p class="font-weight-bold color-white">Sedang Menambah Keranjang....</p>
        </div>
    </div>
    <img src="{{ asset('/assets/icon/pet-banner.webp') }}" style="width: 100%;" height="600">
    <div class="text-center mt-3 mb-3">
        <p class="font-weight-bold main-text-color" style="font-size: 24px; letter-spacing: 1px;">Menu Rumah Makan Apung
            Wanawisata</p>
    </div>
    <div class="pl-5 pr-5 pt-2 pb-2 mt-3" style="padding-left: 5rem !important; padding-right: 5rem; !important">
        <div class="w-100 mb-3">
            <ul class="nav nav-pills mb-3" id="myTab" role="tablist">
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
                    <div class="row" id="panel-product-grooming">
                        @foreach($grooming as $v)
                            <div class="col-lg-3 col-md-4 mb-4">
                                <div class="card card-item" data-id="{{ $v->id }}"
                                     style="cursor: pointer; height: 370px; border-color: #29538d">
                                    <div class="card-body" style="height: 370px">
                                        <p class="font-weight-bold elipsis-one main-text-color text-center mb-1" style="font-size: 20px;">{{ $v->nama }}</p>
                                        <div style="height: 220px">
                                            <p class="mb-0 font-weight-bold" style="color: #535961; font-size: 16px;">Layanan Grooming</p>
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div><div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div><div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div><div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div><div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div><div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div><div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div><div class="d-flex align-items-center">
                                                <i class="fa fa-check mr-2"></i>
                                                <span class="font-weight-bold">Mandi</span>
                                            </div>
                                        </div>
                                        <p class="elipsis-two mb-0"
                                           style="color: #535961; font-size: 12px; height: 35px">{{ $v->deskripsi }}</p>

                                        <p class="font-weight-bold main-text-color mb-1 text-center" style="font-size: 24px;">
                                            Rp. {{ number_format($v->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        function emptyElementProduct() {
            return '<div class="col-lg-12 col-md-12" >' +
                '<div class="d-flex align-items-center justify-content-center" style="height: 600px"><p class="font-weight-bold">Tidak Ada Produk</p></div>' +
                '</div>';
        }

        function singleProductElement(data) {

            return '<div class="col-lg-3 col-md-4 mb-4">' +
                '<div class="card card-item" data-id="' + data['id'] + '"' +
                'style="cursor: pointer; height: 370px; border-color: #461a0a">' +
                '<img class="card-img-top" src="/assets/barang/' + data['gambar'] + '" alt="Card image cap" height="220">' +
                '<div class="card-body" style="height: 200px">' +
                '<p class="card-title font-weight-bold elipsis-one main-text-color mb-0">' + data['nama'] + '</p>' +
                '<p class="elipsis-two mb-0" style="color: #535961; font-size: 12px; height: 35px">' + data['deskripsi'] + '</p>' +
                '<p class="font-weight-bold main-text-color mb-1" style="font-size: 20px;">\n' +
                'Rp. ' + formatUang(data['harga']) + '</p>\n' +
                '<div class="d-flex w-100 justify-content-between align-items-center">\n' +
                '<p class="text-green mb-0" style="color: #535961; font-size: 12px;">Stock : ' + data['qty'] + '</p>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>';
        }

        function createElementProduct(data) {
            let child = '';
            $.each(data, function (k, v) {
                child += singleProductElement(v);
            });
            return child;
        }

        async function getProductByName(index) {
            let el = $('#panel-product-' + index);
            el.empty();
            el.append(createLoader());
            let name = $('#filter-' + index).val();
            try {
                let response = await $.get('/product/data?name=' + name + '&category=' + index);
                el.empty();
                if (response['status'] === 200) {
                    if (response['payload'].length > 0) {
                        el.append(createElementProduct(response['payload']));
                        $('.card-item').on('click', function () {
                            let id = this.dataset.id;
                            window.location.href = '/product/' + id + '/detail';
                        });
                    } else {
                        el.append(emptyElementProduct());
                    }
                }
            } catch (e) {
                console.log(e);
                alert('terjadi kesalahan');
            }
        }

        $(document).ready(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                console.log($(e.target).attr('id'));
            });
            $('.card-item').on('click', function () {
                let id = this.dataset.id;
                window.location.href = '/product/' + id + '/detail';
            });

            $('.btn-search').on('click', function (e) {
                let id = this.dataset.id;
                e.preventDefault();
                getProductByName(id);
            })
        });
    </script>
@endsection
