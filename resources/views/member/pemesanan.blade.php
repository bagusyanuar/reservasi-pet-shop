@extends('member.layout')

@section('content')
    <div class="container-fluid mt-2" style="padding-left: 50px; padding-right: 50px; padding-top: 10px;">
        <ol class="breadcrumb breadcrumb-transparent mb-2">
            <li class="breadcrumb-item">
                <a href="/beranda">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Cara Pemesanan
            </li>
        </ol>
        <div class="w-100 product-detail" style="min-height: 350px">
            <ol type="1">
                <li>
                    <p>Silahkan melakukan registrasi atau login sebagai member terlebih dahulu.</p>
                </li>
                <li>
                    <p>Pilih paket layanan yang tersedia</p>
                </li>
                <li>
                    <p>Silahkan Isi Formulir paket layanan. Setelah selesai klik "Reservasi"</p>
                </li>
                <li>
                    <p>Jika anda memilih layanan antar jemput, mohon tunggu pegawai kami untu menjemput kucing anda.
                        jika anda memilih antar sendiri anda bisa mengantar kucing anda ke omo pets & grooming</p>
                </li>
                <li>
                    <p>Mohon Menunggu antrian yang ada untuk layanan tersebut</p>
                </li>
            </ol>

        </div>
    </div>
@endsection

@section('js')
@endsection
