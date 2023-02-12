<div class="modal-body">
    <div class="form-body">
        <div class="form-group" id="div_job_skill_id">
            <label for="job_skill_id" class="bold">Habilidad</label>
            <?php
            $job_skill_id = (isset($profileSkill) ? $profileSkill->job_skill_id : null);
            ?>
            {!! Form::select('job_skill_id', [''=>'Seleccione habilidad']+$jobSkills, $job_skill_id, array('class'=>'form-control', 'id'=>'job_skill_id')) !!} <span class="help-block text-danger job_skill_id-error"></span>
        </div>
        <div class="form-group" id="div_job_experience_id">
            <label for="job_experience_id" class="bold"> Experiencia</label>
            <?php
            $job_experience_id = (isset($profileSkill) ? $profileSkill->job_experience_id : null);
            ?>
            {!! Form::select('job_experience_id', [''=>'Seleccione experiencia']+$jobExperiences, $job_experience_id, array('class'=>'form-control', 'id'=>'job_experience_id')) !!} <span class="help-block text-danger job_experience_id-error"></span>
        </div>
    </div>
</div>