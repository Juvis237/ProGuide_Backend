<div>
    
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h3 class="text-capitalize">{{$type}}</h3>
        <a href="#"  wire:click.prevent="$emitTo('admin.blog.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
            {{__('edits.add_blog')}}
        </a>
    </div>

    <div class="rounded-lg bg-white p-2 py-4">
        <div class="d-flex justify-content-end">
            <div class="mx-2">
                <select name="" class="form-control rounded-md " id="">
                    <option value="">{{__('edits.category')}}</option>
                </select>
            </div>
            <div>
                <select name="" class="form-control rounded-md " id="">
                    <option value="">{{__('edits.status')}}</option>
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
                <th>{{__('tables.title')}}</th>
                <th>{{__('edits.category')}}</th>
                <th>{{__('edits.status')}}</th>
                <th>{{__('tables.created_on')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($blogs as $k=>$blog)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td><a href="{{route('blog.detail', $blog)}}" class="text-primary">{{$blog->byLocale()->title}}</a></td>
                    <td>{{$blog->category->name}} </td>
                    <td><div class="badge {{$blog->status == 'draft'? 'badge-draft' : 'badge-success'}}">
                        {{ucfirst($blog->status)}} </div></td>
                    <td>{{$blog->created_at->format('d M Y')}}</td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.blog.publish','load',{{$blog}})"
                        class="btn btn-default text-primary"><i class="fas fa-refresh"></i>  {{$blog->status==="published"?"un-Publish":"Publish"}}</a>
                        <a href="{{route('blog.detail', $blog)}}" class="btn btn-default text-secondary"><i
                                class="fa fa-eye"></i> View</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.blog.edit','load',{{$blog}})"
                           class="btn btn-default text-success"><i class="fa fa-pen"></i> {{__('edits.edit')}}</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.blog.delete','load',{{$blog}})"
                           class="btn btn-default text-danger"><i class="fa fa-trash"></i> {{__('edits.delete')}}</a>

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

    <livewire:admin.blog.edit :type="$type"  />
    <livewire:admin.blog.delete  />
    <livewire:admin.blog.publish  />
</div>

