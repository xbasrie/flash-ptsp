<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class KubTanahForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $no_hp;

    // Uploads
    public $surat_pernyataan_tidak_sengketa;
    public $surat_keterangan_domisili_badan;
    public $npwp_badan;
    public $ktp_pemohon;
    public $surat_pernyataan_keabsahan;
    public $surat_keterangan_keberadaan_badan;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
        
        'surat_pernyataan_tidak_sengketa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_keterangan_domisili_badan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'npwp_badan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'ktp_pemohon' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_pernyataan_keabsahan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_keterangan_keberadaan_badan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'kub-tanah')->firstOrFail();

        // Store Files
        $files = [];
        $files['surat_pernyataan_tidak_sengketa'] = $this->surat_pernyataan_tidak_sengketa->store('attachments/kub-tanah', 'public');
        $files['surat_keterangan_domisili_badan'] = $this->surat_keterangan_domisili_badan->store('attachments/kub-tanah', 'public');
        $files['npwp_badan'] = $this->npwp_badan->store('attachments/kub-tanah', 'public');
        $files['ktp_pemohon'] = $this->ktp_pemohon->store('attachments/kub-tanah', 'public');
        $files['surat_pernyataan_keabsahan'] = $this->surat_pernyataan_keabsahan->store('attachments/kub-tanah', 'public');
        $files['surat_keterangan_keberadaan_badan'] = $this->surat_keterangan_keberadaan_badan->store('attachments/kub-tanah', 'public');

        // Generate Tracking Code
        $code = 'KUB-TANAH-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

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
            'note' => 'Permohonan Rekomendasi Hak Atas Tanah baru diajukan.',
        ]);

        $this->tracking_code = $code;
        $this->reset(['nama', 'no_hp', 'surat_pernyataan_tidak_sengketa', 'surat_keterangan_domisili_badan', 
            'npwp_badan', 'ktp_pemohon', 'surat_pernyataan_keabsahan', 'surat_keterangan_keberadaan_badan']);

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.kub-tanah-form');
    }
}
