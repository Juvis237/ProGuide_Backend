<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Notifications extends Component
{
    public function render()
    {
        return view('livewire.admin.notifications');
    }

    protected $listeners = ['mark_as_read'];

    public function mark_as_read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        $this->emit("success", __('messages.action_success'));
        $this->emit('$refresh');
    }
}
