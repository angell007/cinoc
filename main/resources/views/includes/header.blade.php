<div class="header sticky-top" style="    background-color: #fff;">

    <div class="container-fluid">

        <div class="row">



            <div class="col-lg-2 col-md-8 col-8 mx-auto">



                <a href="{{ url('/') }}" class="logo">



                    <img style="    width: 230px;     max-width: 120%;"
                        src="{{ url('/images/bannerescuelatecnologicav2.jpg') }}" alt="{{ $siteSetting->site_name }}" />



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

                <button class="navbar-toggler collapsed logo" type="button" data-toggle="collapse"
                    data-target="#nav-main" aria-controls="nav-main" aria-expanded="false"
                    aria-label="Toggle navigation">



                    <!--<a href="{{ url('/') }}" class="logo">-->

                    <img style="height: 60px; border-radius: 25%;" src="{{ url('/images/Logo-bolsa-de-empleo.png') }}"
                        alt="{{ $siteSetting->site_name }}" />

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





                            <li class="nav-item {{ Request::url() == route('index') ? 'active' : '' }}"><a
                                    href="{{ url('/') }}" class="nav-link "
                                    style="background-color: ##d46441;">Inicio</a> </li>

                            <li class="nav-item"><a
                                    href="https://iescinoc.edu.co/quienes-somos/" target="_blank" class="nav-link "
                                    style="background-color: ##d46441;">Quienes Somos</a> </li>

                            <li class="nav-item "><a href="https://bolsaempleo.iescinoc.edu.co/publicaciones"
                                    class="nav-link " style="background-color: ##d46441;"
                                    target="_blank">Publicaciones</a> </li>
                                    

                            @if (Auth::guard('company')->check())
                                <!-- <li class="nav-item"><a href="{{ url('/job-seekers') }}" class="nav-link">{{ __('Seekers') }}</a> </li> -->
                            @else
                                <li class="nav-item {{ Request::url() == url('/jobs') ? 'active' : '' }}"><a
                                        href="{{ url('/jobs') }}" class="nav-link">{{ __('Jobs') }}</a>

                                </li>
                            @endif



                            <li class="nav-item {{ Request::url() == url('/companies') ? 'active' : '' }}"><a
                                    href="{{ url('/companies') }}" class="nav-link">Empresas</a> </li>

                            @foreach ($show_in_top_menu as $top_menu)
                                @php $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug); @endphp

                                <!--   <li class="nav-item {{ Request::url() == route('cms', $top_menu->page_slug) ? 'active' : '' }}"><a href="{{ route('cms', $top_menu->page_slug) }}" class="nav-link">{{ $cmsContent->page_title }}</a> </li>

                           -->
                            @endforeach

                            <!--<li class="nav-item {{ Request::url() == route('blogs') ? 'active' : '' }}"><a href="{{ route('blogs') }}" class="nav-link">{{ __('Blog') }}</a> </li>-->

                            <li class="nav-item {{ Request::url() == route('contact.us') ? 'active' : '' }}"><a
                                    href="https://iescinoc.edu.co/pqrs/" target="_blank" class="nav-link">PQRS</a> </li>

                            @if (Auth::check())
                                <li class="nav-item dropdown userbtn"><a
                                        href="">{{ Auth::user()->printUserImage() }}</a>

                                    <ul class="dropdown-menu">

                                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><i
                                                    class="fa fa-tachometer" aria-hidden="true"></i>

                                                {{ __('Dashboard') }}</a> </li>

                                        <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link"><i
                                                    class="fa fa-user" aria-hidden="true"></i>

                                                {{ __('My Profile') }}</a> </li>

                                        <li class="nav-item"><a
                                                href="{{ route('view.public.profile', Auth::user()->id) }}"
                                                class="nav-link"><i class="fa fa-eye" aria-hidden="true"></i>

                                                {{ __('View Public Profile') }}</a> </li>

                                        <li><a href="{{ route('my.job.applications') }}" class="nav-link"><i
                                                    class="fa fa-desktop" aria-hidden="true"></i>

                                                {{ __('My Job Applications') }}</a> </li>

                                        <li class="nav-item"><a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();"
                                                class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i>

                                                {{ __('Logout') }}</a> </li>

                                        <form id="logout-form-header" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">

                                            {{ csrf_field() }}

                                        </form>

                                    </ul>

                                </li>
                            @endif

                            @if (Auth::guard('company')->check())
                                <li class="nav-item postjob"><a href="{{ route('post.job') }}"
                                        class="nav-link register">{{ __('Publicar una Oferta') }}</a> </li>

                                <li class="nav-item dropdown userbtn"><a
                                        href="">{{ Auth::guard('company')->user()->printCompanyImage() }}</a>

                                    <ul class="dropdown-menu">

                                        <li class="nav-item"><a href="{{ route('company.home') }}"
                                                class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i>

                                                {{ __('Dashboard') }}</a> </li>

                                        <li class="nav-item"><a href="{{ route('company.profile') }}"
                                                class="nav-link"><i class="fa fa-user" aria-hidden="true"></i>

                                                {{ __('Company Profile') }}</a></li>

                                        <li class="nav-item"><a href="{{ route('post.job') }}" class="nav-link"><i
                                                    class="fa fa-desktop" aria-hidden="true"></i>

                                                {{ __('Post Job') }}</a></li>

                                        <li class="nav-item"><a href="{{ route('company.messages') }}"
                                                class="nav-link"><i class="fa fa-envelope-o" aria-hidden="true"></i>

                                                {{ __('Company Messages') }}</a></li>

                                        <li class="nav-item"><a href="{{ route('company.logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();"
                                                class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i>

                                                {{ __('Logout') }}</a> </li>

                                        <form id="logout-form-header1" action="{{ route('company.logout') }}"
                                            method="POST" style="display: none;">

                                            {{ csrf_field() }}

                                        </form>

                                    </ul>

                                </li>
                            @endif

                            @if (!Auth::user() && !Auth::guard('company')->user())
                                <li class="nav-item {{ Request::url() == route('login') ? 'active' : '' }}"><a
                                        href="{{ route('login') }}" class="nav-link">{{ __('login') }}</a> </li>

                                <li class="nav-item"><a href="{{ route('register') }}"
                                        class="nav-link register">{{ __('Register') }}</a> </li>
                            @endif

                            <!-- <li class="dropdown userbtn"><a href="{{ url('/') }}"><img

                                        src="{{ asset('/') }}images/lang.png" alt="" class="userimg" /></a>

                                <ul class="dropdown-menu">

                                    @foreach ($siteLanguages as $siteLang)
<li><a href="javascript:;"

                                                onclick="event.preventDefault(); document.getElementById('locale-form-{{ $siteLang->iso_code }}').submit();"

                                                class="nav-link">{{ $siteLang->native }}</a>

                                            <form id="locale-form-{{ $siteLang->iso_code }}"

                                                action="{{ route('set.locale') }}" method="POST" style="display: none;">

                                                {{ csrf_field() }}

                                                <input type="hidden" name="locale" value="{{ $siteLang->iso_code }}" />

                                                <input type="hidden" name="return_url" value="{{ url()->full() }}" />

                                                <input type="hidden" name="is_rtl" value="{{ $siteLang->is_rtl }}" />

                                            </form>

                                        </li>
@endforeach

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

/*?>
?>@if (!Auth::user() && !Auth::guard('company')->user())
    <div class="">my dive 2</div>
@endif<?php */

?>
