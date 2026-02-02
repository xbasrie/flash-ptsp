<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Service;

class ServiceSearch extends Component
{
    public $search = '';

    public function render()
    {
        $services = [];
        
        if (strlen($this->search) >= 2) {
            $services = Service::where('is_active', true)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('description', 'like', '%' . $this->search . '%');
                })
                ->limit(10)
                ->get();
        }

        return view('livewire.public.service-search', [
            'services' => $services
        ]);
    }
}
