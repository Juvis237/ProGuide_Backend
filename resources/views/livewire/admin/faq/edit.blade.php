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
                <h5 class="modal-title" id="exampleModalLongTitle">{{$isEditMode?  __('edits.edit')."FAQ" : __('edits.create')."FAQ"}}</h5>
            </div>
            <div class="mb-3 text-right {{ !$isEditMode ? 'd-none' : ''}}">
                <div class="edit-lang-options">
                    <a href="#" wire:click.prevent = "setLang('en')"
                       class="{{ $lang == 'en' ? 'bg-secondary rounded p-2 text-white' : '' }} ">{{__('edits.edit_english')}}</a>
                    <a href="#" wire:click.prevent = "setLang('fr')"
                       class="{{ $lang == 'fr' ? 'bg-secondary rounded p-2 text-white' : '' }}">{{__('edits.edit_french')}}</a>
                </div>
            </div>
            <div class="modal-body row">

                <div class=" form-group col-12">
                    <label>Category<span class="text-danger">*</span></label>
                    <select wire:model="category_id" class="form-control">
                        <option disabled value="">{{__('tables.all_categories')}}</option>
                        <option  value="">{{__('tables.all_categories')}}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>{{__('tables.question')}}<span class="text-danger">*</span></label>
                    <input type="text" wire:model="question" class="form-control">
                    @error('question') <span class="error"> {{ $message }} </span> @enderror
                </div>



                <div class=" form-group col-12">
                    <label>{{__('edits.content')}}<span class="text-danger">*</span></label>
                    <textarea type="text" wire:model="answer" class="form-control"></textarea>
                    @error('answer') <span class="error"> {{ $message }} </span> @enderror
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
