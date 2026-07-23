@extends('admin.layouts.admin_layout')
@section('content')
    <div class="page-content-wrapper">
    <div class="page-content"> 
       
           
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Jobs</span> </li>
            </ul>
        </div>


        <h3 class="page-title">Manage Jobs <small>Jobs</small> </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">template_contrato {{ $template_contrato->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/template_contrato') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/template_contrato/' . $template_contrato->id . '/edit') }}" title="Edit template_contrato"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/template_contrato' . '/' . $template_contrato->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete template_contrato" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $template_contrato->id }}</td>
                                    </tr>
                                    <tr><th> Nombre </th><td> {{ $template_contrato->nombre }} </td></tr><tr><th> Html </th><td> {{ $template_contrato->html }} </td></tr><tr><th> Status </th><td> {{ $template_contrato->status }} </td></tr>
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
