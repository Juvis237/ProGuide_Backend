<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="save">
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
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('edits.email_user')}}</h5>
            </div>
            <div class="modal-body row">
                <div class=" form-group col-12">
                    <label>{{__('edits.greetings')}}<span class="text-danger">*</span></label>
                    <input type="text" wire:model="greeting" class="form-control">
                    @error('greeting') <span class="error"> {{ $message }} </span> @enderror
                </div>
                <div class=" form-group col-12">
                    <label>{{__('edits.subject')}}<span class="text-danger">*</span></label>
                    <input type="text" wire:model="subject" class="form-control">
                    @error('subject') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>{{__('edits.content')}}<span class="text-danger">*</span></label>
                    <x-wysiwyg
                        wire:model="content"
                        wire:key="uniqueKey"
                        id="description"
                        class="description form-input rounded-md shadow-sm mt-1 block w-full"
                        rows="20"
                        autocomplete="description"
                    />
                    @error('content') <span class="error"> {{ $message }} </span> @enderror
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">{{__('edits.close')}}
                </button>
                <button type="button" wire:click="send" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    {{__('edits.send')}}
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
