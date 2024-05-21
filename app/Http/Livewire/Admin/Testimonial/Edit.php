<?php

namespace App\Http\Livewire\Admin\Testimonial;

use App\Models\testimonial;
use Illuminate\Contracts\Validation\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $showModal = false;
    public $isEditMode = false;

    public ?testimonial $testimonial = null;

    public $name = "";
    public $company = "";
    public $image = null;
    public $testimony = "";
    public $lang = "en";

    public function render()
    {
        return view('livewire.admin.testimonial.edit');
    }


    protected $listeners = [
        'load'=>'load'
    ];

    public function load(?testimonial $testimonial){
        $this->testimonial = $testimonial;
        if(isset($this->testimonial) && $this->testimonial->exists){
            $this->isEditMode = true;
            $this->name = $testimonial->testimony;
            $this->company = $testimonial->company;
            $this->testimony = $testimonial->testimony;
        }else{
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }

    protected $rules = [
        "name" => 'required',
        "company" => 'required',
        "testimony" => 'required',
    ];

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
                if(!$this->isEditMode && !isset($this->image)){
                    $validator->errors()->add('image', 'The Image field is required.');
                    return;
                }
            });
        })->validate();


        if($this->isEditMode){
            if(isset($this->image)){
                $data["image"] = $this->image->store('images');
                unlink('storage/'. $this->testimonial->image);
            }
            $this->testimonial->update($data);
            $this->emit("success", __('messages.action_success'));
        }else{
            $data["image"] =  $this->image->store('images');
            $this->testimonial->create($data);
            $this->emit("success", __('messages.action_success'));
        }
        $this->emit("testimonialCreated");
        $this->showModal = false;
    }


    public function updatedShowModal($value){
        if(!$value){
            $this->name= "";
            $this->image = null;
            $this->company= "";
            $this->testimony= "";
        }
    }
}