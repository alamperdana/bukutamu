<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="light-style <?php if(auth()->guard()->check()): ?> layout-navbar-fixed layout-menu-fixed <?php endif; ?>"
    dir="ltr" data-theme="theme-default" data-assets-path="<?php echo e(asset('assets/')); ?>">

<head>
    <title> <?php echo e(config('app.name')); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/fav.ico')); ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/fonts/fontawesome.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/fonts/tabler-icons.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/fonts/flag-icons.css')); ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/rtl/core.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/rtl/theme-default.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/demo.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/loading.css')); ?>" />

    <!-- CSS Libraries -->
    <?php echo $__env->yieldPushContent('cssLibrary'); ?>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/node-waves/node-waves.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/typeahead-js/typeahead.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/apex-charts/apex-charts.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/izitoast/css/iziToast.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/animate-css/animate.css')); ?>" />

    <!-- Page-Specific CSS -->
    <?php echo $__env->yieldPushContent('css'); ?>
    <style>
        /* Sembunyikan menu & navbar saat guest */
        .no-menu .layout-menu,
        .no-navbar .layout-navbar { display: none !important; }

        /* Lebarkan area konten saat guest */
        .no-menu .layout-page { margin-left: 0 !important; padding-left: 0 !important; width: 100% !important; }
        .no-menu .content-wrapper { margin-left: 0 !important; }
        .no-navbar .layout-page { padding-top: 0 !important; }
        .no-navbar .content-wrapper { padding-top: 0 !important; width: 100% !important; }

        /* Jika template Anda biasa memakai container-xxl,
            hilangkan batasan max-width saat guest */
        .no-navbar .content-wrapper .container-xxl {
            max-width: none !important;
            width: 100% !important;
        }
    </style>

    <!-- Helpers -->
    <script src="<?php echo e(asset('assets/vendor/js/helpers.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/config.js')); ?>"></script>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper <?php if(auth()->guard()->check()): ?> layout-content-navbar <?php endif; ?>">
        <div class="layout-container <?php if(auth()->guard()->guest()): ?> no-menu <?php endif; ?>">

            <!-- Menu -->
            <?php if(auth()->guard()->check()): ?>
                <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page <?php if(auth()->guard()->guest()): ?> no-navbar <?php endif; ?>">
                <!-- Navbar -->
                <?php if(auth()->guard()->check()): ?>
                    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Modal -->
                    <div class="modal fade" id="modal_action" data-bs-backdrop="static" tabindex="-1"></div>
                    <!-- / Modal -->
                    
                    <!-- Content -->
                    <?php echo $__env->yieldContent('content'); ?>
                    <!-- / Content -->

                    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- preloader -->
        <div class="preloader" style="visibility:hidden;">
            <div class="lds-ellipsis">
                <div></div><div></div><div></div><div></div>
            </div>
        </div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:jsassets/vendor/js/core.js -->
    <script src="<?php echo e(asset('assets/vendor/libs/jquery/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/node-waves/node-waves.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/izitoast/js/iziToast.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/hammer/hammer.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/i18n/i18n.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/typeahead-js/typeahead.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/js/menu.js')); ?>"></script>
    <!-- endbuild -->


    <!-- Vendors JS -->
    <script src="<?php echo e(asset('assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/sweetalert/sweetalert.all.js')); ?>"></script>

    <!-- Stack for JavaScript Libraries -->
    <?php echo $__env->yieldPushContent('jsLibrary'); ?>

    <!-- Main JS -->
    <script src="<?php echo e(asset('assets/js/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

    <!-- Page JS -->
    <script src="<?php echo e(asset('assets/js/tables-datatables-extensions.js')); ?>"></script>

    <!-- Stack for custom JavaScript per page -->
    <?php echo $__env->yieldPushContent('js'); ?>

    <!-- SweetAlert scripts -->
    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/layouts/app.blade.php ENDPATH**/ ?>