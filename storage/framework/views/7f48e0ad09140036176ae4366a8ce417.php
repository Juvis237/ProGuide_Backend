<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | <?php echo e(config('app.name')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('be_assets')); ?>/images/favicon.ico">
    <!-- App css -->
    <link href="<?php echo e(asset('be_assets')); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?php echo e(asset('be_assets')); ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('be_assets')); ?>/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4 mt-3">
                            <a href="">
                                <span><img src="<?php echo e(asset('be_assets')); ?>/images/prologo.png" alt="" height="70"></span>

                            </a>

                        </div>

                        <form action="<?php echo e(route('admin.login')); ?>" method="post" class="p-2">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" name="email" required="" placeholder="john@deo.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-4 pb-3">
                                <div class="custom-control custom-checkbox checkbox-primary">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Sign In </button>
                            </div>
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="<?php echo e(asset('be_assets')); ?>/js/vendor.min.js"></script>

<!-- App js -->
<script src="<?php echo e(asset('be_assets')); ?>/js/app.min.js"></script>

</body>

</html>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>