<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Delivrable Details</h3>
            </div>
            <div>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.delivrable.edit','load',{{$school}}, {{$delivrable}})" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Edit Delivrable
                </a>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.delivrable.modes.edit','load',{{$delivrable}})" class="btn btn-secondary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Add Mode
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               {{$delivrable->name}}
           </h4>
       </div>
       <livewire:admin.school.delivrable.modes.index :delivrable='$delivrable'>


    <livewire:admin.school.delivrable.edit />
   
</div>
