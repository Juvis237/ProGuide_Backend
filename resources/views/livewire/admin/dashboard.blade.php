<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h5 class="text-capitalize breadcrumb-heading">{{__('admin.dashboard')}}</h5>
        </div>
        <nav class="breadcrumb-nav" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item" aria-current="page" style="color: #026BCF;">{{__('admin.dashboard')}}</li>
            </ol>
        </nav>
    </div>
    <div class="justify-content-between">
        <div class="row">
            @include(
                'components.card',
                with([
                    'link' => route('requests'),
                    'icon' => asset('images/icon_request_received.svg'),
                    'title' => __('admin.total_requests'),
                    'figure' => $requestCount,
                ]))
            @include(
                'components.card',
                with([
                    'link' => route('admin.dashboard'),
                    'icon' => asset('images/business_service.svg'),
                    'title' => __('admin.business_services'),
                    'figure' => $businesServiceCount,
                ]))
            @include(
                'components.card',
                with([
                    'link' => route('index.user', ['type' => 'client']),
                    'icon' => asset('images/user.svg'),
                    'title' => __('admin.total_users'),
                    'figure' => $UserCount,
                ]))
            @include(
                'components.card',
                with([
                    'link' => route('index.user', ['type' => 'worker']),
                    'icon' => asset('images/user.svg'),
                    'title' => __('admin.total_admins'),
                    'figure' => $adminUserCount,
                ]))
            @include(
                'components.card',
                with([
                    'link' => route('pages.index'),
                    'icon' => asset('images/pages.svg'),
                    'title' => __('admin.pages'),
                    'figure' => $pageCount,
                ]))
            @include(
                'components.card',
                with([
                    'link' => route('blogs'),
                    'icon' => asset('images/blog.svg'),
                    'title' => __('admin.blogs'),
                    'figure' => $blogCount,
                ]))
            @include(
                'components.card',
                with([
                    'link' => route('testimonial'),
                    'icon' => asset('images/testimonails.svg'),
                    'title' => __('admin.testimonials'),
                    'figure' => $testimonialCount,
                ]))
            @include(
                'components.card',
                with([
                    'link' => route('faqs'),
                    'icon' => asset('images/faqs.svg'),
                    'title' => 'FAQS',
                    'figure' => $faqCount,
                ]))
        </div>
    </div>
</div>
