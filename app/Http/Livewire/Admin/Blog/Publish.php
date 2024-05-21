<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;

class Publish extends Component
{
    public $showModal = false;
    public Blog $blog;

    protected $listeners = [
        'load' => 'load'
    ];

    /**
     * @param Blog $blog
     */
    public function load(Blog $blog)
    {
        $this->blog = $blog;
        $this->showModal = true;
    }

    public function publish($status)
    {
        $this->blog->status = $status;
        $this->blog->save();
        $this->emit("success", __('messages.action_success'));
        $this->emit("blogDeleted");
        $this->blog->refresh();
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.admin.blog.publish');
    }
}
