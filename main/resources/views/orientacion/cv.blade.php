@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.inner_page_title', ['page_title' => 'Solicitud de revisión de hoja de vida'])
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')
            <div class="col-md-9 col-sm-8">
                <div class="userccount">
                    <div class="formpanel mt0">
                        @include('flash::message')

                        <h5>Solicitud de revisión de hoja de vida</h5>

                        <p style="line-height: 1.6; margin-bottom: 15px;">
                            Seleccione la hoja de vida que desea enviar a revisión. La administradora de la Bolsa de Empleo
                            evaluará el contenido, redacción, estructura, organización de la información y presentación del
                            currículo dentro de un plazo de uno (1) a tres (3) días hábiles. Las observaciones serán
                            incorporadas en el documento mediante comentarios y remitidas al correo electrónico registrado.
                        </p>

                        <form id="cvReviewForm" class="form-horizontal">
                            <div class="formrow">
                                <label for="cv_id"><strong>Hoja de vida a revisar</strong></label>
                                <select class="form-control" name="cv_id" id="cv_id" required>
                                    <option value="platform">Hoja de vida registrada en la plataforma</option>
                                    @foreach ($cvs as $cv)
                                        <option value="{{ $cv->id }}">{{ $cv->title_cv }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="formrow" style="margin-top: 15px;">
                                <button type="button" id="btnEnviar" class="btn btn-primary" onclick="sendRevision()">
                                    Enviar solicitud
                                </button>
                                <a href="{{ route('my.cv.preview') }}" class="btn btn-default">Ver mi hoja de vida</a>
                                <a href="{{ url('my-profile#cvs') }}" class="btn btn-default">Gestionar archivos de CV</a>
                            </div>
                        </form>

                        @if ($cvs->isEmpty())
                            <div class="alert alert-info" style="margin-top: 15px;">
                                También puede solicitar la revisión de la hoja de vida generada con la información registrada en la plataforma.
                                Si desea adjuntar un archivo adicional, cargue uno en la sección
                                <a href="{{ url('my-profile#cvs') }}">Gestionar currículum</a>.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection

@push('scripts')
<script type="text/javascript">
    function sendRevision() {
        var btn = document.getElementById('btnEnviar');
        var cvId = document.getElementById('cv_id').value;

        btn.disabled = true;
        btn.innerHTML = 'Enviando...';

        $.ajax({
            type: 'POST',
            url: '{{ route('send-revision') }}',
            data: {
                _token: '{{ csrf_token() }}',
                cv_id: cvId
            },
            success: function() {
                btn.disabled = false;
                btn.innerHTML = 'Enviar solicitud';
                alert('Su solicitud de revisión fue enviada exitosamente. Recibirá las observaciones en su correo electrónico.');
            },
            error: function() {
                btn.disabled = false;
                btn.innerHTML = 'Enviar solicitud';
                alert('No fue posible enviar su solicitud. Intente nuevamente más tarde.');
            }
        });
    }
</script>
@endpush
