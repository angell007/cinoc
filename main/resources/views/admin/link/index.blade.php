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
                    <li> <span>LINKs</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage LINKs <small>LINKs</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span
                                    class="caption-subject font-dark sbold uppercase">LINKs</span> </div>
                            <div class="actions">
                                <a href="{{ route('create.link') }}" class="btn btn-xs btn-success"><i
                                        class="glyphicon glyphicon-plus"></i> Add New LINK</a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="link-search-form">
                                    <table class="table table-striped table-bordered table-hover" id="link_datatable_ajax">
                                        <thead>
                                            <tr role="row" class="filter">
                                                <td>{!! Form::select('lang', ['' => 'Select Language'] + $languages, config('default_lang'), [
                                                    'id' => 'lang',
                                                    'class' => 'form-control',
                                                ]) !!}</td>
                                                <td><input type="text" class="form-control" name="link" id="link"
                                                        autocomplete="off"></td>
                                                <td><input type="text" class="form-control" name="text" id="text"
                                                        autocomplete="off"></td>
                                                <td></td>
                                            </tr>
                                            <tr role="row" class="heading">
                                                <th>Language</th>
                                                <th>Enlace</th>
                                                <th>Descripción</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#link_datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                /*		"order": [[0, "desc"]],
                 paging: true,
                 info: true,
                 */
                ajax: {
                    url: '{!! route('fetch.data.links') !!}',
                    data: function(d) {
                        d.lang = $('#lang').val();
                        d.link = $('input[name=link]').val();
                        d.text = $('input[name=text]').val();
                    }
                },
                columns: [
                    /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                    {
                        data: 'lang',
                        name: 'lang'
                    },
                    {
                        data: 'link',
                        name: 'link'
                    },
                    {
                        data: 'text',
                        name: 'text'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#link-search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#lang').on('change', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#link').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#text').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function delete_link(id) {
            if (confirm('Are you sure! you want to delete?')) {
                $.post("{{ route('delete.link') }}", {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        if (response == 'ok') {
                            var table = $('#link_datatable_ajax').DataTable();
                            table.row('link_dt_row_' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }
    </script>
@endpush
