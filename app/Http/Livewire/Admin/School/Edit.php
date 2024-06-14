<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\School;
use Livewire\Component;
use Illuminate\Contracts\Validation\Validator;

class Edit extends Component
{
    public $showModal = false;
    public $isEditMode = false;

    public ?School $school = null;
    public $lang = 'en';
    public $name = "";

    protected $listeners = [
        'load' => 'load'
    ];

    public function load(?School $school)
    {
        $this->school = $school;
        if (isset($this->school) && $this->school->exists) {
            $this->isEditMode = true;
            $this->name = $school->name;
        } else {
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }


    protected $rules = [
        "name" => 'required',
    ];

    public function save()
    {
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });
        })->validate();


        if ($this->isEditMode) {

            $this->school->update($data);
            $this->emit("success", 'school updated successively');
        } else {
            $this->school->create($data);
            $this->emit("success", 'school created successively');
        }
        $this->emit("schoolCreated");
        $this->showModal = false;
    }


    public function updatedShowModal($value)
    {
        if (!$value) {
            $this->name = "";
        }
    }
    public function render()
    {
        return view('livewire.admin.school.edit');
    }
}
