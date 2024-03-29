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

Route::get('login', 'AuthController@index')->name('admin.login');
Route::get('logout', 'AuthController@logout')->name('admin.logout');
Route::post('login', 'AuthController@login')->name('admin.post-login');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'DashboardController@index')->name('admin.index');
});

// Kelas
Route::match(['get', 'post'], 'level/datatable', 'Level\LevelController@dataTable');
Route::match(['get', 'post'], 'level/select2', 'Level\LevelController@select2');
Route::apiResource('level', 'Level\LevelController', [
    'parameters' => [
        'level' => 'level'
    ]
]);

// Rombel
Route::match(['get', 'post'], 'rombel/datatable', 'Rombel\RombelController@dataTable');
Route::match(['get', 'post'], 'rombel/select2', 'Rombel\RombelController@select2');
Route::apiResource('rombel', 'Rombel\RombelController');

// Siswa
Route::match(['get', 'post'], 'siswa/datatable', 'Siswa\SiswaController@dataTable');
Route::apiResource('siswa', 'Siswa\SiswaController');
Route::match(['get', 'post'], 'school/select2', 'Siswa\SiswaController@select2sekolah');
Route::get('siswa-import', 'Siswa\SiswaController@import')->name('siswa.import');
Route::post('import-document', 'Siswa\SiswaController@importDocument')->name('import.document.siswa');


// Mapel
Route::match(['get', 'post'], 'mapel/datatable', 'Mapel\MapelController@dataTable');
Route::match(['get', 'post'], 'mapel/select2', 'Mapel\MapelController@select2');
Route::apiResource('mapel', 'Mapel\MapelController');


// Paket Soal
Route::match(['get', 'post'], 'paket-soal/datatable', 'PaketSoal\PaketSoalController@dataTable');
Route::get('/paket-soal/soal/datatable/{id}', 'PaketSoal\PaketSoalController@soalDataTable')->name('paket.soal.datatable');
Route::match(['get', 'post'], 'paket-soal/select2', 'PaketSoal\PaketSoalController@select2');
Route::apiResource('paket-soal', 'PaketSoal\PaketSoalController');
Route::get('paket/{id}/detail', 'PaketSoal\PaketSoalController@detail')->name('paket.detail');
Route::get('paket-import', 'PaketSoal\PaketSoalController@import')->name('paket.import');
Route::post('import-document-paket', 'PaketSoal\PaketSoalController@importDocument')->name('import.document.paket');
Route::post('paket-soal-update', 'PaketSoal\PaketSoalController@updatePaketSoal')->name('paket.soal.update');


// Soal
Route::match(['get', 'post'], 'soal/datatable', 'Soal\SoalController@dataTable');
Route::get('soal-import/{paketId?}', 'Soal\SoalController@import')->name('soal.import');
Route::post('import', 'Soal\SoalController@importDocument')->name('import.document');


// Route::match(['get', 'post'], 'soal/select2', 'Mapel\MapelController@select2');
Route::resource('soal', 'Soal\SoalController');

// Ujian
Route::match(['get', 'post'], 'ujian/datatable', 'Ujian\UjianController@dataTable');
Route::resource('ujian', 'Ujian\UjianController');

// Riwayat Ujian
Route::get('riwayat-ujian/', 'Ujian\RiwayatUjianController@index')->name('ujian.riwayat');
Route::get('riwayat-ujian/datatable', 'Ujian\RiwayatUjianController@dataTable')->name('ujian.riwayat.data');
Route::get('riwayat-ujian/hasil', 'Ujian\RiwayatUjianController@hasilUjian')->name('ujian.riwayat.hasilUjian');
Route::get('riwayat-ujian/{ujian}', 'Ujian\RiwayatUjianController@show')->name('ujian.riwayat.show');

// Pengaturan
Route::get('pengaturan', 'Pengaturan\PengaturanController@index')->name('pengaturan.index');
Route::post('pengaturan', 'Pengaturan\PengaturanController@update')->name('pengaturan.update');
Route::post('pengaturan/slug', 'Pengaturan\PengaturanController@updateSlug')->name('pengaturan.update-slug');
