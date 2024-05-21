<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class Suspend extends Component
{
    public $showModal = false;
    public User $user;

    protected $listeners = [
        'load' => 'load'
    ];

    /**
     * @param User $user
     */
    public function load(User $user)
    {
        $this->user = $user;
        $this->showModal = true;
    }

    public function suspend()
    {
        if ($this->user->status != '2') {
            $this->user->status = '2';
        } else {
            $this->user->status = '1';
        }

        $this->user->save();
        $this->emit("success", __('messages.action_success'));
        $this->emit("userSuspended");
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.admin.users.suspend');
    }
}
