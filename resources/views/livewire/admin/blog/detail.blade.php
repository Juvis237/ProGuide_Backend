<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">{{__('edits.blog_details')}}</h3>
            </div>
            <div>
                <a href="#" wire:click.prevent="$emitTo('admin.blog.publish','load',{{$blog}})"
                class="btn btn-secondary"> {{$blog->status==="published"?__('edits.unpublish'): __('edits.publish')}}</a>

                <a href="#"  wire:click.prevent="$emitTo('admin.blog.edit','load',{{$blog}})" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    {{__('edits.edit_blog')}}
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               {{$blog->byLocale()->title}}
           </h4>
           <span>
                <h5>{{__('edits.category')}}</h5>
                {{$blog->category->name}}
           </span>

           <span>
                    <h5>{{__('edits.status')}}</h5>
                    <div class="badge {{$blog->status == 'draft'? 'badge-draft' : 'badge-success'}}">
                        {{ucfirst($blog->status)}} </div>
            </span>

       </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <img class="img-fluid p-2" src="{{ $blog->coverImage() }}" >
            </div>
        </div>

        <h5>{{__('edits.type')}}</h5>
        {{ucfirst($blog->type)}}

        @if ($blog->type == 'podcast')
             <h5>{{__('edits.preview')}}</h5>
            <div class="col-12 ">
                {!! $blog->path !!}
            </div>
        @endif

        @if ($blog->type == 'video')
            <h5>{{__('edits.preview')}}</h5>
                <div class="row">
                    <div class="col-8 mx-1 mb-1" >
                        <iframe src="{{ $blog->url() }}" width="100%" height="400px"></iframe>
                    </div>
                </div>
            </div>
        @endif


        <h5>Description</h5>
        {!! $blog->byLocale()->description !!}


        <h5>{{__('edits.created_on')}}</h5>
        {{$blog->created_at}}

    <livewire:admin.blog.edit :type="$blog->type"  />
    <livewire:admin.blog.publish  />
</div>
