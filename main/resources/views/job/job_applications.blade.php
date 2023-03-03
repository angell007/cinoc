@extends('layouts.app')
@section('content')
    @include('includes.header')

    @include('includes.inner_page_title', ['page_title' => __('Job Applications')])

    <div class="listpgWraper">
        <div class="container">
            <div class="row"> @include('includes.company_dashboard_menu') <div class="col-md-9 col-sm-8">
                    <div class="myads">
                        <div class="row mb-3 p-3 bg-white text-center">
                            <div class="col-md-12 mb-5">
                                <h3>{{ __('Job Applications') }}
                                </h3>
                            </div>
                            <div class="col-md-3"> Filtro por : </div>
                            <div class="col-4"> <select class="form-control" id="select" placeholder="Seleccione">
                                    <option value="">Seleccione
                                    </option>
                                    <option value="ciudad">Ciudad
                                    </option>
                                    <option value="edad">Rango de edad
                                    </option>
                                    <option value="expectativa">Expectativa salarial
                                    </option>
                                    <option value="educacion">Nivel Educativo
                                    </option>
                                    <option value="cargo">Cargo
                                    </option>
                                    <option value="experiencia">Años de experiencia en el cargo
                                    </option>
                                </select> </div>
                            <div class="col-3"> <input class="form-control" name="value" id="value"> </div>
                            <div class="col-2"> <button class="btn btn-info btn-xs go">Filtrar
                                </button> </div>
                        </div>
                        <ul class="searchList">
                            @if (isset($job_applications) && count($job_applications))
                                @foreach ($job_applications as $job_application)
                                    @php
                                        $user = $job_application->getUser();
                                        $job = $job_application->getJob();
                                        $company = $job->getCompany();
                                        $profileCv = $job_application->getProfileCv();
                                    @endphp
                                    @if (null !== $job_application && null !== $user && null !== $job && null !== $company && null !== $profileCv)
                                        <li>
                                            <div class="row p-5">
                                                <div class="col-md-5 col-sm-5">
                                                    <div class="jobimg">{{ $user->printUserImage(100, 100) }}
                                                    </div>
                                                    <div class="jobinfo">
                                                        <h3>
                                                            <a
                                                                href="{{ route('applicant.profile', $job_application->id) }}">{{ $user->getName() }}
                                                            </a>
                                                        </h3>
                                                        <div class="location"> {{ $user->getLocation() }}
                                                        </div>
                                                    </div>
                                                    <div class="clearfix">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">

                                                </div>
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="listbtn">
                                                        <a href="{{ route('applicant.profile', $job_application->id) }}">{{ __('View Profile') }}
                                                        </a>
                                                    </div>
                                                </div>
                                                @if ($job_application->status == 'contratado')
                                                    <div id="">
                                                        <h3 style="color:blue;">Contratado
                                                        </h3>
                                                    </div>
                                                @elseif($job_application->status == 'rechazado')
                                                    <div id="">
                                                        <h3 style="color:red;">Rechazado
                                                        </h3>
                                                    </div>
                                                @else
                                                    <div>
                                                        @if ($job_application->status == 'entrevista')
                                                            <br>
                                                            <h5 class="text text-primary">En proceso de entrevista
                                                            </h5> <br>
                                                            @endif @if ($job_application->status == 'espera')
                                                                <a class=" entrevistar btn  btn-info"
                                                                    data-id="{{ $user->id }}"
                                                                    data-compa="{{ $company->id }}"
                                                                    data-job="{{ $job_application->id }}" id=""
                                                                    href="#">Entrevistar
                                                                </a>
                                                            @endif <a
                                                                class=" contra btn mm-{{ $job_application->id }} btn-success"
                                                                data-id="{{ $user->id }}"
                                                                data-compa="{{ $company->id }}"
                                                                data-job="{{ $job_application->id }}" id=""
                                                                href="#">Contratar
                                                            </a> <a id=""
                                                                class=" recha btn btn-danger mm-{{ $job_application->id }}"
                                                                data-job="{{ $job_application->id }}"
                                                                data-id="{{ $user->id }}" href="#">Anular
                                                            </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <p>{{ \Illuminate\Support\Str::limit($user->getProfileSummary('summary'), 150, '...') }}
                                            </p>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
    @endsection
    @push('scripts')
    
    <script>
        $('document').ready(function() {
            $(".con-f").hide();
            $(".re-f").hide();
            $(".contra").click(function() {
                Swal.fire({
                    title: '¿Esta seguro que quiere contratar a este candidato?',
                    text: "Luego de contratar a este candidato sera irreversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'no',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/contratar_emp') }}",
                            method: 'post',
                            data: {
                                id_candidato: $(this).attr('data-id'),
                                id_empresa: $(this).attr('data-compa'),
                                id_job: $(this).attr('data-job'),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                $(".mm-" + result).hide();
                                $(".con-f-" + result).show();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Contratado le enviaremos una notificacion al candidato ',
                                    showConfirmButton: false,
                                    timer: 2500
                                }) location.reload();
                            }
                        });
                    }
                })
            });
        });
    </script>
    <script>
        $('document').ready(function() {
            var query = window.location.search.substring(1);
            qs = query.split('=');
            if (qs[0] != undefined & qs[1] != undefined) {
                select = document.getElementById('select').value = qs[0];
                val = document.getElementById('value').value = qs[1];
            }
            $(".go").click(function() {
                select = document.getElementById('select').value;
                val = document.getElementById('value').value;
                location.href = `${window.location.pathname}?${select}=${val}`;
            }) $(".recha").click(function() {
                Swal.fire({
                    title: '¿Esta seguro que quiere rechazar a este candidato?',
                    text: "Luego de rechazar a este candidato sera irreversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'no',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/rechazar_emp') }}",
                            method: 'post',
                            data: {
                                id_job: $(this).attr('data-job'),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                $(".mm-" + result).hide();
                                $(".re-f-" + result).show();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Rechazado le enviaremos una notificacion al candidato ',
                                    showConfirmButton: false,
                                    timer: 2500
                                }) location.reload();
                            }
                        });
                    }
                })
            });
            $(".entrevistar").click(function() {
                Swal.fire({
                    title: '¿Esta seguro que quiere entrevistar a este candidato?',
                    text: "",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'no',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/entrevistar') }}",
                            method: 'post',
                            data: {
                                id_job: $(this).attr('data-job'),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                console.log(result) $(".mm-" + result).hide();
                                $(".re-f-" + result).show();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Le enviaremos una notificacion al candidato ',
                                    showConfirmButton: false,
                                    timer: 2500
                                }) location.reload();
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush
