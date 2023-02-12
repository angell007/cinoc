<?php if((bool)$siteSetting->is_slider_active): ?>
<!-- Revolution slider start -->
<div class="tp-banner-container"> 
    <div class="tp-banner">
        <ul>
            <?php if(isset($sliders) && count($sliders)): ?>
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--Slide -->
            <li data-slotamount="7" data-transition="slotzoom-horizontal" data-masterspeed="1000" data-saveperformance="on"> <img alt="<?php echo e($slide->slider_heading); ?>" src="<?php echo e(asset('/')); ?>images/slider/dummy.png" data-lazyload="<?php echo e(ImgUploader::print_image_src('/slider_images/'.$slide->slider_image)); ?>">
                <div class="caption lft large-title tp-resizeme slidertext1" data-x="left" data-y="150" data-speed="600" data-start="1600"><?php echo e($slide->slider_heading); ?></div>
                <div class="caption lfb large-title tp-resizeme sliderpara" data-x="left" data-y="200" data-speed="600" data-start="2800"><?php echo $slide->slider_description; ?></div>
                <div class="caption lfb large-title tp-resizeme slidertext5" data-x="left" data-y="280" data-speed="600" data-start="3500"><a href="<?php echo e($slide->slider_link); ?>"><?php echo e($slide->slider_link_text); ?></a></div>
            </li>
            <!--Slide end-->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<!-- Revolution slider end -->
<!--Search Bar start-->
<div class="searchbar searchblack">
    <div class="container">
        <?php echo $__env->make('includes.search_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<!-- Search End -->
<?php else: ?>
<div class="searchwrap" style="background-image: url('<?php echo e(asset('images/IES-CINOC-PENSILVANIA.jpg')); ?>');">
<!--<div class="searchwrap" style="background-image: url('http://ek3eb.hosts.cx/6036e1120c880612536316.jpg');">-->
    <div class="container">
        <h3>LA IES CINOC EL MEJOR ALIADO PARA TRANSFORMAR COMUNIDADES<span></span></h3>

        <?php echo $__env->make('includes.search_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- button start 
        <div class="getstarted"><a href="<?php echo e(url('/')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Get Started Now')); ?></a></div>
        button end -->

    </div>
</div>
<?php endif; ?><?php /**PATH C:\laragon\www\cinoc\main\resources\views/includes/search.blade.php ENDPATH**/ ?>