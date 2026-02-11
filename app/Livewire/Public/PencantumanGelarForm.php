<?php

namespace App\Livewire\Public;

use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PencantumanGelarForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('pencantuman-gelar');
    }

    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $golongan;
    
    // Files - 12 Requirements
    public $surat_usul_kakankemenag; // 1
    public $sptjm_bermaterai; // 2
    public $sptjm_kakankemenag; // 3
    public $ijazah; // 4
    public $transkrip_nilai; // 5
    public $dokumen_tubel_ib; // 6
    public $akreditasi_jurusan; // 7
    public $sk_kp_terakhir; // 8
    public $sk_cpns; // 9
    public $sk_pns; // 10
    public $sk_jabatan_fungsional; // 11
    public $screenshot_pddikti; // 12

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nip' => 'required|string|max:20',
        'no_hp' => 'required|string|max:20',
        'unit_kerja' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'golongan' => 'required|string',
        
        'surat_usul_kakankemenag' => 'required|file|mimes:pdf|max:2048',
        'sptjm_bermaterai' => 'required|file|mimes:pdf|max:2048',
        'sptjm_kakankemenag' => 'required|file|mimes:pdf|max:2048',
        'ijazah' => 'required|file|mimes:pdf|max:2048',
        'transkrip_nilai' => 'required|file|mimes:pdf|max:2048',
        'dokumen_tubel_ib' => 'required|file|mimes:pdf|max:2048',
        'akreditasi_jurusan' => 'required|file|mimes:pdf|max:2048',
        'sk_kp_terakhir' => 'required|file|mimes:pdf|max:2048',
        'sk_cpns' => 'required|file|mimes:pdf|max:2048',
        'sk_pns' => 'required|file|mimes:pdf|max:2048',
        'sk_jabatan_fungsional' => 'required|file|mimes:pdf|max:2048',
        'screenshot_pddikti' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'pencantuman-gelar')->firstOrFail();

        $files = [];
        $file_fields = [
            'surat_usul_kakankemenag', 'sptjm_bermaterai', 'sptjm_kakankemenag',
            'ijazah', 'transkrip_nilai', 'dokumen_tubel_ib',
            'akreditasi_jurusan', 'sk_kp_terakhir', 'sk_cpns',
            'sk_pns', 'sk_jabatan_fungsional', 'screenshot_pddikti'
        ];

        foreach ($file_fields as $field) {
            if ($this->$field) {
                $files[$field] = $this->$field->store('attachments/pencantuman-gelar', 'public');
            }
        }

        $code = 'PG-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

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
            'note' => 'Permohonan Pencantuman Gelar baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.pencantuman-gelar-form')->layout('components.layouts.app');
    }
}
