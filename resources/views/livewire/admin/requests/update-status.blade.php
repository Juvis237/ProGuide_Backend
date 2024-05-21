<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="change">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <div class="modal-inner short">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('edits.update')}}</h5>
            </div>

            <div class="modal-body ">
                 <p class="text-center"> {{__('edits.other_deletes')}} ?</p>
            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">{{__('edits.close')}}
                </button>
                <button type="button" wire:click="change" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="change"></i>
                    {{__('edits.mark_as')}} {{ucfirst($status)}}
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
