{!! APFrmErrHelp::showOnlyErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'logo') !!}">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="{{ asset('/') }}admin_assets/no-image.png" alt="" /> </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                    <div> <span class="btn default btn-file"> <span class="fileinput-new"> Logo de compañía </span> <span class="fileinput-exists"> Carga </span> {!! Form::file('logo', null, array('id'=>'logo')) !!} </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                </div>
                {!! APFrmErrHelp::showErrors($errors, 'logo') !!} </div>
        </div>
        @if(isset($company))
        <div class="col-md-6">
            {{ ImgUploader::print_image("company_logos/$company->logo") }}        
        </div>    
        @endif  
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}"> {!! Form::label('name', 'Nombre de compañía', ['class' => 'bold']) !!}
        {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'Nombre de compañía')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'name') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}"> {!! Form::label('email', 'Email de compañía', ['class' => 'bold']) !!}
        {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email de compañía')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'email') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}"> {!! Form::label('tipo_identificacion', 'Tipo de identificación', ['class' => 'bold']) !!}
        {!! Form::select('tipo_identificacion', [null => __('Selecciona el tipo de identificación'),'CC'=>'CC','NIT'=>'NIT'], null, array('class'=>'form-control', 'id'=>'tipo_identificacion')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'tipo de identificación') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'identificacion') !!}"> {!! Form::label('identificacion', 'Identificación', ['class' => 'bold']) !!}
        {!! Form::number('identificacion', null, array('class'=>'form-control', 'id'=>'identificacion', 'placeholder'=> 'N° de identificación' )) !!}
        {!! APFrmErrHelp::showErrors($errors, 'identificacion') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'password') !!}"> {!! Form::label('password', 'Contraseña', ['class' => 'bold']) !!}
        {!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>'Contraseña')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'password') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'ceo') !!}"> {!! Form::label('ceo', 'Ceo de compañía', ['class' => 'bold']) !!}
        {!! Form::text('ceo', null, array('class'=>'form-control', 'id'=>'ceo', 'placeholder'=>'Ceo de compañía')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'ceo') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'industry_id') !!}"> {!! Form::label('industry_id', 'Industria', ['class' => 'bold']) !!}                    
        {!! Form::select('industry_id', ['' => 'Seleccione industria']+$industries, null, array('class'=>'form-control', 'id'=>'industry_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'industry_id') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'ownership_type') !!}"> {!! Form::label('ownership_type', 'Tipo de Propiedad', ['class' => 'bold']) !!}
        {!! Form::select('ownership_type_id', ['' => 'Seleccione tipo de propiedad']+$ownershipTypes, null, array('class'=>'form-control', 'id'=>'ownership_type_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'ownership_type_id') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}"> {!! Form::label('description', 'Detalles de compañía', ['class' => 'bold']) !!}
        {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>'Detalles de compañía')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'description') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}"> {!! Form::label('camara_comercio', 'cámara de comercio', ['class' => 'bold']) !!}
        {!! Form::file('camara_comercio',  array('class'=>'form-control', 'id'=>'camara_comercio', 'accept'=>'.pdf')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'description') !!} </div>  
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'location') !!}"> {!! Form::label('location', 'Ubicación', ['class' => 'bold']) !!}
        {!! Form::text('location', null, array('class'=>'form-control', 'id'=>'location', 'placeholder'=>'Ubicación')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'location') !!} </div>     
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'map') !!}"> {!! Form::label('map', 'Google Map', ['class' => 'bold']) !!}
        {!! Form::textarea('map', null, array('class'=>'form-control', 'id'=>'map', 'placeholder'=>'Google Map')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'map') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'no_of_offices') !!}"> {!! Form::label('no_of_offices', 'Número de oficinas', ['class' => 'bold']) !!}
        {!! Form::select('no_of_offices', ['' => 'Seleccione num oficinas']+MiscHelper::getNumOffices(), null, array('class'=>'form-control', 'id'=>'no_of_offices')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'no_of_offices') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'website') !!}"> {!! Form::label('website', 'Sitio web', ['class' => 'bold']) !!}
        {!! Form::text('website', null, array('class'=>'form-control', 'id'=>'website', 'placeholder'=>'Sitio web')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'website') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'no_of_employees') !!}"> {!! Form::label('no_of_employees', 'Número de empleados', ['class' => 'bold']) !!}
        {!! Form::select('no_of_employees', ['' => 'Seleccione num empleados']+MiscHelper::getNumEmployees(), null, array('class'=>'form-control', 'id'=>'no_of_employees')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'no_of_employees') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'established_in') !!}"> {!! Form::label('established_in', 'Fundada en', ['class' => 'bold']) !!}
        {!! Form::select('established_in', ['' => 'Seleccione fundada en']+MiscHelper::getEstablishedIn(), null, array('class'=>'form-control', 'id'=>'established_in')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'established_in') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'fax') !!}"> {!! Form::label('fax', 'Fax #', ['class' => 'bold']) !!}
        {!! Form::text('fax', null, array('class'=>'form-control', 'id'=>'fax', 'placeholder'=>'Fax #')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'fax') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'phone') !!}"> {!! Form::label('phone', 'Número telefónico', ['class' => 'bold']) !!}
        {!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone', 'placeholder'=>'Número telefónico')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'phone') !!} </div>




    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'facebook') !!}"> {!! Form::label('facebook', 'Dirección de facebook', ['class' => 'bold']) !!}
        {!! Form::text('facebook', null, array('class'=>'form-control', 'id'=>'facebook', 'placeholder'=>'Dirección de facebook')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'facebook') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'twitter') !!}"> {!! Form::label('twitter', 'Twitter', ['class' => 'bold']) !!}
        {!! Form::text('twitter', null, array('class'=>'form-control', 'id'=>'twitter', 'placeholder'=>'Twitter')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'twitter') !!} </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'linkedin') !!}"> {!! Form::label('linkedin', 'Linkedin', ['class' => 'bold']) !!}
        {!! Form::text('linkedin', null, array('class'=>'form-control', 'id'=>'linkedin', 'placeholder'=>'Linkedin')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'linkedin') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'google_plus') !!}"> {!! Form::label('google_plus', 'Google+', ['class' => 'bold']) !!}
        {!! Form::text('google_plus', null, array('class'=>'form-control', 'id'=>'google_plus', 'placeholder'=>'Google+')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'google_plus') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'pinterest') !!}"> {!! Form::label('pinterest', 'Pinterest', ['class' => 'bold']) !!}
        {!! Form::text('pinterest', null, array('class'=>'form-control', 'id'=>'pinterest', 'placeholder'=>'Pinterest')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'pinterest') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'country_id') !!}"> {!! Form::label('country_id', 'País', ['class' => 'bold']) !!}                    
        {!! Form::select('country_id', ['' => 'Seleccione país']+$countries, old('country_id', (isset($company))? $company->country_id:$siteSetting->default_country_id), array('class'=>'form-control', 'id'=>'country_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'country_id') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}"> {!! Form::label('state_id', 'Departamento', ['class' => 'bold']) !!}
        <span id="default_state_dd">                    
            {!! Form::select('state_id', ['' => 'Seleccione departamento'], null, array('class'=>'form-control', 'id'=>'state_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'state_id') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'city_id') !!}"> {!! Form::label('city_id', 'Ciudad', ['class' => 'bold']) !!}  
        <span id="default_city_dd">                  
            {!! Form::select('city_id', ['' => 'Seleccione ciudad'], null, array('class'=>'form-control', 'id'=>'city_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'city_id') !!} </div>


    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'company_package_id') !!}"> {!! Form::label('company_package_id', 'Plan', ['class' => 'bold']) !!}  
        {!! Form::select('company_package_id', ['' => 'Seleccione plan']+$packages, null, array('class'=>'form-control', 'id'=>'company_package_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'company_package_id') !!} </div>

    @if(isset($company) && $company->package_id > 0)
    <div class="form-group">
        {!! Form::label('package', 'Package : ', ['class' => 'bold']) !!}         
        <strong>{{$company->getPackage('package_title')}}</strong>
    </div>
    <div class="form-group">
        {!! Form::label('package_Duration', 'Package Duration : ', ['class' => 'bold']) !!}
        <strong>{{$company->package_start_date->format('d M, Y')}}</strong> - <strong>{{$company->package_end_date->format('d M, Y')}}</strong>
    </div>
    <div class="form-group">
        {!! Form::label('package_quota', 'Availed quota : ', ['class' => 'bold']) !!}
        <strong>{{$company->availed_jobs_quota}}</strong> / <strong>{{$company->jobs_quota}}</strong>
    </div>
    <hr/>
    @endif

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">
        {!! Form::label('is_active', 'Activa?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', ((isset($company)) ? $company->is_active : 1)) == 0) {
                $is_active_1 = '';
                $is_active_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="active" name="is_active" type="radio" value="1" {{$is_active_1}}>
                Activa </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" {{$is_active_2}}>
                In-Activa </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_featured') !!}">
        {!! Form::label('is_featured', 'Destacada?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_featured_1 = '';
            $is_featured_2 = 'checked="checked"';
            if (old('is_featured', ((isset($company)) ? $company->is_featured : 0)) == 1) {
                $is_featured_1 = 'checked="checked"';
                $is_featured_2 = '';
            }
            ?>
            <label class="radio-inline">
                <input id="featured" name="is_featured" type="radio" value="1" {{$is_featured_1}}>
                Destacada </label>
            <label class="radio-inline">
                <input id="not_featured" name="is_featured" type="radio" value="0" {{$is_featured_2}}>
                No destacada </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_featured') !!} </div>
    <div class="form-actions"> {!! Form::button('Guardar <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!} </div>
</div>
@push('scripts')
@include('admin.shared.tinyMCEFront') 
<script type="text/javascript">
    $(document).ready(function () {
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterDefaultStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterDefaultCities(0);
        });
        filterDefaultStates(<?php echo old('state_id', (isset($company)) ? $company->state_id : 0); ?>);
    });
    function filterDefaultStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.default.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterDefaultCities(<?php echo old('city_id', (isset($company)) ? $company->city_id : 0); ?>);
                    });
        }
    }
    function filterDefaultCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.default.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
        }
    }
</script>
@endpush