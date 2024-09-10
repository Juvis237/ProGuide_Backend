<?php

namespace App\Http\Livewire\Admin\Request;

use App\Models\Request;
use Livewire\Component;

class Detail extends Component
{
    protected $listeners = ['userSuspended' => '$refresh'];

    public Request $request;



    public function mount(Request $request){
        $this->request = $request;
    }
    public function render()
    {
        return view('livewire.admin.request.detail');
    }
}
