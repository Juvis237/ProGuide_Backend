@section('title', 'Pages')
<div class="row">
    <div class="col-lg-12">
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center  flex-wrap">
                <div class="col-md-6 col-lg-4 p-0 mb-4">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control"
                        placeholder="{{__('tables.search')}}">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered m-10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('tables.title')}}</th>
                            <th>{{__('tables.last_updated')}}</th>
                            <th>{{__('tables.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $k => $page)
                            <tr>
                                <td>{{ $k + 1 }}</td>
                                <td>{{ $page->byLocale()->title }}</td>
                                <td class="text-nowrap">{{ $page->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-secondary" href="#"
                                            wire:click.prevent = "$emitTo('admin.pages.edit', 'load', {{ $page }})">
                                            {{__('edits.edit')}}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination" style="justify-content: center;margin-top: 20px;">
            {{ $pages->links() }}
        </div>
    </div>
</div>
<livewire:admin.pages.edit />
