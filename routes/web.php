<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layanan/cuti', App\Livewire\Public\CutiForm::class)->name('layanan.cuti');

Route::get('/layanan/kepegawaian', function () {
    return view('public.category-kepegawaian');
})->name('layanan.kepegawaian');

Route::get('/layanan/kub', function () {
    return view('public.category-kub');
})->name('layanan.kub');

Route::get('/layanan/satya-lencana', App\Livewire\Public\SatyaLencanaForm::class)->name('layanan.satya-lencana');
Route::get('/layanan/tugas-belajar', App\Livewire\Public\TugasBelajarForm::class)->name('layanan.tugas-belajar');
Route::get('/layanan/kenaikan-pangkat', App\Livewire\Public\KenaikanPangkatForm::class)->name('layanan.kenaikan-pangkat');
Route::get('/layanan/pensiun', App\Livewire\Public\PensiunForm::class)->name('layanan.pensiun');
Route::get('/layanan/jenjang-jf', App\Livewire\Public\JenjangJfForm::class)->name('layanan.jenjang-jf');
Route::get('/layanan/skpp-skmi', App\Livewire\Public\SkppSkmiForm::class)->name('layanan.skpp-skmi');
Route::get('/layanan/pencantuman-gelar', App\Livewire\Public\PencantumanGelarForm::class)->name('layanan.pencantuman-gelar');
Route::get('/layanan/karis-karsu', App\Livewire\Public\KarisKarsuForm::class)->name('layanan.karis-karsu');
Route::get('/layanan/usul-ralat-data-siasn', App\Livewire\Public\UsulDataSiasnForm::class)->name('layanan.usul-ralat-data-siasn');

// KUB
Route::get('/layanan/kub/pendirian', App\Livewire\Public\KubPendirianForm::class)->name('layanan.kub-pendirian');
Route::get('/layanan/kub/rohaniawan', App\Livewire\Public\KubRohaniawanForm::class)->name('layanan.kub-rohaniawan');
Route::get('/layanan/kub/tanah', App\Livewire\Public\KubTanahForm::class)->name('layanan.kub-tanah');

// Bimas Islam
Route::get('/layanan/bimas-islam', function () {
    return view('public.category-bimas-islam');
})->name('layanan.bimas-islam');

Route::get('/layanan/bimas-masjid', App\Livewire\Public\BimasIslamMasjidForm::class)->name('layanan.bimas-masjid');
Route::get('/layanan/bimas-musholla', App\Livewire\Public\BimasIslamMushollaForm::class)->name('layanan.bimas-musholla');
Route::get('/layanan/bimas-majelis-taklim', App\Livewire\Public\BimasIslamMajelisTaklimForm::class)->name('layanan.bimas-majelis-taklim');

// Zakat & Wakaf
Route::get('/layanan/zawa', function () {
    return view('public.category-zawa');
})->name('layanan.zawa');

Route::get('/layanan/zawa/konsultasi', App\Livewire\Public\ZawaKonsultasiForm::class)->name('layanan.zawa-konsultasi');
Route::get('/layanan/zawa/tanah', App\Livewire\Public\ZawaTanahForm::class)->name('layanan.zawa-tanah');
Route::get('/layanan/zawa/nadzir', App\Livewire\Public\ZawaNadzirForm::class)->name('layanan.zawa-nadzir');
Route::get('/layanan/zawa/tunai', App\Livewire\Public\ZawaTunaiForm::class)->name('layanan.zawa-tunai');

Route::get('/layanan/magang', function() {
    return redirect()->away('https://magang.kemenagsby.web.id/');
})->name('layanan.magang');

Route::get('/tracking', App\Livewire\Public\TrackingService::class)->name('tracking');
