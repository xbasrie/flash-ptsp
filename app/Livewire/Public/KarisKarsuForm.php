<?php

namespace App\Livewire\Public;

use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class KarisKarsuForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('karis-karsu');
    }

    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $golongan;
    public $jenis_layanan;
    
    // Files - 6 Requirements
    public $surat_pengantar; // 1
    public $sk_cpns; // 2
    public $sk_pns; // 3
    public $akta_nikah; // 4
    public $laporan_perkawinan; // 5
    public $pasfoto; // 6

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nip' => 'required|string|max:20',
        'no_hp' => 'required|string|max:20',
        'unit_kerja' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'golongan' => 'required|string',
        'jenis_layanan' => 'required|in:karis,karsu',
        
        'surat_pengantar' => 'required|file|mimes:pdf|max:2048',
        'sk_cpns' => 'required|file|mimes:pdf|max:2048',
        'sk_pns' => 'required|file|mimes:pdf|max:2048',
        'akta_nikah' => 'required|file|mimes:pdf|max:2048',
        'laporan_perkawinan' => 'required|file|mimes:pdf|max:2048',
        'pasfoto' => 'required|image|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'karis-karsu')->firstOrFail();

        $file_fields = [
            'surat_pengantar', 'sk_cpns', 'sk_pns',
            'akta_nikah', 'laporan_perkawinan', 'pasfoto'
        ];

        // Process file uploads...
        $files = [];
        foreach ($file_fields as $field) {
            if ($this->$field) {
                $files[$field] = $this->$field->store('attachments/karis-karsu', 'public');
            }
        }

        $code = 'KK-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'email' => $this->email,
                'nip' => $this->nip,
                'no_hp' => $this->no_hp,
                'unit_kerja' => $this->unit_kerja,
                'jabatan' => $this->jabatan,
                'golongan' => $this->golongan,
                'jenis_layanan' => $this->jenis_layanan,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan KARIS/KARSU baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.karis-karsu-form')->layout('components.layouts.app');
    }
}
