@extends('layouts.app')



@section('content')
    <!-- Header start -->



    @include('includes.header')



    <!-- Header end -->



    <!-- Inner Page Title start -->



    @include('includes.inner_page_title', ['page_title' => __('Register')])



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



                            <li class="nav-item"><a class="nav-link {{ $c_or_e == 'candidate' ? 'active' : '' }}"
                                    data-toggle="tab" href="#candidate" aria-expanded="true">{{ __('Candidate') }}</a></li>



                            <li class="nav-item"><a class="nav-link {{ $c_or_e == 'employer' ? 'active' : '' }}"
                                    data-toggle="tab" href="#employer" aria-expanded="false">{{ __('Employer') }}</a></li>



                        </ul>



                    </div>



                    <div class="tab-content">



                        <div id="candidate" class="formpanel tab-pane {{ $c_or_e == 'candidate' ? 'active' : '' }}">



                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">



                                {{ csrf_field() }}



                                <input type="hidden" name="candidate_or_employer" value="candidate" />



                                <div class="formrow{{ $errors->has('national_id_card_number') ? ' has-error' : '' }}">



                                    <input type="number" name="national_id_card_number" class="form-control"
                                        required="required" placeholder="{{ __('Identificación') }}"
                                        value="{{ old('national_id_card_number') }}">



                                    @if ($errors->has('national_id_card_number'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('national_id_card_number') }}</strong> </span>
                                    @endif

                                </div>



                                <!-- /*********************************************************************************************************************************************************** */ -->

                                <div class="formrow{{ $errors->has('first_name') ? ' has-error' : '' }}">



                                    <input type="text" name="first_name" class="form-control" required="required"
                                        placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}">



                                    @if ($errors->has('first_name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('first_name') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('middle_name') ? ' has-error' : '' }}">



                                    <input type="text" name="middle_name" class="form-control"
                                        placeholder="{{ __('Segundo Nombre') }}" value="{{ old('middle_name') }}">



                                    @if ($errors->has('middle_name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('middle_name') }}</strong> </span>
                                    @endif

                                </div>



                                <!--<div class="formrow{{ $errors->has('last_name') ? ' has-error' : '' }}">-->



                                <!--    <input type="text" name="last_name" class="form-control" required="required" placeholder="{{ __('Apellidos') }}" value="{{ old('last_name') }}">-->



                                <!--    @if ($errors->has('last_name'))
    <span class="help-block text-danger"> <strong>{{ $errors->first('last_name') }}</strong> </span>
    @endif-->

                                <!--</div>-->



                                <div class="formrow{{ $errors->has('first_lastname') ? ' has-error' : '' }}">



                                    <input type="text" name="first_lastname" class="form-control" required="required"
                                        placeholder="{{ __('Primer apellido') }}" value="{{ old('first_lastname') }}">



                                    @if ($errors->has('first_lastname'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('first_lastname') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('second_lastname') ? ' has-error' : '' }}">



                                    <input type="text" name="second_lastname" class="form-control"
                                        placeholder="{{ __('Segundo apellido') }}" value="{{ old('second_lastname') }}">



                                    @if ($errors->has('second_lastname'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('second_lastname') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">



                                    <input type="email" name="email" class="form-control" required="required"
                                        placeholder="{{ __('Email') }}" value="{{ old('email') }}">



                                    @if ($errors->has('email'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('rol') ? ' has-error' : '' }}">



                                    <select type="text" name="rol" class="form-control" required="required"
                                        placeholder="{{ __('Rol') }}" value="{{ old('rol') }}">

                                        <option value="Estudiante" selected>Estudiante</option>

                                        <option value="Egresado">Egresado</option>

                                    </select>

                                    <!-- <input type="text" name="rol" class="form-control" required="required" placeholder="{{ __('Apellidos') }}" value="{{ old('rol') }}"> -->



                                    @if ($errors->has('rol'))
                                        <span class="help-block text-danger"> <strong>{{ $errors->first('rol') }}</strong>
                                        </span>
                                    @endif

                                </div>





                                <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">



                                    <input type="password" name="password" class="form-control" required="required"
                                        placeholder="{{ __('Password') }}" value="">



                                    @if ($errors->has('password'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">



                                    <input type="password" name="password_confirmation" class="form-control"
                                        required="required" placeholder="{{ __('Password Confirmation') }}"
                                        value="">



                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong> </span>
                                    @endif

                                </div>







                                <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">



                                    <?php
                                    
                                    $is_checked = '';
                                    
                                    if (old('is_subscribed', 1)) {
                                        $is_checked = 'checked="checked"';
                                    }
                                    
                                    ?>



                                    <input type="checkbox" value="1" name="is_subscribed"
                                        {{ $is_checked }} />{{ __('Suscríbete al boletín de noticias') }}



                                    @if ($errors->has('is_subscribed'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('is_subscribed') }}</strong> </span>
                                    @endif

                                </div>











                                <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">



                                    <input type="checkbox" value="1" name="terms_of_use" />



                                    <a href="#" data-toggle="modal" data-target="#modalProteccionDatos">{{ __('Acepto los términos de uso') }}</a>

                                    @if ($errors->has('terms_of_use'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('terms_of_use') }}</strong> </span>
                                    @endif

                                </div>



                                <div>

                                    {!! NoCaptcha::renderJs() !!}

                                    {!! NoCaptcha::display() !!}

                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block text-danger">

                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>

                                        </span>
                                    @endif

                                </div>



                                <input type="submit" class="btn" value="{{ __('Register') }}">



                            </form>



                        </div>



                        <div id="employer" class="formpanel tab-pane fade {{ $c_or_e == 'employer' ? 'active' : '' }}">



                            <form class="form-horizontal" method="POST" action="{{ route('company.register') }}">



                                {{ csrf_field() }}



                                <input type="hidden" name="candidate_or_employer" value="employer" />



                                <div class="formrow{{ $errors->has('name') ? ' has-error' : '' }}">



                                    <input type="text" name="name" class="form-control" required="required"
                                        placeholder="Nombre de empresa" value="{{ old('name') }}">



                                    @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('name') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">



                                    <input type="email" name="email" class="form-control" required="required"
                                        placeholder="{{ __('Email') }}" value="{{ old('email') }}">



                                    @if ($errors->has('email'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">



                                    <input type="password" name="password" class="form-control" required="required"
                                        placeholder="{{ __('Password') }}" value="">



                                    @if ($errors->has('password'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">



                                    <input type="password" name="password_confirmation" class="form-control"
                                        required="required" placeholder="{{ __('Password Confirmation') }}"
                                        value="">



                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">



                                    <?php
                                    
                                    $is_checked = '';
                                    
                                    if (old('is_subscribed', 1)) {
                                        $is_checked = 'checked="checked"';
                                    }
                                    
                                    ?>



                                    <input type="checkbox" value="1" name="is_subscribed"
                                        {{ $is_checked }} />{{ __('Suscríbete al boletín de noticias') }}



                                    @if ($errors->has('is_subscribed'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('is_subscribed') }}</strong> </span>
                                    @endif

                                </div>



                                <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">



                                    <input type="checkbox" value="1" name="terms_of_use" />



                                    <a href="#" data-toggle="modal" data-target="#modalProteccionDatos">{{ __('Acepto los términos de uso') }}</a>

                                    @if ($errors->has('terms_of_use'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('terms_of_use') }}</strong> </span>
                                    @endif

                                </div>



                                <div>

                                    {!! NoCaptcha::renderJs() !!}

                                    {!! NoCaptcha::display() !!}

                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block text-danger">

                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>

                                        </span>
                                    @endif

                                </div>



                                <input type="submit" class="btn" value="{{ __('Register') }}">



                            </form>



                        </div>



                    </div>



                    <!-- sign up form -->







                    <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> Ya estas registrado? <a
                            href="{{ route('login') }}"> Ingresar </a></div>



                    <!-- sign up form end-->







                </div>



            </div>







        </div>



    </div>

    <div class="modal fade modal-proteccion-datos" id="modalProteccionDatos" tabindex="-1" role="dialog" aria-labelledby="modalProteccionDatosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-proteccion-datos__header">
                    <div>
                        <p class="modal-proteccion-datos__eyebrow">Antes de registrarte</p>
                        <h4 class="modal-title" id="modalProteccionDatosLabel">
                            <i class="fa fa-shield" aria-hidden="true"></i> Protección de Datos Personales
                        </h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">&times;</button>
                </div>

                <div class="modal-body modal-proteccion-datos__body">
                    <div class="modal-proteccion-datos__guide">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span>Lee esta información y consulta los documentos adjuntos. Luego marca el checkbox <strong>«Acepto los términos de uso»</strong> para continuar con tu registro.</span>
                    </div>

                    <div class="modal-proteccion-datos__intro">
                        <p>
                            En la Institución Universitaria Oriente de Caldas (UNIOC), la protección de los datos
                            personales es un compromiso institucional. Toda la información que suministras en la
                            Bolsa de Empleo se trata conforme a la Política Institucional de Protección de Datos
                            Personales y la Ley 1581 de 2012.
                        </p>
                        <p>
                            Los datos de estudiantes, egresados, empleadores y demás usuarios se usan únicamente
                            para los servicios de gestión y colocación de empleo, garantizando confidencialidad,
                            seguridad y un tratamiento adecuado.
                        </p>
                    </div>

                    <div class="modal-proteccion-datos__cards">
                        <div class="modal-proteccion-datos__card">
                            <div class="modal-proteccion-datos__card-icon">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h5>¿Qué protege esta política?</h5>
                                <ul>
                                    <li>Los datos personales de estudiantes, egresados, empleadores y demás usuarios.</li>
                                    <li>La información en las bases de datos institucionales.</li>
                                    <li>Tu derecho a conocer, actualizar, rectificar y suprimir tu información.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="modal-proteccion-datos__card">
                            <div class="modal-proteccion-datos__card-icon">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h5>¿Por qué es importante?</h5>
                                <ul>
                                    <li>Protege tu privacidad y la de tu información personal.</li>
                                    <li>Promueve un tratamiento responsable, transparente y seguro.</li>
                                    <li>Previene usos indebidos y accesos no autorizados.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="modal-proteccion-datos__card">
                            <div class="modal-proteccion-datos__card-icon">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h5>¿Cuáles son tus derechos?</h5>
                                <p class="modal-proteccion-datos__card-lead">Como usuario de la Bolsa de Empleo de la IES CINOC, puedes:</p>
                                <ul>
                                    <li>Conocer la información que la institución ha recopilado sobre ti.</li>
                                    <li>Actualizar y rectificar tus datos cuando sea necesario.</li>
                                    <li>Solicitar la supresión de tus datos cuando la ley lo permita.</li>
                                    <li>Presentar consultas o reclamos sobre el tratamiento de tu información.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="modal-proteccion-datos__docs">
                        <h5><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Documentos para consultar</h5>
                        <p class="modal-proteccion-datos__docs-hint">Descarga y revisa los documentos oficiales antes de aceptar los términos.</p>
                        <div class="modal-proteccion-datos__doc-buttons">
                            <a href="https://bolsaempleo.iescinoc.edu.co/documents/Anexo%202.%20OFICIO%20Y%20ACUERDO%20POLITICA%20DE%20TRATAMIENTO%20DE%20DATOS.pdf"
                                class="modal-proteccion-datos__doc-btn" target="_blank" rel="noopener noreferrer">
                                <span class="modal-proteccion-datos__doc-label">Anexo</span>
                                <span class="modal-proteccion-datos__doc-title">Política de protección de datos personales</span>
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>
                            <a href="https://bolsaempleo.iescinoc.edu.co/documents/Anexo%203.%20R-293-de-2017-Presentacion-de-informes-estadisticos.pdf"
                                class="modal-proteccion-datos__doc-btn" target="_blank" rel="noopener noreferrer">
                                <span class="modal-proteccion-datos__doc-label">Anexo</span>
                                <span class="modal-proteccion-datos__doc-title">Resolución 293 de 2017</span>
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <div class="modal-proteccion-datos__section">
                        <h5><i class="fa fa-users" aria-hidden="true"></i> Información de grupos poblacionales</h5>
                        <p>
                            En cumplimiento de la Resolución 293 de 2017, la Bolsa de Empleo de la UNIOC solicita
                            a los oferentes registrados información sobre su grupo poblacional para los informes
                            estadísticos del Servicio Público de Empleo.
                        </p>
                        <p>
                            Estos datos se usan exclusivamente con fines estadísticos, de seguimiento y cumplimiento
                            legal, siempre bajo confidencialidad y conforme a la normativa de protección de datos
                            personales.
                        </p>
                    </div>

                    <div class="modal-proteccion-datos__closing">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <div>
                            <p><strong>Tu información está protegida.</strong> En la UNIOC trabajamos para que sea tratada de manera segura, responsable y transparente.</p>
                            <p>El tratamiento de tus datos se realiza conforme a la Política Institucional de Protección de Datos Personales.</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer modal-proteccion-datos__footer">
                    <p class="modal-proteccion-datos__footer-hint">
                        <i class="fa fa-arrow-up" aria-hidden="true"></i> Al cerrar, marca el checkbox para continuar
                    </p>
                    <button type="button" class="btn button-orng" data-dismiss="modal">
                        Entendido, volver al registro
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection

@push('styles')
<style>
    .modal-proteccion-datos .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18);
    }

    .modal-proteccion-datos__header {
        background: linear-gradient(135deg, #ffb72f 0%, #ff9000 100%);
        color: #fff;
        border-bottom: none;
        padding: 20px 24px;
        align-items: flex-start;
    }

    .modal-proteccion-datos__header .close {
        color: #fff;
        opacity: 0.9;
        text-shadow: none;
        margin-top: 2px;
    }

    .modal-proteccion-datos__eyebrow {
        margin: 0 0 4px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        opacity: 0.9;
    }

    .modal-proteccion-datos__header .modal-title {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .modal-proteccion-datos__header .modal-title .fa {
        margin-right: 8px;
    }

    .modal-proteccion-datos__body {
        max-height: 68vh;
        overflow-y: auto;
        padding: 20px 24px 8px;
        background: #fafafa;
    }

    .modal-proteccion-datos__guide {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        background: #fff8e8;
        border: 1px solid #ffe2a8;
        border-left: 4px solid #ff9000;
        border-radius: 8px;
        padding: 14px 16px;
        margin-bottom: 18px;
        font-size: 14px;
        line-height: 1.5;
        color: #5a4a2a;
    }

    .modal-proteccion-datos__guide .fa {
        color: #ff9000;
        font-size: 18px;
        margin-top: 2px;
    }

    .modal-proteccion-datos__intro {
        background: #fff;
        border-radius: 8px;
        padding: 16px 18px;
        margin-bottom: 16px;
        border: 1px solid #eee;
    }

    .modal-proteccion-datos__intro p:last-child {
        margin-bottom: 0;
    }

    .modal-proteccion-datos__cards {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 18px;
    }

    .modal-proteccion-datos__card {
        display: flex;
        gap: 14px;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 16px;
    }

    .modal-proteccion-datos__card-icon {
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #fff3d6;
        color: #ff9000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .modal-proteccion-datos__card h5 {
        margin: 0 0 8px;
        font-size: 15px;
        font-weight: 700;
        color: #333;
    }

    .modal-proteccion-datos__card-lead {
        margin-bottom: 8px;
        font-size: 14px;
        color: #666;
    }

    .modal-proteccion-datos__card ul {
        margin: 0;
        padding-left: 18px;
    }

    .modal-proteccion-datos__card li {
        margin-bottom: 4px;
        font-size: 14px;
        line-height: 1.45;
        color: #555;
    }

    .modal-proteccion-datos__docs {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 16px 18px;
        margin-bottom: 16px;
    }

    .modal-proteccion-datos__docs h5 {
        margin: 0 0 6px;
        font-size: 15px;
        font-weight: 700;
    }

    .modal-proteccion-datos__docs h5 .fa {
        color: #e74c3c;
        margin-right: 6px;
    }

    .modal-proteccion-datos__docs-hint {
        margin: 0 0 14px;
        font-size: 13px;
        color: #777;
    }

    .modal-proteccion-datos__doc-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .modal-proteccion-datos__doc-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: #fffaf2;
        border: 1px solid #ffd88a;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .modal-proteccion-datos__doc-btn:hover {
        background: #fff3d6;
        border-color: #ff9000;
        color: #333;
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 144, 0, 0.15);
    }

    .modal-proteccion-datos__doc-label {
        flex-shrink: 0;
        background: #ff9000;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 8px;
        border-radius: 4px;
        letter-spacing: 0.04em;
    }

    .modal-proteccion-datos__doc-title {
        flex: 1;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.3;
    }

    .modal-proteccion-datos__doc-btn .fa-external-link {
        color: #ff9000;
        font-size: 14px;
    }

    .modal-proteccion-datos__section {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 16px 18px;
        margin-bottom: 16px;
    }

    .modal-proteccion-datos__section h5 {
        margin: 0 0 10px;
        font-size: 15px;
        font-weight: 700;
    }

    .modal-proteccion-datos__section h5 .fa {
        color: #ff9000;
        margin-right: 6px;
    }

    .modal-proteccion-datos__section p:last-child {
        margin-bottom: 0;
    }

    .modal-proteccion-datos__closing {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        background: linear-gradient(135deg, #f0fdf4 0%, #e8f8ee 100%);
        border: 1px solid #b8e6c8;
        border-radius: 8px;
        padding: 16px 18px;
        margin-bottom: 8px;
    }

    .modal-proteccion-datos__closing .fa {
        color: #28a745;
        font-size: 22px;
        margin-top: 2px;
    }

    .modal-proteccion-datos__closing p {
        margin: 0 0 6px;
        font-size: 14px;
        line-height: 1.5;
        color: #2d5a3d;
    }

    .modal-proteccion-datos__closing p:last-child {
        margin-bottom: 0;
    }

    .modal-proteccion-datos__footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        background: #fff;
        border-top: 1px solid #eee;
        padding: 14px 24px;
    }

    .modal-proteccion-datos__footer-hint {
        margin: 0;
        font-size: 13px;
        color: #888;
    }

    .modal-proteccion-datos__footer-hint .fa {
        color: #ff9000;
        margin-right: 4px;
    }

    @media (max-width: 576px) {
        .modal-proteccion-datos__footer {
            flex-direction: column;
            align-items: stretch;
        }

        .modal-proteccion-datos__footer .btn {
            width: 100%;
        }
    }
</style>
@endpush
