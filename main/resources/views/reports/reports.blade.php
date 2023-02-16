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

        <!-- BEGIN CONTENT BODY -->

        <div class="page-content">

            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE BAR -->

            <div class="page-bar">

                <ul class="page-breadcrumb">

                    <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>

                    <li> <span>Reportes</span> </li>

                </ul>

            </div>

            <!-- END PAGE BAR -->

            <!-- BEGIN PAGE TITLE-->

            <h3 class="page-title">Gestión de Reportes <small>Reportes</small> </h3>

            <!-- END PAGE TITLE-->

            <!-- END PAGE HEADER-->

            <div class="row">

                <div class="col-md-12">

                    <!-- Begin: life time stats -->

                    <div class="portlet light portlet-fit portlet-datatable bordered">

                        <div class="portlet-title">

                            <div class="caption"> <i class="icon-settings font-dark"></i> <span
                                    class="caption-subject font-dark sbold uppercase">Reportes</span> </div>

                        </div>

                        <div class="portlet-body">

                            <div class="table-container">



                                <form action="{{ route('download.reports') }}" method="POST" role="form" class="row"
                                    id="datatable-search-form">

                                    @csrf

                                    <div class="col-md-12 form-group">

                                        <select name="tipo reporte" class="custom-select form-control">

                                            <option value="1">Reporte Estudiantes </option>

                                            <option value="2">Reporte Compañias</option>

                                            <option value="3">Reporte Ofertas </option>

                                            <option value="4">Reporte Egresados </option>

                                            <option value="5">Reporte Contratados</option>

                                            <option value="6">Reporte Aplicados</option>

                                            <option value="7">Reporte Entrevistados</option>

                                            <option value="8">Reporte Remitidos</option>

                                            <option value="9">Reporte Ofertas TXT </option>

                                            <option value="10">Reporte Oferentes TXT Mensual </option>

                                            <option value="11">Reporte Oferentes TXT Semestral </option>

                                            <option value="12">Reporte Practicas Laborales TXT</option>

                                        </select>

                                    </div>

                                    <div class="col-md-6 form-group">

                                        <label for="formGroupExampleInput">Fecha inicio</label>

                                        <input name="inicio" type="date" class="form-control"
                                            id="formGroupExampleInput">

                                    </div>

                                    <div class="col-md-6 form-group">

                                        <label for="formGroupExampleInput2">Fecha fin</label>

                                        <input name="fin" type="date" class="form-control"
                                            id="formGroupExampleInput2">

                                    </div>

                                    <div class="col-md-6 form-group">

                                        <button type="submit" class="btn btn-primary">Descargar</button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- END CONTENT BODY -->

    </div>
@endsection
