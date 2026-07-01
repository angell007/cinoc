<h5 onclick="mostrarEducacionNoFormal();">{{ __('Educación no formal') }}</h5>

<div class="row">
    <div class="col-md-12">
        <div id="contenedor_educacion_no_formal"></div>
    </div>
</div>

<a href="javascript:;" onclick="mostrarModalEducacionNoFormal();">
    {{ __('Agregar educación no formal') }}
</a>

<hr>

<div class="modal" id="modal_educacion_no_formal" role="dialog"></div>

@push('styles')
    <style>
        .form-control-xg {
            height: 15px !important;
        }

        .form-control-xs {
            height: 10px !important;
        }

        .datepicker>div {
            display: block;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const mostrarModalEducacionNoFormal = () => {
            $("#modal_educacion_no_formal").modal();
            cargarFormularioEducacionNoFormal();
        }

        const cargarFormularioEducacionNoFormal = () => {
            $.ajax({
                type: "POST",
                url: "{{ route('get.front.profile.education_non_formal.form', $user->id) }}",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: (json) => {
                    $("#modal_educacion_no_formal").html(json.html);
                    inicializarDatepicker();
                    filtrarEstadosEducacionNoFormal(0, 0);
                    inicializarSelect2();
                }
            });
        }

        const mostrarModalEdicionEducacionNoFormal = (id = 0, estadoId = 0, ciudadId = 0, tipoGradoId = 0) => {
            $("#modal_educacion_no_formal").modal();
            cargarFormularioEdicionEducacionNoFormal(id, estadoId, ciudadId, tipoGradoId);
        }

        const cargarFormularioEdicionEducacionNoFormal = async (id, estadoId, ciudadId, tipoGradoId) => {
            try {
                const response = await $.ajax({
                    type: "POST",
                    url: "{{ route('get.front.profile.education_non_formal.edit.form', $user->id) }}",
                    data: {
                        "education_non_formal_id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json'
                });

                $("#modal_educacion_no_formal").html(response.html);

                await inicializarDatepicker();
                await filtrarEstadosEducacionNoFormal(estadoId, ciudadId);
                //await filtrarTiposGrado(tipoGradoId);

               // inicializarSelect2ConDatos();

            } catch (error) {
                console.error("Error al cargar el formulario de edición:", error);
            }
        }

        const enviarFormularioEducacionNoFormal = () => {
            const form = $('#add_edit_profile_education_non_formal');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: (json) => {
                    console.log(json);
                    $("#modal_educacion_no_formal").html(json.html);
                    mostrarEducacionNoFormal();
                },
                error: (json) => {
                    if (json.status === 422) {
                        mostrarErroresValidacion(json.responseJSON.errors);
                    }
                }
            });
        }

        const eliminarEducacionNoFormal = (id) => {
            if (confirm("{{ __('¿Estás seguro de que quieres eliminar?') }}")) {
                $.post("{{ route('delete.front.profile.education_non_formal') }}", {
                    id: id,
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                }).done((response) => {
                    if (response == 'ok') {
                        $(`#education_non_formal_${id}`).remove();
                    } else {
                        alert('¡La solicitud falló!');
                    }
                });
            }
        }

        const inicializarDatepicker = () => {
            $(".datepicker").datepicker({
                autoclose: true,
                format: 'yyyy-m-d'
            });

            $('.select2-multiple').select2({
                placeholder: "{{ __('') }}",
                allowClear: true
            });
        }

        $(document).ready(() => {
            mostrarEducacionNoFormal();
            inicializarDatepicker();

            $(document).on('change', '#degree_level_id',
                function(e) {
                    e.preventDefault();
                    filtrarTiposGrado(0);
                });
            $(document).on('change', '#education_non_formal_country',
                function(e) {
                    e.preventDefault();
                    filtrarEstadosEducacionNoFormal(0, 0);
                });
            $(document).on('change', '#default_state_education_non_formal_dd',
                function(e) {
                    console.log('cambio');
                    e.preventDefault();
                    filtrarCiudadesEducacionNoFormal(0);
                });
        });

        const mostrarEducacionNoFormal = () => {
            $.post("{{ route('show.front.profile.education_non_formal', $user->id) }}", {
                user_id: {{ $user->id }},
                _method: 'POST',
                _token: '{{ csrf_token() }}'
            }).done((response) => {
                $('#contenedor_educacion_no_formal').html(response);
            });
        }

        // Función para filtrar tipos de grado
        // const filtrarTiposGrado = (tipoGradoId) => {
        //     const nivelGradoId = $('#degree_level_id').val();
        //     if (nivelGradoId) {
        //         $.post("{{ route('filter.degree.types.dropdown') }}", {
        //             degree_level_id: nivelGradoId,
        //             degree_type_id: tipoGradoId,
        //             _method: 'POST',
        //             _token: '{{ csrf_token() }}'
        //         }).done((response) => {
        //             $('#degree_types_dd').html(response);
        //         });
        //     }
        // }

        const filtrarEstadosEducacionNoFormal = (estadoId, ciudadId) => {
            const paisId = $('#education_non_formal_country').val();
            if (paisId) {
                $.post("{{ route('filter.lang.states.dropdown') }}", {
                    country_id: paisId,
                    state_id: estadoId,
                    new_state_id: 'education_non_formal_state',
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                }).done((response) => {
                    $('#default_state_education_non_formal_dd').html(response);
                    filtrarCiudadesEducacionNoFormal(ciudadId);
                });
            }
        }

        const filtrarCiudadesEducacionNoFormal = (ciudadId) => {
            const estadoId = $('#default_state_education_non_formal_dd').val();
            console.log(estadoId);
            if (estadoId) {
                $.post("{{ route('filter.lang.cities.dropdown') }}", {
                    state_id: estadoId,
                    city_id: ciudadId,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                }).done((response) => {
                    $('#default_city_education_non_formal_dd').html(response);
                });
            }
        }

        // const inicializarSelect2 = () => {
        //     $('.selected-remote').select2({
        //         width: 'resolve',
        //         ajax: {
        //             url: '/api/titles',
        //             dataType: 'json'
        //         }
        //     });
        // }

        // const inicializarSelect2ConDatos = async () => {
        //     const tituloGrado = document.getElementById('degree_title').getAttribute("value");
        //     const selectEstudiante = $('.selected-remote');
        //     try {
        //         const data = await $.ajax({
        //             type: 'GET',
        //             url: '/api/titles?name=' + tituloGrado
        //         });

        //         const opcion = new Option(data.text, data.id, true, true);
        //         selectEstudiante.append(opcion).trigger('change');
        //     } catch (error) {
        //         console.error("Error al inicializar Select2 con datos:", error);
        //     }
        // }

        const mostrarErroresValidacion = (errores) => {
            $('.help-block').html('');
            $.each(errores, (campo, mensajes) => {
                $(`.${campo}-error`).html(` <strong>${mensajes.join(', ')}</strong>`);
                $(`#div_${campo}`).addClass('has-error');
            });
        }
    </script>
@endpush
