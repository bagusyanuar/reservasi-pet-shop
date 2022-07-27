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
Route::match(['post', 'get'],'/', [\App\Http\Controllers\AuthController::class, 'login_member']);
//Route::match(['post', 'get'], '/login-member', [\App\Http\Controllers\AuthController::class, 'login_member']);
//Route::match(['post', 'get'], '/register', [\App\Http\Controllers\AuthController::class, 'register']);
//Route::match(['post', 'get'], '/login-admin', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);


Route::get('/product/{id}/detail', [\App\Http\Controllers\Member\HomepageController::class, 'product_page']);
Route::get('/product/data', [\App\Http\Controllers\Member\ProductController::class, 'get_product_by_name']);


Route::group(['prefix' => 'admin'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\AdminController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\AdminController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\AdminController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
});

Route::group(['prefix' => 'member'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\MemberController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\MemberController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\MemberController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\MemberController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\MemberController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\MemberController::class, 'destroy']);
});

Route::group(['prefix' => 'category'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\CategoryController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\CategoryController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'product'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\BarangController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\BarangController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\BarangController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\BarangController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\BarangController::class, 'destroy']);
});

Route::group(['prefix' => 'kota'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KotaController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\KotaController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\KotaController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\KotaController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\KotaController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\KotaController::class, 'destroy']);
});

Route::group(['prefix' => 'ongkir'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\OngkirController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\OngkirController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\OngkirController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\OngkirController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\OngkirController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\OngkirController::class, 'destroy']);
});


Route::group(['prefix' => 'pesanan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PaymentController::class, 'index']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PaymentController::class, 'detail']);
});

Route::group(['prefix' => 'pesanan-proses'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PesananController::class, 'index']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PesananController::class, 'detail']);
});

Route::group(['prefix' => 'pesanan-selesai-menunggu'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PesananController::class, 'ambil']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PesananController::class, 'detail_ambil']);
});

Route::group(['prefix' => 'pesanan-selesai'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PesananController::class, 'selesai']);
    Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Admin\PesananController::class, 'detail_selesai']);
});

Route::group(['prefix' => 'laporan-pembayaran'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pembayaran']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pembayaran_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pembayaran_cetak']);
});

Route::group(['prefix' => 'laporan-pesanan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pesanan']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pesanan_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_pesanan_cetak']);
});

Route::group(['prefix' => 'laporan-stock'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_stock']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_stock_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_stock_cetak']);
});

Route::group(['prefix' => 'beranda'],  function (){
    Route::get('/', [\App\Http\Controllers\Member\HomepageController::class, 'index']);

    Route::get('/category/{id}', [\App\Http\Controllers\Member\HomepageController::class, 'category_page']);
    Route::get('/category/{id}/data', [\App\Http\Controllers\Member\HomepageController::class, 'get_product_by_name_and_category']);
    Route::get('/tentang', [\App\Http\Controllers\Member\HomepageController::class, 'about']);
    Route::get('/hubungi', [\App\Http\Controllers\Member\HomepageController::class, 'contact']);
    Route::group(['prefix' => 'product'], function (){
        Route::get('/data', [\App\Http\Controllers\Member\ProductController::class, 'get_product_by_name']);
        Route::get('/{id}/detail', [\App\Http\Controllers\Member\ProductController::class, 'detail']);
    });

    Route::group(['prefix' => 'cart'], function (){
        Route::get('/', [\App\Http\Controllers\Member\KeranjangController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Member\KeranjangController::class, 'add_to_cart']);
        Route::post('/destroy', [\App\Http\Controllers\Member\KeranjangController::class, 'delete_cart']);
        Route::get('/count', [\App\Http\Controllers\Member\KeranjangController::class, 'count_cart']);
        Route::post('/checkout', [\App\Http\Controllers\Member\KeranjangController::class, 'checkout']);
        Route::get('/{id}/detail', [\App\Http\Controllers\Member\ProductController::class, 'detail']);
    });

    Route::group(['prefix' => 'transaksi'], function (){
        Route::get('/', [\App\Http\Controllers\Member\TransaksiController::class, 'index']);
        Route::get('/{id}/detail', [\App\Http\Controllers\Member\TransaksiController::class, 'detail']);
    });

    Route::group(['prefix' => 'pembayaran'], function (){
        Route::get('/{id}/detail', [\App\Http\Controllers\Member\PembayaranController::class, 'detail']);
        Route::post('/{id}/create', [\App\Http\Controllers\Member\PembayaranController::class, 'create']);
        Route::get('/{id}/cetak', [\App\Http\Controllers\Member\PembayaranController::class, 'cetak']);
    });
});

