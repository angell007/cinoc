<?php
$lang = config('default_lang');
if (isset($link)) {
    $lang = $link->lang;
}
$lang = MiscHelper::getLang($lang);
$direction = MiscHelper::getLangDirection($lang);
$queryString = MiscHelper::getLangQueryStr();
?>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'lang') !!}">
        {!! Form::label('lang', 'Language', ['class' => 'bold']) !!}
        {!! Form::select('lang', ['' => 'Select Language'] + $languages, $lang, [
            'class' => 'form-control',
            'id' => 'lang',
            'onchange' => 'setLang(this.value)',
        ]) !!}
        {!! APFrmErrHelp::showErrors($errors, 'lang') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'link') !!}">
        {!! Form::label('link', 'Enlace', ['class' => 'bold']) !!}
        {!! Form::textarea('link', null, [
            'class' => 'form-control',
            'id' => 'link',
            'placeholder' => 'Enlace',
        ]) !!}
        {!! APFrmErrHelp::showErrors($errors, 'link') !!}
    </div>

    <div class="form-group">
        <label for="description">Rol</label>
        <select class="form-control" name="rol">
            <option>
                Candidato
            </option>
            <option>
                Empleador
            </option>
        </select>
    </div>



    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'text') !!}">
        {!! Form::label('text', 'Descripción', ['class' => 'bold']) !!}
        {!! Form::textarea('text', null, [
            'class' => 'form-control',
            'id' => 'text',
            'placeholder' => 'Descripción',
        ]) !!}
        {!! APFrmErrHelp::showErrors($errors, 'text') !!}
    </div>
    <div class="form-actions">
        {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', [
            'class' => 'btn btn-large btn-primary',
            'type' => 'submit',
        ]) !!}
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        function setLang(lang) {
            window.location.href = "<?php echo url(Request::url()) . $queryString; ?>" + lang;
        }
    </script>
    @include('admin.shared.tinyMCE')
@endpush
