{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
@php
    $salary_currency = Request::get('salary_currency', isset($job) ? $job->salary_currency : $siteSetting->default_currency_code);
    $mostrarInfoChecked = old('mostrarInfo', (isset($job) && $job->show_info == 'si') ? '1' : '0');
@endphp
<div class="form-body">
    {!! Form::hidden('id', null) !!}

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'company_id') !!}" id="company_id_div">
        {!! Form::label('company_id', 'Compañía', ['class' => 'bold']) !!}
        {!! Form::select('company_id', ['' => 'Seleccione Compañía'] + $companies, null, ['class' => 'form-control', 'id' => 'company_id']) !!}
        {!! APFrmErrHelp::showErrors($errors, 'company_id') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
        {!! Form::label('title', __('Job title'), ['class' => 'bold']) !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => __('Job title')]) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'position') !!}">
        {!! Form::label('position', 'Ocupación', ['class' => 'bold']) !!}
        {!! Form::select('position', [], null, ['class' => 'form-control', 'id' => 'position']) !!}
        {!! APFrmErrHelp::showErrors($errors, 'position') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
        {!! Form::label('description', __('Offer Description'), ['class' => 'bold']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => __('Job description')]) !!}
        {!! APFrmErrHelp::showErrors($errors, 'description') !!}
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'country_id') !!}" id="country_id_div">
                {!! Form::label('country_id', __('Country'), ['class' => 'bold']) !!}
                {!! Form::select(
                    'country_id',
                    ['' => __('Select Country')] + $countries,
                    old('country_id', isset($job) ? $job->country_id : $siteSetting->default_country_id),
                    ['class' => 'form-control', 'id' => 'country_id']
                ) !!}
                {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}" id="state_id_div">
                {!! Form::label('state_id', __('Departamento'), ['class' => 'bold']) !!}
                <span id="default_state_dd">
                    {!! Form::select('state_id', ['' => __('Seleccione Departamento')], null, ['class' => 'form-control', 'id' => 'state_id']) !!}
                </span>
                {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'city_id') !!}" id="city_id_div">
                {!! Form::label('city_id', __('City'), ['class' => 'bold']) !!}
                <span id="default_city_dd">
                    {!! Form::select('city_id', ['' => __('Seleccione Ciudad')], null, ['class' => 'form-control', 'id' => 'city_id']) !!}
                </span>
                {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('salary_range', __('Salary Range'), ['class' => 'bold']) !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'salary_from') !!}" id="salary_from_div">
                {!! Form::text('salary_from', null, ['class' => 'form-control', 'id' => 'salary_from', 'placeholder' => __('Salary from')]) !!}
                {!! APFrmErrHelp::showErrors($errors, 'salary_from') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'salary_to') !!}" id="salary_to_div">
                {!! Form::text('salary_to', null, ['class' => 'form-control', 'id' => 'salary_to', 'placeholder' => __('Salary to')]) !!}
                {!! APFrmErrHelp::showErrors($errors, 'salary_to') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'salary_currency') !!}" id="salary_currency_div">
                {!! Form::select('salary_currency', ['' => __('Select Salary Currency')] + $currencies, $salary_currency, ['class' => 'form-control', 'id' => 'salary_currency']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'salary_currency') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'salary_period_id') !!}" id="salary_period_id_div">
                {!! Form::select('salary_period_id', ['' => __('Select Salary Period')] + $salaryPeriods, null, ['class' => 'form-control', 'id' => 'salary_period_id']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'salary_period_id') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'hide_salary') !!}">
                {!! Form::label('hide_salary', __('Hide Salary?'), ['class' => 'bold']) !!}
                <div class="radio-list">
                    <?php
                    $hide_salary_1 = '';
                    $hide_salary_2 = 'checked="checked"';
                    if (old('hide_salary', isset($job) ? $job->hide_salary : 0) == 1) {
                        $hide_salary_1 = 'checked="checked"';
                        $hide_salary_2 = '';
                    }
                    ?>
                    <label class="radio-inline">
                        <input id="hide_salary_yes" name="hide_salary" type="radio" value="1" {{ $hide_salary_1 }}>
                        {{ __('Yes') }}
                    </label>
                    <label class="radio-inline">
                        <input id="hide_salary_no" name="hide_salary" type="radio" value="0" {{ $hide_salary_2 }}>
                        {{ __('No') }}
                    </label>
                </div>
                {!! APFrmErrHelp::showErrors($errors, 'hide_salary') !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}" id="functional_area_id_div">
                {!! Form::select('functional_area_id', ['' => __('Select profession')] + $functionalAreas, null, ['class' => 'form-control', 'id' => 'functional_area_id']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'functional_area_id') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_type_id') !!}" id="job_type_id_div">
                {!! Form::select('job_type_id', ['' => __('Select Job Type')] + $jobTypes, null, ['class' => 'form-control', 'id' => 'job_type_id']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'job_type_id') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'num_of_positions') !!}" id="num_of_positions_div">
                {!! Form::select('num_of_positions', ['' => __('Select number of Positions')] + MiscHelper::getNumPositions(), null, ['class' => 'form-control', 'id' => 'num_of_positions']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'num_of_positions') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'expiry_date') !!}">
                {!! Form::text('expiry_date', null, ['class' => 'form-control datepicker', 'id' => 'expiry_date', 'placeholder' => __('Job expiry date'), 'autocomplete' => 'off']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'expiry_date') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'degree_level_id') !!}" id="degree_level_id_div">
                {!! Form::select('degree_level_id', ['' => __('Select Required Degree Level')] + $degreeLevels, null, ['class' => 'form-control', 'id' => 'degree_level_id']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'degree_level_id') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}" id="job_experience_id_div">
                {!! Form::select('job_experience_id', ['' => __('Select Required job experience')] + $jobExperiences, null, ['class' => 'form-control', 'id' => 'job_experience_id']) !!}
                {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('mostrarInfo', 'Mostrar información de la empresa', ['class' => 'bold']) !!}
        <div class="radio-list">
            <label class="radio-inline">
                <input id="mostrarInfo_yes" name="mostrarInfo" type="radio" value="1" {{ $mostrarInfoChecked == '1' ? 'checked="checked"' : '' }}>
                {{ __('Yes') }}
            </label>
            <label class="radio-inline">
                <input id="mostrarInfo_no" name="mostrarInfo" type="radio" value="0" {{ $mostrarInfoChecked != '1' ? 'checked="checked"' : '' }}>
                {{ __('No') }}
            </label>
        </div>
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_freelance') !!}">
        {!! Form::label('is_freelance', __('Remoto?'), ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_freelance_1 = '';
            $is_freelance_2 = 'checked="checked"';
            if (old('is_freelance', isset($job) ? $job->is_freelance : 0) == 1) {
                $is_freelance_1 = 'checked="checked"';
                $is_freelance_2 = '';
            }
            ?>
            <label class="radio-inline">
                <input id="is_freelance_yes" name="is_freelance" type="radio" value="1" {{ $is_freelance_1 }}>
                {{ __('Yes') }}
            </label>
            <label class="radio-inline">
                <input id="is_freelance_no" name="is_freelance" type="radio" value="0" {{ $is_freelance_2 }}>
                {{ __('No') }}
            </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_freelance') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'pcd') !!}">
        {!! Form::label('pcd', __('Puede aplicar persona en condición de discapacidad?'), ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $pcd_1 = '';
            $pcd_2 = 'checked="checked"';
            if (old('pcd', isset($job) ? $job->pcd : 0) == 1) {
                $pcd_1 = 'checked="checked"';
                $pcd_2 = '';
            }
            ?>
            <label class="radio-inline">
                <input id="pcd_yes" name="pcd" type="radio" value="1" {{ $pcd_1 }}>
                {{ __('Yes') }}
            </label>
            <label class="radio-inline">
                <input id="pcd_no" name="pcd" type="radio" value="0" {{ $pcd_2 }}>
                {{ __('No') }}
            </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'pcd') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_pl') !!}">
        {!! Form::label('is_pl', __('Práctica laboral?'), ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_pl_1 = '';
            $is_pl_2 = 'checked="checked"';
            if (old('is_pl', isset($job) ? $job->is_pl : 0) == 1) {
                $is_pl_1 = 'checked="checked"';
                $is_pl_2 = '';
            }
            ?>
            <label class="radio-inline">
                <input id="is_pl_yes" name="is_pl" type="radio" value="1" {{ $is_pl_1 }}>
                {{ __('Yes') }}
            </label>
            <label class="radio-inline">
                <input id="is_pl_no" name="is_pl" type="radio" value="0" {{ $is_pl_2 }}>
                {{ __('No') }}
            </label>
        </div>
        <small class="text-danger">Si selecciona práctica laboral, se guardará el tipo de contrato como : Otra</small>
        {!! APFrmErrHelp::showErrors($errors, 'is_pl') !!}
    </div>

    <hr>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">
        {!! Form::label('is_active', 'Activo?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', isset($job) ? $job->is_active : 1) == 0) {
                $is_active_1 = '';
                $is_active_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="active" name="is_active" type="radio" value="1" {{ $is_active_1 }}>
                Activo
            </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" {{ $is_active_2 }}>
                Inactivo
            </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_featured') !!}">
        {!! Form::label('is_featured', 'Destacado?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_featured_1 = '';
            $is_featured_2 = 'checked="checked"';
            if (old('is_featured', isset($job) ? $job->is_featured : 0) == 1) {
                $is_featured_1 = 'checked="checked"';
                $is_featured_2 = '';
            }
            ?>
            <label class="radio-inline">
                <input id="featured" name="is_featured" type="radio" value="1" {{ $is_featured_1 }}>
                Destacado
            </label>
            <label class="radio-inline">
                <input id="not_featured" name="is_featured" type="radio" value="0" {{ $is_featured_2 }}>
                No Destacado
            </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_featured') !!}
    </div>

    <div class="form-actions">
        {!! Form::button('Guardar <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', ['class' => 'btn btn-large btn-primary', 'type' => 'submit']) !!}
    </div>
</div>
@push('css')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('admin.shared.tinyMCEFront')
<script type="text/javascript">
    $(document).ready(function() {
        $('#company_id').select2({
            width: '100%',
            placeholder: 'Seleccione Compañía',
            allowClear: true
        });

        var $positionSelect = $('#position');
        $positionSelect.select2({
            width: '100%',
            placeholder: 'Ocupación',
            allowClear: true,
            ajax: {
                url: '/api/proffesions',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { q: params.term || '' };
                },
                processResults: function(data) {
                    return data;
                }
            }
        });

        @php
            $selectedPosition = old('position', isset($job) ? $job->position : null);
        @endphp
        @if (!empty($selectedPosition))
        $.ajax({
            type: 'GET',
            url: '/api/proffesions?name=' + encodeURIComponent(@json($selectedPosition))
        }).then(function(data) {
            if (!data || !data.id) {
                return;
            }
            var option = new Option(data.text, data.id, true, true);
            $positionSelect.append(option).trigger('change');
        });
        @endif

        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d'
        });
        $('#country_id').on('change', function(e) {
            e.preventDefault();
            filterDefaultStates(0);
        });
        $(document).on('change', '#state_id', function(e) {
            e.preventDefault();
            filterDefaultCities(0);
        });
        filterDefaultStates(<?php echo old('state_id', (isset($job)) ? $job->state_id : 0); ?>);
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
                    filterDefaultCities(<?php echo old('city_id', (isset($job)) ? $job->city_id : 0); ?>);
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
</script>
@endpush
