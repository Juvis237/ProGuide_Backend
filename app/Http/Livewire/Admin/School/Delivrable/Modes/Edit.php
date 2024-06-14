<?php

namespace App\Http\Livewire\Admin\School\Delivrable\Modes;

use App\Models\Delivrable;
use App\Models\DelivrableMode;
use Livewire\Component;
use Illuminate\Contracts\Validation\Validator;

class Edit extends Component
{
    public $showModal = false;
    public $isEditMode = false;

    public ?Delivrable $delivrable = null;
    public ?DelivrableMode $mode = null;
    public $lang = 'en';
    public $name = "";
    public $delivrable_name = '';
    public $delivrable_id = '';
    public $price = 0;
    public $duration = '';

    protected $listeners = [
        'load' => 'load'
    ];

    public function load(?Delivrable $delivrable, ?DelivrableMode $mode)
    {
        $this->delivrable = $delivrable;
        $this->mode = $mode;
        if (isset($this->mode) && $this->mode->exists) {
            $this->isEditMode = true;
            $this->delivrable_name = $delivrable->name; 
            $this->delivrable_id = $delivrable->id;
            $this->name = $mode->name;
            $this->price = $mode->price;
            $this->duration = $mode->duration;
        } else {
            $this->delivrable_name = $delivrable->name;
            $this->delivrable_id = $delivrable->id;
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }


    protected $rules = [
        "name" => 'required',
        "price" => 'nullable',
        "duration" => 'nullable',
        "delivrable_id" => 'required',
    ];

    public function save()
    {
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });
        })->validate();


        if ($this->isEditMode) {

            $this->mode->update($data);
            $this->emit("success", 'Mode updated successively');
        } else {
            $this->mode->create($data);
            $this->emit("success", 'Mode created successively');
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
        return view('livewire.admin.school.delivrable.modes.edit');
    }
}
