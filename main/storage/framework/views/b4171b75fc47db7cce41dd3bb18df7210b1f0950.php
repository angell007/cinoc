

<?php $__env->startSection('content'); ?>
<!-- Header start -->
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Header end --> 
<!-- Inner Page Title start -->
<?php echo $__env->make('includes.inner_page_title', ['page_title'=>__('Page Not Found')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Inner Page Title end -->
<div class="about-wraper"> 
    <!-- About -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?php echo e(__('Page Not Found')); ?></h2>
                <p><?php echo e(__('Sorry, the page you are looking for could not be found')); ?></p>
            </div>      
        </div>
    </div>  
</div>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\cinoc\main\resources\views/errors/404.blade.php ENDPATH**/ ?>