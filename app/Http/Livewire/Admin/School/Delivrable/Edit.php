<?php

namespace App\Http\Livewire\Admin\School\Delivrable;

use App\Models\Delivrable;
use App\Models\School;
use Livewire\Component;
use Illuminate\Contracts\Validation\Validator;

class Edit extends Component
{
    public $showModal = false;
    public $isEditMode = false;

    public ?Delivrable $delivrable = null;
    public ?School $school = null;
    public $lang = 'en';
    public $name = "";
    public $school_name = '';
    public $school_id = '';
    public $price = 0;
    public $duration = '';

    protected $listeners = [
        'load' => 'load'
    ];

    public function load(?School $school, ?Delivrable $delivrable)
    {
        $this->school = $school;
        $this->delivrable = $delivrable;
        if (isset($this->delivrable) && $this->delivrable->exists) {
            $this->isEditMode = true;
            $this->school_name = $school->name; 
            $this->school_id = $school->id;
            $this->name = $delivrable->name;
            $this->price = $delivrable->price;
            $this->duration = $delivrable->duration;
        } else {
            $this->school_name = $school->name;
            $this->school_id = $school->id;
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }


    protected $rules = [
        "name" => 'required',
        "price" => 'nullable',
        "duration" => 'nullable',
        "school_id" => 'required',
    ];

    public function save()
    {
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });
        })->validate();


        if ($this->isEditMode) {

            $this->delivrable->update($data);
            $this->emit("success", 'delivrable updated successively');
        } else {
            $this->delivrable->create($data);
            $this->emit("success", 'delivrable created successively');
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
        return view('livewire.admin.school.delivrable.edit');
    }
}
