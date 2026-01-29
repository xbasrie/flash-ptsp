<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class SatyaLencanaForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $golongan;
    public $jenis_satya_lencana; // 10, 20, 30

    // File Uploads
    public $sk_cpns;
    public $sk_kp_terakhir;
    public $sk_jabatan_terakhir;
    public $drh;
    public $skp_2_tahun;
    public $piagam_terakhir;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:20',
        'no_hp' => 'required|string|max:15',
        'unit_kerja' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'golongan' => 'required|string|max:100',
        'jenis_satya_lencana' => 'required|in:10,20,30',
        
        'sk_cpns' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'sk_kp_terakhir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'sk_jabatan_terakhir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'drh' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'skp_2_tahun' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Allow larger size for 2 years
        'piagam_terakhir' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'satya-lencana')->firstOrFail();

        // Store Files
        $files = [];
        $files['sk_cpns'] = $this->sk_cpns->store('attachments/satya-lencana', 'public');
        $files['sk_kp_terakhir'] = $this->sk_kp_terakhir->store('attachments/satya-lencana', 'public');
        $files['sk_jabatan_terakhir'] = $this->sk_jabatan_terakhir->store('attachments/satya-lencana', 'public');
        $files['drh'] = $this->drh->store('attachments/satya-lencana', 'public');
        $files['skp_2_tahun'] = $this->skp_2_tahun->store('attachments/satya-lencana', 'public');
        
        if ($this->piagam_terakhir) {
            $files['piagam_terakhir'] = $this->piagam_terakhir->store('attachments/satya-lencana', 'public');
        }

        // Generate Tracking Code
        $code = 'SATYA-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'nip' => $this->nip,
                'no_hp' => $this->no_hp,
                'unit_kerja' => $this->unit_kerja,
                'jabatan' => $this->jabatan,
                'golongan' => $this->golongan,
                'jenis_satya_lencana' => $this->jenis_satya_lencana,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Satya Lencana baru diajukan.',
        ]);

        $this->tracking_code = $code;
        $this->reset([
            'nama', 'nip', 'no_hp', 'unit_kerja', 'jabatan', 'golongan', 'jenis_satya_lencana',
            'sk_cpns', 'sk_kp_terakhir', 'sk_jabatan_terakhir', 'drh', 'skp_2_tahun', 'piagam_terakhir'
        ]);

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.satya-lencana-form');
    }
}
