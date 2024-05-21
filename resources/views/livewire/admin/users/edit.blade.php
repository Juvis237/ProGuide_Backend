<div>
    <h4>{{__('admin.add_business')}}</h4>

    <div class="mt-4 p-4 rounded-lg bg-white">
        <div class="row ">
            <h5 class="pb-5 col-12">{{__('edits.business_contact')}}</h5>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">{{__('common.first_name')}} <span class="required-field">*</span></label>
                    <input type="text" wire:model="first_name" class="form-control" >
                    @error('first_name') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">{{__('common.last_name')}} <span class="required-field">*</span></label>
                    <input type="text" wire:model="last_name" class="form-control" >
                    @error('last_name') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">{{__('common.email')}} <span class="required-field">*</span></label>
                    <input type="email" wire:model="email" class="form-control" >
                    @error('email') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">{{__('common.phone')}} <span class="required-field">*</span></label>
                    <input type="text" wire:model="phone" class="form-control" >
                    @error('phone') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label class="font-15" for="">{{__('common.password')}} <span class="required-field">*</span></label>
                    <div class="input-group">
                        <input type="text" {{$isEditMode ? 'disabled' : ''}} wire:model="password" class="form-control bl-none">
                    </div>
                    @error('password') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-start">
                <button class="rounded-lg bg-white border border-primary p-2 mt-3  text-primary border-black " {{$isEditMode ? 'disabled' : ''}} wire:click='generate' wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="generate"></i>
                    <i class="fa fa-lock"></i> {{__('edits.generate')}} </button>
            </div>


                <div class=" col-12 d-flex align-items-center">
                    <h6 class="me-2">{{__('edits.status')}}  : </h6>
                    <div style="width: 5px"></div>
                    <div class="form-check form-switch ">
                        <input class="form-check-input ms-2" type="checkbox" wire:model = 'status' role="switch" id="flexSwitchCheckChecked" >
                        <label class="form-check-label" for="flexSwitchCheckChecked">{{$status == 0 ? 'Inactive' : 'Active'}}</label>
                    </div>
                </div>

                <div class=" col-12 mt-4 d-flex align-items-center">
                    <div class="form-check form-switch ">
                        <input class="form-check-input ms-2" type="checkbox" wire:model = 'check' role="switch" id="emailcount" checked >
                        <label class="form-check-label" for="emailcount">{{__('edits.send_account')}} </label>
                    </div>
                </div>



        </div>
    </div>

    <div class="mt-4 p-4  rounded-lg bg-white">
        <h5 class="pb-5 col-12">{{__('edits.business_info')}}</h5>
        <div class="col-12">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for="">{{__('edits.company')}} <span class="required-field">*</span></label>
                <input type="text" wire:model="company" class="form-control" >
                @error('company') <span class="error"> {{ $message }} </span> @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for="">Address <span class="required-field">*</span></label>
                <input type="text" wire:model="address" class="form-control" >
                @error('address') <span class="error"> {{ $message }} </span> @enderror
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <label class="font-15 font-weight-bold text-dark" for="">{{__('common.region')}} <span class="required-field">*</span></label>
            <select  wire:model="region_id" wire:change='set_cities'  class="form-control">
                <option value="">{{__('edits.select_region')}}</option>
                @foreach ($regions as $reg)
                    <option  value="{{$reg->id}}">{{$reg->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-lg-6">
            <label class="font-15 font-weight-bold text-dark" for="">{{__('common.city')}} <span class="required-field">*</span></label>
            <select  wire:model="city_id" class="form-control">
                <option value="">{{__('edits.select_city')}}</option>
                @foreach ($cities as $cit)
                    <option value="{{$cit->id}}">{{$cit->name}}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="col-12 col-lg-6">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for="">Category <span class="required-field">*</span></label>
                <input type="text" wire:model="category" class="form-control" >
                @error('category') <span class="error"> {{ $message }} </span> @enderror
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for="">Sub Category <span class="required-field">*</span></label>
                <input type="text" wire:model="sub_category" class="form-control" >
                @error('sub_catergory') <span class="error"> {{ $message }} </span> @enderror
            </div>
        </div> --}}
        <div class="col-12 ">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for="">{{__('edits.website')}} <span class="required-field">*</span></label>
                <input type="text" wire:model="website" class="form-control" >
                @error('website') <span class="error"> {{ $message }} </span> @enderror
            </div>
        </div>
    </div>

    <button type="button" class="btn bt-sm btn-primary border-0 mt-5" {{$saved? 'disabled' : ''}} wire:click = 'save'>
        {{$isEditMode ? __('edits.update_business') : __('edits.create_business') }}
    </button>

</div>
