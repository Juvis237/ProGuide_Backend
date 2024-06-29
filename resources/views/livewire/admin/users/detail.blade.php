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
                        <h4>{{$user->name}}</h4>
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
                        <h4>School Information</h4>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">School  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->school}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Faculty :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->faculty}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Department :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->department}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Level  :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->level}}</p>
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
            @if ($tab == 0)
            <div class="table-responsive">
                <table class="table table-bordered m-0">
        
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Delivrable</th>
                        <th>Mode</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->requests as $k=>$request)
                        <tr wire:key="{{$k}}">
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$request->user->name}}</td>
                            <td>{{$request->delivrable->name}} </td>
                            <td>{{$request->mode->name}}</td>
                            <td>
                                <div class="badge badge-{{$request->status}} p-2">{{ucfirst($request->status)}}</div>
                            </td>
                            <td>{{$request->assignedTo?->name}}</td>
                            <td>{{$request->created_at->format('d M Y')}}</td>
                            <td>{{isset($request->delivrable->duration)? $request->delivrable->duration : $request->mode->duration}} Days</td>
                            <td>
                                @if($request->status != 'assigned')
                                <a href="#" wire:click.prevent="$emitTo('admin.request.assign','load',{{$request}})"
                                   class="btn btn-default text-success"><i class="fa fa-pen"></i> Assign</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
        
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        <div>

        </div>
    </div>
    <livewire:admin.users.suspend />
    <livewire:admin.users.delete />
</div>

