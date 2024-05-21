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
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('edits.add_blog')}}</h5>
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
                    <label>{{__('tables.title')}}<span class="text-danger">*</span></label>
                    <input type="text" wire:model="title" class="form-control">
                    @error('title') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>{{__('edits.category')}}<span class="text-danger">*</span></label>
                    <select wire:model="category_id" class="form-control">
                        <option disabled value="">{{__('tables.all_categories')}}</option>
                        <option  value="">{{__('tables.all_categories')}}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                    </select>
                    @error('category_id') <span class="error"> {{ $message }} </span> @enderror
                </div>





                <div class=" form-group col-12">
                    <label>Description<span class="text-danger">*</span></label>
                    <x-wysiwyg
                        wire:model="description"
                        wire:key="uniqueKey"
                        id="description"
                        class="description form-input rounded-md shadow-sm mt-1 block w-full"
                        rows="20"
                        autocomplete="description"
                    />
                    @error('description') <span class="error"> {{ $message }} </span> @enderror
                </div>


                @if ($type == 'video')
                    <div class=" form-group col-12">
                        <label>Url<span class="text-danger">*</span></label>
                        <input type="text" wire:model="path" class="form-control">
                        @error('path') <span class="error"> {{ $message }} </span> @enderror
                    </div>

                    <label>{{__('edits.preview')}}</label>
                    <div class=" form-group col-12">
                        <div class="row">
                            @if (isset($path))
                                <div class="col-8 mx-1 mb-1" >
                                    <iframe src="{{ $path }}" width="100%" height="400px"></iframe>
                                </div>
                            @endif

                            @if ($isEditMode && !isset($path))
                                <div class="col-8  mx-1 mb-1">
                                    <iframe src="{{ $blog->url() }}" width="100%" height="400px"></iframe>
                                </div>
                            @endif
                        </div>
                    </div>

                @endif

                @if ($type == 'podcast')
                    <div class=" form-group col-12">
                        <label>Url<span class="text-danger">*</span></label>
                        <input type="text" wire:model="path" class="form-control">
                        @error('path') <span class="error"> {{ $message }} </span> @enderror
                    </div>

                    <label>{{__('edits.preview')}}</label>
                    <div class=" form-group col-12">
                        <div class="row">
                            @if (isset($path))
                                <div class="col-8 mx-1 mb-1" >
                                    {!! $path !!}
                                </div>
                            @endif

                            @if ($isEditMode && !isset($path))
                                <div class="col-8  mx-1 mb-1">
                                    {!! $blog->path !!}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

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
                                @php
                                    if($lang == 'fr'){
                                        app()->setLocale('fr');
                                    } else{
                                        app()->setLocale('en');
                                    }
                                @endphp
                                <img class="img-fluid p-2" src="{{ $blog->coverImage() }}" >
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
                <button type="button" wire:click="save" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    {{__('edits.save_changes')}}
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>


</form>
