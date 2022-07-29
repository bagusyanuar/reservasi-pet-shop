@extends('member.layout')

@section('content')
    <div class="container-fluid mt-2" style="padding-left: 50px; padding-right: 50px; padding-top: 10px;">
        <ol class="breadcrumb breadcrumb-transparent mb-2">
            <li class="breadcrumb-item">
                <a href="/beranda">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tentang Kami
            </li>
        </ol>
        <div class="w-100 product-detail text-center" style="min-height: 350px">
            <img src="{{ asset('/assets/icon/logo-pet-shop.jpg') }}" height="250"/>
            <p class="mb-1 mt-2" style="color: #535961;">
                omo cats pets & grooming menyediakan jasa layanan grooming dan
                penitipan kucing
            </p>
        </div>
    </div>
@endsection

@section('js')
@endsection
