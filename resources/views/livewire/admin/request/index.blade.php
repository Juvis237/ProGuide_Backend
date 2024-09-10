<div>
    
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h3 class="text-capitalize">User Requests</h3>

    </div>

    <div class="rounded-lg bg-white p-2 py-4">
        <div class="d-flex justify-content-end">
            <div>
                <select name="" wire:model='filters.status' class="form-control rounded-md " id="">
                    <option value="">Status</option>
                    @foreach (\App\Models\Request::STATUS as $item)
                        <option value="{{$item}}">{{strtoupper($item)}}</option>
                    @endforeach
                </select>
            </div>

            <div class=" mb-3 mx-2">
                <div class="">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                           placeholder="Type to Search">
                </div>
            </div>
        </div>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Delivrable</th>
                <th>Mode</th>
                <th>Status</th>
                <th>Scan Copy</th>
                <th>Assigned To</th>
                <th>Date</th>
                <th>Duration</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $k=>$request)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$request->user->name}}</td>
                    <td>{{$request->delivrable->name}} </td>
                    <td>{{$request->mode->name}}</td>
                    <td>
                        <div class="badge badge-success p-2">{{ucfirst($request->status)}}</div>
                    </td>
                    <td>
                        {{$request->scan_copy? 'Yes' : 'No'}}
                    </td>
                    <td>{{$request->assignedTo?->name}}</td>
                    <td>{{$request->created_at->format('d M Y')}}</td>
                    <td>{{isset($request->delivrable->duration)? $request->delivrable->duration : $request->mode->duration}} Days</td>
                    <td>
                        <div class="d-flex">
                            <div class="button-list">
                                <a href="{{route('admin.request.detail', $request)}}" class="btn btn-primary"><i
                                    class="fa fa-eye"></i> </a>
                            </div>
                            @if($request->status != 'assigned')
                            <a href="#" wire:click.prevent="$emitTo('admin.request.assign','load',{{$request}})"
                               class="btn btn-default text-success"><i class="fa fa-pen"></i> Assign</a>
                            @endif
                        </div>


                    </td>
                </tr>
            @endforeach

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
    <livewire:admin.request.assign  />
</div>
