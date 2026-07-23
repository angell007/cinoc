@php
    $profileCompletion = null;
    if (class_exists(\App\Helpers\ProfileCompletionHelper::class) && Auth::check()) {
        $profileCompletion = $profileCompletion ?? \App\Helpers\ProfileCompletionHelper::assess(Auth::user());
    }
@endphp

@if($profileCompletion && !$profileCompletion['is_complete'])
<div class="alert alert-warning profile-completion-notice">
    <strong>Hoja de vida incompleta ({{ $profileCompletion['percentage'] }}% de {{ $profileCompletion['threshold'] }}% requerido).</strong>
    Para aplicar a vacantes debes diligenciar al menos el {{ $profileCompletion['threshold'] }}% de los campos obligatorios del sistema.
    <br><br>
    <strong>Campos pendientes:</strong> {{ implode(', ', $profileCompletion['missing']) }}.
    <br><br>
    <a href="{{ route('my.profile') }}" class="btn btn-sm btn-primary">Completar mi hoja de vida</a>
    <a href="{{ url('my-cv') }}" class="btn btn-sm btn-default">Ver avance de mi hoja de vida</a>
</div>
@elseif($profileCompletion)
<div class="alert alert-success profile-completion-notice">
    Tu hoja de vida está registrada al {{ $profileCompletion['percentage'] }}%. Ya puedes aplicar a vacantes.
</div>
@endif
