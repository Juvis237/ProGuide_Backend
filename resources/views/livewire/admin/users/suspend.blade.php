<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="delete">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <div class="modal-inner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('edits.suspend')}}</h5>
            </div>
            <div class="modal-body ">
                 
                @if(isset($user))
                <p class="text-center"> {{__('edits.other_deletes')}} ?</p>
                 <p class="text-center"> {{__('common.name')}} : <span>{{$user->first_name }}</span></p>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">{{__('edits.close')}}
                </button>
                @if(isset($user))
                <button type="button" wire:click="suspend" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="delete"></i>
                    {{$user->status != 2? __('edits.suspend') : __('edits.unsuspend')}}
                </button>
                @endif

            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
