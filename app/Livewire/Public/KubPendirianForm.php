<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class KubPendirianForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('kub-pendirian');
    }

    public $nama;
    public $email;
    public $no_hp;

    // Uploads
    public $surat_permohonan;
    public $proposal_pendirian;
    public $bukti_kepemilikan_tanah;
    public $akte_notaris_pendirian;
    public $rekomendasi_fkub;
    public $susunan_pengurus;
    public $surat_pernyataan_konflik;
    public $surat_keterangan_domisili;
    public $ktp_pengguna; // 90 orang
    public $dukungan_masyarakat; // 60 orang
    public $foto_fisik_papan_nama;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'no_hp' => 'required|string|max:15',
        
        'surat_permohonan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'proposal_pendirian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'bukti_kepemilikan_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'akte_notaris_pendirian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'rekomendasi_fkub' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'susunan_pengurus' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_pernyataan_konflik' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_keterangan_domisili' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'ktp_pengguna' => 'required|file|mimes:pdf,zip,rar|max:10240', // Allow zip for many KTPs
        'dukungan_masyarakat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'foto_fisik_papan_nama' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'kub-pendirian')->firstOrFail();

        // Store Files
        $files = [];
        $files['surat_permohonan'] = $this->surat_permohonan->store('attachments/kub-pendirian', 'public');
        $files['proposal_pendirian'] = $this->proposal_pendirian->store('attachments/kub-pendirian', 'public');
        $files['bukti_kepemilikan_tanah'] = $this->bukti_kepemilikan_tanah->store('attachments/kub-pendirian', 'public');
        $files['akte_notaris_pendirian'] = $this->akte_notaris_pendirian->store('attachments/kub-pendirian', 'public');
        $files['rekomendasi_fkub'] = $this->rekomendasi_fkub->store('attachments/kub-pendirian', 'public');
        $files['susunan_pengurus'] = $this->susunan_pengurus->store('attachments/kub-pendirian', 'public');
        $files['surat_pernyataan_konflik'] = $this->surat_pernyataan_konflik->store('attachments/kub-pendirian', 'public');
        $files['surat_keterangan_domisili'] = $this->surat_keterangan_domisili->store('attachments/kub-pendirian', 'public');
        $files['ktp_pengguna'] = $this->ktp_pengguna->store('attachments/kub-pendirian', 'public');
        $files['dukungan_masyarakat'] = $this->dukungan_masyarakat->store('attachments/kub-pendirian', 'public');
        $files['foto_fisik_papan_nama'] = $this->foto_fisik_papan_nama->store('attachments/kub-pendirian', 'public');

        // Generate Tracking Code
        $code = 'KUB-IBADAH-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

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
            'note' => 'Permohonan Izin Pendirian Rumah Ibadah baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.kub-pendirian-form');
    }
}
