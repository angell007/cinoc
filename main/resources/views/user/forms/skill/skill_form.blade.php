<div class="modal-body">
    <div class="form-body">
        <div class="formrow" id="div_job_skill_id">
            <?php
            $job_skill_id = (isset($profileSkill) ? $profileSkill->job_skill_id : null);
            ?>
            {!! Form::select('job_skill_id', [''=>__('Select skill')]+$jobSkills, $job_skill_id, array('class'=>'custom-select text-wrap', 'id'=>'job_skill_id')) !!} 
            <span class="help-block text-danger job_skill_id-error"></span> </div>
   
</div>