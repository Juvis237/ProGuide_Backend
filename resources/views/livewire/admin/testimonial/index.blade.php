@section('title','Testimonial')
<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3>{{__('admin.testimonial')}}</h3>
            <a href="#"  wire:click.prevent="$emitTo('admin.testimonial.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                {{__('edits.add_testimonial')}}
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="{{__('tables.search')}}">
        </div>
    </div>
    <p class="sub-header">
        List of Testimonies
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>{{__('common.name')}}</th>
                <th>{{__('edits.company')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($testimonial as $k=>$testimonial)
                <tr wire:key="{{$k}}">
                    <td>{{$k+1}}</td>
                    <td>{{$testimonial->name}}</td>
                    <td>{{$testimonial->company}}</td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.testimonial.edit','load',{{$testimonial}})" class="btn btn-default text-primary"><i class="fa fa-pen"></i> {{__('edits.edit')}}</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.testimonial.delete','load',{{$testimonial}})" class="btn btn-default text-danger"><i class="fa fa-trash"></i> {{__('edits.delete')}}</a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">{{__('tables.no_entry')}}</td>
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

    <livewire:admin.testimonial.edit  />

    <livewire:admin.testimonial.delete  />
</div>
