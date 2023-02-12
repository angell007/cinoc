@extends('admin.layouts.admin_layout')
@section('content')


    <div class="page-content-wrapper">
    <div class="page-content"> 
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Editar documento contratado #{{ $documento_contratado->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/documento_contratado') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras </button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/documento_contratado/' . $documento_contratado->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.documento_contratado.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
