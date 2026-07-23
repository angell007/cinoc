@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">documento_pasantia {{ $documento_pasantia->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/documento_pasantias') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/documento_pasantias/' . $documento_pasantia->id . '/edit') }}" title="Edit documento_pasantia"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/documento_pasantias' . '/' . $documento_pasantia->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete documento_pasantia" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $documento_pasantia->id }}</td>
                                    </tr>
                                    <tr><th> Id Empresa </th><td> {{ $documento_pasantia->id_empresa }} </td></tr><tr><th> Id Candidato </th><td> {{ $documento_pasantia->id_candidato }} </td></tr><tr><th> Fecha </th><td> {{ $documento_pasantia->fecha }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
