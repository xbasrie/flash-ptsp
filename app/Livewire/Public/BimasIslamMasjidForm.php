<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class BimasIslamMasjidForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $no_hp;
    public $email;

    // Files
    public $surat_permohonan;
    public $proposal;
    public $sk_takmir;
    public $status_tanah;
    public $surat_domisili;
    public $surat_tidak_konflik;
    public $surat_komitmen;
    public $foto_masjid; // Depan, Dalam, Wudhu (bisa zip atau pdf combined, atau single file requirement based on prompt implying multiple aspects)

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        
        'surat_permohonan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'proposal' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'sk_takmir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'status_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_domisili' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tidak_konflik' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_komitmen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'foto_masjid' => 'required|file|mimes:pdf,jpg,jpeg,png,zip|max:10240', // Combined or zip
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'bimas-masjid')->firstOrFail();

        $files = [];
        $files['surat_permohonan'] = $this->surat_permohonan->store('attachments/bimas-masjid', 'public');
        $files['proposal'] = $this->proposal->store('attachments/bimas-masjid', 'public');
        $files['sk_takmir'] = $this->sk_takmir->store('attachments/bimas-masjid', 'public');
        $files['status_tanah'] = $this->status_tanah->store('attachments/bimas-masjid', 'public');
        $files['surat_domisili'] = $this->surat_domisili->store('attachments/bimas-masjid', 'public');
        $files['surat_tidak_konflik'] = $this->surat_tidak_konflik->store('attachments/bimas-masjid', 'public');
        $files['surat_komitmen'] = $this->surat_komitmen->store('attachments/bimas-masjid', 'public');
        $files['foto_masjid'] = $this->foto_masjid->store('attachments/bimas-masjid', 'public');

        $code = 'IDM-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

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
            'note' => 'Permohonan ID Masjid/Musholla baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.bimas-islam-masjid-form')->layout('components.layouts.app');
    }
}
