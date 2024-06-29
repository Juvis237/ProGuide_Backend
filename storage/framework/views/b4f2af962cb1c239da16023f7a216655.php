<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title><?php echo $__env->yieldContent('pageTitle', config('app.name')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo e(asset('be_assets')); ?>/images/prologo.png
">

    <link href="<?php echo e(asset('be_assets')); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"
          id="bootstrap-stylesheet"/>
    <link href="<?php echo e(asset('be_assets')); ?>/libs/select2/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('be_assets')); ?>/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('be_assets')); ?>/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="<?php echo e(asset('be_assets/css/toastr.css')); ?>" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="<?php echo e(asset('be_assets')); ?>/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('be_assets/css/toastr.css')); ?>" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <?php echo \Livewire\Livewire::styles(); ?>

    <style>
        .error {
            color: #ff0000;
            font-size: 12px;
        }

        .menu-custom {
            padding: 20px !important;
        }

        .btn {
            padding: 0.25rem 0.5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        [x-cloak] {
            display: none !important;
        }

        .overlay, .cover {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background: black;
            opacity: 0.75;
        }

        .user-box .user-info {
            z-index: 10;
        }

        .modal {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            overflow-y: scroll;
            z-index: 1000;
            width: 100%;
            height: 100%;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .modal-inner {
            background-color: white;
            border-top: 20px #FF5E14 solid;
            border-radius: 0.5em;
            max-width: 1000px;
            width: 1000px;
            padding: 2em;
            margin: auto;
        }

        .btn.focus, .btn:focus {
            box-shadow: none;
        }

    </style>

</head>

<body>

<!-- Begin page -->
<div id="wrapper" class="w-100">


    <!-- Topbar Start -->
    <div class="navbar-custom bg-white">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.notifications', [])->html();
} elseif ($_instance->childHasBeenRendered('hihjfto')) {
    $componentId = $_instance->getRenderedChildComponentId('hihjfto');
    $componentTag = $_instance->getRenderedChildComponentTagName('hihjfto');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hihjfto');
} else {
    $response = \Livewire\Livewire::mount('admin.notifications', []);
    $html = $response->html();
    $_instance->logRenderedChild('hihjfto', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="<?php echo e(auth()->user()->profile? asset('storage/'.auth()->user()->profile)  : asset('be_assets/images/users/avatar-1.jpg')); ?>" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                                   <?php echo e(auth()->user()->user_name); ?>

                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                    <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item notify-item">
                        Logout
                    </a>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="<?php echo e(route('home')); ?>" class="logo text-center logo-dark">
                        <span class="logo-lg">

                            <img src="<?php echo e(asset('be_assets')); ?>/images/prologo.png" alt="" height="60">
                            <!-- <span class="logo-lg-text-dark">Simple</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">S</span> -->
                            <img src="<?php echo e(asset('be_assets')); ?>/images/prologo.png" alt="" height="22">

                        </span>
            </a>

            <a href="<?php echo e(route('home')); ?>" class="logo text-center logo-light">
                        <span class="logo-lg">

                            <img src="<?php echo e(asset('be_assets')); ?>/images/prologo.png" alt="" height="60">

                            <!-- <span class="logo-lg-text-light">Simple</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-lg-text-light">S</span> -->
                            <img src="<?php echo e(asset('be_assets')); ?>/images/prologo.png" alt="" height="22">

                        </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>
    </div>
    <!-- end Topbar --> <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">


        <div class="user-box">
            <div class="float-left">
                <img src="<?php echo e(auth()->user()->profile? asset('storage/'.auth()->user()->profile) : asset('be_assets/images/users/avatar-1.jpg')); ?>" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="user-info">
                <a href="#"><?php echo e(auth()->user()->user_name); ?></a>
                <p class="text-muted m-0">Administrator</p>
            </div>
        </div>

        <div id="sidebar-menu">

            <ul class="metismenu menu-custom" id="side-menu">
                <li>
                    <a href="<?php echo e(route('home')); ?>">
                        <i class="fa fa-home"></i>
                        <span> Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.schools')); ?>">
                        <i class="fa fa-university"></i>
                        <span> Schools</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('requests')); ?>">
                        <i class="fa fa-question"></i>
                        <span> Requests</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('index.user', ['type' => 'client'])); ?>">
                        <i class="fa fa-users"></i>
                        <span> Users</span>
                    </a>
                </li>

             
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-list"></i>
                            <span>Categories</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level " style="">

                            <li><a href="<?php echo e(route('categories',['type'=>'blog'])); ?>"><i class=""></i>Blogs
                                    Categories</a></li>
                            <li><a href="<?php echo e(route('categories',['type'=>'faq'])); ?>"><i class=""></i>FAQ
                                    Categories</a></li>

                        </ul>
                    </li>
                    <li><a href="<?php echo e(route('constant.index')); ?>"><i class="fa fa-question-circle"></i><span>Constants</span> </a></li>
            

            
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-info-circle"></i>
                            <span>About</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" style="">
                            <li><a href="<?php echo e(route('testimonial')); ?>"><i class=""></i>Testimonials</a></li>
                            <li><a href="<?php echo e(route('pages.index')); ?>"><i class=""></i>Page content</a></li>

                        </ul>
                    </li>
      

                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-registered"></i>
                        <span>Resource</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level " style="">
                            <li><a href="<?php echo e(route('blogs',['type'=>'text'])); ?>"><i class=""></i>Blog</a></li>
                
                            <li><a href="<?php echo e(route('faqs')); ?>"><i class=""></i>FAQ</a></li>


                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-user"></i>
                        <span>Profile</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level " style="">
                        <li><a href="<?php echo e(route('change-password')); ?>"><i class=""></i>Change Password</a></li>
                        <li><a href="<?php echo e(route('update-profile')); ?>"><i class=""></i>Update Profile</a></li>

                    </ul>
                </li>

            </ul>


        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>


    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start container-fluid -->
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
                <?php echo e($slot ?? ""); ?>

            </div>
            <!-- end container-fluid -->


            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2023 &copy; <?php echo $__env->yieldContent('pageTitle', config('app.name')); ?>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- end content -->

    </div>
    <!-- END content-page -->

</div>


<!-- END wrapper -->

<!-- Vendor js -->
<script src="<?php echo e(asset('be_assets')); ?>/js/vendor.min.js"></script>
<script src="<?php echo e(asset('be_assets')); ?>/js/app.min.js"></script>
<script src="<?php echo e(asset('be_assets/js/toastr.min.js')); ?>"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.tiny.cloud/1/o5hnd9kr5x850u6dajws5zd4nhm8pk8vobbhdheqjhxqp5ov/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

<?php echo \Livewire\Livewire::scripts(); ?>


<script>
    $(function () { //ready

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "hideDuration": "1000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        Livewire.on('success', message => {
            toastr.success(message);
        })

        <?php if(session()->has('success')): ?>
        toastr.success('<?php echo e(session()->get("success")); ?>');
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
        toastr.error('<?php echo e(session()->get("error")); ?>');
        <?php endif; ?>

        Livewire.on('error', message => {
            toastr.error(message);

        })

    });
</script>
<?php echo $__env->yieldContent('script'); ?>

</body>

</html>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>