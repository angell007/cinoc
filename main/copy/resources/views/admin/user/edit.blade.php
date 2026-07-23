@extends('admin.layouts.admin_layout')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.home') }}">Inicio</a>
                        <i class="fa fa-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('list.users') }}">Usuarios</a>
                        <i class="fa fa-chevron-right"></i>
                    </li>
                    <li>
                        <span>Editar usuario</span>
                    </li>
                </ul>
            </div>
            
            <h1 class="page-title">Editar usuario</h1>
            
            @include('flash::message')
            
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-user font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Información del usuario</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="nav nav-tabs nav-tabs-line">
                                <li class="active">
                                    <a href="#Details" data-toggle="tab">
                                        <i class="fa fa-user"></i> Perfil
                                    </a>
                                </li>
                                <li>
                                    <a href="#Summary" data-toggle="tab">
                                        <i class="fa fa-file-text-o"></i> Resumen
                                    </a>
                                </li>
                                <li>
                                    <a href="#CV" data-toggle="tab">
                                        <i class="fa fa-file-pdf-o"></i> C.V
                                    </a>
                                </li>
                                <li>
                                    <a href="#Projects" data-toggle="tab">
                                        <i class="fa fa-tasks"></i> Proyectos
                                    </a>
                                </li>
                                <li>
                                    <a href="#Experience" data-toggle="tab">
                                        <i class="fa fa-briefcase"></i> Experiencia
                                    </a>
                                </li>
                                <li>
                                    <a href="#Education" data-toggle="tab">
                                        <i class="fa fa-graduation-cap"></i> Educación formal
                                    </a>
                                </li>
                                <li>
                                    <a href="#NonFormalEducation" data-toggle="tab">
                                        <i class="fa fa-certificate"></i> Educación no formal
                                    </a>
                                </li>
                                <li>
                                    <a href="#Skills" data-toggle="tab">
                                        <i class="fa fa-star"></i> Habilidades
                                    </a>
                                </li>
                                <li>
                                    <a href="#Languages" data-toggle="tab">
                                        <i class="fa fa-language"></i> Idiomas
                                    </a>
                                </li>
                                <li>
                                    <a href="#Pass" data-toggle="tab">
                                        <i class="fa fa-lock"></i> Contraseña
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="Details">
                                    @include('admin.user.forms.form')
                                </div>
                                <div class="tab-pane fade" id="Summary">
                                    @include('admin.user.forms.summary')
                                </div>
                                <div class="tab-pane fade" id="CV">
                                    @include('admin.user.forms.cv.cvs')
                                </div>
                                <div class="tab-pane fade" id="Projects">
                                    @include('admin.user.forms.project.projects')
                                </div>
                                <div class="tab-pane fade" id="Experience">
                                    @include('admin.user.forms.experience.experience')
                                </div>
                                <div class="tab-pane fade" id="Education">
                                    @include('admin.user.forms.education.education')
                                </div>
                                <div class="tab-pane fade" id="NonFormalEducation">
                                    @include('admin.user.forms.non_formal_education.education')
                                </div>
                                <div class="tab-pane fade" id="Skills">
                                    @include('admin.user.forms.skill.skills')
                                </div>
                                <div class="tab-pane fade" id="Languages">
                                    @include('admin.user.forms.language.languages')
                                </div>
                                <div class="tab-pane fade" id="Pass">
                                    @include('admin.user.pass.change')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
