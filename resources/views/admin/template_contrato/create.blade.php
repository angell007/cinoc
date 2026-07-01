@extends('admin.layouts.admin_layout')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.4.25/jodit.min.css"/>
    <div class="page-content-wrapper">
    <div class="page-content"> 
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Crear Un Nuevo Contrato</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/template_contrato') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/template_contrato') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.template_contrato.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts') 

<script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.4.25/jodit.min.js"></script>
<!-- Initialize the editor. -->
<script>
var editor = new Jodit('#editor');
editor.value = '<p>Escriba aca su nuevo template</p>';
</script>
@endpush