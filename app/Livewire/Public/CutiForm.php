<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CutiForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('cuti');
    }

    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $pangkat_golongan;
    public $jenis_cuti;
    public $alasan_cuti;
    public $lama_hari;
    public $mulai_tanggal;
    public $sampai_tanggal;
    public $lampiran;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nip' => 'required|string|max:20',
        'no_hp' => 'required|string|max:15',
        'unit_kerja' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'pangkat_golongan' => 'required|string|max:100',
        'jenis_cuti' => 'required|string',
        'alasan_cuti' => 'required|string',
        'lama_hari' => 'required|integer|min:1',
        'mulai_tanggal' => 'required|date',
        'sampai_tanggal' => 'required|date|after_or_equal:mulai_tanggal',
        'lampiran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB Max
    ];

    public function render()
    {
        return view('livewire.public.cuti-form');
    }

    public function save()
    {
        $this->validate();

        $service = \App\Models\Service::where('slug', 'cuti')->firstOrFail();

        // Upload file
        $path = $this->lampiran->store('attachments/cuti', 'public');

        // Generate Tracking Code
        $code = 'CUTI-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

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
                'jenis_cuti' => $this->jenis_cuti,
                'alasan_cuti' => $this->alasan_cuti,
                'lama_hari' => $this->lama_hari,
                'mulai_tanggal' => $this->mulai_tanggal,
                'sampai_tanggal' => $this->sampai_tanggal,
                'lampiran_path' => $path,
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
