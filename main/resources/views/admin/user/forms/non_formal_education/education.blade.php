{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <div class="form-group">
        <button class="btn purple btn-outline sbold" onclick="mostrarModalEducacionNoFormal();">
            {{ __('Nueva educación no formal') }}
        </button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">{{ __('Educación No Formal') }}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row" id="contenedor_educacion_no_formal">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal_educacion_no_formal" role="dialog">
</div>

@push('css')
    <style type="text/css">
        .datepicker>div {
            display: block;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        function mostrarModalEducacionNoFormal() {
            $("#modal_educacion_no_formal").modal();
            cargarFormularioEducacionNoFormal();
        }

        function cargarFormularioEducacionNoFormal() {
            $.ajax({
                type: "POST",
                url: "{{ route('get.profile.education_non_formal.form', $user->id) }}",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                datatype: 'json',
                success: function(json) {
                    $("#modal_educacion_no_formal").html(json.html);
                    inicializarDatepicker();
                    filtrarEstadosEducacionNoFormal(0, 0);
                    $('.selected-remote').select2({
                        width: 'resolve',
                        ajax: {
                            url: '/api/titles',
                            dataType: 'json'
                        }
                    });
                }
            });
        }

        function mostrarModalEdicionEducacionNoFormal(id = 0, estadoId = 0, ciudadId = 0) {
            $("#modal_educacion_no_formal").modal();
            cargarFormularioEdicionEducacionNoFormal(id, estadoId, ciudadId);
        }

        function cargarFormularioEdicionEducacionNoFormal(id, estadoId, ciudadId) {
            $.ajax({
                type: "POST",
                url: "{{ route('get.profile.education_non_formal.edit.form', $user->id) }}",
                data: {
                    "education_non_formal_id": id,
                    "_token": "{{ csrf_token() }}"
                },
                datatype: 'json',
                success: async function(json) {
                    $("#modal_educacion_no_formal").html(json.html);
                    await inicializarDatepicker();
                    await filtrarEstadosEducacionNoFormal(estadoId, ciudadId);
                    var titulo = await document.getElementById('titulo').getAttribute("value");
                    $('.selected-remote').select2({
                        width: 'resolve',
                        ajax: {
                            url: '/api/titles',
                            dataType: 'json'
                        }
                    });
                    var selectEstudiante = $('.selected-remote');
                    $.ajax({
                        type: 'GET',
                        url: '/api/titles?name=' + titulo
                    }).then(function(data) {
                        var option = new Option(data.text, data.id, true, true);
                        selectEstudiante.append(option).trigger('change');
                    });
                }
            });
        }

        function enviarFormularioEducacionNoFormal() {
            var form = $('#add_edit_profile_education_non_formal');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function(json) {
                    $("#modal_educacion_no_formal").html(json.html);
                    mostrarEducacionNoFormal();
                },
                error: function(json) {
                    if (json.status === 422) {
                        var resJSON = json.responseJSON;
                        $('.help-block').html('');
                        $.each(resJSON.errors, function(key, value) {
                            $('.' + key + '-error').html(' <strong > ' + value + ' </strong>');
                            $('#div_' + key).addClass('has-error');
                        });
                    } else {
                        alert('Credenciales incorrectas. Por favor, inténtelo de nuevo.')
                    }
                }
            });
        }

        function eliminarEducacionNoFormal(id) {
            if (confirm('¿Está seguro de que desea eliminar?')) {
                $.post("{{ route('delete.profile.education_non_formal') }}", {
                    id: id,
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    if (response == 'ok') {
                        $('#education_non_formal_' + id).remove();
                    } else {
                        alert('¡La solicitud falló!');
                    }
                });
            }
        }

        function inicializarDatepicker() {
            $(".datepicker").datepicker({
                autoclose: true,
                format: 'yyyy-m-d'
            });
            $('.select2-multiple').select2({
                placeholder: "Seleccionar temas principales",
                allowClear: true
            });
        }

        $(document).ready(function() {
            mostrarEducacionNoFormal();
            inicializarDatepicker();

            $(document).on('change', '#education_non_formal_country', function(e) {
                e.preventDefault();
                filtrarEstadosEducacionNoFormal(0, 0);
            });
            $(document).on('change', '#default_state_education_non_formal_dd', function(e) {
                e.preventDefault();
                filtrarCiudadesEducacionNoFormal(0);
            });
        });

        function mostrarEducacionNoFormal() {
            $.post("{{ route('show.profile.education_non_formal', $user->id) }}", {
                user_id: {{ $user->id }},
                _method: 'POST',
                _token: '{{ csrf_token() }}'
            }).done(function(response) {
                $('#contenedor_educacion_no_formal').html(response);
            });
        }

        function filtrarEstadosEducacionNoFormal(estadoId, ciudadId) {
            var paisId = $('#education_non_formal_country').val();
            if (paisId != '') {
                $.post("{{ route('filter.lang.states.dropdown') }}", {
                    country_id: paisId,
                    state_id: estadoId,
                    new_state_id: 'education_non_formal_state',
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    $('#default_state_education_non_formal_dd').html(response);
                    filtrarCiudadesEducacionNoFormal(ciudadId);
                });
            }
        }

        function filtrarCiudadesEducacionNoFormal(ciudadId) {
            var estadoId = $('#default_state_education_non_formal_dd').val();
            if (estadoId != '') {
                $.post("{{ route('filter.lang.cities.dropdown') }}", {
                    state_id: estadoId,
                    city_id: ciudadId,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    $('#default_city_education_non_formal_dd').html(response);
                });
            }
        }
    </script>
@endpush
