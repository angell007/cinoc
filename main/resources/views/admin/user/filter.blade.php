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
        <!--
    BEGIN CONTENT BODY -->
        <div class="page-content">
            <!--
    BEGIN PAGE HEADER-->
            <!--
    BEGIN PAGE BAR -->
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
            <!--
    END PAGE BAR -->
            <!--
    BEGIN PAGE TITLE-->
            <h3 class="page-title">Gestión de estudiantes
                <small>estudiantes
                </small>
            </h3>
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}
                </p>
            @endif
            <!--
    END PAGE TITLE-->
            <!--
    END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!--
    Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark">
                                </i>
                                <span class="caption-subject font-dark sbold uppercase">Estudiantes
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="card bg-info">
                            <div class="form-group col-md-2"> <select class="form-control" id="select" name="select">
                                    <option>Edad
                                    </option>
                                    <option>Carrera
                                    </option>
                                </select> </div>
                            <div class="form-group col-md-3"> <input type="text" class="form-control" id="value"
                                    name="value"> </div>
                        </div>
                        <hr>
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
        </div>
        <!--
    END CONTENT BODY -->
    </div>
@endsection
@push('scripts')
<script>
    $(function() {
        var oTable = $('#user_datatable_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            dom: 'lBrtip',
            pageLength: 25,
            lengthMenu: [
                [25, 100, -1],
                [25, 100, "All"]
            ],
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            "order": [
                [0, "desc"]
            ],
            info: false,
            /* paging: true, */ ajax: {
                url: '{!! route('fetch.data.filter') !!}',
                data: function(d) {
                    d.id = $('input[name=id]').val();
                    d.national_id_card_number = $('input[name=national_id_card_number]').val();
                    d.name = $('input[name=name]').val();
                    d.email = $('input[name=email]').val();
                    d.ciudad = $('input[name=ciudad]').val();
                    d.select = $('select[name=select]').val();
                    d.value = $('input[name=value]').val();
                }
            },
            columns: [{
                data: 'id',
                name: 'id'
            }, {
                data: 'national_id_card_number',
                name: 'national_id_card_number'
            }, {
                data: 'name',
                name: 'name'
            }, {
                data: 'email',
                name: 'email'
            }, {
                data: 'rol',
                name: 'rol'
            }, {
                data: 'ciudad',
                name: 'ciudad'
            }, {
                data: 'cv',
                name: 'cv'
            }, {
                data: 'letter',
                name: 'letter'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });
        $('#user-search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#id').on('keyup', function(e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function(e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#email').on('keyup', function(e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#ciudad').on('keyup', function(e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#national_id_card_number').on('keyup', function(e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#value').on('keyup', function(e) {
            oTable.draw();
            e.preventDefault();
        });
    });
</script>
@endpush
