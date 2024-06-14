<?php

namespace App\Http\Livewire\Admin\School\Delivrable;

use App\Models\School;
use Livewire\Component;

class Index extends Component
{
    public School $school;

    protected $listeners = [
        'schoolCreated' => '$refresh',

    ];
    public function mount(School $school){
        $this->school = $school;
    }
    public function render()
    {
        return view('livewire.admin.school.delivrable.index');
    }
}
