<div>
    <h4>{{$user->role=="client"?"User":"Business"}} Details</h4>
    <div class="row mt-2">
        <div class="col-12 col-lg-4 ">
            <div class="row d-flex align-items-center py-4 px-2 bg-white rounded-lg shadow-sm mx-2">
                <div class=" col-12 col-md-4">
                        <img class="bg-white  signature-image" style="max-width:  100px"
                        src="{{ !isset($user->profile)?  asset('be_assets/images/Frame 75.png') : asset('storage/'.$user->profile) }}">
                </div>
                <div class="col-12 col-md-6">
                    <span>
                        <h4>{{$user->first_name}}</h4>
                        <li class="text-primary font-weight-bold">{{ucfirst($user->role)}}</li>
                        <div class="d-flex mt-2">
                            <a class="btn border border-primary rounded  text-primary {{$user->role == 'client'? 'd-none' : ''}}" href="{{route('edit.user', ['user' => $user->id])}}">
                                {{__('edits.edit')}} 
                            </a>
                            <button class="mx-1 btn btn-warning " wire:click.prevent="$emitTo('admin.users.suspend','load',{{$user}})">
                                {{$user->status != 2? 'Suspend' : 'Unsuspend'}}
                            </button>
                            <button class="btn btn-danger ms-2 {{$user->role == 'client'? 'd-none' : ''}}" wire:click.prevent="$emitTo('admin.users.delete','load',{{$user}})">
                                {{__('edits.delete')}} 
                            </button>
                        </div>

                    </span>
                </div>
                <div class="col-12 my-2">
                    <span>
                        <div class="d-flex align-items-center ">
                            <p class="font-weight-bold font-16 text-dark">{{__('edits.status')}} </p>
                            <div class=" p-2 mx-2 rounded-lg badge badge-{{$user->status == '1' ? 'success' : 'processing'}}" style="margin-top: -5px">
                                {{$user->status == '1' ? 'Active' : 'Inactive'}}
                            </div>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">{{__('common.email')}}  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->email}}</p>
                        </div>
                        <div class="d-flex align-items-center ">
                            <p class="font-weight-bold font-16 text-dark">{{__('common.phone')}}  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->phone}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Address :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->address}}</p>
                        </div>

                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">{{__('edits.joined_on')}}  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->created_at}}</p>
                        </div>
                        
                    </span>

                    <div class="{{$user->role == 'client'? 'd-none': ''}} pt-4 border-top">
                        <h4>Businness Information</h4>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">{{__('edits.company')}}  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->company_name}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Bio :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->bio}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">{{__('edits.location')}}  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->address}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">{{__('edits.website')}}  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->website}}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-12 col-lg-8   py-4 px-2 bg-white rounded-lg shadow-sm">
            <div class="d-flex overflow-auto">
                @foreach ($menus as $menu)
                    <a href="{{route('user.detail', ['user' => $user, 'tab' => $loop->index])}}" class="hover-overlay text-dark">
                        <div class="px-4 py-1 d-flex align-items-center {{$tab == $loop->index? 'border-bottom  border-primary' : ''}} ">
                            <p class="font-weight-bold {{$tab == $loop->index? 'text-primary' : ''}} font-16 ">{{$menu}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div>

        </div>
    </div>
    <livewire:admin.users.suspend />
    <livewire:admin.users.delete />
</div>

