{!! Form::model($company, array('method' => 'put', 'route' => array('update.company.profile'), 'class' => 'form', 'files'=>true)) !!}
<h5>Información de la Empresa</h5>

<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'email') !!}">
            <label>{{__('Email')}}</label>
            <label class="text">{{$company->email}}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'password') !!}">
            <label>{{__('Password')}}</label>
            {!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>__('Password'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'password') !!}
        </div>
    </div>
</div>
<hr>


<!--<h5>{{__('Empresa Information')}}</h5>-->
<div class="row">
    <div class="col-md-6">
        <div class="formrow">
            <label>{{__('Logo de la Empresa')}}</label>
            {{ ImgUploader::print_image("company_logos/$company->logo", 100, 100) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <div id="thumbnail"></div>
            <label class="btn btn-default"> {{__('Select Company Logo')}}
                <input type="file" name="logo" id="logo" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'logo') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'name') !!}">
            <label>Nombre de la Empresa</label>
            {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>__('Empresa Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'name') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'ceo') !!}">
            <label>Representante Legal</label>
            {!! Form::text('ceo', null, array('class'=>'form-control', 'id'=>'ceo', 'placeholder'=> 'Representante' )) !!}
            {!! APFrmErrHelp::showErrors($errors, 'ceo') !!}
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'tipo_identificacion_ceo') !!}">
            <label>Tipo de identificación Representante Legal</label>
             {!! Form::select('tipo_identificacion_ceo', ['' => __('Selecciona el tipo de identificación del Representante Legal'),'CC'=>'CC','NIT'=>'NIT'], null, array('class'=>'form-control', 'id'=>'tipo_identificacion_ceo')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'tipo_identificacion_ceo') !!}
        </div>
    </div>
    
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'identificacion_ceo') !!}">
            <label>Número de identificación Representante Legal</label>
            {!! Form::number('identificacion_ceo', null, array('class'=>'form-control', 'id'=>'identificacion_ceo', 'placeholder'=> 'N° de identificación Representante Legal' )) !!}
            {!! APFrmErrHelp::showErrors($errors, 'identificacion_ceo') !!}
        </div>
    </div>
    
    
     <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'tipo_identificacion') !!}">
            <label>Tipo de identificación</label>
             {!! Form::select('tipo_identificacion', ['' => __('Selecciona el tipo de identificacion'),'CC'=>'CC','NIT'=>'NIT'], null, array('class'=>'form-control', 'id'=>'tipo_identificacion')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'tipo_identificacion') !!}
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'identificacion') !!}">
            <label>Número de identificación</label>
            {!! Form::number('identificacion', null, array('class'=>'form-control', 'id'=>'identificacion', 'placeholder'=> 'N° de identificación' )) !!}
            {!! APFrmErrHelp::showErrors($errors, 'identificacion') !!}
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'name') !!}">
            <label>Cámara de comercio</label>
             {!! Form::file('camara_comercio',  array('class'=>'form-control', 'id'=>'camara_comercio', 'accept'=>'.pdf')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'industry_id') !!}
        </div>
    </div>
    
    <div class="col-md-12 my-3 ">
        
          @if(isset($company->camara_comercio) && $company->camara_comercio != '')
        
            <!--<form action="{{url('donwload-camara', $company )}}" methos="POST">-->
            <!--  <div class="form-group">-->
            <!--    <input type="hidden" class="form-control-file" name="company" value="{{$company}}">-->
            <!--  </div>-->
            <!--  <button type="button" class="btn btn-primary">Descargar archivo</button>-->
            <!--</form>-->
            
            <a class="btn btn-success py-3" href="{{url('donwload-camara', $company )}}">Descargar archivo</a>
            
        @endif
       
    </div>
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'industry_id') !!}">
            <label>Sector Productivo</label>
            {!! Form::select('industry_id', ['' => __('Seleccion el Sector Productivo')]+$industries, null, array('class'=>'form-control', 'id'=>'industry_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'industry_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'ownership_type') !!}">
            <label>{{__('Clasificación de Entidad')}}</label>
            {!! Form::select('ownership_type_id', ['' => __('Seleccione Tipo de Entidad')]+$ownershipTypes, null, array('class'=>'form-control', 'id'=>'ownership_type_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'ownership_type_id') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'description') !!}">
            <label>{{__('Descripción')}}</label>
            {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>__('Company details'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'description') !!}
        </div>
    </div>
    
    
     <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'country_id') !!}">
            <label>{{__('Country')}}</label>
            {!! Form::select('country_id', ['' => __('Select Country')]+$countries, old('country_id', (isset($company))? $company->country_id:$siteSetting->default_country_id), array('class'=>'form-control form-control-sm', 'id'=>'country_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
            <label>{{__('Departamento')}}</label>
            <span id="default_state_dd"> {!! Form::select('state_id', ['' => __('Seleccione Departamento')], null, array('class'=>'form-control form-control-sm', 'id'=>'state_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
            <label>{{__('City')}}</label>
            <span id="default_city_dd"> {!! Form::select('city_id', ['' => __('Seleccione Ciudad')], null, array('class'=>'form-control form-control-sm', 'id'=>'city_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}
        </div>
    </div>
    
    
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'location') !!}">
            <label>{{__('Address')}}</label>
            {!! Form::text('location', null, array('class'=>'form-control', 'id'=>'location', 'placeholder'=>__('Location'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'location') !!}
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'no_of_offices') !!}">
			<label>{{__('No of Office')}}</label>
			{!! Form::select('no_of_offices', ['' => __('Select num. of offices')]+MiscHelper::getNumOffices(), null, array('class'=>'form-control', 'id'=>'no_of_offices')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'no_of_offices') !!} </div>
    </div> -->
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'no_of_employees') !!}">
            <label>{{__('No. de Empleados')}}</label>
            {!! Form::select('no_of_employees', ['' => __('Seleccione Rango')]+MiscHelper::getNumEmployees(), null, array('class'=>'form-control', 'id'=>'no_of_employees')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'no_of_employees') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'established_in') !!}">
            <label>{{__('Established In')}}</label>
            {!! Form::select('established_in', ['' => __('Select Established In')]+MiscHelper::getEstablishedIn(), null, array('class'=>'form-control', 'id'=>'established_in')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'established_in') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'website') !!}">
            <label>{{__('Sitio Web')}}</label>
            {!! Form::text('website', null, array('class'=>'form-control', 'id'=>'website', 'placeholder'=>__('Ej: https://www.misitioweb.com'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'website') !!}
        </div>
    </div>


   <!--  <div class="col-md-4">-->
         
   <!--     <div class="formrow {!! APFrmErrHelp::hasError($errors, 'fax') !!}">-->
			<!--<label>{{__('Fax')}}</label>-->
			<!--{!! Form::text('fax', null, array('class'=>'form-control', 'id'=>'fax', 'placeholder'=>__('Fax'))) !!}-->
   <!--         {!! APFrmErrHelp::showErrors($errors, 'fax') !!} </div>-->
   <!-- </div> -->
    
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'phone') !!}">
            <label>{{__('Phone')}}</label>
            {!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone', 'placeholder'=>__('Phone'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'phone') !!}
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'facebook') !!}">
            <label>{{__('Facebook')}}</label>
            {!! Form::text('facebook', null, array('class'=>'form-control', 'id'=>'facebook', 'placeholder'=>__('Facebook'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'facebook') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'twitter') !!}">
            <label>Twitter</label>
            {!! Form::text('twitter', null, array('class'=>'form-control', 'id'=>'twitter', 'placeholder'=>'Twitter')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'twitter') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'linkedin') !!}">
            <label>{{__('LinkedIn')}}</label>
            {!! Form::text('linkedin', null, array('class'=>'form-control', 'id'=>'linkedin', 'placeholder'=>__('Linkedin'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'linkedin') !!}
        </div>
    </div>
    
    
    
    
    
     <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'google_plus') !!}">
			<label>{{__('Instagram')}}</label>
			{!! Form::text('google_plus', null, array('class'=>'form-control', 'id'=>'google_plus', 'placeholder'=>__('Instagram'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'google_plus') !!} </div>
    </div> 
    
    
    
    <!-- <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'google_plus') !!}">
			<label>{{__('Google Plus')}}</label>
			{!! Form::text('google_plus', null, array('class'=>'form-control', 'id'=>'google_plus', 'placeholder'=>__('Google+'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'google_plus') !!} </div>
    </div> -->
    <!-- <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'pinterest') !!}">
			<label>{{__('Pinterest')}}</label>
			{!! Form::text('pinterest', null, array('class'=>'form-control', 'id'=>'pinterest', 'placeholder'=>__('Pinterest'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'pinterest') !!} </div>
    </div> -->
   
    <!-- <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'map') !!}">
            <label>{{__('Google Map Iframe')}}</label>
            {!! Form::textarea('map', null, array('class'=>'form-control', 'id'=>'map', 'placeholder'=>__('Google Map'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'map') !!}
        </div>
    </div> -->
    
    <div class="col-md-12">
        <div class="formrow">
            <button type="submit" class="btn">{{__('Update Profile and Save')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
<input type="file" name="image" id="image" style="display:none;" accept="image/*" />
{!! Form::close() !!}
<hr>
@push('styles')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('includes.tinyMCEFront')
<script type="text/javascript">
    $(document).ready(function() {
        $('#country_id').on('change', function(e) {
            e.preventDefault();
            filterLangStates(0);
        });
        $(document).on('change', '#state_id', function(e) {
            e.preventDefault();
            filterLangCities(0);
        });
        filterLangStates(<?php echo old('state_id', (isset($company)) ? $company->state_id : 0); ?>);

        /*******************************/
        var fileInput = document.getElementById("logo");
        fileInput.addEventListener("change", function(e) {
            var files = this.files
            showThumbnail(files)
        }, false)
    });

    function showThumbnail(files) {
        $('#thumbnail').html('');
        for (var i = 0; i < files.length; i++) {
            var file = files[i]
            var imageType = /image.*/
            if (!file.type.match(imageType)) {
                console.log("Not an Image");
                continue;
            }
            var reader = new FileReader()
            reader.onload = (function(theFile) {
                return function(e) {
                    $('#thumbnail').append('<div class="fileattached"><img height="100px" src="' + e.target.result + '" > <div>' + theFile.name + '</div><div class="clearfix"></div></div>');
                };
            }(file))
            var ret = reader.readAsDataURL(file);
        }
    }


    function filterLangStates(state_id) {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown') }}", {
                    country_id: country_id,
                    state_id: state_id,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#default_state_dd').html(response);
                    filterLangCities(<?php echo old('city_id', (isset($company)) ? $company->city_id : 0); ?>);
                });
        }
    }

    function filterLangCities(city_id) {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.lang.cities.dropdown') }}", {
                    state_id: state_id,
                    city_id: city_id,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#default_city_dd').html(response);
                });
        }
    }
</script>
@endpush