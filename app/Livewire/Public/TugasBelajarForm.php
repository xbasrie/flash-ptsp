<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class TugasBelajarForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('tugas-belajar');
    }

    public $jenis_tugas_belajar = 'mandiri'; // mandiri, beasiswa

    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $golongan;

    // Common Files
    public $surat_pengantar;
    public $surat_pernyataan;
    public $surat_perjanjian;
    public $skp_2_tahun;
    public $surat_diterima;
    public $sertifikat_akreditasi;
    public $jadwal_kuliah;

    // Beasiswa Only
    public $surat_keterangan_beasiswa;

    public $tracking_code;

    protected function rules()
    {
        $rules = [
            'jenis_tugas_belajar' => 'required|in:mandiri,beasiswa',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nip' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'unit_kerja' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'golongan' => 'required|string|max:100',
            
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_pernyataan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_perjanjian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'skp_2_tahun' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'surat_diterima' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sertifikat_akreditasi' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'jadwal_kuliah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if ($this->jenis_tugas_belajar === 'beasiswa') {
            $rules['surat_keterangan_beasiswa'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'tugas-belajar')->firstOrFail();

        // Store Files
        $files = [];
        $files['surat_pengantar'] = $this->surat_pengantar->store('attachments/tugas-belajar', 'public');
        $files['surat_pernyataan'] = $this->surat_pernyataan->store('attachments/tugas-belajar', 'public');
        $files['surat_perjanjian'] = $this->surat_perjanjian->store('attachments/tugas-belajar', 'public');
        $files['skp_2_tahun'] = $this->skp_2_tahun->store('attachments/tugas-belajar', 'public');
        $files['surat_diterima'] = $this->surat_diterima->store('attachments/tugas-belajar', 'public');
        $files['sertifikat_akreditasi'] = $this->sertifikat_akreditasi->store('attachments/tugas-belajar', 'public');
        $files['jadwal_kuliah'] = $this->jadwal_kuliah->store('attachments/tugas-belajar', 'public');

        if ($this->jenis_tugas_belajar === 'beasiswa' && $this->surat_keterangan_beasiswa) {
             $files['surat_keterangan_beasiswa'] = $this->surat_keterangan_beasiswa->store('attachments/tugas-belajar', 'public');
        }

        // Generate Tracking Code
        $code = 'TUBEL-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'jenis_tugas_belajar' => $this->jenis_tugas_belajar,
                'nama' => $this->nama,
                'email' => $this->email,
                'nip' => $this->nip,
                'no_hp' => $this->no_hp,
                'unit_kerja' => $this->unit_kerja,
                'jabatan' => $this->jabatan,
                'golongan' => $this->golongan,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Tugas Belajar (' . ucfirst($this->jenis_tugas_belajar) . ') baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.tugas-belajar-form');
    }
}
