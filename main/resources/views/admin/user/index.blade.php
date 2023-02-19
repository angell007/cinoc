@extends('admin.layouts.admin_layout')
@section('content')
    <style type="text/css">
        .table td,
        .table th {
            font-size: 12px;
            line-height: 2.42857 !important;
        }
    </style>
    <div class="page-content-wrapper">
       
        <div class="page-content">
          
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.home') }}">Home
                        </a>
                        <i class="fa fa-circle">
                        </i>
                    </li>
                    <li>
                        <span>Estudiantes/Egresados
                        </span>
                    </li>
                </ul>
            </div>
           
            <h3 class="page-title">Gestión de estudiantes
                <small>estudiantes
                </small>
            </h3>
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}
                </p>
            @endif
           
            <div class="row">
                <div class="col-md-12">
                    <!--
                                Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark">
                                </i>
                                <span class="caption-subject font-dark sbold uppercase">estudiantes
                                </span>
                            </div>
                            <div class="actions"> <button type="button" class="btn btn-primary" data-toggle="modal"
                                    title="importar archivo para habilitación de registro " data-target="#fileModalUp"> <i
                                        class="fa fa-upload">
                                    </i> </button> <button type="button" class="btn btn-info"
                                    title="importar archivo para cambio de Rol " data-toggle="modal" title="upload data"
                                    data-target="#fileModalImport"> <i class="fa fa-upload">
                                    </i> </button> <a href="{{ route('create.user') }}" class="btn btn-xs btn-success">
                                    <i class="glyphicon glyphicon-plus">
                                    </i> Nuevo estudiante/egresado
                                </a> </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="user-search-form">
                                    <table class="table table-striped table-bordered table-hover" id="user_datatable_ajax">
                                        <thead>
                                            <tr role="row" class="filter">
                                                <td>
                                                    <input placeholder="ID" type="text" class="form-control"
                                                        name="id" id="id" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input placeholder="Identificación" type="text" class="form-control"
                                                        name="national_id_card_number" id="national_id_card_number"
                                                        autocomplete="off">
                                                </td>
                                                <td>
                                                    <input placeholder="Nombre" type="text" class="form-control"
                                                        name="name" id="name" autocomplete="off">
                                                </td>
                                
                                                <td>
                                                    <input placeholder="Email" type="text" class="form-control"
                                                        name="email" id="email" autocomplete="off">
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <input placeholder="Ciudad" type="text" class="form-control"
                                                        name="ciudad" id="ciudad" autocomplete="off">
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr role="row" class="heading">
                                                <th>Id
                                                </th>
                                                <th>Identificación
                                                </th>
                                                <th>Nombre
                                                </th>
                                                <th>Email
                                                </th>
                                                <th>Rol
                                                </th>
                                                <th>Ciudad
                                                </th>
                                                <th>Hoja de vida
                                                </th>
                                                <th>Carta de presentación
                                                </th>
                                                <th>Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!--
                                Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark">
                                </i>
                                <span class="caption-subject font-dark sbold uppercase">Documentos subidos <button
                                        type="button" class="btn btn-info" id="downloadids"
                                        title="Descargar todos los documentos" onclick="getXls()"> <i
                                            class="fa fa-download">
                                        </i> </button> </span>
                            </div>
                            <div class="actions"> </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="user-search-form">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="documents_datatable_ajax">
                                        <thead>
                                            <tr role="row" class="filter">
                                                <td>
                                                    <input placeholder="ID" type="text" class="form-control"
                                                        name="id" id="id" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input placeholder="Identificación" type="text"
                                                        class="form-control" name="national_id_card_number2"
                                                        id="national_id_card_number2" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input placeholder="Nombre" type="text" class="form-control"
                                                        name="name" id="name" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input placeholder="Email" type="text" class="form-control"
                                                        name="email" id="email" autocomplete="off">
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr role="row" class="heading">
                                                <th>Id
                                                </th>
                                                <th>Identificacion
                                                </th>
                                                <th>Nombre
                                                </th>
                                                <th>Email
                                                </th>
                                                <th>Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> @include('partials.modal') @include('partials.fileModalImport')
        <!--
    </div>
@endsection
