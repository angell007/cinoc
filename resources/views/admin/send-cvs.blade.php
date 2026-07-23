@extends('admin.layouts.admin_layout')

@section('content')
    <div class="page-content-wrapper">

        <div class="page-content">

            <div class="row ">

                <div class="col-md-12">

                    <div class="card">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="portlet light portlet-fit portlet-datatable bordered">

                                    <div class="portlet-title">

                                        <div class="caption"> <i class="icon-pencil font-dark"></i> <span
                                                class="caption-subject font-dark sbold uppercase">Hojas de vida
                                                remitidas</span> </div>

                                        <div class="actions">

                                            <button data-toggle="modal" data-target="#fileModalUpCv"
                                                class="btn btn-xs btn-success">

                                                <i class="fa fa-user"></i> Subir información </button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="table">

                                <table class="table" id="cvusers">

                                    <thead>

                                        <tr>

                                            <th scope="col">Fecha </th>
                                            <th scope="col">Empresa </th>
                                            <th scope="col">Oferta</th>
                                            <th scope="col">Candidato </th>
                                            <th scope="col"># Identificación</th>
                                            <th scope="col">Programa </th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Contacto </th>
                                            <th scope="col">Poblacion </th>
                                            <th scope="col">Rol </th>
                                            <th scope="col">Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>

                            <br />

                            <br />

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @include('partials.fileModalUpCv')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {

            $('#cvusers').DataTable({

                "order": [
                    [0, "asc"]
                ],

                processing: true,

                serverSide: true,

                stateSave: true,

                ajax: '{!! route('get-cvs-sended') !!}',

                columns: [{
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'company',
                        name: 'company'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'id_number',
                        name: 'id_number'
                    },
                    {
                        data: 'programa',
                        name: 'programa'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'contacto',
                        name: 'contacto'
                    },
                    {
                        data: 'segmento',
                        name: 'segmento'
                    },
                    {
                        data: 'rol',
                        name: 'rol'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
