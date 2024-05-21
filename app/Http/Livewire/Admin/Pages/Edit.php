<?php

namespace App\Http\Livewire\Admin\Pages;


use App\Models\Admin;
use App\Models\Page;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.admin.pages.edit');
    }


    public $showModal = false;
    public $isEditMode = false;
    public $title = '';
    public Page $page;
    public $description = '';
    public $lang = 'en';

    protected function getRules()
    {
        return [
            "title" => 'required',
            'description' => 'nullable',
        ];
    }


    public function load(Page $page)
    {
        $this->page = $page;
        if (isset($page) && $page->exists) {
            $this->isEditMode = true;
            $this->title = $page->title;
            $this->description = $page->content;
        }
        $this->showModal = true;
    }

    protected $listeners = [
        'load'
    ];


    public function setLang($lang)
    {
        $this->lang = $lang;
        if ($this->lang = 'fr') {
            $this->title = $this->page->title_fr;
            $this->description = $this->page->content_fr;
        } else {
            $this->title = $this->page->title;
            $this->description = $this->page->content;
        }
        return;
    }
    public function save()
    {
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });
        })->validate();


        $data['content'] = $data['description'];
        if ($this->lang == 'fr') {
            $this->page->title_fr = $this->title;
            $this->page->content_fr = $this->description;
            $this->page->save();
        } else {
            $this->page->update($data);
        }


        $this->emit("success", __('messages.action_success'));
        $this->emit("pageUpdated");
        $this->showModal = false;
    }

    public function updatedShowModal($value)
    {
        if (!$value) {
            $this->title = "";
            $this->description = "";
            $this->lang = "en";
        }
    }
}
