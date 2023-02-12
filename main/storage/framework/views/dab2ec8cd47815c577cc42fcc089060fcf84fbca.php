<div class="header sticky-top" style="    background-color: #fff;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-2 col-md-8 col-8 mx-auto"> 
            
               <a href="<?php echo e(url('/')); ?>" class="logo">
                
                <img style="    width: 230px;     max-width: 120%;" src="<?php echo e(url('/images/bannerescuelatecnologicav2.jpg')); ?>" alt="<?php echo e($siteSetting->site_name); ?>" />
                
                </a>
                <!--<div class="navbar-header navbar-white">-->
                <!--    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>-->
                <!--</div>-->
                <div class="clearfix"></div>
            </div>
            
            <!--<div class="col-lg-1 col-md-1 col-1 mx-auto"> -->
            <!--    <div class="navbar-header navbar-white">-->
            <!--        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation"> <i class="fa fa-bars"></i> </span> </button>-->
            <!--    </div>-->
            <!--    <div class="clearfix"></div>-->
            <!--</div>-->
            
            <div class=" col-lg-2 col-md-4 col-4 mx-auto"> 
            <button class="navbar-toggler collapsed logo"  type="button" data-toggle="collapse" data-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation">
            
               <!--<a href="<?php echo e(url('/')); ?>" class="logo">-->
                <img  style="height: 60px; border-radius: 25%;" src="<?php echo e(url('/images/Logo-bolsa-de-empleo.png')); ?>" alt="<?php echo e($siteSetting->site_name); ?>" />
                <!--</a>-->
            
             </button>
                <div class="clearfix"></div>
            </div>
            
            <div class="col-lg-8 col-md-12 col-12">

                <!-- Nav start -->
                <nav class="navbar navbar-expand-lg navbar-white" style="    margin-top: 20px;">

                    <div class="navbar-collapse collapse" id="nav-main">
                        <ul class="navbar-nav ml-auto">

                            <!-- <li>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#fileModalUp">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </li> -->


                            <li class="nav-item <?php echo e(Request::url() == route('index') ? 'active' : ''); ?>"><a href="<?php echo e(url('/')); ?>" class="nav-link " style="background-color: ##d46441;">Inicio</a> </li>
                            
                            
                            <li class="nav-item "><a href="https://bolsaempleo.iescinoc.edu.co/publicaciones" class="nav-link " style="background-color: ##d46441;" target="_blank">Publicaciones</a> </li>


                            <?php if(Auth::guard('company')->check()): ?>
                            <!-- <li class="nav-item"><a href="<?php echo e(url('/job-seekers')); ?>" class="nav-link"><?php echo e(__('Seekers')); ?></a> </li> -->
                            <?php else: ?>
                            <li class="nav-item <?php echo e(Request::url() == url('/jobs') ? 'active' : ''); ?>"><a href="<?php echo e(url('/jobs')); ?>" class="nav-link"><?php echo e(__('Jobs')); ?></a>
                            </li>
                            <?php endif; ?>

                            <li class="nav-item <?php echo e(Request::url() == url('/companies') ? 'active' : ''); ?>"><a href="<?php echo e(url('/companies')); ?>" class="nav-link">Empresas</a> </li>
                            <?php $__currentLoopData = $show_in_top_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $cmsContent
                            = App\CmsContent::getContentBySlug($top_menu->page_slug); ?>
                            <!--   <li class="nav-item <?php echo e(Request::url() == route('cms', $top_menu->page_slug) ? 'active' : ''); ?>"><a href="<?php echo e(route('cms', $top_menu->page_slug)); ?>" class="nav-link"><?php echo e($cmsContent->page_title); ?></a> </li>
                           -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!--<li class="nav-item <?php echo e(Request::url() == route('blogs') ? 'active' : ''); ?>"><a href="<?php echo e(route('blogs')); ?>" class="nav-link"><?php echo e(__('Blog')); ?></a> </li>-->
                            <li class="nav-item <?php echo e(Request::url() == route('contact.us') ? 'active' : ''); ?>"><a href="https://iescinoc.edu.co/pqrs/" target="_blank" class="nav-link">PQRS</a> </li>
                            <?php if(Auth::check()): ?>
                            <li class="nav-item dropdown userbtn"><a href=""><?php echo e(Auth::user()->printUserImage()); ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="<?php echo e(route('home')); ?>" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <?php echo e(__('Dashboard')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('my.profile')); ?>" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i>
                                            <?php echo e(__('My Profile')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('view.public.profile', Auth::user()->id)); ?>" class="nav-link"><i class="fa fa-eye" aria-hidden="true"></i>
                                            <?php echo e(__('View Public Profile')); ?></a> </li>
                                    <li><a href="<?php echo e(route('my.job.applications')); ?>" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i>
                                            <?php echo e(__('My Job Applications')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i>
                                            <?php echo e(__('Logout')); ?></a> </li>
                                    <form id="logout-form-header" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>
                                    </form>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::guard('company')->check()): ?>
                            <li class="nav-item postjob"><a href="<?php echo e(route('post.job')); ?>" class="nav-link register"><?php echo e(__('Publicar una Oferta')); ?></a> </li>
                            <li class="nav-item dropdown userbtn"><a href=""><?php echo e(Auth::guard('company')->user()->printCompanyImage()); ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="<?php echo e(route('company.home')); ?>" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <?php echo e(__('Dashboard')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('company.profile')); ?>" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i>
                                            <?php echo e(__('Company Profile')); ?></a></li>
                                    <li class="nav-item"><a href="<?php echo e(route('post.job')); ?>" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i>
                                            <?php echo e(__('Post Job')); ?></a></li>
                                    <li class="nav-item"><a href="<?php echo e(route('company.messages')); ?>" class="nav-link"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            <?php echo e(__('Company Messages')); ?></a></li>
                                    <li class="nav-item"><a href="<?php echo e(route('company.logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i>
                                            <?php echo e(__('Logout')); ?></a> </li>
                                    <form id="logout-form-header1" action="<?php echo e(route('company.logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>
                                    </form>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <?php if(!Auth::user() && !Auth::guard('company')->user()): ?>
                            <li class="nav-item <?php echo e(Request::url() == route('login') ? 'active' : ''); ?>"><a href="<?php echo e(route('login')); ?>" class="nav-link"><?php echo e(__('login')); ?></a> </li>
                            <li class="nav-item"><a href="<?php echo e(route('register')); ?>" class="nav-link register"><?php echo e(__('Register')); ?></a> </li>
                            <?php endif; ?>
                            <!-- <li class="dropdown userbtn"><a href="<?php echo e(url('/')); ?>"><img
                                        src="<?php echo e(asset('/')); ?>images/lang.png" alt="" class="userimg" /></a>
                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $siteLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siteLang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="javascript:;"
                                                onclick="event.preventDefault(); document.getElementById('locale-form-<?php echo e($siteLang->iso_code); ?>').submit();"
                                                class="nav-link"><?php echo e($siteLang->native); ?></a>
                                            <form id="locale-form-<?php echo e($siteLang->iso_code); ?>"
                                                action="<?php echo e(route('set.locale')); ?>" method="POST" style="display: none;">
                                                <?php echo e(csrf_field()); ?>
                                                <input type="hidden" name="locale" value="<?php echo e($siteLang->iso_code); ?>" />
                                                <input type="hidden" name="return_url" value="<?php echo e(url()->full()); ?>" />
                                                <input type="hidden" name="is_rtl" value="<?php echo e($siteLang->is_rtl); ?>" />
                                            </form>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li> -->
                        </ul>

                        <!-- Nav collapes end -->

                    </div>
                    <div class="clearfix"></div>
                </nav>

                <!-- Nav end -->

            </div>
        </div>

        <!-- row end -->

    </div>

    <!-- Header container end -->

</div>

<?php
/*?>@if (!Auth::user() && !Auth::guard('company')->user())
    <div class="">my dive 2</div>
@endif<?php */
?><?php /**PATH C:\laragon\www\cinoc\main\resources\views/includes/header.blade.php ENDPATH**/ ?>