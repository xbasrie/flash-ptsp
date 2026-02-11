<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class BimasIslamMajelisTaklimForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('bimas-majelis-taklim');
    }

    public $nama;
    public $no_hp;
    public $email;

    // Files
    public $surat_permohonan;
    public $proposal; // Uraian singkat
    public $susunan_pengurus;
    public $surat_domisili;
    public $surat_tidak_konflik;
    public $surat_komitmen;
    public $ktp_pengurus_jamaah;
    public $dokumentasi_kegiatan;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        
        'surat_permohonan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'proposal' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'susunan_pengurus' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_domisili' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tidak_konflik' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_komitmen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'ktp_pengurus_jamaah' => 'required|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
        'dokumentasi_kegiatan' => 'required|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'bimas-majelis-taklim')->firstOrFail();

        $files = [];
        $files['surat_permohonan'] = $this->surat_permohonan->store('attachments/bimas-majelis-taklim', 'public');
        $files['proposal'] = $this->proposal->store('attachments/bimas-majelis-taklim', 'public');
        $files['susunan_pengurus'] = $this->susunan_pengurus->store('attachments/bimas-majelis-taklim', 'public');
        $files['surat_domisili'] = $this->surat_domisili->store('attachments/bimas-majelis-taklim', 'public');
        $files['surat_tidak_konflik'] = $this->surat_tidak_konflik->store('attachments/bimas-majelis-taklim', 'public');
        $files['surat_komitmen'] = $this->surat_komitmen->store('attachments/bimas-majelis-taklim', 'public');
        $files['ktp_pengurus_jamaah'] = $this->ktp_pengurus_jamaah->store('attachments/bimas-majelis-taklim', 'public');
        $files['dokumentasi_kegiatan'] = $this->dokumentasi_kegiatan->store('attachments/bimas-majelis-taklim', 'public');

        $code = 'MT-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'no_hp' => $this->no_hp,
                'email' => $this->email,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan ID Majelis Taklim baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.bimas-islam-majelis-taklim-form')->layout('components.layouts.app');
    }
}
