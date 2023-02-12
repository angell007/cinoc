<script type="text/javascript" src="http://code.google.com/p/jquery-"></script>
<h5>{{__('Job Details')}}</h5>
@if(isset($job))
{!! Form::model($job, array('method' => 'put', 'route' => array('update.front.job', $job->id), 'class' => 'form', 'id' => 'danform')) !!}
{!! Form::hidden('id', $job->id) !!}
@else
{!! Form::open(array('method' => 'post', 'route' => array('store.front.job'), 'class' => 'form')) !!}
@endif

<div class="row">
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'title') !!}"> {!! Form::text('title', null, array('class'=>'form-control', 'id'=>'title', 'placeholder'=>__('Job title'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'title') !!} </div>
    </div>

    <div class="col-md-12">

        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'professions') !!}">
            {!! Form::select('position', [], [], array('class'=>'form-control selected-remote', 'id'=>'position')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'position') !!} </div>
    </div>

    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'description') !!}">
            {!! Form::label('Offer Description', __('Offer Description'), ['class' => 'bold']) !!}
            {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>__('Job description'),'maxlength'=>'10')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'description') !!} </div>
    </div>

    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'benefits') !!}">
            {!! Form::label('Beneficios', __('Beneficios'), ['class' => 'bold']) !!}
            {!! Form::textarea('benefits', null, array('class'=>'form-control', 'id'=>'benefits', 'placeholder'=>__('Job Benefits'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'benefits') !!}</div>
    </div>


    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'skills') !!}">
            <?php
            $skills = old('skills', $jobSkillIds);
            ?>
            {!! Form::label('Skills Required', __('Skills Required'), ['class' => 'bold']) !!}
            {!! Form::select('skills[]', $jobSkills, $skills, array('class'=>'form-control select2-multiple', 'id'=>'skills', 'multiple'=>'multiple')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'skills') !!} </div>
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
            {!! Form::label('Offer Description', __('Salary Range'), ['class' => 'bold']) !!}
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_from') !!}" id="salary_from_div"> {!! Form::text('salary_from', null, array('class'=>'form-control number-1 inputform ', 'id'=>'salary_from', 'placeholder'=>__('Salary from'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_from') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_to') !!}" id="salary_to_div">
            {!! Form::text('salary_to', null, array('class'=>'form-control number-1 inputform ', 'id'=>'salary_to', 'placeholder'=>__('Salary to'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_to') !!} </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_currency') !!}" id="salary_currency_div">
            @php
            $salary_currency = Request::get('salary_currency', (isset($job))? $job->salary_currency:$siteSetting->default_currency_code);
            @endphp

            {!! Form::select('salary_currency', ['' => __('Select Salary Currency')]+$currencies, $salary_currency, array('class'=>'form-control', 'id'=>'salary_currency')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_currency') !!} </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_period_id') !!}" id="salary_period_id_div"> {!! Form::select('salary_period_id',$salaryPeriods, null, array('class'=>'form-control', 'id'=>'salary_period_id','placeholder'=>__('Select Salary Period'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_period_id') !!} </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'hide_salary') !!}"> {!! Form::label('hide_salary', __('Hide Salary?'), ['class' => 'bold']) !!}
            <div class="radio-list">
                <?php
                $hide_salary_1 = '';
                $hide_salary_2 = 'checked="checked"';
                if (old('hide_salary', ((isset($job)) ? $job->hide_salary : 0)) == 1) {
                    $hide_salary_1 = 'checked="checked"';
                    $hide_salary_2 = '';
                }
                ?>
                <label class="radio-inline">
                    <input id="hide_salary_yes" name="hide_salary" type="radio" value="1" {{$hide_salary_1}}>
                    {{__('Yes')}} </label>
                <label class="radio-inline">
                    <input id="hide_salary_no" name="hide_salary" type="radio" value="0" {{$hide_salary_2}}>
                    {{__('No')}} </label>
            </div>
            {!! APFrmErrHelp::showErrors($errors, 'hide_salary') !!}
        </div>
    </div>


    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}" id="functional_area_id_div"> {!! Form::select('functional_area_id', ['' => __('Select profession')]+$functionalAreas, null, array('class'=>'form-control', 'id'=>'functional_area_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'functional_area_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_type_id') !!}" id="job_type_id_div"> {!! Form::select('job_type_id', ['' => __('Select Job Type')]+$jobTypes, null, array('class'=>'form-control', 'id'=>'job_type_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_type_id') !!} </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'num_of_positions') !!}" id="num_of_positions_div"> {!! Form::select('num_of_positions', ['' => __('Select number of Positions')]+MiscHelper::getNumPositions(), null, array('class'=>'form-control', 'id'=>'num_of_positions')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'num_of_positions') !!} </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'expiry_date') !!}"> {!! Form::text('expiry_date', null, array('class'=>'form-control datepicker inputform', 'id'=>'expiry_date', 'placeholder'=>__('Job expiry date'), 'autocomplete'=>'off')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'expiry_date') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'degree_level_id') !!}" id="degree_level_id_div"> {!! Form::select('degree_level_id', ['' =>__('Select Required Degree Level')]+$degreeLevels, null, array('class'=>'form-control', 'id'=>'degree_level_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'degree_level_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}" id="job_experience_id_div"> {!! Form::select('job_experience_id', ['' => __('Select Required job experience')]+$jobExperiences, null, array('class'=>'form-control', 'id'=>'job_experience_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!} </div>
    </div>

    <div class="col-md-6">
        <label class="radio-inline">Mostrar información de la empresa
            <input id="is_freelance_yes" name="mostrarInfo" type="radio" value="1">
            {{__('Yes')}} </label>
    </div>

    <br>
    <hr>

    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_freelance') !!}"> {!! Form::label('is_freelance', __('Remoto?'), ['class' => 'bold']) !!}
            <div class="radio-list">
                <?php
                $is_freelance_1 = '';
                $is_freelance_2 = 'checked="checked"';
                if (old('is_freelance', ((isset($job)) ? $job->is_freelance : 0)) == 1) {
                    $is_freelance_1 = 'checked="checked"';
                    $is_freelance_2 = '';
                }
                ?>
                <label class="radio-inline">
                    <input id="is_freelance_yes" name="is_freelance" type="radio" value="1" {{$is_freelance_1}}>
                    {{__('Yes')}} </label>
                <label class="radio-inline">
                    <input id="is_freelance_no" name="is_freelance" type="radio" value="0" {{$is_freelance_2}}>
                    {{__('No')}} </label>

            </div>
            {!! APFrmErrHelp::showErrors($errors, 'is_freelance') !!}
        </div>
    </div>

    <div class="col-md-12">

        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_pl') !!}"> {!! Form::label('is_pl', __('Práctica laboral?'), ['class' => 'bold']) !!}
            <div class="radio-list">
                <?php
                $is_pl_1 = '';
                $is_pl_2 = 'checked="checked"';
                
                if (old('is_pl', ((isset($job)) ? $job->is_pl : 0)) == 1) {
                    $is_pl_1 = 'checked="checked"';
                    $is_pl_2 = '';
                }
                ?>
                <label class="radio-inline">
                    <input id="is_pl_yes" name="is_pl" type="radio" value="1" {{$is_pl_1}}>
                    {{__('Yes')}} </label>
                <label class="radio-inline">
                    <input id="is_pl_no" name="is_pl" type="radio" value="0" {{$is_pl_2}}>
                    {{__('No')}} </label>
                    <br>
                    <br>
                
                <small class="text-danger">Si selecciona práctica laboral, se guardará el tipo de contrato como : Otra </small>

            </div>
            {!! APFrmErrHelp::showErrors($errors, 'is_pl') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="formrow">
            <button type="submit" class="btn">{{ isset($job)?__('Update Job'):__('Post offer') }} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
<input type="file" name="image" id="image" style="display:none;" accept="image/*" />
{!! Form::close() !!}
<hr>
@push('styles')
<style type="text/css">
    .inputform {
        height: 28px !important;
    }

    .datepicker>div {
        display: block;
    }

</style>
@endpush
@push('scripts')

<script type="text/javascript">
    $(document).ready(function() {


        // Fetch the preselected item, and add to the control
        var studentSelect = $('.selected-remote');
        $.ajax({
            type: 'GET', 
            url: '/api/proffesions?name=' + <?php echo isset($job->position) ? '"'. $job->position . '"' : '"'. '"' ?>
        }).then(function(data) {
            var option = new Option(data.text, data.id, true, true);
            studentSelect.append(option).trigger('change');
        });

        $('.select2-multiple').select2({
            placeholder: "{{__('Select Required Skills')}}"
            , allowClear: true
        });
        $('.select').select2({
            placeholder: "{{__('Select')}}"
            , allowClear: true
        });
        $(".datepicker").datepicker({
            autoclose: true
            , format: 'yyyy-m-d'
        });
        $('#country_id').on('change', function(e) {
            e.preventDefault();
            filterLangStates(0);
        });
        $(document).on('change', '#state_id', function(e) {
            e.preventDefault();
            filterLangCities(0);
        });
        filterLangStates(<?php echo old('state_id', (isset($job)) ? $job->state_id : 0); ?>);

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
                    filterLangCities(<?php echo old('city_id', (isset($job)) ? $job->city_id : 0); ?>);
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
                    $('#state_id').select2();
                    $('#city_id').select2();
                });
        }
    }
    
    });

</script>
@include('includes.tinyMCEFront')
@endpush
