<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <head>
        <meta charset="utf-8" />
        <title> <?php echo $__env->yieldContent('title'); ?> | Universitas Muhammadiyah Makassar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta content="Hukum Keluarga (Ahwal Syaksiyah) Universitas Muhammadiyah Makassar" name="description" />
        <meta content="M Hamdani Ilham Latjoro" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(URL::asset('logo.png')); ?>">
        <?php echo $__env->make('layouts.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>

    <?php echo $__env->yieldContent('body'); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.vendor-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH /Users/hamdaniilham/Laravel/ahwal-syaksiyah/resources/views/layouts/master-without-nav.blade.php ENDPATH**/ ?>