

<?php $__env->startSection('content'); ?>

<!-- Header start -->

<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Header end --> 

<!-- Search start -->

<?php echo $__env->make('includes.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Search End --> 

<!-- Top Employers start -->

<?php echo $__env->make('includes.top_employers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Top Employers ends --> 

<!-- Popular Searches start -->

<?php echo $__env->make('includes.popular_searches', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Popular Searches ends --> 

<!-- Featured Jobs start -->

<?php echo $__env->make('includes.featured_jobs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Featured Jobs ends -->

<!-- Login box start -->

<?php echo $__env->make('includes.login_text', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Login box ends --> 

<!-- How it Works start -->

<?php echo $__env->make('includes.how_it_works', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- How it Works Ends -->

<!-- Latest Jobs start -->

<?php echo $__env->make('includes.latest_jobs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Latest Jobs ends --> 

<!-- Testimonials start -->

<?php echo $__env->make('includes.testimonials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Testimonials End -->

<!-- Video start -->

<?php echo $__env->make('includes.video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Video end --> 

<!-- Login box start -->

<?php echo $__env->make('includes.employer_login_text', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Login box ends --> 

<!-- Testimonials start -->

<?php echo $__env->make('includes.home_blogs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Testimonials End -->

<!-- Subscribe start -->

<?php echo $__env->make('includes.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Subscribe End -->

<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?> 

<script>

    console.log('hola');

    $(document).ready(function ($) {

        $("form").submit(function () {

            $(this).find(":input").filter(function () {

                return !this.value;

            }).attr("disabled", "disabled");

            return true;

        });

        $("form").find(":input").prop("disabled", false);

    });

</script>

<?php echo $__env->make('includes.country_state_city_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\cinoc\main\resources\views/welcome.blade.php ENDPATH**/ ?>