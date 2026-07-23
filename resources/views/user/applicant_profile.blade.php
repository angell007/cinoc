@extends('layouts.app')

@section('content')

    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->

    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title' => __($page_title)])
    <!-- Inner Page Title end -->

    <div class="listpgWraper">
        <div class="container">
            @include('flash::message')

            <!-- Job Detail start -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Job Header start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <div class="jobinfo">
                            <!-- Información del Candidato -->
                            <div class="candidateinfo d-flex align-items-center mb-4">
                                <div class="userPic mr-4">
                                    {{ $user->printUserImage() }}
                                </div>
                                <div>
                                    <h2 class="title mb-2 font-weight-bold" style="color: #333; font-size: 1.8rem;">
                                        {{ $user->getName() }}
                                        @if ((bool) $user->is_immediate_available)
                                            <span class="badge badge-success ml-2 py-1 px-2"
                                                style="font-size: 0.7rem; background-color: #28a745; vertical-align: middle;">{{ __('Disponible') }}</span>
                                        @endif
                                    </h2>
                                    <p class="text-muted mb-1"><i
                                            class="fa fa-map-marker mr-2"></i>{{ $user->getLocation() }}</p>
                                    <p class="text-muted"><i class="fa fa-clock-o mr-2"></i>{{ __('Miembro desde') }}
                                        {{ $user->created_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <br>

                        <!-- Botones de Acción -->
                        <div class="jobButtons d-flex flex-wrap justify-content-start">
                            @if (isset($job) && isset($company))
                                @if (Auth::guard('company')->check() &&
                                        Auth::guard('company')->user()->isFavouriteApplicant($user->id, $job->id, $company->id))
                                    <a href="{{ route('remove.from.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id]) }}"
                                        class="btn btn-outline-danger mr-2 mb-2">
                                        <i class="fa fa-heart mr-1"></i> {{ __('Quitar de Favoritos') }}
                                    </a>
                                @else
                                    <a href="{{ route('add.to.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id]) }}"
                                        class="btn btn-outline-primary mr-2 mb-2">
                                        <i class="fa fa-heart-o mr-1"></i> {{ __('Agregar a Favoritos') }}
                                    </a>
                                @endif
                            @endif

                            @if (null !== $profileCv && isset($job))
                                <a href="{{ url('download-cv-on-candidate', [$profileCv->cv_file, $user->id, $job->id]) }}"
                                    class="btn btn-outline-success mr-2 mb-2">
                                    <i class="fa fa-download mr-1"></i> {{ __('Descargar CV') }}
                                </a>
                            @endif
                            <a href="javascript:;" onclick="send_message()" class="btn btn mb-2">
                                <i class="fa fa-envelope mr-1"></i> {{ __('Enviar Mensaje') }}
                            </a>
                        </div>
                    </div>

                    <!-- About Employee start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('About me') }}</h3>
                        <p>{{ $user->getProfileSummary('summary') }}</p>
                    </div>

                    <!-- Aspirations start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">Aspiraciones del candidato</h3>
                        <p>{{ $user->getProfileSummary('aspirations') }}</p>
                    </div>

                    <!-- Cover Letter start -->
                    @if (isset($user->letter) && $user->letter != '')
                        <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                            <a class="btn btn-warning btn-lg btn-block"
                                href="{{ url('donwload-letter', ['candidato' => $user]) }}">Descargar Carta de
                                presentación</a>
                        </div>
                    @endif

                    <!-- Education start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('Education') }}</h3>
                        <div id="education_div"></div>
                    </div>

                    <!-- Education non formal start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('Educación no formal') }}</h3>
                        <div id="education_non_formal_div"></div>
                    </div>

                    <!-- Experience start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('Experience') }}</h3>
                        <div id="experience_div"></div>
                    </div>

                    <!-- Portfolio start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('Portfolio') }}</h3>
                        <div id="projects_div"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Candidate Contact -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">Contacto del candidato</h3>
                        <div class="candidateinfo">
                            @if (!empty($user->phone))
                                <p><i class="fa fa-phone mr-2"></i><a
                                        href="tel:{{ $user->phone }}">{{ $user->phone }}</a></p>
                            @endif
                            @if (!empty($user->mobile_num))
                                <p><i class="fa fa-mobile mr-2"></i><a
                                        href="tel:{{ $user->mobile_num }}">{{ $user->mobile_num }}</a></p>
                            @endif
                            @if (!empty($user->email))
                                <p><i class="fa fa-envelope mr-2"></i><a
                                        href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                            @endif
                            <p><i class="fa fa-map-marker mr-2"></i>{{ $user->street_address }}</p>
                        </div>
                    </div>

                    <!-- Candidate Detail start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('Candidate Detail') }}</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>{{ __('Verificado') }}:</strong> <span
                                    class="float-right">{{ ((bool) $user->verified) ? 'Si' : 'No' }}</span></li>
                            <li class="mb-2"><strong>{{ __('Immediate Available') }}:</strong> <span
                                    class="float-right">{{ ((bool) $user->is_immediate_available) ? 'Si' : 'No' }}</span>
                            </li>
                            <li class="mb-2"><strong>{{ __('Age') }}:</strong> <span
                                    class="float-right">{{ $user->getAge() }} Años</span></li>
                            <li class="mb-2"><strong>{{ __('Gender') }}:</strong> <span
                                    class="float-right">{{ $user->getGender('gender') }}</span></li>
                            <li class="mb-2"><strong>{{ __('Estado civil') }}:</strong> <span
                                    class="float-right">{{ $user->getMaritalStatus('marital_status') }}</span></li>
                            <li class="mb-2"><strong>{{ __('Experience') }}:</strong> <span
                                    class="float-right">{{ $user->getJobExperience('job_experience') }}</span></li>
                            <li class="mb-2"><strong>{{ __('Career Level') }}:</strong> <span
                                    class="float-right">{{ $user->getCareerLevel('career_level') }}</span></li>
                            <li class="mb-2"><strong>{{ __('Posibilidad de viajar') }}:</strong> <span
                                    class="float-right">{{ $user->travel_possibility }}</span></li>
                            <li class="mb-2">
                                <strong>{{ __('Posibilidad de trasladarse de lugar de residencia') }}:</strong> <span
                                    class="float-right">{{ $user->relocation_possibility }}</span></li>
                            <li class="mb-2"><strong>{{ __('Propiedad medio de transporte') }}:</strong> <span
                                    class="float-right">{{ $user->own_transport }}</span></li>

                            <li class="mb-2"><strong>{{ __('Licencia de conducción para carro') }}:</strong> <span
                                    class="float-right">{{ $user->car_license }}</span></li>

                            @if ($user->car_license == 'Si')
                                <li class="mb-2">
                                    <strong>{{ __('Categoría de licencia de conducción para carro') }}:</strong> <span
                                        class="float-right">{{ $user->car_license_category }}</span></li>
                            @endif

                            <li class="mb-2"><strong>{{ __('Licencia de conducción para moto') }}:</strong> <span
                                    class="float-right">{{ $user->motorcycle_license }}</span></li>

                            @if ($user->motorcycle_license == 'Si')
                                <li class="mb-2">
                                    <strong>{{ __('Categoría de licencia de conducción para moto') }}:</strong> <span
                                        class="float-right">{{ $user->motorcycle_license_category }}</span></li>
                            @endif
                        </ul>
                    </div>

                    <!-- Skills start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('Skills') }}</h3>
                        <div id="skill_div"></div>
                    </div>

                    <!-- Languages start -->
                    <div class="job-header bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="mb-3">{{ __('Languages') }}</h3>
                        <div id="language_div"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sendmessage" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="" id="send-form">
                    @csrf
                    <input type="hidden" name="seeker_id" id="seeker_id" value="{{ $user->id }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Send Message') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" cols="10" rows="7"
                                placeholder="Escribe tu mensaje aquí..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection

@push('styles')
    <style type="text/css">
        .formrow iframe {
            height: 78px;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#send_applicant_message', function() {
                var postData = $('#send-applicant-message-form').serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('contact.applicant.message.send') }}",
                    data: postData,
                    //dataType: 'json',
                    success: function(data) {
                        response = JSON.parse(data);
                        var res = response.success;
                        if (res == 'success') {
                            var errorString = '<div role="alert" class="alert alert-success">' +
                                response.message + '</div>';
                            $('#alert_messages').html(errorString);
                            $('#send-applicant-message-form').hide('slow');
                            $(document).scrollTo('.alert', 2000);
                        } else {
                            var errorString =
                                '<div class="alert alert-danger" role="alert"><ul>';
                            response = JSON.parse(data);
                            $.each(response, function(index, value) {
                                errorString += '<li>' + value + '</li>';
                            });
                            errorString += '</ul></div>';
                            $('#alert_messages').html(errorString);
                            $(document).scrollTo('.alert', 2000);
                        }
                    },
                });
            });
            showEducation();
            showProjects();
            showExperience();
            showSkills();
            showLanguages();
        });

        function showProjects() {
            $.post("{{ route('show.applicant.profile.projects', $user->id) }}", {
                    user_id: {{ $user->id }},
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#projects_div').html(response);
                });
        }

        function showExperience() {
            $.post("{{ route('show.applicant.profile.experience', $user->id) }}", {
                    user_id: {{ $user->id }},
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#experience_div').html(response);
                });
        }

        function showEducation() {
            $.post("{{ route('show.applicant.profile.education', $user->id) }}", {
                    user_id: {{ $user->id }},
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#education_div').html(response);
                });
        }

        function showEducationNonFormal() {
            $.post("{{ route('show.applicant.profile.education_non_formal', $user->id) }}", {
                    user_id: {{ $user->id }},
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#education_non_formal_div').html(response);
                });
        }

        function showLanguages() {
            $.post("{{ route('show.applicant.profile.languages', $user->id) }}", {
                    user_id: {{ $user->id }},
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#language_div').html(response);
                });
        }

        function showSkills() {
            $.post("{{ route('show.applicant.profile.skills', $user->id) }}", {
                    user_id: {{ $user->id }},
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#skill_div').html(response);
                });
        }

        function send_message() {
            const el = document.createElement('div')
            el.innerHTML =
                "Please <a class='btn' href='{{ route('login') }}' onclick='set_session()'>log in</a> as a Employer and try again."
            @if (null !== Auth::guard('company')->user())
                $('#sendmessage').modal('show');
            @else
                swal({
                    title: "You are not Loged in",
                    content: el,
                    icon: "error",
                    button: "OK",
                });
            @endif
        }

        if ($("#send-form").length > 0) {
            $("#send-form").validate({
                validateHiddenInputs: true,
                ignore: "",
                rules: {
                    message: {
                        required: true,

                        maxlength: 5000
                    },
                },

                messages: {
                    message: {
                        required: "Message is required"
                    }
                },

                submitHandler: function(form) {
                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        }

                    });

                    @if (null !== Auth::guard('company')->user())

                        $.ajax({

                            url: "{{ route('submit-message-seeker') }}",

                            type: "POST",

                            data: $('#send-form').serialize(),

                            success: function(response) {

                                $("#send-form").trigger("reset");

                                $('#sendmessage').modal('hide');

                                swal({

                                    title: "Success",

                                    text: response["msg"],

                                    icon: "success",

                                    button: "OK",

                                });

                            }

                        });
                    @endif

                }
            })
        }
    </script>
@endpush
