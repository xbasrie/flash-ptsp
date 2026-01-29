<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class KubRohaniawanForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $no_hp;

    // Uploads
    public $paspor;
    public $visa;
    public $surat_penjamin;
    public $proposal_lembaga;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
        
        'paspor' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'visa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_penjamin' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'proposal_lembaga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'kub-rohaniawan')->firstOrFail();

        // Store Files
        $files = [];
        $files['paspor'] = $this->paspor->store('attachments/kub-rohaniawan', 'public');
        $files['visa'] = $this->visa->store('attachments/kub-rohaniawan', 'public');
        $files['surat_penjamin'] = $this->surat_penjamin->store('attachments/kub-rohaniawan', 'public');
        $files['proposal_lembaga'] = $this->proposal_lembaga->store('attachments/kub-rohaniawan', 'public');

        // Generate Tracking Code
        $code = 'KUB-WNA-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'no_hp' => $this->no_hp,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Rekomendasi Rohaniawan Asing baru diajukan.',
        ]);

        $this->tracking_code = $code;
        $this->reset(['nama', 'no_hp', 'paspor', 'visa', 'surat_penjamin', 'proposal_lembaga']);

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.kub-rohaniawan-form');
    }
}
