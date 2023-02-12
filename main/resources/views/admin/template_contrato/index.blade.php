@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">



            <div class="col-md-12">
                <!-- <div class="card"> -->

                <div class="card-header">Gestión de emails</div>

                <hr>

                <!-- <div class="card-body"> -->
                
                    @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                    @endif
                    
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                    <ul>
                    <li>{!! \Session::get('success') !!}</li>
                    </ul>
                    </div>
                    @endif

                <form method="GET" action="{{ route('send-mail') }}" accept-charset="UTF-8" class="" role="search">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Seleccione plantilla</label>
                            <select class="sidebar-pos-option form-control custom-select input-sm" name="plantilla">
                                @foreach ($templates as $template)
                                <option value="{{$template->id}}" selected="selected">{{$template->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Seleccione Empresa</label>

                            <select class="sidebar-pos-option form-control custom-select input-sm" name="company">
                                @foreach ($companies as $company)
                                <option value="{{$company->id}}" selected="selected">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Seleccione Estudiante</label>

                            <select class="sidebar-pos-option form-control custom-select input-sm" name="user">
                                @foreach ($users as $user)
                                <option value="{{$user->id}}" selected="selected">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 mt-2">
                            <input type="submit" class="btn btn-info " value="Enviar Email">
                        </div>
                    </div>
                </form>

                <br />
                <br />
                <!-- </div> -->

                <!-- </div> -->
            </div>

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Plantilas en el sistema </div>


                    <div class="card-body">
                        <a href="{{ url('/admin/template_contrato/create') }}" class="btn btn-success btn-sm" title="Nueva plantilla">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                        </a>

                        <form method="GET" action="{{ url('/admin/template_contrato') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Html</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($template_contrato as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td><?php echo $item->html;  ?></td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <!--<a href="{{ url('/admin/template_contrato/' . $item->id) }}" title="View template_contrato"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Ver</button></a>-->
                                            <!--<a href="{{ url('/admin/template_contrato/' . $item->id . '/edit') }}" title="Edit template_contrato"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>-->

                                            <form method="POST" action="{{ url('/admin/template_contrato' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete template_contrato" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>Eliminiar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $template_contrato->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection