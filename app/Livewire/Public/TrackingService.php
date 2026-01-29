<?php

namespace App\Livewire\Public;

use App\Models\Submission;
use Livewire\Component;

class TrackingService extends Component
{
    public $tracking_code;
    public $submission;
    public $logs;

    protected $rules = [
        'tracking_code' => 'required|string|min:15|max:25', // Accommodate CUTI (19) and SATYA (20)
    ];

    public function search()
    {
        $this->validate();

        $this->submission = Submission::where('tracking_code', $this->tracking_code)
            ->with(['service', 'logs' => function ($query) {
                $query->latest();
            }])
            ->first();

        if ($this->submission) {
            $this->logs = $this->submission->logs;
        } else {
            $this->submission = null;
            $this->addError('tracking_code', 'Kode Tracking tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.public.tracking-service');
    }
}
