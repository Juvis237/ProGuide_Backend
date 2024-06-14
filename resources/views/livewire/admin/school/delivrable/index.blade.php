<p class="sub-header">
    school Delivrables
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Number Of Modes</th>
                <th>Duration/days</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($school->delivrables as $k=>$del)
                <tr wire:key="{{$k}}">
                    <td>{{$k+1}}</td>
                    <td>{{$del->name}}</td>
                    <td>{{$del->price}}</td>
                    <td>{{$del->modes->count()}}</td>
                    <td>{{$del->duration}}</td>
                    <td>
                        <a href="{{route('admin.delivrable.details', $del)}}" class="btn btn-default text-secondary"><i
                            class="fa fa-eye"></i> View</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delivrable.edit','load',{{$school}}, {{$del}})" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.schooldelivrable.delete','load',{{$del}})" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
