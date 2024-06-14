<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\School;
use Livewire\Component;

class Details extends Component
{
    public School $school;

    public function mount(School $school){
        $this->school = $school;
    }
    public function render()
    {
        return view('livewire.admin.school.details');
    }
}
