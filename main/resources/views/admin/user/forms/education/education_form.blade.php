<div class="modal-body">
    <div class="form-body">
        <div class="form-group" id="div_degree_level_id">
            <label for="degree_level_id" class="bold">Grado</label>
            <?php
            $degree_level_id = (isset($profileEducation) ? $profileEducation->degree_level_id : null);
            ?>
            {!! Form::select('degree_level_id', [''=>'Seleccione Grado']+$degreeLevels, $degree_level_id, array('class'=>'form-control', 'id'=>'degree_level_id')) !!}
            <span class="help-block text-danger degree_level_id-error"></span>
        </div>


       

        <div class="form-group" id="div_degree_title">
            <label for="degree_title" class="bold"> Titulo </label>
            <input class="form-control" id="degree_title" placeholder=" Titulo" name="degree_title" type="text" value="{{(isset($profileEducation)? $profileEducation->degree_title:'')}}">
            <span class="help-block text-danger degree_title-error"></span>
        </div>

        <div class="form-group" id="div_major_subjects">
            <label for="degree_major_subjects" class="bold">Temas</label>
            <?php
            $profileEducationMajorSubjectIds = old('major_subjects', $profileEducationMajorSubjectIds);
            ?>
            {!! Form::select('major_subjects[]', $majorSubjects, $profileEducationMajorSubjectIds, array('class'=>'form-control select2-multiple', 'id'=>'major_subjects', 'multiple'=>'multiple')) !!}
            <span class="help-block text-danger major_subjects-error"></span>
        </div>

        <div class="form-group" id="div_country_id">
            <label for="country_id" class="bold">País</label>
            <?php
            $country_id = (isset($profileEducation) ? $profileEducation->country_id : 0);
            ?>
            {!! Form::select('country_id', [''=>'Seleccione País']+$countries, $country_id, array('class'=>'form-control', 'id'=>'education_country_id')) !!}
            <span class="help-block text-danger country_id-error"></span>
        </div>

        <div class="form-group" id="div_state_id">
            <label for="state_id" class="bold">Departamento</label>
            <span id="default_state_education_dd">
                {!! Form::select('state_id', [''=>'Seleccione departamento'], null, array('class'=>'form-control', 'id'=>'education_state_id')) !!}
            </span>
            <span class="help-block text-danger state_id-error"></span>
        </div>

        <div class="form-group" id="div_city_id">
            <label for="city_id" class="bold">Ciudad</label>
            <span id="default_city_education_dd">
                {!! Form::select('city_id', [''=>'Seleccione ciudad'], null, array('class'=>'form-control', 'id'=>'city_id')) !!}
            </span>
            <span class="help-block text-danger city_id-error"></span>
        </div>

        <div class="form-group" id="div_institution">
            <label for="institution" class="bold">Institución</label>
            <input class="form-control" id="institution" placeholder="Institution" name="institution" type="text" value="{{(isset($profileEducation)? $profileEducation->institution:'')}}">
            <span class="help-block text-danger institution-error"></span>
        </div>


        <div class="form-group" id="div_date_completion">
            <label for="date_completion" class="bold">Año de finalizado</label>
            <?php
            $date_completion = (isset($profileEducation) ? $profileEducation->date_completion : null);
            ?>
            {!! Form::select('date_completion', [''=>'Seleccione año']+MiscHelper::getEstablishedIn(), $date_completion, array('class'=>'form-control', 'id'=>'date_completion')) !!}
            <span class="help-block text-danger date_completion-error"></span>
        </div>
        
        <?php 
                    $date_coursing = [  
                                        'NA' => 'NA',
                                        'I' => 'I',
                                        'II' => 'II',
                                        'III' => 'III',
                                        'IV'=> 'IV',
                                        'V' => 'V',
                                        'VI' => 'VI',
                                        'VII' => 'VII',
                                        'VIII'=> 'VIII',
                                        'IX'=> 'IX',
                                        'X'=> 'X'
                                        ] ;
                    $date_coursed = (isset($profileEducation) ? $profileEducation->degree_result : null);

        ?>
        
        <div class="formrow" id="div_degree_result">
            {!! Form::select('degree_result', [''=>__('Degree Result')]+$date_coursing, $date_coursed, array('class'=>'form-control', 'id'=>'degree_result')) !!}
            <span class="help-block text-danger date_coursing-error"></span>
        </div>


       
    </div>
</div>