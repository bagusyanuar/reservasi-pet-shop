@extends('member.layout')

@section('content')
    <img src="{{ asset('/assets/icon/banner5.jpg') }}" style="width: 100%;" height="600">
    <div class="text-center mt-3 mb-3">
        <p class="font-weight-bold" style="font-size: 16px; letter-spacing: 1px; color: #117d17">Temukan Produk Material
            Toilet
            Sesuai Kebutuhan Anda.</p>
    </div>
    <div class="text-center mt-3 mb-3">
        <p class="font-weight-bold" style="font-size: 24px; letter-spacing: 1px; color: #117d17">Produk Material Toilet
            Di Toko
            Kami.</p>
    </div>
    <div class="pl-5 pl-5 pt-2 pb-2 mt-3">
        <div class="row w-100">
            <div class="col-lg-2">
                <div class="card" style="border-color: #117d17">
                    <div class="card-header" style="background-color: #117d17 ">
                        <p class="font-weight-bold mb-0" style="color: whitesmoke; font-size: 18px">Kategori</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="/beranda/category/{{ $category->id }}"
                                   class="category-menu">{{ $category->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="d-flex align-items-center justify-content-end mb-2">
                    <ol class="breadcrumb breadcrumb-transparent mb-0">
                        <li class="breadcrumb-item">
                            <a href="/beranda" class="category-menu">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $current_category->nama }}
                        </li>
                    </ol>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-grow-1 mr-2">
                        <input type="text" class="form-control" id="filter" placeholder="Cari Nama barang"
                               name="filter">
                    </div>
                    <div>
                        <a href="#" class="btn btn-success" id="btn-search"><i
                                class="fa fa-search mr-1"></i><span>Cari</span></a>
                    </div>
                </div>

                <div class="panel-product" id="panel-product">
                    <div class="row">
                        @foreach($data as $v)
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var id = '{{ $current_category->id }}';

        function emptyElementProduct() {
            return '<div class="col-lg-12 col-md-12" >' +
                '<div class="d-flex align-items-center justify-content-center" style="height: 600px"><p class="font-weight-bold">Tidak Ada Produk</p></div>' +
                '</div>';
        }

        function singleProductElement(data) {
            return '<div class="col-lg-3 col-md-4 mb-4">' +
                '<div class="card card-item" data-id="' + data['id'] + '" style="cursor: pointer; height: 400px; border-color: #117d17">' +
                '<img class="card-img-top" src="/assets/barang/' + data['gambar'] + '" alt="Card image cap" height="200">' +
                '<div class="card-body" style="height: 200px">' +
                '<p class="card-title font-weight-bold elipsis-one text-green">' + data['nama'] + '</p>' +
                '<p class="text-green elipsis-two mb-0" style="color: #535961; font-size: 12px; height: 35px">' + data['deskripsi'] + '</p>' +
                '<p class="font-weight-bold text-green" style="font-size: 20px;">Rp. ' + formatUang(data['harga']) + '</p>' +
                '<div class="d-flex w-100 justify-content-between align-items-center">' +
                '<p class="text-green mb-0" style="color: #535961; font-size: 12px;">Stock : ' + data['qty'] + '</p>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        }

        function createElementProduct(data) {
            let child = '';
            $.each(data, function (k, v) {
                child += singleProductElement(v);
            });
            return '<div class="row">' + child + '</div>';
        }

        async function getProductByName() {
            let el = $('#panel-product');
            el.empty();
            el.append(createLoader());
            let name = $('#filter').val();
            try {
                let response = await $.get('/beranda/category/' + id + '/data?name=' + name);
                el.empty();
                if (response['status'] === 200) {
                    if (response['payload'].length > 0) {
                        el.append(createElementProduct(response['payload']));
                        $('.card-item').on('click', function () {
                            let id = this.dataset.id;
                            window.location.href = '/beranda/product/' + id + '/detail';
                        });
                    } else {
                        el.append(emptyElementProduct());
                    }
                }
            } catch (e) {
                console.log(e);
            }
        }

        $(document).ready(function () {
            $('.card-item').on('click', function () {
                let id = this.dataset.id;
                window.location.href = '/beranda/product/' + id + '/detail';
            });

            $('#btn-search').on('click', function (e) {
                e.preventDefault();
                getProductByName();
            })
        });
    </script>
@endsection
