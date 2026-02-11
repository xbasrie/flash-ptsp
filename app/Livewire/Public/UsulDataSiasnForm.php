<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UsulDataSiasnForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('usul-ralat-data-siasn');
    }

    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $pangkat_golongan;
    
    public $surat_pengantar;
    public $sptjm;
    public $surat_persetujuan;
    public $data_pendukung;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nip' => 'required|string|max:20',
        'no_hp' => 'required|string|max:15',
        'unit_kerja' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'pangkat_golongan' => 'required|string|max:100',
        'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'sptjm' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'surat_persetujuan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'data_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
    ];

    public function render()
    {
        return view('livewire.public.usul-data-siasn-form');
    }

    public function save()
    {
        $this->validate();

        $service = \App\Models\Service::where('slug', 'usul-ralat-data-siasn')->firstOrFail();

        // Upload files
        $uploadPath = 'attachments/usul-data-siasn';
        $suratPengantarPath = $this->surat_pengantar->store($uploadPath, 'public');
        $sptjmPath = $this->sptjm->store($uploadPath, 'public');
        $suratPersetujuanPath = $this->surat_persetujuan->store($uploadPath, 'public');
        $dataPendukungPath = $this->data_pendukung ? $this->data_pendukung->store($uploadPath, 'public') : null;

        // Generate Tracking Code
        $code = 'SIASN-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = \App\Models\Submission::create([
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
                'pangkat_golongan' => $this->pangkat_golongan,
                'surat_pengantar' => $suratPengantarPath,
                'sptjm' => $sptjmPath,
                'surat_persetujuan' => $suratPersetujuanPath,
                'data_pendukung' => $dataPendukungPath,
            ],
        ]);

        \App\Models\TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan baru diajukan oleh pemohon.',
        ]);

        $this->reset();
        $this->tracking_code = $code;
        
        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }
}
