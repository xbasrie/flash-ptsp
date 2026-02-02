<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class ZawaKonsultasiForm extends Component
{
    public $nama;
    public $email;
    public $no_hp;
    public $topik;

    public $tracking_code;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'no_hp' => 'required|string|max:15',
        'topik' => 'required|string|max:1000',
    ];

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'zawa-konsultasi')->firstOrFail();

        $code = 'ZAWA-KONSUL-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'topik' => $this->topik,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Konsultasi Wakaf baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.zawa-konsultasi-form');
    }
}
