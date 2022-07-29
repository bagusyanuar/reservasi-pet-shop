<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [\App\Http\Controllers\Member\HomepageController::class, 'index']);
Route::match(['post', 'get'], '/login-member', [\App\Http\Controllers\AuthController::class, 'login_member']);
Route::match(['post', 'get'], '/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::match(['post', 'get'], '/login-admin', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/product/{id}/detail', [\App\Http\Controllers\Member\HomepageController::class, 'product_page']);
Route::get('/product/data', [\App\Http\Controllers\Member\ProductController::class, 'get_product_by_name']);
Route::get('/product/slot', [\App\Http\Controllers\Admin\SlotController::class, 'getSlot']);
Route::get('/product/slot/{type}', [\App\Http\Controllers\Admin\SlotController::class, 'getUsedSlot']);
Route::get('/tentang', [\App\Http\Controllers\Member\HomepageController::class, 'about']);
Route::get('/cara-pemesanan', [\App\Http\Controllers\Member\HomepageController::class, 'pemesanan']);


Route::group(['prefix' => 'reservasi'], function () {
    Route::get('/', [\App\Http\Controllers\Member\ReservasiController::class, 'index']);
    Route::get('/{id}/detail', [\App\Http\Controllers\Member\ReservasiController::class, 'detail']);
    Route::post('/checkout', [\App\Http\Controllers\Member\ReservasiController::class, 'reservasi']);
});

Route::group(['prefix' => 'kucing-ku'], function () {
    Route::get('/', [\App\Http\Controllers\Member\KucingController::class, 'index']);
    Route::get('/tambah', [\App\Http\Controllers\Member\KucingController::class, 'add_page']);
    Route::post('/create', [\App\Http\Controllers\Member\KucingController::class, 'create']);
    Route::get('/edit/{id}', [\App\Http\Controllers\Member\KucingController::class, 'edit_page']);
    Route::post('/patch', [\App\Http\Controllers\Member\KucingController::class, 'patch']);
    Route::post('/delete', [\App\Http\Controllers\Member\KucingController::class, 'destroy']);
});

Route::match(['get', 'post'], '/profil', [\App\Http\Controllers\Member\ProfilController::class, 'index']);


Route::group(['prefix' => 'pembayaran'], function () {
    Route::get('/{id}/detail', [\App\Http\Controllers\Member\PembayaranController::class, 'detail']);
    Route::post('/{id}/create', [\App\Http\Controllers\Member\PembayaranController::class, 'create']);
    Route::get('/{id}/cetak', [\App\Http\Controllers\Member\PembayaranController::class, 'cetak']);
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get('/tambah', [\App\Http\Controllers\Admin\AdminController::class, 'add_page']);
    Route::post('/create', [\App\Http\Controllers\Admin\AdminController::class, 'create']);
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'edit_page']);
    Route::post('/patch', [\App\Http\Controllers\Admin\AdminController::class, 'patch']);
    Route::post('/delete', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
});

Route::group(['prefix' => 'member'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\MemberController::class, 'index']);
    Route::get('/tambah', [\App\Http\Controllers\Admin\MemberController::class, 'add_page']);
    Route::post('/create', [\App\Http\Controllers\Admin\MemberController::class, 'create']);
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\MemberController::class, 'edit_page']);
    Route::post('/patch', [\App\Http\Controllers\Admin\MemberController::class, 'patch']);
    Route::post('/delete', [\App\Http\Controllers\Admin\MemberController::class, 'destroy']);
});

Route::group(['prefix' => 'layanan'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\LayananController::class, 'index']);
    Route::get('/tambah', [\App\Http\Controllers\Admin\LayananController::class, 'add_page']);
    Route::post('/create', [\App\Http\Controllers\Admin\LayananController::class, 'create']);
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\LayananController::class, 'edit_page']);
    Route::post('/patch', [\App\Http\Controllers\Admin\LayananController::class, 'patch']);
    Route::post('/delete', [\App\Http\Controllers\Admin\LayananController::class, 'destroy']);
});

Route::group(['prefix' => 'data-paket'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\PaketController::class, 'index']);
    Route::get('/tambah', [\App\Http\Controllers\Admin\PaketController::class, 'add_page']);
    Route::post('/create', [\App\Http\Controllers\Admin\PaketController::class, 'create']);
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\PaketController::class, 'edit_page']);
    Route::post('/patch', [\App\Http\Controllers\Admin\PaketController::class, 'patch']);
    Route::post('/delete', [\App\Http\Controllers\Admin\PaketController::class, 'destroy']);
});

Route::group(['prefix' => 'wilayah'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\KotaController::class, 'index']);
    Route::get('/tambah', [\App\Http\Controllers\Admin\KotaController::class, 'add_page']);
    Route::post('/create', [\App\Http\Controllers\Admin\KotaController::class, 'create']);
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\KotaController::class, 'edit_page']);
    Route::post('/patch', [\App\Http\Controllers\Admin\KotaController::class, 'patch']);
    Route::post('/delete', [\App\Http\Controllers\Admin\KotaController::class, 'destroy']);
});

Route::group(['prefix' => 'kucing'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\KucingController::class, 'index']);
    Route::get('/tambah', [\App\Http\Controllers\Admin\KucingController::class, 'add_page']);
    Route::post('/create', [\App\Http\Controllers\Admin\KucingController::class, 'create']);
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\KucingController::class, 'edit_page']);
    Route::post('/patch', [\App\Http\Controllers\Admin\KucingController::class, 'patch']);
    Route::post('/delete', [\App\Http\Controllers\Admin\KucingController::class, 'destroy']);
});

Route::group(['prefix' => 'reservasi-baru'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\ReservasiController::class, 'index']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\ReservasiController::class, 'detail']);
});

Route::group(['prefix' => 'reservasi-waiting-list'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\ReservasiController::class, 'waiting_list']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\ReservasiController::class, 'detail_waiting_list']);
});

Route::group(['prefix' => 'reservasi-ongoing'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\ReservasiController::class, 'ongoing']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\ReservasiController::class, 'detail_ongoing']);
    Route::post('/kegiatan', [\App\Http\Controllers\Admin\ReservasiController::class, 'kegiatan_ongoing']);
    Route::post('/kegiatan/delete', [\App\Http\Controllers\Admin\ReservasiController::class, 'delete_kegiatan_ongoing']);
});

Route::group(['prefix' => 'reservasi-selesai'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\ReservasiController::class, 'selesai']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\ReservasiController::class, 'detail_selesai']);
    Route::get('/{id}/cetak', [\App\Http\Controllers\Admin\ReservasiController::class, 'cetak_detail_selesai']);
});

//Route::group(['prefix' => 'pesanan'], function () {
//    Route::get('/', [\App\Http\Controllers\Admin\PaymentController::class, 'index']);
//    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PaymentController::class, 'detail']);
//});
//
//Route::group(['prefix' => 'pesanan-proses'], function () {
//    Route::get('/', [\App\Http\Controllers\Admin\PesananController::class, 'index']);
//    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PesananController::class, 'detail']);
//});
//
//Route::group(['prefix' => 'pesanan-selesai-menunggu'], function () {
//    Route::get('/', [\App\Http\Controllers\Admin\PesananController::class, 'ambil']);
//    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PesananController::class, 'detail_ambil']);
//});
//
//Route::group(['prefix' => 'pesanan-selesai'], function () {
//    Route::get('/', [\App\Http\Controllers\Admin\PesananController::class, 'selesai']);
//    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PesananController::class, 'detail_selesai']);
//});

Route::group(['prefix' => 'laporan-pembayaran'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pembayaran']);
    Route::get('/data', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pembayaran_data']);
    Route::get('/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pembayaran_cetak']);
});

Route::group(['prefix' => 'laporan-reservasi'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_reservasi']);
    Route::get('/data', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_reservasi_data']);
    Route::get('/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_reservasi_cetak']);
});

//Route::group(['prefix' => 'laporan-pesanan'], function () {
//    Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pesanan']);
//    Route::get('/data', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pesanan_data']);
//    Route::get('/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pesanan_cetak']);
//});
//
//Route::group(['prefix' => 'laporan-stock'], function () {
//    Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_stock']);
//    Route::get('/data', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_stock_data']);
//    Route::get('/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_stock_cetak']);
//});

Route::group(['prefix' => 'beranda'], function () {
    Route::get('/', [\App\Http\Controllers\Member\HomepageController::class, 'index']);

    Route::get('/category/{id}', [\App\Http\Controllers\Member\HomepageController::class, 'category_page']);
    Route::get('/category/{id}/data', [\App\Http\Controllers\Member\HomepageController::class, 'get_product_by_name_and_category']);

    Route::get('/hubungi', [\App\Http\Controllers\Member\HomepageController::class, 'contact']);
    Route::group(['prefix' => 'product'], function () {
        Route::get('/data', [\App\Http\Controllers\Member\ProductController::class, 'get_product_by_name']);
        Route::get('/{id}/detail', [\App\Http\Controllers\Member\ProductController::class, 'detail']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [\App\Http\Controllers\Member\KeranjangController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Member\KeranjangController::class, 'add_to_cart']);
        Route::post('/destroy', [\App\Http\Controllers\Member\KeranjangController::class, 'delete_cart']);
        Route::get('/count', [\App\Http\Controllers\Member\KeranjangController::class, 'count_cart']);
        Route::post('/checkout', [\App\Http\Controllers\Member\KeranjangController::class, 'checkout']);
        Route::get('/{id}/detail', [\App\Http\Controllers\Member\ProductController::class, 'detail']);
    });

    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', [\App\Http\Controllers\Member\TransaksiController::class, 'index']);
        Route::get('/{id}/detail', [\App\Http\Controllers\Member\TransaksiController::class, 'detail']);
    });


});

