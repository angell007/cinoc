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
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Estudiantes/Egresados</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Gestión de estudiantes <small>estudiantes</small> </h3>
        
        @if(Session::has('message'))
            <p class="alert {{Session::get('alert-class')}}">{{ Session::get('message') }}</p>
        @endif

        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">

                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">estudiantes</span> </div>
                        <div class="actions">

                            <button type="button" class="btn btn-primary" data-toggle="modal" title="importar archivo para habilitación de registro " data-target="#fileModalUp">
                            <i class="fa fa-upload"></i>
                            </button>
                            
                            <button type="button" class="btn btn-info" title="importar archivo para cambio de Rol " data-toggle="modal" title="upload data" data-target="#fileModalImport">
                            <i class="fa fa-upload"></i>
                            </button>

                            <a href="{{ route('create.user') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Nuevo estudiante/egresado </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="user-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="user_datatable_ajax">
                                    <thead>
                                        <tr role="row" class="filter">                  
                                            <td><input placeholder="ID" type="text" class="form-control" name="id" id="id" autocomplete="off"></td>                    
                                            <td><input placeholder="Identificación" type="text" class="form-control" name="national_id_card_number" id="national_id_card_number" autocomplete="off"></td>                    
                                            <td><input placeholder="Nombre" type="text" class="form-control" name="name" id="name" autocomplete="off"></td>
                                            <!--<td><input placeholder="" type="text" class="form-control" name="" id="" autocomplete="off"></td>-->
                                            <td><input placeholder="Email" type="text" class="form-control" name="email" id="email" autocomplete="off"></td>
                                            <td></td>
                                            <td><input placeholder="Ciudad" type="text" class="form-control" name="ciudad" id="ciudad" autocomplete="off"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading"> 
                                            <th>Id</th>                                        
                                            <th>Identificación</th>                                        
                                            <th>Nombre</th>
                                            <th>Email</th>                                        
                                            <th>Rol</th>                                        
                                            <th>Ciudad</th>                                        
                                            <th>Hoja de vida</th>                                        
                                            <th>Carta de presentación</th>                                        
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">

                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Documentos subidos
                        
                               <button type="button" class="btn btn-info" id="downloadids" title="Descargar todos los documentos" onclick="getXls()">
                                   <i class="fa fa-download"></i>
                               </button>

                        </span> 
                        
               
                        </div>
                        <div class="actions">

                           

                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="user-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="documents_datatable_ajax">
                                    <thead>
                                        <tr role="row" class="filter">                  
                                            <td><input placeholder="ID" type="text" class="form-control" name="id" id="id" autocomplete="off"></td>                    
                                            <td><input placeholder="Identificación" type="text" class="form-control" name="national_id_card_number2" id="national_id_card_number2" autocomplete="off"></td>                    
                                            <td><input placeholder="Nombre" type="text" class="form-control" name="name" id="name" autocomplete="off"></td>
                                            <td><input placeholder="Email" type="text" class="form-control" name="email" id="email" autocomplete="off"></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading"> 
                                            <th>Id</th>                                        
                                            <th>Identificacion</th>                                        
                                            <th>Nombre</th>
                                            <th>Email</th>                                        
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modal')
    @include('partials.fileModalImport')

    <!-- END CONTENT BODY --> 
</div>
@endsection
@push('scripts') 
<script>
    $(function () {
        var oTable = $('#user_datatable_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
               dom: 'lBrtip',
            pageLength: 25,
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            buttons: [
                'copy','csv','excel','pdf','print'
                ],
            "order": [[0, "desc"]],
            info: false,
            /*		
             paging: true,
             */
            ajax: {
                url: '{!! route('fetch.data.users') !!}',
                data: function (d) {
                    d.id = $('input[name=id]').val();
                    d.national_id_card_number = $('input[name=national_id_card_number]').val();
                    d.name = $('input[name=name]').val();
                    d.email = $('input[name=email]').val();
                    d.ciudad = $('input[name=ciudad]').val();
                }
            }, columns: [
                /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                {data: 'id', name: 'id'},
                {data: 'national_id_card_number', name: 'national_id_card_number'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'rol', name: 'rol'},
                {data: 'ciudad', name: 'ciudad'},
                 {
                    data:'cv',
                    name:'cv'
                },
                 {
                    data:'letter',
                    name:'letter'
                },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#user-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#id').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#email').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#ciudad').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#national_id_card_number').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    
    $(function () {
        var oTable = $('#documents_datatable_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
                dom: 'lBrtip',
            pageLength: 25,
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            buttons: [
                'copy','csv','excel','pdf','print'
                ],
            "order": [[0, "desc"]],
            info: false,
            /*		
             paging: true,
             */
            ajax: {
                url: '{!! route('fetch.data.documents') !!}',
                data: function (d) {
                    d.id = $('input[name=id]').val();
                    d.national_id_card_number2 = $('input[name=national_id_card_number2]').val();
                    d.name = $('input[name=name]').val();
                    d.email = $('input[name=email]').val();
                }
            }, columns: [
                /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                {data: 'id', name: 'id'},
                {data: 'national_id_card_number', name: 'national_id_card_number'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#user-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#id').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#email').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#national_id_card_number2').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    
    function delete_document(id) {
        if (confirm('Deseas eleminar este documento?')) {
            $.post("{{ route('delete.document') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#documents_datatable_ajax').DataTable();
                            table.row('document_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
    function delete_user(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete.user') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#user_datatable_ajax').DataTable();
                            table.row('user_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
    function make_active(id) {
        $.post("{{ route('make.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Make InActive");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function make_not_active(id) {
        $.post("{{ route('make.not.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Make Active");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function make_verified(id) {
        $.post("{{ route('make.verified.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_not_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Verified");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function make_not_verified(id) {
        $.post("{{ route('make.not.verified.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Not Verified");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    
    
      function getXls(){
          
          console.log('obtain xls');
          
                fetch('./get-xls')
                .then(response => response.blob())
                .then((blob )=>{ 
                    
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = "Documentos.xlsx";
            document.body.appendChild(a); // we need to append the element to the dom -> otherwise it will not work in firefox
            a.click();    
            a.remove();  //afterwards we remove the element again 
                    
                })
            }
            
            
</script> 
@endpush