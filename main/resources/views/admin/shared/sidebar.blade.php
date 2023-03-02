<div class="page-sidebar navbar-collapse collapse">



    <ul class="page-sidebar-menu page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

        <li class="sidebar-toggler-wrapper hide">

            <div class="sidebar-toggler"> </div>

        </li>

        <li class="sidebar-search-wrapper"></li>



        <li class="nav-item start active"> <a href="{{ route('admin.home') }}" class="nav-link"> <i class="icon-home"></i> <span class="title">Inicio</span> </a> </li>



        @if(APAuthHelp::hasPermission('admin'))

        @include('admin/shared/side_bars/admin_user')

        @endif



        <li class="heading">

            <h3 class="uppercase">Modulos</h3>

        </li>



        @if(APAuthHelp::hasPermission('job'))

        @include('admin/shared/side_bars/job')

        @endif

        

        @if(APAuthHelp::hasPermission('publicaciones'))



         <li class="">

                <a href="https://bolsaempleo.iescinoc.edu.co/publicaciones" class="nav-link text text-white" target="_blank"> <i class="fa fa-bell"></i> <span class="title">Publicaciones</span> </a> 

        </li>

        

        @endif



        @if(APAuthHelp::hasPermission('company'))

        @include('admin/shared/side_bars/company')

        @endif



        @if(APAuthHelp::hasPermission('site_user'))

        @include('admin/shared/side_bars/site_user')

        @endif



        @if(APAuthHelp::hasPermission('reportes'))

        @include('admin/shared/side_bars/reportes')

        @endif



        @if(APAuthHelp::hasPermission('language'))

        <li class="heading">

            <h3 class="uppercase">Lenguajes</h3>

        </li> @include('admin/shared/side_bars/language')

        @endif





        <li class="heading">

            <h3 class="uppercase">Documentos</h3>

        </li>



        @if(APAuthHelp::hasPermission('plantilla'))

        <li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-globe" aria-hidden="true"></i> <span class="title">Plantilla</span> <span class="arrow"></span> </a>

            <ul class="sub-menu">

                <li class="nav-item  "> <a href="{{ url('/admin/template_contrato') }}" class="nav-link "> <span class="title">Lista</span> </a> </li>

            </ul>

        </li>

        @endif





        @if(APAuthHelp::hasPermission('doc-contratados'))

        <li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-globe" aria-hidden="true"></i> <span class="title">Documento de Contratados</span> <span class="arrow"></span> </a>

            <ul class="sub-menu">

                <li class="nav-item  "> <a href="{{ url('/admin/documento_contratado') }}" class="nav-link "> <span class="title">Lista</span> </a> </li>

            </ul>

        </li>

        @endif

        

        @if(APAuthHelp::hasPermission('send-alerts'))

        <li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-globe" aria-hidden="true"></i> <span class="title">Envio de cvs</span> <span class="arrow"></span> </a>

            <ul class="sub-menu">

                <li class="nav-item  "> <a href="{{ url('/admin/send-cvs') }}" class="nav-link "> <span class="title">Inicio</span> </a> </li>

            </ul>

        </li>

        @endif



        @if(APAuthHelp::hasPermission('doc-pasanias'))

        <li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-globe" aria-hidden="true"></i> <span class="title">Documento de pasantía</span> <span class="arrow"></span> </a>

            <ul class="sub-menu">

                <li class="nav-item  "> <a href="{{ url('/admin/documento_pasantias') }}" class="nav-link "> <span class="title">Lista</span> </a> </li>

            </ul>

        </li>

        @endif



        @if(APAuthHelp::hasPermission('localidades'))

        <li class="heading">

            <h3 class="uppercase">Localidades</h3>

        </li>

        @include('admin/shared/side_bars/country')

        @include('admin/shared/side_bars/country_detail')

        @include('admin/shared/side_bars/state')

        @include('admin/shared/side_bars/city')

        @endif


        @if(APAuthHelp::hasPermission('packages'))

        <li class="heading">

            <h3 class="uppercase">User Packages</h3>

        </li>

        @endif



        @if(APAuthHelp::hasPermission('package'))

        @include('admin/shared/side_bars/package')

        @endif





        @if(APAuthHelp::hasPermission('attr-trabajo'))

        <li class="heading">

            <h3 class="uppercase">Atributos de trabajo</h3>

        </li>

        @endif



        @if(APAuthHelp::hasPermission('language_level'))

        @include('admin/shared/side_bars/language_level')

        @endif



        @if(APAuthHelp::hasPermission('career_level'))

        @include('admin/shared/side_bars/career_level')

        @endif



        @if(APAuthHelp::hasPermission('functional_area'))

        @include('admin/shared/side_bars/functional_area')

        @endif



        @if(APAuthHelp::hasPermission('gender'))

        @include('admin/shared/side_bars/gender')

        @endif



        @if(APAuthHelp::hasPermission('industry'))

        @include('admin/shared/side_bars/industry')

        @endif



        @if(APAuthHelp::hasPermission('job_experience'))

        @include('admin/shared/side_bars/job_experience')

        @endif



        @if(APAuthHelp::hasPermission('job_skill'))

        @include('admin/shared/side_bars/job_skill')

        @endif





        @if(APAuthHelp::hasPermission('job_type'))

        @include('admin/shared/side_bars/job_type')

        @endif



        @if(APAuthHelp::hasPermission('job_shift'))

        @include('admin/shared/side_bars/job_shift')

        @endif



        @if(APAuthHelp::hasPermission('degree_level'))

        @include('admin/shared/side_bars/degree_level')

        @endif



        @if(APAuthHelp::hasPermission('degree_type'))

        @include('admin/shared/side_bars/degree_type') --

        @endif



        @if(APAuthHelp::hasPermission('major_subject'))

        @include('admin/shared/side_bars/major_subject')

        @endif



        @if(APAuthHelp::hasPermission('result_type'))

        @include('admin/shared/side_bars/result_type') --

        @endif



        @if(APAuthHelp::hasPermission('marital_status'))

        @include('admin/shared/side_bars/marital_status')

        @endif



        @if(APAuthHelp::hasPermission('marital_status_real'))

        @include('admin/shared/side_bars/marital_status_real')

        @endif



        @if(APAuthHelp::hasPermission('ownership_type'))

        @include('admin/shared/side_bars/ownership_type')

        @endif



        @if(APAuthHelp::hasPermission('salary_period'))

        @include('admin/shared/side_bars/salary_period')

        @endif



        @if(APAuthHelp::hasPermission('site'))

        @include('admin/shared/side_bars/site_setting')

        @endif



        <li class="heading">

            <h3 class="uppercase">Manage</h3>

            @if(APAuthHelp::hasPermission('gestion'))

            @include('admin/shared/side_bars/gestion')

            @include('admin/shared/side_bars/trainings')

            @include('admin/shared/side_bars/faq')

            @include('admin/shared/side_bars/video')

            @include('admin/shared/side_bars/links')

            @include('admin/shared/side_bars/seo')

            @endif

        </li>





    </ul>



</div>