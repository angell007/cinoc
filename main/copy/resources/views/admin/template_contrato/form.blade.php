<p>
    Convenciones:
    <br />
    <span>
        Para nombre empresa: @nombre_empresa@
        <br />Para nit empresa: @nit_empresa@
        <br />Para nombre estudiante: @nombre_estudiante@
        <br />Para documento estudiante: @documento_estudiante@
        <br />Para instituto de formación: @instituto@
        <br />Para modalidad: @modalidad@
        <br />Para estudio o carrera: @estudio@
        <br />Para fecha : @fecha@
    </span>
</p>

<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    <label for="nombre" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="nombre" type="text" id="nombre" value="{{ isset($template_contrato->nombre) ? $template_contrato->nombre : ''}}">
    {!! $errors->first('nombre', '<p class="help-block text-danger">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('html') ? 'has-error' : ''}}">
    <label for="html" class="control-label">{{ 'Html' }}</label>

    <textarea class="form-control" rows="20" style="height:500px" name="html" type="textarea" id="editor">{{ isset($template_contrato->html) ? $template_contrato->html : ''}}</textarea>
    {!! $errors->first('html', '<p class="help-block text-danger">:message</p>') !!}


</div>


<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">Action</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($template_contrato->status) ? $template_contrato->status : ''}}">
    {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>