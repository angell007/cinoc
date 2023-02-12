<div class="modal-body">
    <div class="form-body">
        <div class="form-group" id="div_title">
            <label for="title" class="bold">Experiencia Titulo</label>
            <input class="form-control" id="title" placeholder="Experiencia titulo" name="title" type="text" value="{{(isset($profileExperience)? $profileExperience->title:'')}}">
            <span class="help-block text-danger title-error"></span>
        </div>

        <div class="form-group" id="div_company">
            <label for="company" class="bold">Compañia</label>
            <input class="form-control" id="company" placeholder="Compañia" name="company" type="text" value="{{(isset($profileExperience)? $profileExperience->company:'')}}">
            <span class="help-block text-danger company-error"></span>
        </div>

        <div class="form-group" id="div_country_id">
            <label for="country_id" class="bold">Pais</label>
            <?php
            $country_id = (isset($profileExperience) ? $profileExperience->country_id : 0);
            ?>
            {!! Form::select('country_id', [''=>'Seleccione país']+$countries, $country_id, array('class'=>'form-control', 'id'=>'experience_country_id')) !!}
            <span class="help-block text-danger country_id-error"></span>
        </div>

        <div class="form-group" id="div_state_id">
            <label for="state_id" class="bold">Departamento</label>
            <span id="default_state_experience_dd">
                {!! Form::select('state_id', [''=>'Seleccione departamento'], null, array('class'=>'form-control', 'id'=>'experience_state_id')) !!}
            </span>
            <span class="help-block text-danger state_id-error"></span>
        </div>

        <div class="form-group" id="div_city_id">
            <label for="city_id" class="bold">Ciudad</label>
            <span id="default_city_experience_dd">
                {!! Form::select('city_id', [''=>'Seleccione ciudad'], null, array('class'=>'form-control', 'id'=>'city_id')) !!}
            </span>
            <span class="help-block text-danger city_id-error"></span>
        </div>

        <div class="form-group" id="div_date_start">
            <label for="date_start" class="bold">Fecha de inicio</label>
            <input class="form-control datepicker" autocomplete="off" id="date_start" placeholder="Fecha de inicio" name="date_start" type="text" value="{{(isset($profileExperience)? $profileExperience->date_start->format('Y-m-d'):'')}}">
            <span class="help-block text-danger date_start-error"></span>
        </div>
        <div class="form-group" id="div_date_end">
            <label for="date_end" class="bold">Fecha de finalizado</label>
            <input class="form-control datepicker" autocomplete="off" id="date_end" placeholder="Fecha de finalizado" name="date_end" type="text" value="{{(isset($profileExperience)? $profileExperience->date_end->format('Y-m-d'):'')}}">
            <span class="help-block text-danger date_end-error"></span>
        </div>
        <div class="form-group" id="div_is_currently_working">
            <label for="is_currently_working" class="bold">Actualmente en curso?</label>
            <div class="radio-list" style="margin-left:22px;">
                <?php
                $val_1_checked = '';
                $val_2_checked = 'checked="checked"';

                if (isset($profileExperience) && $profileExperience->is_currently_working == 1) {
                    $val_1_checked = 'checked="checked"';
                    $val_2_checked = '';
                }
                ?>
                <label class="radio-inline"><input id="currently_working" name="is_currently_working" type="radio" value="1" {{$val_1_checked}}> Si </label>
                <label class="radio-inline"><input id="not_currently_working" name="is_currently_working" type="radio" value="0" {{$val_2_checked}}> No </label>
            </div>
            <span class="help-block text-danger is_currently_working-error"></span>
        </div>
        <div class="form-group" id="div_description">
            <label for="name" class="bold">Descripción</label>
            <textarea name="description" class="form-control" id="description" placeholder="Experience description">{{(isset($profileExperience)? $profileExperience->description:'')}}</textarea>
            <span class="help-block text-danger description-error"></span>
        </div>
    </div>
</div>