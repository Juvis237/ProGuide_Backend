<?php

namespace App\Http\Livewire\Admin\School\Delivrable\Modes;

use App\Models\Delivrable;
use App\Models\DelivrableMode;
use Livewire\Component;

class Index extends Component
{
    public Delivrable $delivrable;
    protected $listeners = [
        'schoolCreated' => '$refresh',

    ];
    public function mount(Delivrable $delivrable){
        $this->delivrable = $delivrable;
    }
    public function render()
    {
        return view('livewire.admin.school.delivrable.modes.index');
    }
}
