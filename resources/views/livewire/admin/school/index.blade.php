<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3>Schools</h3>
            <a href="#"  wire:click.prevent="$emitTo('admin.school.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                Add School
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="Search Here">
        </div>
    </div>
    <p class="sub-header">
        List of Schools
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>

                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($schools as $k=>$school)
                <tr wire:key="{{$k}}">
                    <td>{{$k+1}}</td>
                    <td>{{$school->name}}</td>
                    <td>
                        <a href="{{route('admin.school.details', $school)}}" class="btn btn-default text-secondary"><i
                            class="fa fa-eye"></i> View</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.edit','load',{{$school}})" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delete','load',{{$school}})" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
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

    <livewire:admin.school.edit  />

    <livewire:admin.school.delete  />
</div>
