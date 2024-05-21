<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Manage Requests</h4>
    </div>

    <div class="rounded-lg bg-white p-2 py-4">

        <div class="d-flex justify-content-end flex-column flex-lg-row">
            <div class=" mb-3 mr-2">
                <select  wire:model.debounce.500ms="filters.category" wire:change='set_sub'  class="form-control">
                    <option disabled value="">{{__('tables.all_categories')}}</option>
                    <option  value="">{{__('tables.all_categories')}}</option>
                    @foreach ($categories as $cat)
                        <option {{$cat->id == $filters['category']?"selected":""}}  value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class=" mb-3 mr-2">
                <select  wire:model="filters.sub_category" class="form-control">
                    <option disabled value="">Select Sub Category</option>
                    <option  value="">{{__('tables.all_sub')}}</option>
                    @foreach ($sub_categories as $sub)
                        <option {{$sub->id == $filters['sub_category']?"selected":""}}  value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class=" mb-3 mr-2">
                <select  wire:model="filters.region" wire:change='set_cities'  class="form-control">
                    <option disabled value="">{{__('edits.select_region')}}</option>
                    <option  value="">{{__('tables.all_regions')}}</option>
                    @foreach ($regions as $reg)
                        <option  {{$reg->id == $filters['region']?"selected":""}} value="{{$reg->id}}">{{$reg->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class=" mb-3 mr-2">
                <select  wire:model="filters.city" class="form-control">
                    <option disabled value="">{{__('edits.select_cities')}}</option>
                    <option  value="">{{__('tables.all_cities')}}</option>
                    @foreach ($cities as $cit)
                        <option {{$cit->id == $filters['city']?"selected":""}} value="{{$cit->id}}">{{$cit->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class=" mb-3 mr-2">
                <select name="" class="form-control rounded-md " id="">
                    <option value="">{{__('edits.status')}}</option>
                </select>
            </div>

            <div class=" mb-3 mr-2">
                <div class="">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                           placeholder="{{__('tables.search')}}">
                </div>
            </div>
        </div>

        <div class="table-responsive bg-white">
            <table class="table table-bordered m-0 rounded-lg">

                <thead class="bg-light">
                <tr >
                    <th>#</th>
                    <th>{{__('edits.sender')}}</th>
                    <th>{{__('edits.title')}} & Description</th>
                    <th>{{__('edits.user')}}</th>
                    <th>Date</th>
                    <th>{{__('edits.requested_on')}}</th>
                    <th>{{__('edits.status')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($requests as $k=>$request)
                    <tr wire:key="{{$k}}">
                        <td>{{$loop->index + 1}}</td>
                        <td>
                            <div class="d-flex">
                                <img src="{{$request->user->profile_picture}}" class="rounded-circle" width="50px" alt="">
                                <p class="mx-2">{{$request->user->first_name}}</p>
                            </div>
                        </td>
                        <td>
                            <span>
                                <p class="font-weight-bold">
                                    {{$request->title}}
                                </p>
                                <p>
                                    {!! $request->description !!}
                                </p>
                            </span>



                        </td>
                        <td>
                            {{$request->user->first_name.' '.$request->user->last_name}}
                        </td>
                        <td>{{$request->date}} </td>
                        <td>{{$request->created_at  }} </td>
                        <td class="p-2">
                            <div class=" p-2 rounded-lg badge badge-{{$request->status}}">
                                {{ucfirst($request->status)}}
                            </div>
                             </td>
                        <td>
                            <div class="button-list">
                                <a href="{{route('requests.detail', $request)}}" class="btn btn-primary"><i
                                    class="fa fa-eye"></i> </a>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class=" text-center">{{__('tables.no_entry')}}</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>


        {{-- Pagination --}}
        @if($this->rows->count())
            <div class="mt-5">
                {{ $this->rows->links() }}
            </div>
        @endif
        {{-- / Pagination --}}
</div>
