<?php

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
Route::get('/', 'MemberController@lihatHalamanBeranda')->name('index');
Route::get('lihat-semua-acara','MemberController@lihatSemuaAcara')->name('lihat-semua-acara');
Route::get('lihat-acara-kategori','MemberController@cariAcaraKategori')->name('lihat-acara-kategori');
Route::get('lihat-acara-cari','MemberController@cariAcara')->name('lihat-acara-cari');
Route::group(['prefix' => 'tamu', 'as' => 'tamu.'], function () {
    Route::group(['middleware' => ['user.toLogin']], function () {
        Route::get('login', 'TamuController@lihatHalamanLogin')->name('lihat-login');
        Route::post('login', 'TamuController@login')->name('login');
        Route::get('register', 'TamuController@lihatHalamanRegistrasi')->name('lihat-registrasi');
        Route::post('registrasi', 'TamuController@registrasi')->name('register');
    });
    Route::get('logout', 'MemberController@logout')->name('logout');

    Route::group(['middleware' => ['user.loggedin'], 'as' => 'user.'], function () {
        Route::get('lihat-akun', 'MemberController@lihatAkun')->name('lihat-akun');
        Route::get('lihat-detail-acara/{id_acara}', 'MemberController@lihatDetailAcara')->name('lihat-detail-acara');
        Route::get('cari-acara', 'MemberController@cariAcara')->name('cari-acara');
        Route::post('daftar-panitia', 'MemberController@daftarPanitia')->name('daftar-panitia');
        Route::get('lihat-semua-acara', 'MemberController@lihatSemuaAcara')->name('lihat-semua-acara');
        Route::get('lihat-halaman-daftar-panitia', 'MemberController@lihatHalamanDaftarPanitia')->name('lihat-halaman-daftar-panitia');
        Route::post('upload-foto', 'UploadController@Upload')->name('upload-foto');
        Route::get('lihat-halaman-pesan-tiket/{id_acara}','PesananController@lihatHalamanPesanTiket')->name('lihat-halaman-pesan-tiket');
        Route::post('pesan-tiket', 'PesananController@pesanTiket')->name('pesan-tiket');
        Route::get('lihat-halaman-konfirmasi-transfer/{id_pesan}','PesananController@lihatHalamanKonfirmasiTransfer')->name('lihat-halaman-konfirmasi-transfer');
        Route::get('lihat-halaman-upload-bukti-konfirmasi/{id_pesan}','PesananController@halamanUploadBuktiKonfirmasi')->name('lihat-halaman-upload-bukti-konfirmasi');
        Route::post('update-konfirmasi-transfer','PesananController@updateKonfirmasiTransfer')->name('update-konfirmasi-transfer');
        Route::post('upload-bukti-transfer/{id_pesan}','PesananController@uploadBuktiKonfirmasiTransfer')->name('upload-bukti-transfer');
        Route::get('lihat-halaman-pesanan','MemberController@lihatHalamanPesanan')->name('lihat-halaman-pesanan');

        Route::group(['prefix' => 'panitia', 'as' => 'panitia.', 'middleware' => ['panitia']], function () {
            Route::get('lihat-profil-panitia', 'PanitiaController@lihatProfilePanitia')->name('lihat-halaman-profile-panitia');
            Route::get('lihat-kumpulan-acara', 'PanitiaController@lihatKumpulanAcara')->name('lihat-halaman-kumpulan-acara');


            Route::group(['prefix' => 'panitia-verif', 'as' => 'verif.', 'middleware' => ['panitia.verif']], function () {
                Route::get('lihat-halaman-tambah-acara', 'PanitiaController@lihatHalamanTambahAcara')->name('lihat-halaman-tambah-acara');
                Route::post('buat-acara', 'PanitiaController@buatAcara')->name('buat-acara');
                Route::post('hapus-acara/{id_acara}', 'PanitiaController@hapusAcara')->name('hapus-acara');
                Route::get('lihat-halaman-ubah-acara/{id_acara}', 'PanitiaController@lihatHalamanEditAcara')->name('lihat-halaman-ubah-acara');
                Route::post('ubah-acara/{id_acara}', 'PanitiaController@editAcara')->name('ubah-acara');
                Route::get('lihat-halaman-input-kode-acara', 'PanitiaController@lihatHalamanDeteksiKode')->name('lihat-halaman-scan-barcode');
                Route::get('deteksi-kode-acara','PanitiaController@deteksiKodeAcara')->name('deteksi-barcode-acara');
                Route::get('lihat-halaman-pembeli/{id_acara}', 'PanitiaController@lihatDataPembeli')->name('lihat-halaman-pembeli');

            });
        });

        Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
            Route::get('lihat-konfirmasi-pendaftaran', 'AdminController@lihatHalamanKonfirmasiPendaftaran')->name('lihat-halaman-konfirmasi-pendaftaran');
            Route::post('kelola-panitia', 'AdminController@kelolaPanitia')->name('kelola-panitia');
            Route::get('lihat-konfirmasi-pembayaran', 'AdminController@lihatHalamanKonfirmasiPembayaran')->name('lihat-halaman-konfirmasi-pembayaran');
            Route::post('kelola-pembayaran', 'AdminController@kelolaPembayaran')->name('kelola-pembayaran');
        });

    });
});


Route::get('{name}', function ($name) {
    if (file_exists(public_path($name))) {
        return redirect(url('public/' . $name));
    } else {
        abort(404);
    }
})->where('name', '(.*)');
