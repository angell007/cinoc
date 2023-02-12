{!! Form::model($user, ['method' => 'put', 'route' => ['my.profile'], 'class' => 'form', 'files' => true]) !!}

<h5>{{ __('Account Information') }}</h5>
<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'email') !!}">
            <label for="">{{ __('Email') }}</label>
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => __('Email')]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'email') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'password') !!}">
            <label for="">{{ __('Password') }}</label>
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => __('Password')]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'password') !!}
        </div>
    </div>
</div>

<hr>

<h5>{{ __('Personal Information') }}</h5>

<div class="row">
    <div class="col-md-6">
        <div class="formrow">
            <label>{{ __('Profile Image') }}</label>
            {{ ImgUploader::print_image("user_images/$user->image", 100, 100) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <div id="thumbnail"></div>
            <label class="btn btn-default"> {{ __('Select Profile Image') }}
                <input type="file" name="image" id="image" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'image') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'first_name') !!}">
            <label for="">{{ __('First Name') }}</label>
            {!! Form::text('first_name', null, [
                'class' => 'form-control',
                'id' => 'first_name',
                'placeholder' => __('First Name'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'first_name') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'middle_name') !!}">
            <label for="">{{ __('Middle Name') }}</label>
            {!! Form::text('middle_name', null, [
                'class' => 'form-control',
                'id' => 'middle_name',
                'placeholder' => __('Middle Name'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'middle_name') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'first_lastname') !!}">
            <label for="">{{ __('Primer Apellido') }}</label>
            {!! Form::text('first_lastname', null, [
                'class' => 'form-control',
                'id' => 'first_lastname',
                'placeholder' => __('Primer Apellido'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'first_lastname') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'second_lastname') !!}">
            <label for="">{{ __('Segundo Apellido') }}</label>
            {!! Form::text('second_lastname', null, [
                'class' => 'form-control',
                'id' => 'second_lastname',
                'placeholder' => __('Segundo Apellido'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'second_lastname') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'borncountry_id') !!}">
            <label for="">Pais de Nacimiento</label>
            <?php $borncountry_id = old('borncountry_id', isset($user) && (int) $user->borncountry_id > 0 ? $user->borncountry_id : $siteSetting->default_country_id); ?>
            {!! Form::select('borncountry_id', ['' => __('Select Country')] + $countries, $borncountry_id, [
                'class' => 'form-control',
                'id' => 'borncountry_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'borncountry_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'bornstate_id') !!}">
            <label for="">Departamento de Nacimiento</label>
            <span id="bornstate"> {!! Form::select('bornstate_id', ['' => __('Select State')], null, [
                'class' => 'form-control',
                'id' => 'bornstate_id',
            ]) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'bornstate_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'borncity_id') !!}">
            <label for="">Ciudad de Nacimiento</label>
            <span id="borncity"> {!! Form::select('borncity_id', ['' => __('Select City')], null, [
                'class' => 'form-control',
                'id' => 'borncity_id',
            ]) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'borncity_id') !!}
        </div>
    </div>
</div>


<div class="row">



    <!-- <div class="col-md-6">-->
    <!--     <div class="formrow {!! APFrmErrHelp::hasError($errors, 'father_name') !!}">-->
    <!--<label for="">{{ __('Father Name') }}</label>-->
    <!--{!! Form::text('father_name', null, [
        'class' => 'form-control',
        'id' => 'father_name',
        'placeholder' => __('Father Name'),
    ]) !!}-->
    <!--         {!! APFrmErrHelp::showErrors($errors, 'father_name') !!} </div>-->
    <!-- </div>-->

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'gender_id') !!}">
            <label for="">{{ __('Gender') }}</label>
            {!! Form::select('gender_id', ['' => __('Select Gender')] + $genders, null, [
                'class' => 'form-control',
                'id' => 'gender_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'gender_id') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'marital_status_id') !!}">
            <label for="">Grupo poblacional</label>
            {!! Form::select('marital_status_id', ['' => 'Seleccione grupo poblacional'] + $maritalStatuses, null, [
                'class' => 'form-control',
                'id' => 'marital_status_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'marital_status_id') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'civil_status_id') !!}">
            <label for="">Estado cilvil</label>
            {!! Form::select('civil_status_id', ['' => 'Seleccione Estado civil'] + $civilStatuses, null, [
                'class' => 'form-control',
                'id' => 'civil_status_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'civil_status_id') !!}
        </div>
    </div>


    <div class="col-md-6">
        <!--<div class="formrow {!! APFrmErrHelp::hasError($errors, 'marital_status_id') !!}">-->
        <label for="">Rol</label>
        <select name="status_edu" id="status_edu">
            <option {{ $user->rol == 'Egresado' ? 'selected' : '' }} value="Egresado">Egresado</option>
            <option {{ $user->rol == 'Estudiante' ? 'selected' : '' }} value="Estudiante">Estudiante</option>
            <!--</status>   -->

        </select>
        <!--</div>-->
    </div>



    <div class="col-md-6" id="praticas">
        <!--<div class="formrow {!! APFrmErrHelp::hasError($errors, 'marital_status_id') !!}">-->
        <label for="">Cursa practica profecionales</label>
        <select name="status_parcticas" id="">
            <option {{ $user->status_parcticas == 'No' ? 'selected' : '' }} value="No">No</option>
            <option {{ $user->status_parcticas == 'Si' ? 'selected' : '' }} value="Si">Si</option>
            <!--</status>   -->
        </select>
        <!--</div>-->
    </div>


    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'country_id') !!}">
            <label for="">País de recidencia</label>
            <?php $country_id = old('country_id', isset($user) && (int) $user->country_id > 0 ? $user->country_id : $siteSetting->default_country_id); ?>
            {!! Form::select('country_id', ['' => __('Select Country')] + $countries, $country_id, [
                'class' => 'form-control',
                'id' => 'country_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
            <label for="">Departamento de recidencia</label>
            <span id="state_dd"> {!! Form::select('state_id', ['' => __('Select State')], null, ['class' => 'form-control', 'id' => 'state_id']) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
            <label for="">Ciudad de recidencia</label>
            <span id="city_dd"> {!! Form::select('city_id', ['' => __('Select City')], null, ['class' => 'form-control', 'id' => 'city_id']) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'nationality_id') !!}">
            <label for="">{{ __('Nationality') }}</label>
            {!! Form::select('nationality_id', ['' => __('Select Nationality')] + $nationalities, null, [
                'class' => 'form-control',
                'id' => 'nationality_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'nationality_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'date_of_birth') !!}">
            <label for="">{{ __('Date of Birth') }}</label>
            {!! Form::date('date_of_birth', null, [
                'class' => 'form-control',
                'id' => 'date_of_birth',
                'placeholder' => __('Date of Birth'),
                'autocomplete' => 'off',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'date_of_birth') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'national_id_card_number') !!}">
            <label for="">{{ __('National ID') }}</label>
            {!! Form::text('national_id_card_number', null, [
                'class' => 'form-control',
                'id' => 'national_id_card_number',
                'placeholder' => __('National ID Card#'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'national_id_card_number') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'phone') !!}">
            <label for="">{{ __('Phone') }}</label>
            {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => __('Phone')]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'phone') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'mobile_num') !!}">
            <label for="">{{ __('Mobile') }}</label>
            {!! Form::text('mobile_num', null, [
                'class' => 'form-control',
                'id' => 'mobile_num',
                'placeholder' => __('Mobile Number'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'mobile_num') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'street_address') !!}">
            <label for="">{{ __('Street Address') }}</label>
            {!! Form::textarea('street_address', null, [
                'class' => 'form-control textC ',
                'id' => 'street_address',
                'placeholder' => __('Street Address'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'street_address') !!}
        </div>
    </div>

</div>

<hr>

<h5>Programa académico</h5>

<div class="row">
    <!--<div class="col-md-6">-->
    <!--       <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}">-->
    <!--		<label for="">{{ __('Job Experience') }}</label>-->
    <!--		{!! Form::select('job_experience_id', ['' => __('Select Experience')] + $jobExperiences, null, [
        'class' => 'form-control',
        'id' => 'job_experience_id',
    ]) !!}-->
    <!--           {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!} </div>-->
    <!--   </div>-->
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'career_level_id') !!}">
            <label for="">{{ __('Career Level') }}</label>
            {!! Form::select('career_level_id', ['' => __('Select Career level')] + $careerLevels, null, [
                'class' => 'form-control',
                'id' => 'career_level_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'career_level_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'industry_id') !!}">
            <label for="">{{ __('Select Industry') }}</label>
            {!! Form::select('industry_id', ['' => __('Select Industry')] + $industries, null, [
                'class' => 'form-control',
                'id' => 'industry_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'industry_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}">
            <label for="">{{ __('Functional Area') }}</label>
            {!! Form::select('functional_area_id', ['' => __('Select Functional Area')] + $functionalAreas, null, [
                'class' => 'form-control',
                'id' => 'functional_area_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'functional_area_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'current_salary') !!}">
            <label for="">{{ __('Current Salary') }}</label>
            {!! Form::text('current_salary', null, [
                'class' => 'form-control number-1',
                'id' => 'current_salary',
                'placeholder' => __('Current Salary'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'current_salary') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'expected_salary') !!}">
            <label for="">{{ __('Expected Salary') }}</label>
            {!! Form::text('expected_salary', null, [
                'class' => 'form-control number-1',
                'id' => 'expected_salary',
                'placeholder' => __('Expected Salary'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'expected_salary') !!}
        </div>
    </div>
    <div style="display:none;" class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_currency') !!}">
            <label for="">{{ __('Salary Currency') }}</label>
            @php
                $salary_currency = Request::get('salary_currency', isset($user) && !empty($user->salary_currency) ? $user->salary_currency : $siteSetting->default_currency_code);
            @endphp
            {!! Form::text('salary_currency', $salary_currency, [
                'class' => 'form-control',
                'id' => 'salary_currency',
                'placeholder' => __('Salary Currency'),
                'autocomplete' => 'off',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_currency') !!}
        </div>
    </div>
</div>



<div class="row">

    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_subscribed') !!}">
            <?php
            $is_checked = 'checked="checked"';
            if (old('is_subscribed', isset($user) ? $user->is_subscribed : 1) == 0) {
                $is_checked = '';
            }
            ?>
            <input type="checkbox" value="1" name="is_subscribed" {{ $is_checked }} />
            {{ __('Subscribe to news letter') }}
            {!! APFrmErrHelp::showErrors($errors, 'is_subscribed') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow"><button type="submit" class="btn">{{ __('Update Profile and Save') }} <i
                    class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></div>
    </div>
</div>


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
    <script type="text/javascript">
        $(document).ready(function() {


            $("#praticas").hide();
            $("#status_edu").change(function() {
                // alert(this.value);
                if (this.value === "estudiante") {

                    $("#praticas").show();
                } else {
                    $("#praticas").hide();
                }


            });




        });


        $(document).ready(function() {
            initdatepicker();

            $('#salary_currency').typeahead({
                source: function(query, process) {
                    return $.get("{{ route('typeahead.currency_codes') }}", {
                        query: query
                    }, function(data) {
                        data = $.parseJSON(data);
                        return process(data);
                    });
                }
            });

            $('#borncountry_id').on('change', function(e) {
                e.preventDefault();
                filterStates2(0);
            });

            $(document).on('change', '#bornstate_id', function(e) {
                e.preventDefault();
                filterCities2(0);
            });

            filterStates2(<?php echo old('bornstate_id', $user->bornstate_id); ?>);
            /*******************************************************************/
            $('#country_id').on('change', function(e) {
                e.preventDefault();
                filterStates(0);
            });

            $(document).on('change', '#state_id', function(e) {
                e.preventDefault();
                filterCities(0);
            });

            filterStates(<?php echo old('state_id', $user->state_id); ?>);

            /*******************************/
            var fileInput = document.getElementById("image");
            fileInput.addEventListener("change", function(e) {
                var files = this.files
                showThumbnail(files)
            }, false)

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
                            $('#thumbnail').append(
                                '<div class="fileattached"><img height="100px" src="' + e.target
                                .result + '" > <div>' + theFile.name +
                                '</div><div class="clearfix"></div></div>');
                        };
                    }(file))
                    var ret = reader.readAsDataURL(file);
                }
            }
        });

        function filterStates(state_id) {
            let country_id = $('#country_id').val();
            if (country_id != '') {
                $.post("{{ route('filter.lang.states.dropdown') }}", {
                        country_id: country_id,
                        state_id: state_id,
                        _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        $('#state_dd').html(response);
                        filterCities(<?php echo old('city_id', $user->city_id); ?>);
                    });
            }
        }

        function filterStates2(state_id) {
            let country_id = $('#borncountry_id').val();
            if (country_id != '') {
                $.post("{{ route('filter.lang.states.dropdown2') }}", {
                        country_id: country_id,
                        state_id: state_id,
                        _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        $('#bornstate').html(response);
                        filterCities2(<?php echo old('borncity_id', $user->borncity_id); ?>);
                    });
            }
        }

        function filterCities(city_id) {
            console.log('1');
            let state_id = $('#state_id').val();
            if (state_id != '') {
                $.post("{{ route('filter.lang.cities.dropdown') }}", {
                        state_id: state_id,
                        city_id: city_id,
                        _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        $('#city_dd').html(response);
                    });
            }
        }

        function filterCities2(city_id) {
            console.log('2');
            let state_id = $('#bornstate_id').val();
            if (state_id != '') {
                $.post("{{ route('filter.lang.cities.dropdown2') }}", {
                        state_id: state_id,
                        city_id: city_id,
                        _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        $('#borncity').html(response);
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
