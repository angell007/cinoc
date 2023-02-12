@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Gestión de permisos</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->        
        <!-- END PAGE HEADER-->
        <br />
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Permisos</span> </div>
                    </div>
                    
                    <form action="{{route('save-permissions')}}" method="post">
                        @csrf
                        <div class="form-group">
                                
                                    <div class="row justify-content-center">
                                        

                                        @foreach($permissions as $permiso)
                                        
                                        
                                            <div class="col-md-3">
                                                
                                            <div class="form-check">
                                                <input type="checkbox" name="permisos[{{$permiso->id}}]" <?php echo (in_array($permiso->name , $misPermissions))  ? 'checked' : ''; ?> class="form-check-input" id="{{$permiso->name}}">
                                                <label class="form-check-label" for="{{$permiso->name}}">{{__( ucfirst($permiso->description))}}</label>
                                              </div>
                                              
                                              </div>
                                              
                                        @endforeach
                                        
                                        
                                        <input type="hidden" name="id" value="{{$id}}">
                                        
                                      
                                    
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-info"> Guardar permisos </button>
                                    <div class="w-100"></div>
                                    </div >
                                      
                    
                     </div >
                 </form >
                </div >
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>
@endsection
