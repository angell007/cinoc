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
                    <li> <a href="{{ route('admin.home') }}">Inicio</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Lista de Participantes</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Gestionar Participantes <small>Admin</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span
                                    class="caption-subject font-dark sbold uppercase">Participantes</span> </div>
                            <div class="actions">
                                <button data-toggle="modal" data-target="#fileModalUploaded" class="btn btn-xs btn-success">
                                    <i class="fa fa-user"></i> Agregar participante </button>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover" id="admin_participants_ajax">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <!--<th><input type="checkbox" class="group-checkable"></th>-->
                                            <th>Nombre</th>
                                            <th>Contacto</th>
                                            <th>Email</th>
                                            <th>Documento</th>
                                            <th>Semestre</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.fileModalUploaded')

    </div>
@endsection
@push('scripts')
    <script>
    
    
    let id = window.location.pathname.split("/").pop()
    
        $(function() {
            $('#admin_participants_ajax').DataTable({
                "order": [
                    [0, "asc"]
                ],
                processing: true,
                serverSide: true,
                stateSave: true,
                /*
                 searching: false,
                 paging: true,
                 info: true,
                 */
                ajax: '{!! route('get-list-participants', ['id' => $id]) !!}',
                columns: [
                    /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'identifier',
                        name: 'identifier'
                    },
                    {
                        data: 'semester',
                        name: 'semester'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

        $('#form').on('submit', function(e) {

            e.preventDefault();
            
                var data={
                name: $('#name').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
                semester: $('#semester').val(),
                identifier: $('#id_number').val(),
                status: $('#status').val(),
                trainings_id: id,
                //add other properties similarly
                }


            $.post("{{ route('upload-participant') }}", {
                     data: data,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {

                   if(response) window.location.reload();


                });

        })
    </script>
@endpush
