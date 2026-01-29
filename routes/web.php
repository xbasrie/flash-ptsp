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

// KUB
Route::get('/layanan/kub/pendirian', App\Livewire\Public\KubPendirianForm::class)->name('layanan.kub-pendirian');
Route::get('/layanan/kub/rohaniawan', App\Livewire\Public\KubRohaniawanForm::class)->name('layanan.kub-rohaniawan');
Route::get('/layanan/kub/tanah', App\Livewire\Public\KubTanahForm::class)->name('layanan.kub-tanah');

Route::get('/tracking', App\Livewire\Public\TrackingService::class)->name('tracking');
