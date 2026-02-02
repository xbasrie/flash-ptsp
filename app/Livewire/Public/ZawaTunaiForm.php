<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class ZawaTunaiForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $nik;
    public $no_hp;
    public $email;
    public $alamat;
    
    // Details
    public $profesi_wakif;
    public $profesi_wakif_lainnya;

    public $sumber_dana;
    public $sumber_dana_lainnya;

    public $ikrar = false;
    
    // Files
    public $bukti_transfer;

    public $tracking_code;

    protected function rules() 
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:1000',
            
            'profesi_wakif' => 'required|in:asn,pelajar,catin,jamaah_haji,lainnya',
            'sumber_dana' => 'required|in:gaji,hasil_usaha,warisan,lainnya',
            'ikrar' => 'required|accepted',
            
            'bukti_transfer' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if ($this->profesi_wakif === 'lainnya') {
            $rules['profesi_wakif_lainnya'] = 'required|string|max:255';
        }

        if ($this->sumber_dana === 'lainnya') {
            $rules['sumber_dana_lainnya'] = 'required|string|max:255';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'zawa-tunai')->firstOrFail();

        $files = [];
        $files['bukti_transfer'] = $this->bukti_transfer->store('attachments/zawa-tunai', 'public');

        $profesi = $this->profesi_wakif === 'lainnya' ? $this->profesi_wakif_lainnya : $this->profesi_wakif;
        $sumber = $this->sumber_dana === 'lainnya' ? $this->sumber_dana_lainnya : $this->sumber_dana;

        $code = 'ZAWA-TUNAI-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'nik' => $this->nik,
                'no_hp' => $this->no_hp,
                'email' => $this->email,
                'alamat' => $this->alamat,
                'profesi_wakif' => $profesi,
                'sumber_dana' => $sumber,
                'ikrar' => $this->ikrar,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Wakaf Tunai baru diterima.',
        ]);

        $this->reset();
        $this->ikrar = false;
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Wakaf Tunai Kami Terima! Terimakasih. Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.zawa-tunai-form');
    }
}
