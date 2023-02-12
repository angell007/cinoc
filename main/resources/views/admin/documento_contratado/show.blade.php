@extends('admin.layouts.admin_layout')
@section('content')

<div class="page-content-wrapper">
    <div class="page-content"> 
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Documento contratado {{ $documento_contratado->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/documento_contratado') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras </button></a>
                        <a href="{{ url('/admin/documento_contratado/' . $documento_contratado->id . '/edit') }}" title="Edit documento_contratado"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar </button></a>

                        <form method="POST" action="{{ url('admin/documento_contratado' . '/' . $documento_contratado->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete documento_contratado" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar </button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $documento_contratado->id }}</td>
                                    </tr>
                                    <tr><th> Empresa </th><td> {{ $documento_contratado->id_empresa }} </td></tr><tr><th> Id Candidato </th><td> {{ $documento_contratado->id_candidato }} </td></tr><tr><th> Fecha </th><td> {{ $documento_contratado->fecha }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
