<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class BimasIslamMushollaForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('bimas-musholla');
    }

    public $nama;
    public $no_hp;
    public $email;

    // Files
    public $surat_permohonan;
    public $surat_dukungan; // 30+ orang
    public $rekomendasi_kua;
    public $sk_takmir_masjid; // FC SK Pendirian/Pembentukan Takmir Masjid
    public $status_tanah; // FC Status Tanah
    public $surat_tidak_konflik;
    public $surat_komitmen;
    public $foto_bangunan; // JPG/JPeg

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        
        'surat_permohonan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_dukungan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'rekomendasi_kua' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'sk_takmir_masjid' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'status_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tidak_konflik' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_komitmen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'foto_bangunan' => 'required|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'bimas-musholla')->firstOrFail();

        $files = [];
        $files['surat_permohonan'] = $this->surat_permohonan->store('attachments/bimas-musholla', 'public');
        $files['surat_dukungan'] = $this->surat_dukungan->store('attachments/bimas-musholla', 'public');
        $files['rekomendasi_kua'] = $this->rekomendasi_kua->store('attachments/bimas-musholla', 'public');
        $files['sk_takmir_masjid'] = $this->sk_takmir_masjid->store('attachments/bimas-musholla', 'public');
        $files['status_tanah'] = $this->status_tanah->store('attachments/bimas-musholla', 'public');
        $files['surat_tidak_konflik'] = $this->surat_tidak_konflik->store('attachments/bimas-musholla', 'public');
        $files['surat_komitmen'] = $this->surat_komitmen->store('attachments/bimas-musholla', 'public');
        $files['foto_bangunan'] = $this->foto_bangunan->store('attachments/bimas-musholla', 'public');

        $code = 'ALIH-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

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
            'note' => 'Permohonan Perubahan Status Musholla menjadi Masjid baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.bimas-islam-musholla-form')->layout('components.layouts.app');
    }
}
