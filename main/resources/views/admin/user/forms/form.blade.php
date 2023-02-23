{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

@if (isset($user))
    {!! Form::model($user, [
        'method' => 'put',
        'route' => ['update.user', $user->id],
        'class' => 'form',
        'files' => true,
    ]) !!}

    {!! Form::hidden('id', $user->id) !!}
@else
    {!! Form::open(['method' => 'post', 'route' => 'store.user', 'class' => 'form', 'files' => true]) !!}
@endif

<div class="form-body">

    <input type="hidden" name="front_or_admin" value="admin" />

    <div class="row">

        <div class="col-md-6">

            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'image') !!}">

                <div class="fileinput fileinput-new" data-provides="fileinput">

                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img
                            src="{{ asset('/') }}admin_assets/no-image.png" alt="" /> </div>

                    <div class="fileinput-preview fileinput-exists thumbnail"
                        style="max-width: 200px; max-height: 150px;"> </div>

                    <div> <span class="btn default btn-file"> <span class="fileinput-new"> Seleccione imagen de perfil
                            </span> <span class="fileinput-exists"> Change </span> {!! Form::file('image', null, ['id' => 'image']) !!} </span> <a
                            href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>

                </div>

                {!! APFrmErrHelp::showErrors($errors, 'image') !!}

            </div>

        </div>

        @if (isset($user))
            <div class="col-md-6">

                {{ ImgUploader::print_image("user_images/$user->image") }}

            </div>
        @endif

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'first_name') !!}">

        {!! Form::label('first_name', 'Primer nombre', ['class' => 'bold']) !!}

        {!! Form::text('first_name', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'first_name',
            'placeholder' => 'Primer nombre',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'first_name') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'middle_name') !!}">
        {!! Form::label('middle_name', 'Segundo nombre', ['class' => 'bold']) !!}
        {!! Form::text('middle_name', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'middle_name',
            'placeholder' => 'Segundo nombre',
        ]) !!}
        {!! APFrmErrHelp::showErrors($errors, 'middle_name') !!}

    </div>



    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'first_lastname') !!}">

        {!! Form::label('first_lastname', 'Primer apellido', ['class' => 'bold']) !!}

        {!! Form::text('first_lastname', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'first_lastname',
            'placeholder' => 'Apellidos',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'first_lastname') !!}

    </div>



    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'second_lastname') !!}">

        {!! Form::label('second_lastname', 'Segundo apellido', ['class' => 'bold']) !!}

        {!! Form::text('second_lastname', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'second_lastname',
            'placeholder' => 'Apellidos',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'second_lastname') !!}

    </div>



    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">

        {!! Form::label('email', 'Email', ['class' => 'bold']) !!}

        {!! Form::text('email', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'email',
            'placeholder' => 'Email',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'email') !!}

    </div>



    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'password') !!}">

        {!! Form::label('password', 'Contraseña', ['class' => 'bold']) !!}

        {!! Form::password('password', [
            'class' => 'form-control form-control-xs',
            'id' => 'password',
            'placeholder' => 'Contraseña',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'password') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'father_name') !!}">

        {!! Form::label('father_name', 'Nombre del padre', ['class' => 'bold']) !!}

        {!! Form::text('father_name', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'father_name',
            'placeholder' => 'Nombre del padre',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'father_name') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'date_of_birth') !!}">

        {!! Form::label('date_of_birth', 'Fecha de nacimiento', ['class' => 'bold']) !!}

        {!! Form::date('date_of_birth', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'date_of_birth',
            'placeholder' => 'Fecha de nacimiento',
            'autocomplete' => 'off',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'date_of_birth') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'gender_id') !!}">

        {!! Form::label('gender_id', 'Género', ['class' => 'bold']) !!}

        {!! Form::select('gender_id', ['' => 'Seleccione Género'] + $genders, null, [
            'class' => 'form-control form-control-xs',
            'id' => 'gender_id',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'gender_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'marital_status_id') !!}">

        {!! Form::label('marital_status_id', 'Población', ['class' => 'bold']) !!}

        {!! Form::select('marital_status_id', ['' => 'Seleccione Población'] + $maritalStatuses, null, [
            'class' => 'form-control form-control-xs',
            'id' => 'marital_status_id',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'marital_status_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'nationality_id') !!}">

        {!! Form::label('nationality_id', 'Nacionalidad', ['class' => 'bold']) !!}

        {!! Form::select('nationality_id', ['' => 'Seleccione Nacionalidad'] + $nationalities, null, [
            'class' => 'form-control form-control-xs',
            'id' => 'nationality_id',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'nationality_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'national_id_card_number') !!}">

        {!! Form::label('national_id_card_number', 'Número de identificación', ['class' => 'bold']) !!}

        {!! Form::text('national_id_card_number', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'national_id_card_number',
            'placeholder' => 'Número de identificación',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'national_id_card_number') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'country_id') !!}">

        {!! Form::label('country_id', 'País', ['class' => 'bold']) !!}

        {!! Form::select(
            'country_id',
            ['' => 'Seleccione País'] + $countries,
            old('country_id', isset($user) ? $user->country_id : $siteSetting->default_country_id),
            ['class' => 'form-control form-control-xs', 'id' => 'country_id'],
        ) !!}

        {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">

        {!! Form::label('state_id', 'Departamento', ['class' => 'bold']) !!}

        <span id="default_state_dd">

            {!! Form::select('state_id', ['' => 'Seleccione Departamento'], null, [
                'class' => 'form-control form-control-xs',
                'id' => 'state_id',
            ]) !!}

        </span>

        {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">

        {!! Form::label('city_id', 'Ciudad', ['class' => 'bold']) !!}

        <span id="default_city_dd">

            {!! Form::select('city_id', ['' => 'Seleccione Ciudad'], null, [
                'class' => 'form-control form-control-xs',
                'id' => 'city_id',
            ]) !!}

        </span>

        {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'phone') !!}">

        {!! Form::label('phone', 'Teléfono', ['class' => 'bold']) !!}

        {!! Form::text('phone', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'phone',
            'placeholder' => 'Teléfono',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'phone') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'mobile_num') !!}">

        {!! Form::label('mobile_num', 'Número de celular', ['class' => 'bold']) !!}

        {!! Form::text('mobile_num', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'mobile_num',
            'placeholder' => 'Número de celular',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'mobile_num') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}">

        {!! Form::label('job_experience_id', 'Experiencia', ['class' => 'bold']) !!}

        {!! Form::select('job_experience_id', ['' => 'Seleccione Experiencia'] + $jobExperiences, null, [
            'class' => 'form-control form-control-xs',
            'id' => 'job_experience_id',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'career_level_id') !!}">

        {!! Form::label('career_level_id', 'Nivel de estudio', ['class' => 'bold']) !!}

        {!! Form::select('career_level_id', ['' => 'Seleccione Nivel de estudio'] + $careerLevels, null, [
            'class' => 'form-control form-control-xs',
            'id' => 'career_level_id',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'career_level_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'industry_id') !!}">

        {!! Form::label('industry_id', 'Industria', ['class' => 'bold']) !!}

        {!! Form::select('industry_id', ['' => 'Seleccione Industria'] + $industries, null, [
            'class' => 'form-control form-control-xs',
            'id' => 'industry_id',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'industry_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}">

        {!! Form::label('functional_area_id', 'Área funcional', ['class' => 'bold']) !!}

        {!! Form::select('functional_area_id', ['' => 'Seleccione Area funcional'] + $functionalAreas, null, [
            'class' => 'form-control form-control-xs',
            'id' => 'functional_area_id',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'functional_area_id') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'current_salary') !!}">

        {!! Form::label('current_salary', 'Salario actual', ['class' => 'bold']) !!}

        {!! Form::text('current_salary', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'current_salary',
            'placeholder' => 'Salario actual',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'current_salary') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'expected_salary') !!}">

        {!! Form::label('expected_salary', 'Expectativa de salario', ['class' => 'bold']) !!}

        {!! Form::text('expected_salary', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'expected_salary',
            'placeholder' => 'Expectativa de salario',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'expected_salary') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'salary_currency') !!}">

        {!! Form::label('salary_currency', 'Moneda', ['class' => 'bold']) !!}

        {!! Form::text('salary_currency', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'salary_currency',
            'placeholder' => 'Moneda',
            'autocomplete' => 'off',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'salary_currency') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'street_address') !!}">

        {!! Form::label('street_address', 'Dirección', ['class' => 'bold']) !!}

        {!! Form::textarea('street_address', null, [
            'class' => 'form-control form-control-xs',
            'id' => 'street_address',
            'placeholder' => 'Dirección',
        ]) !!}

        {!! APFrmErrHelp::showErrors($errors, 'street_address') !!}

    </div>



    @if ((bool) config('jobseeker.is_jobseeker_package_active'))

        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_seeker_package_id') !!}"> {!! Form::label('job_seeker_package_id', 'plan', ['class' => 'bold']) !!}

            {!! Form::select('job_seeker_package_id', ['' => 'Seleccione plan'] + $packages, null, [
                'class' => 'form-control form-control-xs',
                'id' => 'job_seeker_package_id',
            ]) !!}

            {!! APFrmErrHelp::showErrors($errors, 'job_seeker_package_id') !!} </div>



        @if (isset($user) && $user->package_id > 0)
            <div class="form-group">

                {!! Form::label('package', 'Package : ', ['class' => 'bold']) !!}

                <strong>{{ $user->getPackage('package_title') }}</strong>

            </div>

            <div class="form-group">

                {!! Form::label('package_Duration', 'Package Duration : ', ['class' => 'bold']) !!}

                <strong>{{ $user->package_start_date->format('d M, Y') }}</strong> -
                <strong>{{ $user->package_end_date->format('d M, Y') }}</strong>

            </div>

            <div class="form-group">

                {!! Form::label('package_quota', 'Availed quota : ', ['class' => 'bold']) !!}

                <strong>{{ $user->availed_jobs_quota }}</strong> / <strong>{{ $user->jobs_quota }}</strong>

            </div>

            <hr />
        @endif

    @endif





    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_immediate_available') !!}">

        {!! Form::label('is_immediate_available', 'Disponibilidad inmediata?', ['class' => 'bold']) !!}

        <div class="radio-list">

            <?php
            
            $is_immediate_available_1 = 'checked="checked"';
            
            $is_immediate_available_2 = '';
            
            if (old('is_immediate_available', isset($user) ? $user->is_immediate_available : 1) == 0) {
                $is_immediate_available_1 = '';
            
                $is_immediate_available_2 = 'checked="checked"';
            }
            
            ?>

            <label class="radio-inline">

                <input id="immediate_available" name="is_immediate_available" type="radio" value="1"
                    {{ $is_immediate_available_1 }}>

                Inmediata disponibilidad </label>

            <label class="radio-inline">

                <input id="not_immediate_available" name="is_immediate_available" type="radio" value="0"
                    {{ $is_immediate_available_2 }}>

                Sin inmediata disponibilidad </label>

        </div>

        {!! APFrmErrHelp::showErrors($errors, 'is_immediate_available') !!}

    </div>





    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">

        {!! Form::label('is_active', 'Activo', ['class' => 'bold']) !!}

        <div class="radio-list">

            <?php
            
            $is_active_1 = 'checked="checked"';
            
            $is_active_2 = '';
            
            if (old('is_active', isset($user) ? $user->is_active : 1) == 0) {
                $is_active_1 = '';
            
                $is_active_2 = 'checked="checked"';
            }
            
            ?>

            <label class="radio-inline">

                <input id="active" name="is_active" type="radio" value="1" {{ $is_active_1 }}>

                Activo </label>

            <label class="radio-inline">

                <input id="not_active" name="is_active" type="radio" value="0" {{ $is_active_2 }}>

                Inactivo </label>

        </div>

        {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}

    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'verified') !!}">

        {!! Form::label('verified', 'Verified', ['class' => 'bold']) !!}

        <div class="radio-list">

            <?php
            
            $verified_1 = 'checked="checked"';
            
            $verified_2 = '';
            
            if (old('verified', isset($user) ? $user->verified : 1) == 0) {
                $verified_1 = '';
            
                $verified_2 = 'checked="checked"';
            }
            
            ?>

            <label class="radio-inline">

                <input id="verified" name="verified" type="radio" value="1" {{ $verified_1 }}>

                Verificado </label>

            <label class="radio-inline">

                <input id="not_verified" name="verified" type="radio" value="0" {{ $verified_2 }}>

                No Verificado </label>

        </div>

        {!! APFrmErrHelp::showErrors($errors, 'verified') !!}

    </div>

    {!! Form::button('Guardar información personal <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', [
        'class' => 'btn btn-large btn-primary',
        'type' => 'submit',
    ]) !!}

</div>

{!! Form::close() !!}

@push('css')
    <style type="text/css">
        .datepicker>div {

            display: block;

        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            initdatepicker();

            $('#salary_currency').typeahead({

                source: function(query, process) {

                    return $.get("{{ route('typeahead.currency_codes') }}", {

                        query: query

                    }, function(data) {

                        console.log(data);

                        data = $.parseJSON(data);

                        return process(data);

                    });

                }

            });



            $('#country_id').on('change', function(e) {

                e.preventDefault();

                filterDefaultStates(0);

            });

            $(document).on('change', '#state_id', function(e) {

                e.preventDefault();

                filterDefaultCities(0);

            });

            filterDefaultStates(<?php echo old('state_id', isset($user) ? $user->state_id : 0); ?>);

        });



        function filterDefaultStates(state_id) {

            var country_id = $('#country_id').val();

            if (country_id != '') {

                $.post("{{ route('filter.default.states.dropdown') }}", {

                        country_id: country_id,

                        state_id: state_id,

                        _method: 'POST',

                        _token: '{{ csrf_token() }}'

                    })

                    .done(function(response) {

                        $('#default_state_dd').html(response);

                        filterDefaultCities(<?php echo old('city_id', isset($user) ? $user->city_id : 0); ?>);

                    });

            }

        }



        function filterDefaultCities(city_id) {

            var state_id = $('#state_id').val();

            if (state_id != '') {

                $.post("{{ route('filter.default.cities.dropdown') }}", {

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



        function initdatepicker() {

            $(".datepicker").datepicker({

                autoclose: true,

                format: 'yyyy-m-d'

            });

        }
    </script>
@endpush
