<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
  <head>
    <title><?php echo e($title); ?> | <?php echo e(config('app.name')); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/fav.ico')); ?>" />

    <?php echo $__env->make('auth.layouts.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Helpers -->
    <script src="<?php echo e(asset('assets/vendor/js/helpers.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/js/helpers.js')); ?>"></script>
  </head>

  <body>
    
    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('auth.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  </body>
</html>
<?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/auth/layouts/app.blade.php ENDPATH**/ ?>