<div class="modal-body">
    <div class="form-body">
        <div class="form-group" id="div_language_id">
            <label for="language_id" class="bold">Idioma</label>
            <?php
            $language_id = (isset($profileLanguage) ? $profileLanguage->language_id : null);
            ?>
            {!! Form::select('language_id', [''=>'Seleccione idioma']+$languages, $language_id, array('class'=>'form-control', 'id'=>'language_id')) !!} <span class="help-block text-danger language_id-error"></span>
        </div>
        <div class="form-group" id="div_language_level_id">
            <label for="language_level_id" class="bold">Nivel de Idioma</label>
            <?php
            $language_level_id = (isset($profileLanguage) ? $profileLanguage->language_level_id : null);
            ?>
            {!! Form::select('language_level_id', [''=>'Seleccione nivel de idioma ']+$languageLevels, $language_level_id, array('class'=>'form-control', 'id'=>'language_level_id')) !!} <span class="help-block text-danger language_level_id-error"></span>
        </div>
    </div>
</div>