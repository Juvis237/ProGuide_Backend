<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Category;
use App\Models\FAQ;
use App\Models\Images;
use Illuminate\Contracts\Validation\Validator;
use Livewire\Component;

class Edit extends Component
{

    public $showModal = false;
    public $isEditMode = false;

    public ?FAQ $faq = null;
    public $lang = 'en';
    public $question = "";
    public $answer = "";

    public $category_id = null;

    protected $listeners = [
        'load' => 'load'
    ];

    public function load(?FAQ $faq)
    {
        $this->faq = $faq;
        if (isset($this->faq) && $this->faq->exists) {
            $this->isEditMode = true;
            $this->question = $faq->question;
            $this->answer = $faq->answer;
            $this->category_id = $faq->category_id;
        } else {
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }

    public function render()
    {
        $categories = Category::faq();
        return view('livewire.admin.faq.edit', ['categories' => $categories]);
    }
    public function setLang($lang)
    {
        $this->lang = $lang;
        if ($this->lang = 'fr') {
            $this->question = $this->faq->question_fr;
            $this->answer = $this->faq->answer_fr;
        } else {
            $this->question = $this->faq->question;
            $this->answer = $this->faq->answer;
        }
        return;
    }

    protected $rules = [
        "question" => 'required',
        "answer" => 'required',
        "category_id" => 'required'
    ];

    public function save()
    {
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });
        })->validate();


        if ($this->isEditMode) {
            if ($this->lang == 'fr') {
                $this->faq->question_fr = $this->question;
                $this->faq->answer_fr = $this->answer;
                $this->faq->save();
            } else {
                $this->faq->update($data);
            }
            $this->emit("success", __('messages.action_success'));
        } else {
            $this->faq->create($data);
            $this->emit("success", __('messages.action_success'));
        }
        $this->emit("faqCreated");
        $this->showModal = false;
    }


    public function updatedShowModal($value)
    {
        if (!$value) {
            $this->answer = "";
            $this->question = "";
        }
    }
}
