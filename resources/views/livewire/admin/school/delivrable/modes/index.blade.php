<p class="sub-header">
    Delivrable Modes
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Duration/Days</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($delivrable->modes as $k=>$mode)
                <tr wire:key="{{$k}}">
                    <td>{{$k+1}}</td>
                    <td>{{$mode->name}}</td>
                    <td>{{$mode->price}}</td>
                    <td>{{$mode->duration}}</td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delivrable.mode.edit','load',{{$delivrable}}, {{$mode}})" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delivrable.mode.delete','load',{{$mode}})" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <livewire:admin.school.delivrable.modes.edit />
