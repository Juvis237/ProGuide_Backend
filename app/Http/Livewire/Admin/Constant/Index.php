<?php

namespace App\Http\Livewire\Admin\Constant;

use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'editedConst' => '$refresh'
    ];
    public function render()
    {
        return view('livewire.admin.constant.index');
    }
}
