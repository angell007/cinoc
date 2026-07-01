<div class="modal-body">
    <div class="form-body">
        <h3>{{ __('Educación No Formal') }}</h3>

        <div class="formrow">
            <label for="education_non_formal_training_type">{{ __('Tipo de Capacitación o Certificación') }}</label>
            {!! Form::select(
                'education_non_formal_training_type',
                [
                    '' => __('Seleccionar Tipo'),
                    'curso' => 'Curso',
                    'taller' => 'Taller', 
                    'diplomado' => 'Diplomado',
                    'seminario' => 'Seminario',
                    'certificacion' => 'Certificación en Competencias',
                ],
                isset($profileEducation) ? $profileEducation->training_type : null,
                [
                    'class' => 'form-control',
                    'id' => 'education_non_formal_training_type',
                ],
            ) !!}
            <span class="help-block text-danger education_non_formal_training_type-error"></span>
        </div>

        <div class="formrow">
            <label for="education_non_formal_institution">{{ __('Institución') }}</label>
            <input class="form-control" id="education_non_formal_institution" name="education_non_formal_institution"
                type="text" placeholder="{{ __('Institución') }}" 
                value="{{ isset($profileEducation) ? $profileEducation->institution : '' }}" />
            <span class="help-block text-danger education_non_formal_institution-error"></span>
        </div>

        <div class="formrow">
            <label for="education_non_formal_certification_status">{{ __('Estado') }}</label>
            {!! Form::select(
                'education_non_formal_certification_status',
                [
                    '' => __('Seleccionar Estado'),
                    'certificado' => 'Certificado',
                    'no_certificado' => 'No Certificado',
                ],
                isset($profileEducation) ? $profileEducation->certification_status : null,
                [
                    'class' => 'form-control',
                    'id' => 'education_non_formal_certification_status',
                ],
            ) !!}
            <span class="help-block text-danger education_non_formal_certification_status-error"></span>
        </div>

        <div class="formrow">
            <label for="education_non_formal_program_name">{{ __('Nombre del Programa') }}</label>
            <input class="form-control" id="education_non_formal_program_name" name="education_non_formal_program_name"
                type="text" placeholder="{{ __('Nombre del Programa') }}"
                value="{{ isset($profileEducation) ? $profileEducation->program_name : '' }}" />
            <span class="help-block text-danger education_non_formal_program_name-error"></span>
        </div>

        <div class="formrow">
            <label for="education_non_formal_country">{{ __('País') }}</label>
            {!! Form::select('country_id', ['' => __('Seleccionar País')] + $countries, 
                isset($profileEducation) ? $profileEducation->country_id : null, 
                [
                    'class' => 'form-control',
                    'id' => 'education_non_formal_country',
                ]) 
            !!}
            <span class="help-block text-danger education_non_formal_country-error"></span>
        </div>

        <div class="formrow">
            <label for="default_state_education_non_formal_dd">{{ __('Departamento') }}</label>
            {!! Form::select('state_id', ['' => __('Seleccionar Departamento')], 
                isset($profileEducation) ? $profileEducation->state_id : null, 
                [
                    'class' => 'form-control',
                    'id' => 'default_state_education_non_formal_dd',
                ]) 
            !!}
            <span class="help-block text-danger default_state_education_non_formal_dd-error"></span>
        </div>

        <div class="formrow">
            <label for="default_city_education_non_formal_dd">{{ __('Ciudad') }}</label>
            {!! Form::select('city_id', ['' => __('Seleccionar Ciudad')], 
                isset($profileEducation) ? $profileEducation->city_id : null, 
                [
                    'class' => 'form-control',
                    'id' => 'default_city_education_non_formal_dd',
                ]) 
            !!}
            <span class="help-block text-danger default_city_education_non_formal_dd-error"></span>
        </div>

        <div class="formrow">
            <label for="education_non_formal_duration">{{ __('Duración en Horas') }}</label>
            <input class="form-control" id="education_non_formal_duration" name="education_non_formal_duration"
                type="number" placeholder="{{ __('Duración en Horas') }}"
                value="{{ isset($profileEducation) ? $profileEducation->duration : '' }}" />
            <span class="help-block text-danger education_non_formal_duration-error"></span>
        </div>

        <div class="form-group">
            <label for="education_non_formal_date">{{ __('Fecha') }}</label>
            {!! Form::date('education_non_formal_date', 
                isset($profileEducation) ? $profileEducation->date : null, 
                [
                    'class' => 'form-control',
                    'id' => 'education_non_formal_date',
                    'placeholder' => __('Fecha'),
                    'autocomplete' => 'off',
                ]) 
            !!}
            <span class="help-block text-danger education_non_formal_date-error"></span>
        </div>
    </div>
</div>
