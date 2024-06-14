<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">School Details</h3>
            </div>
            <div>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.edit','load',{{$school}})" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Edit school
                </a>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.delivrable.edit','load',{{$school}})" class="btn btn-secondary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Add Delivrable
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               {{$school->name}}
           </h4>
       </div>
       <livewire:admin.school.delivrable.index :school='$school'>


    <livewire:admin.school.edit />
    <livewire:admin.school.delivrable.edit />
</div>
