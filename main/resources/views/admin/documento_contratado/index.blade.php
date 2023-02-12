@extends('admin.layouts.admin_layout')
@section('content')
    <div class="page-content-wrapper">
    <div class="page-content"> 
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Documentos contratado</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/documento_contratado/create') }}" class="btn btn-success btn-sm" title="Agregar nuevo">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                        </a>

                        <form method="GET" action="{{ url('/admin/documento_contratado') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Empresa</th><th>Candidato</th><th>Fecha</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($documento_contratado as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->company->name }}</td><td>{{ $item->candidate->first_name }} {{ $item->candidate->last_name }}</td><td>{{ $item->updated_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ url('/admin/documento_contratado/' . $item->id) }}" title="View documento_contratado"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/documento_contratado/' . $item->id . '/edit') }}" title="Edit documento_contratado"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/documento_contratado' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete documento_contratado" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $documento_contratado->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
