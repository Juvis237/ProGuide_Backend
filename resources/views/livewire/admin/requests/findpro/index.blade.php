<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Search Results</h4>
    </div>
    <div class="rounded-lg bg-white p-2 py-4">
        <div class="d-flex justify-content-start">
            <div class=" mb-3 mx-2">
                <div class="">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                           placeholder="{{__('tables.search')}}">
                </div>
            </div>

            <div class="form-group ">
                <select  wire:model.debounce.500ms="filters.category" wire:change='set_sub'  class="form-control">
                    <option disabled value="">{{__('tables.all_categories')}}</option>
                    <option  value="">{{__('tables.all_categories')}}</option>
                    @foreach ($categories as $cat)
                        <option {{$cat->id == $filters['category']?"selected":""}}  value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mx-2">
                <select  wire:model="filters.sub_category" class="form-control">
                    <option disabled value="">Select Sub Category</option>
                    <option  value="">{{__('tables.all_sub')}}</option>
                    @foreach ($sub_categories as $sub)
                        <option {{$sub->id == $filters['sub_category']?"selected":""}}  value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group ">
                <select  wire:model="filters.region" wire:change='set_cities'  class="form-control">
                    <option disabled value="">{{__('edits.select_region')}}</option>
                    <option  value="">{{__('tables.all_regions')}}</option>
                    @foreach ($regions as $reg)
                        <option  {{$reg->id == $filters['region']?"selected":""}} value="{{$reg->id}}">{{$reg->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-2">
                <select  wire:model="filters.city" class="form-control">
                    <option disabled value="">{{__('edits.select_cities')}}</option>
                    <option  value="">{{__('tables.all_cities')}}</option>
                    @foreach ($cities as $cit)
                        <option {{$cit->id == $filters['city']?"selected":""}} value="{{$cit->id}}">{{$cit->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row p-2">
            @foreach ($businesses as $business)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="d-flex">
                            <div>
                                <img src="{{ !isset($business->profile)?  asset('be_assets/images/Frame 75.png') : asset('storage/'.$business->profile) }}" class="rounded-lg" width="100px" alt="User Profile">
                            </div>
                            <div class="ml-3 d-flex align-items-start">
                                <span>
                                    <p class="font-24 font-weight-bold">{{$business->company}}</p>
                                    <p>{{$business->service}}</p>
                                    <div>
                                        <p>
                                            <i class="mx-3"> <img src="{{asset('images/location.png')}}" alt=""></i>
                                            {{$business->city->name}},  {{$business->region->name}}
                                        </p>
                                    </div>
                                    <div class="d-flex">

                                            <a class="btn btn-primary" href="tel:{{$business->phone}}" >
                                                <i class="fa fa-phone"></i> {{__('edits.call_user')}}
                                            </a>


                                                                            
                                        <button class="btn bg-blue-light text-primary mx-1" wire:click.prevent="$emitTo('requests.findpro.send-mail','load',{{$business}})">
                                            <i class="fa fa-envelope"></i> {{__('edits.email_user')}}
                                        </button>

                                        <a class="btn bg-none border-primary text-primary" href="{{route('user.detail', $business)}}">
                                            <i class="fa fa-envelope"></i> {{__('edits.view_details')}}
                                        </a>
                                  
                                    </div>

                                </span>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>







    <livewire:requests.findpro.send-mail />

    <livewire:requests.findpro.search :showModal="$showModal" />
</div>
