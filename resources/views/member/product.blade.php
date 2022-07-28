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
        <div class="w-100 row product-detail" style="min-height: 350px;">
            <div class="col-lg-4 col-md-4">
                <h5 class="card-title mb-2 card-text-title font-weight-bold"
                    style="color: #535961; font-size: 18px">{{$data->nama}}</h5>
                @if($data->tipe == 'grooming')
                    <p style="color: #535961; font-size: 14px">{{ $data->deskripsi }}</p>
                    <div class="card" style="border-color: #29538d">
                        <div class="card-header" style="background-color: #29538d ">
                            <p class="font-weight-bold mb-0" style="color: whitesmoke; font-size: 18px">Layanan
                                Grooming</p>
                        </div>
                        <div class="card-body">
                            @foreach($data->layanan as $v)
                                <div style="color: #535961; font-size: 16px">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold">{{ $v->nama }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($data->tipe == 'penitipan')

                    <div class="card" style="border-color: #29538d">
                        <div class="card-header" style="background-color: #29538d ">
                            <p class="font-weight-bold mb-0" style="color: whitesmoke; font-size: 18px">Detail
                                Penitipan</p>
                        </div>
                        <div class="card-body">
                            <p style="color: #535961; font-size: 14px">{{ $data->deskripsi }}</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-8 col-md-8">
                <div style="border: solid 1px #29538d; border-radius: 5px; padding: 10px;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <p class="font-weight-bold mb-1 main-text-color">Data Reservasi</p>
                            @auth()
                                <div class="form-group w-100 mb-1">
                                    <label for="kucing">Kucing</label>
                                    <select class="form-control" id="kucing" name="kucing">
                                        @foreach(auth()->user()->kucing as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endauth
                            @if($data->tipe == 'grooming')
                                <div class="w-100 mb-1">
                                    <label for="tanggal" class="form-label">Tanggal Reservasi</label>
                                    <input type="date" class="form-control" id="tanggal"
                                           name="tanggal" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="jam" class="form-label">Jam Reservasi</label>
                                    <input type="time" class="form-control" id="jam"
                                           name="jam" value="{{ date('H:i:s') }}">
                                </div>
                            @endif
                            @if($data->tipe == 'penitipan')
                                <div class="w-100 mb-1">
                                    <label for="check_in" class="form-label">Check in</label>
                                    <input type="date" class="form-control" id="check_in"
                                           name="check_in" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="check_out" class="form-label">Check Out</label>
                                    <input type="date" class="form-control" id="check_out"
                                           name="check_out" value="{{ date('Y-m-d') }}">
                                </div>
                            @endif
                            <div class="form-group w-100 mb-1">
                                <label for="transport">Antar Jemput</label>
                                <select class="form-control" id="transport" name="transport">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                            <div class="d-none" id="panel-transport">
                                <div class="form-group w-100 mb-1">
                                    <label for="wilayah">Wilayah</label>
                                    <select class="form-control" id="wilayah" name="wilayah">
                                        <option value="0">--pilih wilayah--</option>
                                        @foreach($wilayah as $w)
                                            <option value="{{ $w->harga }}">{{ $w->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea rows="3" class="form-control" id="alamat"
                                              name="alamat"></textarea>
                                </div>
                            </div>
                            <div class="w-100 mb-1">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea rows="3" class="form-control" id="catatan"
                                          name="catatan"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card" style="border-color: #29538d">
                                <div class="card-header" style="background-color: #29538d ">
                                    <p class="font-weight-bold mb-0 text-center"
                                       style="color: whitesmoke; font-size: 18px">Slot Reservasi</p>
                                </div>
                                <div class="card-body">
                                    <p class="font-weight-bold text-center" style="font-size: 36px" id="lbl-slot">0</p>
                                </div>
                            </div>
                            <hr>
                            <p class="font-weight-bold mb-0 main-text-color">Rincian Biaya</p>
                            <div class="d-flex align-items-center">
                                <div class="mr-1 main-text-color" style="color: #777777">Subtotal
                                    @if($data->tipe === 'penitipan')
                                        <span id="lbl-lama" class="ml-2"
                                              style="font-size: 10px; font-weight: bold">
                                                (1 Hari)
                                            </span>
                                    @endif
                                </div>
                                <div id="lbl-sub-total" class="flex-grow-1 text-right main-text-color"
                                     style="font-size: 20px; font-weight: bold" data-harga="{{$data->harga}}">
                                    Rp. {{ number_format($data->harga, 0, ',', '.') }}</div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="mr-1 main-text-color" style="color: #777777">Transport</div>
                                <div id="lbl-transport" class="flex-grow-1 text-right main-text-color"
                                     style="font-size: 20px; font-weight: bold">
                                    Rp. 0
                                </div>
                            </div>

                            <hr>
                            <div class="d-flex align-items-center">
                                <div class="mr-1 main-text-color" style="color: #777777">Total</div>
                                <div id="lbl-total" class="flex-grow-1 text-right main-text-color"
                                     style="font-size: 20px; font-weight: bold">
                                    Rp. {{ number_format($data->harga, 0, ',', '.') }}</div>
                            </div>
                            <div class="w-100 mt-2 mb-1">
                                <a href="#" class="btn btn-order w-100" id="btn-reservasi">Reservasi</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var paket_id = '{{$data->id}}';
        var tipe = '{{ $data->tipe }}';

        async function getSlot() {
            try {
                let response = await $.get('/product/slot');
                let payload = response['payload'];
                let tanggal = $('#tanggal').val();
                if (tipe === 'penitipan') {
                    tanggal = $('#check_in').val();
                }
                let responseUsed = await $.get('/product/slot/' + tipe + '?tanggal=' + tanggal);
                let payloadUsed = responseUsed['payload'];
                let rest = payload[tipe] - payloadUsed;
                console.log(responseUsed);
                $('#lbl-slot').html(rest);
            } catch (e) {
                alert('gagal load slot');
            }
        }

        function getTransport(status, qty = 1) {
            if (status === '1') {
                let transport = $('#wilayah').val();
                $('#lbl-transport').html('Rp. ' + formatUang(transport.toString()));
                if (tipe === 'grooming') {
                    setTotal(parseInt(transport));
                }

                if (tipe === 'penitipan') {
                    setTotalPenitipan(parseInt(transport), qty);
                }
            } else {
                $('#lbl-transport').html('Rp. 0');
                if (tipe === 'grooming') {
                    setTotal(0);
                }

                if (tipe === 'penitipan') {
                    setTotalPenitipan(0, qty);
                }
            }
        }

        function setTotal(transport = 0) {
            let sub_total = parseInt($('#lbl-sub-total').attr('data-harga'));
            let total = sub_total + transport;
            $('#lbl-total').html('Rp. ' + formatUang(total.toString()))
        }

        function setTotalPenitipan(transport = 0, qty = 1) {
            let sub_total = parseInt($('#lbl-sub-total').attr('data-harga'));
            let total = (sub_total * qty) + transport;
            $('#lbl-lama').html(qty + ' hari');
            $('#lbl-sub-total').html('Rp. ' + formatUang((sub_total * qty).toString()))
            $('#lbl-total').html('Rp. ' + formatUang(total.toString()))
        }

        async function checkout() {
            try {
                blockLoading(true);
                let data = {};
                if (tipe === 'grooming') {
                    data = {
                        type: 'grooming',
                        tanggal_reservasi: $('#tanggal').val(),
                        jam: $('#jam').val(),
                        kucing: $('#kucing').val(),
                        transport: $('#wilayah').val(),
                        alamat: '(' + $("#wilayah option:selected").text() + ') ' + $('#alamat').val(),
                        catatan: $('#catatan').val(),
                        paket: paket_id
                    }
                }

                if (tipe === 'penitipan') {
                    data = {
                        type: 'penitipan',
                        check_in: $('#check_in').val(),
                        check_out: $('#check_out').val(),
                        kucing: $('#kucing').val(),
                        transport: $('#wilayah').val(),
                        alamat: '(' + $("#wilayah option:selected").text() + ') ' + $('#alamat').val(),
                        catatan: $('#catatan').val(),
                        paket: paket_id
                    };
                }
                let response = await $.post('/reservasi/checkout', data);
                let payload = response['payload'];
                console.log(response);
                blockLoading(false);
                window.location.href = '/pembayaran/' + payload + '/detail';
            } catch (e) {
                blockLoading(false);
                console.log(e);
                alert('Terjadi Kesalahan');
            }
        }

        $(document).ready(function () {
            getSlot();
            $('#tanggal').on('change', function (e) {
                getSlot();
            });

            $('#check_in').on('change', function (e) {
                getSlot();
            });

            $('#transport').on('change', function () {
                let val = this.value;
                console.log(val);
                if (val === '1') {
                    $('#panel-transport').removeClass('d-none')
                    $('#panel-transport').addClass('d-block')
                } else {
                    $('#panel-transport').removeClass('d-block')
                    $('#panel-transport').addClass('d-none')
                    $('#wilayah').val('0');
                    $('#alamat').val('');
                    getTransport('0')
                }
            });

            $('#wilayah').on('change', function () {
                let tgl1 = $('#check_in').val();
                let tgl2 = $('#check_out').val();
                let qty = calculate_days(tgl1, tgl2) + 1;
                if (tipe === 'grooming') {
                    getTransport('1');
                }

                if (tipe === 'penitipan') {
                    getTransport('1', qty);
                }

            });
            $('#btn-reservasi').on('click', function (e) {
                e.preventDefault();
                checkout()
            });

            if (tipe === 'penitipan') {
                let tgl1 = $('#check_in').val();
                let tgl2 = $('#check_out').val();
                let qty = calculate_days(tgl1, tgl2) + 1;
                if (tipe === 'grooming') {
                    getTransport('1');
                }

                if (tipe === 'penitipan') {
                    getTransport('1', qty);
                }
                $('#check_out').on('change', function (e) {
                    let tgl1 = $('#check_in').val();
                    let tgl2 = this.value;
                    let qty = calculate_days(tgl1, tgl2) + 1;
                    let transport = $('#transport').val();
                    getTransport(transport, qty);
                });
            }
        });
    </script>
@endsection
