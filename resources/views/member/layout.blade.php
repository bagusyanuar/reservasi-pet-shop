<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/slick/slick-theme.css') }}"/>
    <title>Document</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        #dropdown-logout:hover {
            color: whitesmoke;
            text-decoration: none;
        }
    </style>
    @yield('css')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark"
     style="height: 75px; background-color: #29538d; box-shadow: none !important;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('/assets/icon/small-logo.png') }}" width="30" height="30" alt="">
            <span class="ml-2">OMO Cats</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item mr-1">
                    <a class="nav-link f-bold color-semi-white" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item mr-1">
                    <a class="nav-link f-bold color-semi-white" aria-current="page" href="/tentang">Tentang Kami</a>
                </li>
                <li class="nav-item mr-1">
                    <a class="nav-link f-bold color-semi-white" aria-current="page" href="/cara-pemesanan">Cara
                        Pemesanan</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                @guest()
                    <a href="/login-member" class="navbar-item f-12">
                        <i class="fa fa-user-o mr-2"></i>
                        <span>Masuk / Daftar</span>
                    </a>
                @endguest
                @auth()
                    <div class="dropdown ml-3">
                        <a class="nav-link dropdown-toggle color-white" href="#" id="dropdown-logout" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->username }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-logout">
                            <a href="/reservasi" class="navbar-item f-12 ml-3 d-block" style="color: black">
                                <span class="main-text-color">
                                    <i class="fa fa-briefcase mr-1"></i>
                                    Reservasi
                                </span>
                            </a>
                            <a href="/profil" class="navbar-item f-12 ml-3 d-block" style="color: black">
                                <span class="main-text-color">
                                    <i class="fa fa-user mr-2"></i>
                                    Profil
                                </span>
                            </a>
                            <a href="/kucing-ku" class="navbar-item f-12 ml-3 d-block" style="color: black">
                                <span class="main-text-color">
                                    <i class="fa fa-bookmark mr-2"></i>
                                    Kucing
                                </span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="navbar-item f-12 ml-3" style="color: black">
                                <span class="main-text-color">
                                    <i class="fa fa-power-off mr-1"></i>
                                <span>Keluar</span>
                                </span>
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>


<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 0;">
    <div class="toast d-none" style="position: fixed; top: 0; right: 0; z-index: 99999" data-autohide="true"
         data-delay="8000">
        <div class="toast-header">
            <img src="" class="rounded mr-2" alt="">
            <strong class="mr-auto" id="toast-title"></strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-message">
        </div>
    </div>
</div>
@yield('content')
<div class="footer">
    <div class="d-flex align-items-center w-100 justify-content-center" style="height: 200px">
        <img src="{{ asset('/assets/icon/logo-pet-shop.jpg') }}" height="180" class="mr-3"/>
        <div>
            <p class="font-weight-bold mb-0" style="font-size: 24px; color: white">OMO CATS & GROOMING</p>
            <div class="d-flex align-items-center">
                <div style="color: white" class="mr-2">
                    <i class="fa fa-instagram"></i>
                    <span>@omocatspets</span>
                </div>
                <div style="color: white">
                    <i class="fa fa-phone-square"></i>
                    <span>08956087654324</span>
                </div>
            </div>
            <p class="font-weight-bold mb-0" style="font-size: 16px; color: white">Melayani antar jemput sekitar solo raya</p>
        </div>

    </div>


</div>
<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/slick/slick.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.your-class').slick({
            dots: false,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            autoplay: true,
            arrows: false,
            adaptiveHeight: true
        });
    });
</script>
<script src="{{ asset('/js/helper.js') }}"></script>
@yield('js')
</body>
</html>
