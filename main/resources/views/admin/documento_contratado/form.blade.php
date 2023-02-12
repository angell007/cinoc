<div class="form-group {{ $errors->has('id_empresa') ? 'has-error' : ''}}">
    <label for="id_empresa" class="control-label">{{ 'Empresa' }}</label>
    <input class="form-control" name="id_empresa" type="number" id="id_empresa" value="{{ isset($documento_contratado->id_empresa) ? $documento_contratado->id_empresa : ''}}">
    {!! $errors->first('id_empresa', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('id_candidato') ? 'has-error' : ''}}">
    <label for="id_candidato" class="control-label">{{ 'Candidato' }}</label>
    <input class="form-control" name="id_candidato" type="number" id="id_candidato" value="{{ isset($documento_contratado->id_candidato) ? $documento_contratado->id_candidato : ''}}">
    {!! $errors->first('id_candidato', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
    <label for="fecha" class="control-label">{{ 'Fecha' }}</label>
    <input class="form-control" name="fecha" type="date" id="fecha" value="{{ isset($documento_contratado->fecha) ? $documento_contratado->fecha : ''}}">
    {!! $errors->first('fecha', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('notas') ? 'has-error' : ''}}">
    <label for="notas" class="control-label">{{ 'Notas' }}</label>
    <textarea class="form-control" rows="5" name="notas" type="textarea" id="notas">{{ isset($documento_contratado->notas) ? $documento_contratado->notas : ''}}</textarea>
    {!! $errors->first('notas', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>