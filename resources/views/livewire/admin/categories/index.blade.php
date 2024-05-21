<div>
    <div class="mt-5">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
                <h3 class="text-capitalize">{{$type}} {{__('admin.categories')}}</h3>

                @if (isset($category_id))
                    <a href="#"  wire:click.prevent="$emitTo('admin.categories.add-sub','load', {{$category}})" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            {{__('edits.add_subcategory')}}
                        </div>
                    </a>
                @endif
                @if (!isset($category_id))
                    <a href="#"  wire:click.prevent="$emitTo('admin.categories.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            {{__('edits.add_category')}}
                        </div>
                    </a>
                @endif
            </div>
            <div class="col-md-6 col-lg-4">
                <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="{{__('tables.search')}}">
            </div>
        </div>
        <p class="sub-header">
            List of  categories
        </p>

        <div class="table-responsive">
            <table class="table table-bordered m-0">

                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('common.name')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $k=>$category)
                    <tr wire:key="{{$k}}">
                        <td>{{$k+1}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            @if ($category->type == 'product' && !isset($category->parent_id))
                                <a href="{{route('categories',['category'=>$category])}}" class="btn btn-default text-secondary"><i class="fa fa-pen"></i> {{__('edits.sub_category')}}</a>
                            @endif

                            <a href="#" wire:click.prevent="$emitTo('admin.categories.edit','load',{{$category}})" class="btn btn-default text-success"><i class="fa fa-pen"></i> {{__('edits.edit')}}</a>
                            <a href="#" wire:click.prevent="$emitTo('admin.categories.delete','load',{{$category}})" class="btn btn-default text-danger"><i class="fa fa-trash"></i> {{__('edits.delete')}}</a>
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

        <livewire:admin.categories.edit :type="$type" />
        <livewire:admin.categories.add-sub  />

        <livewire:admin.categories.delete  />
    </div>
</div>
