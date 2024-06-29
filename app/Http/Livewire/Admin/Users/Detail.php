<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class Detail extends Component
{
    protected $listeners = ['userSuspended' => '$refresh'];

    public User $user;
    public $user_id;
    public $tab = 0;

    public $menus = ['Requests'];

    public function mount(User $user, Request $request){
        $this->user = $user;
        $this->user_id = $this->user->id;
        $this->tab = $request->tab;
    }
    public function render()
    {
        return view('livewire.admin.users.detail');
    }
}
