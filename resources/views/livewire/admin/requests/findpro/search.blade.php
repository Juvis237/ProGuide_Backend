<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="">
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
                <h4 class="modal-title" id="exampleModalLongTitle">{{__('admin.search')}}</h4>
            </div>

            <div class="modal-body row">
                <p class="mx-3">{{__('edits.query_db')}}</p>
                <div class="form-group col-12">
                    <label class="font-weight-bold">{{__('edits.search_company')}}</label>
                    <input type="text" wire:model="filters.name" class="form-control">
                </div>

                <div class="form-group col-12">
                    <button class="d-flex justify-content-between rounded-sm form-control  py-1 px-2  bg-blue-light " wire:click = 'setAdvance'>
                        {{__('edits.advanced_search')}}
                        <i class="fa {{$advance_search? 'fa-chevron-down' : 'fa-chevron-up'}}"></i>
                    </button>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="filters.category" wire:change='set_sub'  class="form-control">
                        <option disabled value="">{{__('tables.all_categories')}}</option>
                        <option  value="">{{__('tables.all_categories')}}</option>
                        @foreach ($categories as $cat)
                            <option  value="{{$cat->name}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="filters.sub_category" class="form-control">
                        <option disabled value="">Select Sub Category</option>
                        <option  value="">{{__('tables.all_sub')}}</option>
                        @foreach ($sub_categories as $sub)
                            <option value="{{$sub->name}}">{{$sub->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="filters.region" wire:change='set_cities'  class="form-control">
                        <option disabled value="">{{__('edits.select_region')}}</option>
                        <option  value="">{{__('tables.all_regions')}}</option>
                        @foreach ($regions as $reg)
                            <option  value="{{$reg->name}}">{{$reg->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="filters.city" class="form-control">
                        <option disabled value="">{{__('edits.select_cities')}}</option>
                        <option  value="">{{__('tables.all_cities')}}</option>
                        @foreach ($cities as $cit)
                            <option value="{{$cit->name}}">{{$cit->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="container mx-1">
                <button type="button" wire:click="search" class="btn bg-primary  p-2 px-5" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="search"></i>
                    {{__('edits.find')}}
                </button>
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn border border-primary bg-none text-primary p-2 px-4"
                        data-dismiss="modal">{{__('edits.close')}}
                </button>

            </div>



        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
