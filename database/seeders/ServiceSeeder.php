<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::firstOrCreate(
            ['slug' => 'cuti'],
            [
                'name' => 'Permohonan Cuti',
                'description' => 'Layanan pengajuan berbagai jenis cuti pegawai (Tahunan, Sakit, Besar, dll).',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'satya-lencana'],
            [
                'name' => 'Pengajuan Satya Lencana',
                'description' => 'Layanan usul tanda kehormatan Satya Lencana Karya Satya (10, 20, 30 Tahun).',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'tugas-belajar'],
            [
                'name' => 'Tugas Belajar',
                'description' => 'Layanan pengajuan Tugas Belajar (Biaya Mandiri / Beasiswa).',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'kenaikan-pangkat'],
            [
                'name' => 'Kenaikan Pangkat',
                'description' => 'Layanan usul Kenaikan Pangkat (Fungsional, Reguler, Struktural, Penyesuaian Ijazah).',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'pensiun'],
            [
                'name' => 'Pensiun',
                'description' => 'Layanan pengajuan Pensiun (BUP, Janda/Duda, Uzur, APS).',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'jenjang-jf'],
            [
                'name' => 'Jenjang Jabatan Fungsional',
                'description' => 'Layanan Kenaikan Jenjang dan Pengangkatan Pertama JF.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'skpp-skmi'],
            [
                'name' => 'Usul SKPP dan SKMI',
                'description' => 'Layanan usul Surat Keputusan Penyesuaian Pendidikan & Surat Keterangan Memiliki Ijazah.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'pencantuman-gelar'],
            [
                'name' => 'Pencantuman Gelar',
                'description' => 'Layanan usul Pencantuman Gelar Akademik pada SK Kepangkatan.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'karis-karsu'],
            [
                'name' => 'Pengajuan KARIS/KARSU',
                'description' => 'Layanan pengajuan Kartu Istri / Kartu Suami.',
                'is_active' => true,
            ]
        );

        // Layanan KUB
        Service::firstOrCreate(
            ['slug' => 'kub-pendirian'],
            [
                'name' => 'Izin Pendirian Rumah Ibadah',
                'description' => 'Layanan rekomendasi izin pendirian rumah ibadah.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'kub-rohaniawan'],
            [
                'name' => 'Rekomendasi Rohaniawan Asing',
                'description' => 'Layanan rekomendasi untuk rohaniawan asing.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'kub-tanah'],
            [
                'name' => 'Rekomendasi Hak Atas Tanah',
                'description' => 'Layanan rekomendasi kepemilikan hak atas tanah rumah ibadah.',
                'is_active' => true,
            ]
        );
        
        // Add other placeholders if needed
        // Layanan Bimas Islam
        Service::firstOrCreate(
            ['slug' => 'bimas-nikah'],
            [
                'name' => 'Layanan Nikah',
                'description' => 'Pendaftaran Nikah Online via SIMKAH Gen 4.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'bimas-masjid'],
            [
                'name' => 'ID Masjid dan Musholla',
                'description' => 'Layanan Permohonan Surat Keterangan Terdaftar / ID Masjid dan Musholla.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'bimas-musholla'],
            [
                'name' => 'Perubahan Musholla ke Masjid',
                'description' => 'Layanan Permohonan Perubahan Status Musholla menjadi Masjid.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'bimas-majelis-taklim'],
            [
                'name' => 'Majelis Taklim',
                'description' => 'Layanan Surat Keterangan Terdaftar Majelis Taklim.',
                'is_active' => true,
            ]
        );
        // Layanan Zakat & Wakaf
        Service::firstOrCreate(
            ['slug' => 'zawa-konsultasi'],
            [
                'name' => 'Layanan Informasi dan Konsultasi Wakaf',
                'description' => 'Layanan informasi dan konsultasi terkait wakaf.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'zawa-tanah'],
            [
                'name' => 'Layanan Pendampingan Wakaf Tanah',
                'description' => 'Layanan pendampingan pengurusan wakaf tanah di KUA.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'zawa-nadzir'],
            [
                'name' => 'Layanan Pergantian Nadzir Wakaf Tanah',
                'description' => 'Layanan permohonan pergantian Nadzir wakaf tanah.',
                'is_active' => true,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'zawa-tunai'],
            [
                'name' => 'Layanan Wakaf Tunai',
                'description' => 'Layanan ikrar dan pembayaran wakaf tunai.',
                'is_active' => true,
            ]
        );

         Service::firstOrCreate(
            ['slug' => 'magang'],
            [
                'name' => 'Layanan Magang',
                'description' => 'Layanan permohonan Magang, PKL, atau Penelitian.',
                'is_active' => true,
            ]
        );
        Service::firstOrCreate(
            ['slug' => 'usul-ralat-data-siasn'],
            [
                'name' => 'Usul Ralat Data SIASN BKN',
                'description' => 'Layanan usul perbaikan data pada sistem SIASN BKN.',
                'is_active' => true,
            ]
        );
    }
}
