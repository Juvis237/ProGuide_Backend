<?php

namespace App\Http\Livewire\Admin\School\Delivrable;

use App\Models\Delivrable;
use Livewire\Component;

class Details extends Component
{
    public Delivrable $delivrable;
    public $school;
    public function mount(Delivrable $delivrable){
        $this->delivrable = $delivrable;
        $this->school = $delivrable->school;
    }
    public function render()
    {
        return view('livewire.admin.school.delivrable.details');
    }
}
