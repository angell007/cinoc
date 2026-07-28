@extends('layouts.app')



@section('content')



<!-- Header start -->



@include('includes.header')



<!-- Header end -->



<!-- Inner Page Title start -->



@include('includes.inner_page_title', ['page_title'=>__('Register')])



<!-- Inner Page Title end -->



<div class="listpgWraper">



    <div class="container">



        @include('flash::message')



        <div class="useraccountwrap">



            <div class="userccount">



                <div class="userbtns">



                    <ul class="nav nav-tabs">



                        <?php



                        $c_or_e = old('candidate_or_employer', 'candidate');



                        ?>



                        <li class="nav-item"><a class="nav-link {{($c_or_e == 'candidate')? 'active':''}}" data-toggle="tab" href="#candidate" aria-expanded="true">{{__('Candidate')}}</a></li>



                        <li class="nav-item"><a class="nav-link {{($c_or_e == 'employer')? 'active':''}}" data-toggle="tab" href="#employer" aria-expanded="false">{{__('Employer')}}</a></li>



                    </ul>



                </div>



                <div class="tab-content">



                    <div id="candidate" class="formpanel tab-pane {{($c_or_e == 'candidate')? 'active':''}}">



                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">



                            {{ csrf_field() }}



                            <input type="hidden" name="candidate_or_employer" value="candidate" />

                            <p class="text-muted" style="font-size: 14px; line-height: 1.5; margin-bottom: 15px;">
                                Al registrarte recibirás un correo con un enlace para activar tu cuenta. Tus credenciales de acceso serán tu correo electrónico y la contraseña que definas aquí. Después de activar la cuenta podrás ingresar y diligenciar tu hoja de vida.
                            </p>

                            <div class="formrow{{ $errors->has('national_id_card_number') ? ' has-error' : '' }}">



                                <input type="number" name="national_id_card_number" class="form-control" required="required" placeholder="{{__('Identificación')}}" value="{{old('national_id_card_number')}}">



                                @if ($errors->has('national_id_card_number')) <span class="help-block text-danger"> <strong>{{ $errors->first('national_id_card_number') }}</strong> </span> @endif

                            </div>



                            <!-- /*********************************************************************************************************************************************************** */ -->

                            <div class="formrow{{ $errors->has('first_name') ? ' has-error' : '' }}">



                                <input type="text" name="first_name" class="form-control" required="required" placeholder="{{__('First Name')}}" value="{{old('first_name')}}">



                                @if ($errors->has('first_name')) <span class="help-block text-danger"> <strong>{{ $errors->first('first_name') }}</strong> </span> @endif

                            </div>



                            <div class="formrow{{ $errors->has('middle_name') ? ' has-error' : '' }}">



                                <input type="text" name="middle_name" class="form-control" placeholder="{{__('Segundo Nombre')}}" value="{{old('middle_name')}}">



                                @if ($errors->has('middle_name')) <span class="help-block text-danger"> <strong>{{ $errors->first('middle_name') }}</strong> </span> @endif

                            </div>



                            <!--<div class="formrow{{ $errors->has('last_name') ? ' has-error' : '' }}">-->



                            <!--    <input type="text" name="last_name" class="form-control" required="required" placeholder="{{__('Apellidos')}}" value="{{old('last_name')}}">-->



                            <!--    @if ($errors->has('last_name')) <span class="help-block text-danger"> <strong>{{ $errors->first('last_name') }}</strong> </span> @endif-->

                            <!--</div>-->

                            

                            <div class="formrow{{ $errors->has('first_lastname') ? ' has-error' : '' }}">



                                <input type="text" name="first_lastname" class="form-control" required="required" placeholder="{{__('Primer apellido')}}" value="{{old('first_lastname')}}">



                                @if ($errors->has('first_lastname')) <span class="help-block text-danger"> <strong>{{ $errors->first('first_lastname') }}</strong> </span> @endif

                            </div>

                            

                            <div class="formrow{{ $errors->has('second_lastname') ? ' has-error' : '' }}">



                                <input type="text" name="second_lastname" class="form-control" placeholder="{{__('Segundo apellido')}}" value="{{old('second_lastname')}}">



                                @if ($errors->has('second_lastname')) <span class="help-block text-danger"> <strong>{{ $errors->first('second_lastname') }}</strong> </span> @endif

                            </div>

                            

                            <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">



                                <input type="email" name="email" class="form-control" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">



                                @if ($errors->has('email')) <span class="help-block text-danger"> <strong>{{ $errors->first('email') }}</strong> </span> @endif

                            </div>

                            

                            <div class="formrow{{ $errors->has('rol') ? ' has-error' : '' }}">



                                <select name="rol" class="form-control" required="required">

                                    <option value="" disabled {{ old('rol') ? '' : 'selected' }}>Rol</option>

                                    <option value="Estudiante" {{ old('rol') === 'Estudiante' ? 'selected' : '' }}>Estudiante</option>

                                    <option value="Egresado" {{ old('rol') === 'Egresado' ? 'selected' : '' }}>Egresado</option>

                                </select>



                                @if ($errors->has('rol')) <span class="help-block text-danger"> <strong>{{ $errors->first('rol') }}</strong> </span> @endif

                            </div>





                            <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">



                                <input type="password" name="password" class="form-control" required="required" placeholder="{{__('Password')}}" value="">



                                @if ($errors->has('password')) <span class="help-block text-danger"> <strong>{{ $errors->first('password') }}</strong> </span> @endif

                            </div>



                            <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">



                                <input type="password" name="password_confirmation" class="form-control" required="required" placeholder="{{__('Password Confirmation')}}" value="">



                                @if ($errors->has('password_confirmation')) <span class="help-block text-danger"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span> @endif

                            </div>
<div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">



                                <input type="checkbox" value="1" name="terms_of_use" />



                                <a href="https://bolsaempleo.iescinoc.edu.co/files/OFICIO Y ACUERDO POLITICA DE TRATAMIENTO DE DATOS.pdf" target="_blank">{{__('Acepto los términos de uso')}}</a>

                                <br>

                                <br>

                                 <!--<a href="https://bolsaempleo.iescinoc.edu.co/files/OFICIO Y ACUERDO POLITICA DE TRATAMIENTO DE DATOS.pdf" target="_blank">{{__('Política de protección de datos')}}</a>-->

                                @if ($errors->has('terms_of_use')) <span class="help-block text-danger"> <strong>{{ $errors->first('terms_of_use') }}</strong> </span> @endif

                            </div>







                            <input type="submit" class="btn" value="{{__('Register')}}">



                        </form>



                    </div>



                    <div id="employer" class="formpanel tab-pane fade {{($c_or_e == 'employer')? 'active':''}}">
                        @include('auth.partials.employer_register_form')
                    </div>










                </div>



                <!-- sign up form -->

                

                



                <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> Ya estas registrado? <a href="{{route('login')}}"> Ingresar </a></div>



                <!-- sign up form end-->







            </div>



        </div>







    </div>



</div>



@include('includes.footer')




@push('styles')
<style>
.useraccountwrap .userccount { max-width: 920px; }
.employer-intro {
    background: #f7f9fc;
    border-left: 3px solid #f47c03;
    padding: 12px 14px;
    margin-bottom: 18px;
    color: #44505c;
    font-size: 14px;
}
.employer-intro p { margin: 0; }
.employer-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    margin-bottom: 18px;
}
.employer-step {
    border: 1px solid #d9dee7;
    background: #fff;
    color: #5a6570;
    border-radius: 6px;
    padding: 10px 8px;
    font-size: 12px;
    text-align: left;
}
.employer-step span {
    display: inline-block;
    width: 22px;
    height: 22px;
    line-height: 22px;
    text-align: center;
    border-radius: 50%;
    background: #e9eef5;
    margin-right: 6px;
    font-weight: 700;
}
.employer-step.is-active,
.employer-step.is-done {
    border-color: #f47c03;
    color: #2c3642;
}
.employer-step.is-active span,
.employer-step.is-done span {
    background: #f47c03;
    color: #fff;
}
.employer-panel { display: none; }
.employer-panel.is-active { display: block; }
.employer-panel h5 {
    margin: 0 0 6px;
    font-size: 18px;
    color: #2c3642;
}
.employer-hint {
    margin: 0 0 14px;
    color: #7a8692;
    font-size: 13px;
}
.employer-register-form .formrow { margin-bottom: 12px; }
.employer-register-form label {
    display: block;
    margin-bottom: 4px;
    font-size: 13px;
    color: #44505c;
    font-weight: 600;
}
.employer-terms {
    display: flex !important;
    align-items: center;
    gap: 8px;
    font-weight: 500 !important;
}
.employer-nav {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 18px;
    padding-top: 14px;
    border-top: 1px solid #edf0f4;
}
.employer-file-preview img {
    margin-top: 8px;
    max-height: 80px;
    border-radius: 4px;
}
@media (max-width: 767px) {
    .employer-steps { grid-template-columns: 1fr 1fr; }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
(function() {
    var currentStep = 1;
    var totalSteps = 4;

    function showStep(step) {
        currentStep = step;
        $('.employer-panel').removeClass('is-active');
        $('.employer-panel[data-step="' + step + '"]').addClass('is-active');
        $('.employer-step').removeClass('is-active is-done');
        $('.employer-step').each(function() {
            var target = parseInt($(this).data('step-target'), 10);
            if (target === step) {
                $(this).addClass('is-active');
            } else if (target < step) {
                $(this).addClass('is-done');
            }
        });
        $('#employerPrevBtn').toggle(step > 1);
        $('#employerNextBtn').toggle(step < totalSteps);
        $('#employerSubmitBtn').toggle(step === totalSteps);
    }

    function validateCurrentStep() {
        var valid = true;
        var $panel = $('.employer-panel[data-step="' + currentStep + '"]');
        $panel.find('[required]').each(function() {
            var $el = $(this);
            if ($el.is(':checkbox')) {
                if (!$el.is(':checked')) {
                    valid = false;
                    $el.focus();
                    return false;
                }
            } else if (!$.trim($el.val())) {
                valid = false;
                $el.focus();
                return false;
            }
        });
        if (!valid) {
            alert('Complete los campos obligatorios de este paso antes de continuar.');
        }
        return valid;
    }

    $(document).ready(function() {
        showStep(1);

        $('#employerNextBtn').on('click', function() {
            if (!validateCurrentStep()) {
                return;
            }
            showStep(Math.min(totalSteps, currentStep + 1));
        });

        $('#employerPrevBtn').on('click', function() {
            showStep(Math.max(1, currentStep - 1));
        });

        $('.employer-step').on('click', function() {
            var target = parseInt($(this).data('step-target'), 10);
            if (target < currentStep) {
                showStep(target);
            }
        });

        $('#reg_country_id').on('change', function(e) {
            e.preventDefault();
            filterRegStates(0);
        });

        $(document).on('change', '#employer #state_id', function(e) {
            e.preventDefault();
            filterRegCities(0);
        });

        if ($('#reg_country_id').val()) {
            filterRegStates({{ (int) old('state_id', 0) }});
        }

        @if($errors->any() && old('candidate_or_employer') === 'employer')
            var errorFields = @json(array_keys($errors->getMessages()));
            var stepMap = {
                1: ['person_type', 'email', 'password', 'password_confirmation'],
                2: ['name', 'tipo_identificacion', 'identificacion', 'industry_id', 'ownership_type_id', 'description', 'no_of_employees', 'established_in', 'website', 'logo', 'camara_comercio'],
                3: ['ceo', 'ceo_email', 'tipo_identificacion_ceo', 'identificacion_ceo', 'contact_name', 'phone'],
                4: ['country_id', 'state_id', 'city_id', 'location', 'facebook', 'twitter', 'linkedin', 'google_plus', 'terms_of_use']
            };
            var jumpTo = 1;
            for (var s = 1; s <= 4; s++) {
                for (var i = 0; i < errorFields.length; i++) {
                    if (stepMap[s].indexOf(errorFields[i]) !== -1) {
                        jumpTo = s;
                        s = 5;
                        break;
                    }
                }
            }
            showStep(jumpTo);
        @endif

        var logoInput = document.getElementById('reg_logo');
        if (logoInput) {
            logoInput.addEventListener('change', function() {
                var file = this.files && this.files[0];
                var preview = document.getElementById('reg_logo_preview');
                preview.innerHTML = '';
                if (!file || !file.type.match(/image.*/)) {
                    return;
                }
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Vista previa logo">';
                };
                reader.readAsDataURL(file);
            });
        }
    });

    function filterRegStates(state_id) {
        var country_id = $('#reg_country_id').val();
        if (!country_id) {
            return;
        }
        $.post("{{ route('filter.lang.states.dropdown') }}", {
            country_id: country_id,
            state_id: state_id,
            _method: 'POST',
            _token: '{{ csrf_token() }}'
        }).done(function(response) {
            $('#reg_state_dd').html(response);
            filterRegCities({{ (int) old('city_id', 0) }});
        });
    }

    function filterRegCities(city_id) {
        var state_id = $('#employer #state_id').val();
        if (!state_id) {
            return;
        }
        $.post("{{ route('filter.lang.cities.dropdown') }}", {
            state_id: state_id,
            city_id: city_id,
            _method: 'POST',
            _token: '{{ csrf_token() }}'
        }).done(function(response) {
            $('#reg_city_dd').html(response);
        });
    }

    window.filterRegStates = filterRegStates;
    window.filterRegCities = filterRegCities;
})();
</script>
@endpush

@endsection