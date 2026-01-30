<?php

namespace App\Livewire\Public;

use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class SkppSkmiForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $golongan;
    
    // Files
    public $surat_pengantar;
    public $sptjm;
    public $sk_cpns_pns; // Combined or ask for both? Requirement says "SK CPNS dan SK PNS"
    public $sk_kp_terakhir;
    public $akreditasi_prodi;
    public $ijazah_transkrip_legalisir;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nip' => 'required|string|max:20',
        'no_hp' => 'required|string|max:20',
        'unit_kerja' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'golongan' => 'required|string',
        
        'surat_pengantar' => 'required|file|mimes:pdf|max:2048',
        'sptjm' => 'required|file|mimes:pdf|max:2048',
        'sk_cpns_pns' => 'required|file|mimes:pdf|max:5120', // Allow larger for combined
        'sk_kp_terakhir' => 'required|file|mimes:pdf|max:2048',
        'akreditasi_prodi' => 'required|file|mimes:pdf|max:2048',
        'ijazah_transkrip_legalisir' => 'required|file|mimes:pdf|max:5120',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'skpp-skmi')->firstOrFail();

        $files = [];
        $file_fields = [
            'surat_pengantar', 'sptjm', 'sk_cpns_pns', 'sk_kp_terakhir',
            'akreditasi_prodi', 'ijazah_transkrip_legalisir'
        ];

        foreach ($file_fields as $field) {
            if ($this->$field) {
                $files[$field] = $this->$field->store('attachments/skpp-skmi', 'public');
            }
        }

        $code = 'SK-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

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
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Usul SKPP & SKMI baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.skpp-skmi-form')->layout('components.layouts.app');
    }
}
