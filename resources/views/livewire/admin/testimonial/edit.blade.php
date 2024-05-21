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
                <h5 class="modal-title" id="exampleModalLongTitle">{{$isEditMode?  __('edits.edit_testimonial') : __('edits.add_testimonial')}}</h5>
            </div>
            <div class="modal-body row">
                <div class=" form-group col-12">
                    <label>{{__('common.name')}}<span class="text-danger">*</span></label>
                    <input type="text" wire:model="name" class="form-control">
                    @error('name') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>{{__('edits.company')}}<span class="text-danger">*</span></label>
                    <input type="text" wire:model="company" class="form-control">
                    @error('company') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>{{__('admin.testimonial')}}<span class="text-danger">*</span></label>
                    <textarea type="text" wire:model="testimony" class="form-control"></textarea>
                    @error('testimony') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>{{__('edits.cover_image')}}<span class="text-danger">*</span></label>
                    <div class="row">
                        @if (isset($image))
                            <div class="col-3 card mx-1 mb-1">
                                <img class="img-fluid p-2" src="{{ $image->temporaryUrl() }}" >
                            </div>
                        @endif

                        @if ($isEditMode && !isset($image))
                            <div class="col-3 card mx-1 mb-1">
                                <img class="img-fluid p-2" src="{{ $testimonial->coverImage() }}" >
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{__('edits.select_image')}}</label>
                        <input type="file" class="form-control" wire:model="image">
                        <div wire:loading wire:target="image">Uploading ...</div>
                        @error('image') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">{{__('edits.close')}}
                </button>
                <button type="button" wire:click="save" class="btn btn-primary"  wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    {{__('edits.save_changes')}}
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
