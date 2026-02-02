<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class ZawaNadzirForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $email;
    public $no_hp;

    // Files
    public $rekom_kua;
    public $berita_acara;
    public $akta_ikrar;
    public $pengesahan_nadzir;
    public $surat_tanah;
    public $kesanggupan_nadzir;
    public $pengunduran_diri;
    public $susunan_pengurus;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'no_hp' => 'required|string|max:15',
        
        'rekom_kua' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'berita_acara' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'akta_ikrar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'pengesahan_nadzir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'kesanggupan_nadzir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'pengunduran_diri' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'susunan_pengurus' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'zawa-nadzir')->firstOrFail();

        // Store Files
        $files = [];
        $files['rekom_kua'] = $this->rekom_kua->store('attachments/zawa-nadzir', 'public');
        $files['berita_acara'] = $this->berita_acara->store('attachments/zawa-nadzir', 'public');
        $files['akta_ikrar'] = $this->akta_ikrar->store('attachments/zawa-nadzir', 'public');
        $files['pengesahan_nadzir'] = $this->pengesahan_nadzir->store('attachments/zawa-nadzir', 'public');
        $files['surat_tanah'] = $this->surat_tanah->store('attachments/zawa-nadzir', 'public');
        $files['kesanggupan_nadzir'] = $this->kesanggupan_nadzir->store('attachments/zawa-nadzir', 'public');
        $files['pengunduran_diri'] = $this->pengunduran_diri->store('attachments/zawa-nadzir', 'public');
        $files['susunan_pengurus'] = $this->susunan_pengurus->store('attachments/zawa-nadzir', 'public');

        $code = 'ZAWA-NADZIR-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Pergantian Nadzir Wakaf Tanah baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.zawa-nadzir-form');
    }
}
