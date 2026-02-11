<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class ZawaTanahForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('zawa-tanah');
    }

    public $nama;
    public $email;
    public $no_hp;

    // Files
    public $ktp_wakif;
    public $ktp_nadzir;
    public $surat_tanah;
    
    // Logic for certificate
    public $has_certificate = true;
    
    // Additional if no certificate
    public $riwayat_tanah;
    public $pernyataan_fisik;
    public $surat_tidak_sengketa;
    public $tanggung_jawab_mutlak;

    public $tracking_code;

    protected function rules()
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            
            'ktp_wakif' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ktp_nadzir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];

        if (!$this->has_certificate) {
            $rules['riwayat_tanah'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
            $rules['pernyataan_fisik'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
            $rules['surat_tidak_sengketa'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
            $rules['tanggung_jawab_mutlak'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }

        return $rules;
    }

    public function updatedHasCertificate()
    {
        // Reset validaton or fields if toggled?
    }

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'zawa-tanah')->firstOrFail();

        // Store Files
        $files = [];
        $files['ktp_wakif'] = $this->ktp_wakif->store('attachments/zawa-tanah', 'public');
        $files['ktp_nadzir'] = $this->ktp_nadzir->store('attachments/zawa-tanah', 'public');
        $files['surat_tanah'] = $this->surat_tanah->store('attachments/zawa-tanah', 'public');

        if (!$this->has_certificate) {
            $files['riwayat_tanah'] = $this->riwayat_tanah->store('attachments/zawa-tanah', 'public');
            $files['pernyataan_fisik'] = $this->pernyataan_fisik->store('attachments/zawa-tanah', 'public');
            $files['surat_tidak_sengketa'] = $this->surat_tidak_sengketa->store('attachments/zawa-tanah', 'public');
            $files['tanggung_jawab_mutlak'] = $this->tanggung_jawab_mutlak->store('attachments/zawa-tanah', 'public');
        }

        $code = 'ZAWA-TANAH-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'has_certificate' => $this->has_certificate,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Pendampingan Wakaf Tanah baru diajukan.',
        ]);

        $this->reset();
        $this->has_certificate = true; // reset to default
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.zawa-tanah-form');
    }
}
