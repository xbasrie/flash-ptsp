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
                'description' => 'Layanan usul Surat Keterangan Penghentian Pembayaran & Surat Keterangan Masih Ilmiah.',
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
        
        // Add other placeholders if needed
    }
}
