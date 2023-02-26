<div class="modal-body">

    <div class="form-body">
        <div class="formrow" id="div_degree_level_id"> <?php $degree_level_id = isset($profileEducation) ? $profileEducation->degree_level_id : null; ?>
            {!! Form::select('degree_level_id', ['' => __('Select Degree Level')] + $degreeLevels, $degree_level_id, [
                'class' => 'form-control',
                'id' => 'degree_level_id',
            ]) !!} <span class="help-block text-danger degree_level_id-error">
            </span> </div>


        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'degree_title') !!}">
            <label>{{ __('Degree Title') }}</label>
            {!! Form::select(
                'degree_title',
                [],
                [],
                [
                    'class' => 'form-control-xg selected-remote',
                    'id' => 'degree_title',
                    'value' => isset($profileEducation->degree_title) ? $profileEducation->degree_title : null,
                ],
            ) !!}
            {!! APFrmErrHelp::showErrors($errors, 'degree_title') !!}
            <span class="help-block text-danger degree_title-error"></span>
        </div>

        <div class="formrow" id="div_major_subjects"> <?php $profileEducationMajorSubjectIds = old('major_subjects', $profileEducationMajorSubjectIds); ?>
            <label for="">{{ __('Area') }}</label>
            {!! Form::select('major_subjects[]', $majorSubjects, $profileEducationMajorSubjectIds, [
                'class' => 'form-control select',
                'id' => 'major_subjects',
            ]) !!} <span class="help-block text-danger major_subjects-error">
            </span>
        </div>

        <div class="formrow" id="div_country_id"> <?php $country_id = isset($profileEducation) ? $profileEducation->country_id : ''; ?>
            {!! Form::select('country_id', ['' => __('Select Country')] + $countries, $country_id, [
                'class' => 'form-control',
                'id' => 'education_country_id',
            ]) !!} <span class="help-block text-danger country_id-error">
            </span> </div>

        <div class="formrow" id="div_state_id"> <span id="default_state_education_dd"> {!! Form::select('state_id', ['' => __('Select State')], null, [
            'class' => 'form-control',
            'id' => 'education_state_id',
        ]) !!} </span>
            <span class="help-block text-danger state_id-error">
            </span>
        </div>

        <div class="formrow" id="div_city_id"> <span id="default_city_education_dd"> {!! Form::select('city_id', ['' => __('Select City')], null, ['class' => 'form-control', 'id' => 'city_id']) !!} </span>
            <span class="help-block text-danger city_id-error">
            </span>
        </div>

        <div class="formrow" id="div_institution"> <input class="form-control" id="institution"
                placeholder="{{ __('Institution') }}" name="institution" type="text"
                value="{{ isset($profileEducation) ? $profileEducation->institution : '' }}"> <span
                class="help-block text-danger institution-error">
            </span> </div>

        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'date_completion') !!}">

            {!! Form::label('date_completion', 'Fecha de graduación', ['class' => 'bold']) !!}

            {!! Form::date('date_completion', isset($profileEducation) ? $profileEducation->date_completion : '', [
                'class' => 'form-control',
                'id' => 'date_completion',
                'placeholder' => 'Fecha de graduación',
                'autocomplete' => 'off',
            ]) !!}

            {!! APFrmErrHelp::showErrors($errors, 'date_completion') !!}

        </div>

        <?php $date_coursing = ['NA' => 'NA', 'I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV', 'V' => 'V', 'VI' => 'VI', 'VII' => 'VII', 'VIII' => 'VIII', 'IX' => 'IX', 'X' => 'X'];
        $date_coursed = isset($profileEducation) ? $profileEducation->degree_result : null; ?>

        <div class="formrow" id="div_degree_result">
            {!! Form::select('degree_result', ['' => __('Degree Result')] + $date_coursing, $date_coursed, [
                'class' => 'form-control',
                'id' => 'degree_result',
            ]) !!}
            <span class="help-block text-danger date_coursing-error">
            </span>
        </div>
    </div>
</div>
