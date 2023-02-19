<div class="modal-body">
    <div class="form-body">

        <div class="formrow" id="div_title">
            <input class="form-control" id="titleExp" placeholder="{{ __('Experience Title') }}" name="title"
                type="text" value="{{ isset($profileExperience) ? $profileExperience->title : '' }}">
            <span class="help-block text-danger title-error"> </span>
        </div>

        <div class="formrow" id="div_title">
            <input class="form-control" id="position" placeholder="Cargo" name="position" type="text"
                value="{{ isset($profileExperience) ? $profileExperience->position : '' }}">
            <span class="help-block text-danger title-error"> </span>
        </div>

        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'profession') !!}">
            {!! Form::select(
                'profession',
                [],
                [],
                [
                    'class' => 'form-control-xg selected-remote',
                    'id' => 'profession',
                    'value' => isset($profileExperience->profession) ? $profileExperience->profession : null,
                ],
            ) !!}
            {!! APFrmErrHelp::showErrors($errors, 'profession') !!}
            <span class="help-block text-danger profession-error"></span>
        </div>
        
        <div class="formrow" id="div_company">
            <input class="form-control" id="companyExp" placeholder="{{ __('Company') }}" name="company" type="text"
                value="{{ isset($profileExperience) ? $profileExperience->company : '' }}">
            <span class="help-block text-danger company-error"> </span>
        </div>
        <div class="formrow" id="div_country_id"> <?php $country_id = isset($profileExperience) ? $profileExperience->country_id : $siteSetting->default_country_id; ?>
            {!! Form::select('country_id', ['' => __('Select Country')] + $countries, $country_id, [
                'class' => 'form-control',
                'id' => 'experience_country_id',
            ]) !!}
            <span class="help-block text-danger country_id-error"> </span>
        </div>
        <div class="formrow" id="div_state_id">
            <span id="default_state_experience_dd"> {!! Form::select('state_id', ['' => __('Select State')], null, [
                'class' => 'form-control',
                'id' => 'experience_state_id',
            ]) !!}
            </span> <span class="help-block text-danger state_id-error"> </span>
        </div>
        <div class="formrow" id="div_city_id">
            <span id="default_city_experience_dd"> {!! Form::select('city_id', ['' => __('Select State')], null, ['class' => 'form-control', 'id' => '_id']) !!} </span>
            <span class="help-block text-danger city_id-error"> </span>
        </div>
        <div class="formrow" id="div_date_start">
            <input class="form-control datepicker" autocomplete="off" id="date_startExp"
                placeholder="{{ __('Experience Start Date') }}" name="date_start" type="text"
                value="{{ isset($profileExperience->date_start) ? $profileExperience->date_start->format('Y-m-d') : '' }}">
            <span class="help-block text-danger date_start-error"> </span>
        </div>
        <div class="formrow" id="div_date_end">
            <input class="form-control datepicker" autocomplete="off" id="date_endExp"
                placeholder="{{ __('Experience End Date') }}" name="date_end" type="text"
                value="{{ isset($profileExperience->date_end) ? $profileExperience->date_end->format('Y-m-d') : '' }}">
            <span class="help-block text-danger date_end-error"> </span>
        </div>
        <div class="formrow" id="div_is_currently_working">

            <label for="is_currently_working" class="bold">{{ __('Laborando actualmente?') }} </label>
            <div class="radio-list"> <?php $val_1_checked = '';
            $val_2_checked = 'checked="checked"';
            if (isset($profileExperience) && $profileExperience->is_currently_working == 1) {
                $val_1_checked = 'checked="checked"';
                $val_2_checked = '';
            } ?>
                <label class="radio-inline"> <input id="currently_working" name="is_currently_working" type="radio"
                        value="1" {{ $val_1_checked }}> {{ __('Yes') }} </label>

                <label class="radio-inline"> <input id="not_currently_working" name="is_currently_working"
                        type="radio" value="0" {{ $val_2_checked }}> {{ __('No') }} </label>
            </div>

            <span class="help-block text-danger is_currently_working-error"> </span>

        </div>
        <div class="formrow" id="file-adjunto">
            <label>Adjuntar un archivo </label>
            <input type="file" name="adjunto" accept="image/png, image/jpeg" class="form-control" id="adjunto"
                placeholder="{{ __('Adjunto') }}">
            <span class="help-block text-danger adjunto-error"> </span>
        </div>
        <div class="formrow" id="div_description">
            <textarea name="description" class="form-control" id="descriptionExp" placeholder="{{ __('Experience description') }}">{{ isset($profileExperience) ? $profileExperience->description : '' }}</textarea>
            <span class="help-block text-danger description-error"> </span>
        </div>
    </div>
</div>
