@extends('admin.layouts.admin_layout')

@section('content')

<style type="text/css">

    .table td, .table th {

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

                <li> <span>Lista de Capacitaciones</span> </li>

            </ul>

        </div>

        <!-- END PAGE BAR --> 

        <!-- BEGIN PAGE TITLE-->

        <h3 class="page-title"> Gestionar Capacitaciones  <small>Admin</small> </h3>

        <!-- END PAGE TITLE--> 

        <!-- END PAGE HEADER-->

        <div class="row">

            <div class="col-md-12"> 

                <!-- Begin: life time stats -->

                <div class="portlet light portlet-fit portlet-datatable bordered">

                    <div class="portlet-title">

                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Capacitaciones</span> </div>
                        
                        <div class="actions">

                            <button data-toggle="modal"  data-target="#fileModalUpTrainings" class="btn btn-xs btn-success"> <i class="fa fa-upload"></i> Agregar nueva </button>

                        </div>

                        

                    </div>

                    <div class="portlet-body">

                        <div class="table-container">

                            <table class="table table-striped table-bordered table-hover"  id="admin_user_datatable_ajax">

                                <thead>

                                    <tr role="row" class="heading"> 

                                      <!--<th><input type="checkbox" class="group-checkable"></th>-->

                                        <th>Nombre</th>

                                        <th>Tipo</th>

                                        <th>Fecha</th>

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

    

     @include('partials.modalImportsTrainingsCompany')

     

    <!-- END CONTENT BODY --> 

</div>

@endsection

@push('scripts') 

<script>



            function delete_training(id) {

     

                        var data={trainings_id: id}

    

                        $.post("{{ route('delete-training-company') }}", {

                                 data: data,

                                _method: 'POST',

                                _token: '{{ csrf_token() }}'

                            })

                            .done(function(response) {

            

                              if(response) window.location.reload();

            

                            });



             }

        

        

    $(function () {

        $('#admin_user_datatable_ajax').DataTable({

            "order": [[0, "asc"]],

            processing: true,

            serverSide: true,

            stateSave: true,

            /*

             searching: false,

             paging: true,

             info: true,

             */

            ajax: '{!! route("get-list-trainings-company") !!}',

            columns: [

                {data: 'name', name: 'name'},

                {data: 'type', name: 'type'},

                {data: 'created_at', name: 'created_at'},

                {data: 'action', name: 'action', orderable: false, searchable: false}

            ]

        });

    });

    

</script> 

@endpush