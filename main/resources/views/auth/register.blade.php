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

                        <form class="form-horizontal" method="POST" action="{{ route('company.register') }}">

                            {{ csrf_field() }}

                            <input type="hidden" name="candidate_or_employer" value="employer" />

                            <div class="alert alert-info" style="margin-bottom: 15px;">
                                Al registrarse recibirá un correo confirmando la recepción de su solicitud. Sus credenciales serán el correo electrónico de contacto y la contraseña que defina aquí. El acceso permanecerá deshabilitado hasta que la Bolsa de Empleo valide y active su empresa.
                            </div>

                            <div class="formrow{{ $errors->has('person_type') ? ' has-error' : '' }}">
                                <select name="person_type" class="form-control" required>
                                    <option value="" disabled {{ old('person_type') ? '' : 'selected' }}>Tipo de persona</option>
                                    <option value="natural" {{ old('person_type') === 'natural' ? 'selected' : '' }}>Persona natural</option>
                                    <option value="juridica" {{ old('person_type') === 'juridica' ? 'selected' : '' }}>Persona jurídica</option>
                                </select>
                                @if ($errors->has('person_type')) <span class="help-block text-danger"><strong>{{ $errors->first('person_type') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" name="name" class="form-control" required placeholder="Razón social o nombre" value="{{ old('name') }}">
                                @if ($errors->has('name')) <span class="help-block text-danger"><strong>{{ $errors->first('name') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('tipo_identificacion') ? ' has-error' : '' }}">
                                <select name="tipo_identificacion" class="form-control" required>
                                    <option value="" disabled {{ old('tipo_identificacion') ? '' : 'selected' }}>Tipo de identificación (NIT o documento)</option>
                                    <option value="NIT" {{ old('tipo_identificacion') === 'NIT' ? 'selected' : '' }}>NIT</option>
                                    <option value="CC" {{ old('tipo_identificacion') === 'CC' ? 'selected' : '' }}>CC</option>
                                    <option value="CE" {{ old('tipo_identificacion') === 'CE' ? 'selected' : '' }}>CE</option>
                                </select>
                                @if ($errors->has('tipo_identificacion')) <span class="help-block text-danger"><strong>{{ $errors->first('tipo_identificacion') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('identificacion') ? ' has-error' : '' }}">
                                <input type="text" name="identificacion" class="form-control" required placeholder="NIT o documento de identificación" value="{{ old('identificacion') }}">
                                @if ($errors->has('identificacion')) <span class="help-block text-danger"><strong>{{ $errors->first('identificacion') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('ceo') ? ' has-error' : '' }}">
                                <input type="text" name="ceo" class="form-control" required placeholder="Nombre del representante legal" value="{{ old('ceo') }}">
                                @if ($errors->has('ceo')) <span class="help-block text-danger"><strong>{{ $errors->first('ceo') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('ceo_email') ? ' has-error' : '' }}">
                                <input type="email" name="ceo_email" class="form-control" required placeholder="Correo del representante legal" value="{{ old('ceo_email') }}">
                                @if ($errors->has('ceo_email')) <span class="help-block text-danger"><strong>{{ $errors->first('ceo_email') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                <select name="country_id" id="reg_country_id" class="form-control" required>
                                    <option value="">Seleccione País</option>
                                    @foreach(($countries ?? []) as $id => $label)
                                        <option value="{{ $id }}" {{ (string) old('country_id', $siteSetting->default_country_id ?? '') === (string) $id ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id')) <span class="help-block text-danger"><strong>{{ $errors->first('country_id') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('state_id') ? ' has-error' : '' }}">
                                <span id="reg_state_dd">
                                    <select name="state_id" id="state_id" class="form-control" required>
                                        <option value="">Seleccione Departamento</option>
                                    </select>
                                </span>
                                @if ($errors->has('state_id')) <span class="help-block text-danger"><strong>{{ $errors->first('state_id') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                <span id="reg_city_dd">
                                    <select name="city_id" id="city_id" class="form-control" required>
                                        <option value="">Seleccione Ciudad</option>
                                    </select>
                                </span>
                                @if ($errors->has('city_id')) <span class="help-block text-danger"><strong>{{ $errors->first('city_id') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <input type="text" name="contact_name" class="form-control" required placeholder="Nombre de la persona de contacto" value="{{ old('contact_name') }}">
                                @if ($errors->has('contact_name')) <span class="help-block text-danger"><strong>{{ $errors->first('contact_name') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <input type="text" name="phone" class="form-control" required placeholder="Teléfono de contacto" value="{{ old('phone') }}">
                                @if ($errors->has('phone')) <span class="help-block text-danger"><strong>{{ $errors->first('phone') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" name="email" class="form-control" required placeholder="Correo electrónico de contacto (usuario de acceso)" value="{{ old('email') }}">
                                @if ($errors->has('email')) <span class="help-block text-danger"><strong>{{ $errors->first('email') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password" class="form-control" required placeholder="{{ __('Password') }}" value="">
                                @if ($errors->has('password')) <span class="help-block text-danger"><strong>{{ $errors->first('password') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ __('Password Confirmation') }}" value="">
                                @if ($errors->has('password_confirmation')) <span class="help-block text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span> @endif
                            </div>

                            <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">
                                <input type="checkbox" value="1" name="terms_of_use" />
                                <a href="https://bolsaempleo.iescinoc.edu.co/files/OFICIO Y ACUERDO POLITICA DE TRATAMIENTO DE DATOS.pdf" target="_blank">{{ __('Acepto los términos de uso') }}</a>
                                @if ($errors->has('terms_of_use')) <span class="help-block text-danger"><strong>{{ $errors->first('terms_of_use') }}</strong></span> @endif
                            </div>

                            <input type="submit" class="btn" value="{{ __('Register') }}">

                        </form>

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




@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
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
</script>
@endpush

@endsection