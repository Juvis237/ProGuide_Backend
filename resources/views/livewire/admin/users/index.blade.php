<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Manage Users</h4>
    </div>


    <div class="d-flex justify-content-end flex-column flex-lg-row">
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

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>{{__('common.name')}}</th>
                <th>{{__('common.phone')}}</th>
                <th>{{__('common.email')}}</th>
                <th>Role</th>
                <th>{{__('common.region')}}</th>
                <th>{{__('common.city')}}</th>
                <th>{{__('edits.joined_on')}}</th>
                <th>{{__('edits.status')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $k=>$user)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->phone}}
                    </td>
                    <td>{{$user->email}} </td>
                    <td>{{$user->role  }} </td>
                    <td>
                        {{isset($user->region)?$user->region->name:""}}
                    </td>
                    <td>
                        {{isset($user->city)?$user->city->city:""}}
                    </td>
                    <td>{{$user->created_at}} </td>
                    <td class="p-2">
                        <div class=" p-2 rounded-lg badge badge-{{$user->status == '1' ? 'success' : 'processing'}}">
                            {{$user->status == '1' ? 'Active' : 'Inactive'}}
                        </div>
                         </td>
                    <td>
                        <div class="d-flex">
                            <div class="button-list">
                                <a href="{{route('user.detail', $user)}}" class="btn btn-primary"><i
                                    class="fa fa-eye"></i> </a>
                            </div>
                            <div class="button-list ml-1">
                                <a href="#" wire:click.prevent="$emitTo('admin.users.delete','load',{{$user}})" class="btn btn-danger "><i
                                    class="fa fa-trash"></i> </a>
                            </div>
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

        {{-- Pagination --}}
        @if($this->rows->count())
            <div class="mt-5">
                {{ $this->rows->links() }}
            </div>
        @endif
        {{-- / Pagination --}}
        <livewire:admin.users.delete />   
</div>
