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
        <p class="font-weight-bold main-text-color" style="font-size: 24px; letter-spacing: 1px;">Pilihan Paket Grooming dan Penitipan OMO Cats</p>
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
                                        <p class="font-weight-bold elipsis-one main-text-color text-center mb-1"
                                           style="font-size: 20px;">{{ $v->nama }}</p>
                                        <div style="height: 220px">
                                            <p class="mb-0 font-weight-bold" style="color: #535961; font-size: 16px;">
                                                Layanan Grooming</p>
                                            @if(count($v->layanan) > 8)
                                                @foreach($v->layanan->take(7) as $l)
                                                    <div class="d-flex align-items-center main-text-color">
                                                        <i class="fa fa-check mr-2"></i>
                                                        <span class="font-weight-bold">{{ $l->nama }}</span>
                                                    </div>
                                                @endforeach
                                                <div class="d-flex align-items-center main-text-color">
                                                    <i class="fa fa-check mr-2"></i>
                                                    <span class="font-weight-bold">dll</span>
                                                </div>
                                            @else
                                                @foreach($v->layanan as $l)
                                                    <div class="d-flex align-items-center main-text-color">
                                                        <i class="fa fa-check mr-2"></i>
                                                        <span class="font-weight-bold">{{ $l->nama }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <p class="elipsis-two mb-0"
                                           style="color: #535961; font-size: 12px; height: 35px">{{ $v->deskripsi }}</p>

                                        <p class="font-weight-bold main-text-color mb-1 text-center"
                                           style="font-size: 24px;">
                                            Rp. {{ number_format($v->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-penitipan"
                     role="tabpanel" aria-labelledby="tab-penitipan">
                    <div class="row" id="panel-product-penitipan">
                        @foreach($penitipan as $p)
                            <div class="col-lg-3 col-md-4 mb-4">
                                <div class="card card-item" data-id="{{ $p->id }}"
                                     style="cursor: pointer; height: 200px; border-color: #29538d">
                                    <div class="card-body" style="height: 370px">
                                        <p class="font-weight-bold elipsis-one main-text-color text-center mb-1"
                                           style="font-size: 20px;">{{ $p->nama }}</p>
                                        <p class="elipsis-three mb-0 text-justify"
                                           style="color: #535961; font-size: 12px; height: 50px">{{ $p->deskripsi }}</p>
                                        <p class="font-weight-bold main-text-color mb-1 text-center"
                                           style="font-size: 24px;">
                                            Rp. {{ number_format($p->harga, 0, ',', '.') }}</p>
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
        $(document).ready(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                console.log($(e.target).attr('id'));
            });
            $('.card-item').on('click', function () {
                let id = this.dataset.id;
                window.location.href = '/product/' + id + '/detail';
            });
        });
    </script>
@endsection
