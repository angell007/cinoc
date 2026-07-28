@php
    $employeeOptions = \App\Helpers\MiscHelper::getNumEmployees();
    $yearOptions = \App\Helpers\MiscHelper::getEstablishedIn();
    $defaultCountry = old('country_id', $siteSetting->default_country_id ?? '');
@endphp

<form id="employerRegisterForm" class="employer-register-form" method="POST" action="{{ route('company.register') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="candidate_or_employer" value="employer" />

    <div class="employer-intro">
        <p>Complete la información de su empresa. El acceso se habilitará cuando la Bolsa de Empleo valide y active el registro.</p>
    </div>

    <div class="employer-steps" role="tablist" aria-label="Pasos del registro">
        <button type="button" class="employer-step is-active" data-step-target="1"><span>1</span> Acceso</button>
        <button type="button" class="employer-step" data-step-target="2"><span>2</span> Empresa</button>
        <button type="button" class="employer-step" data-step-target="3"><span>3</span> Representante</button>
        <button type="button" class="employer-step" data-step-target="4"><span>4</span> Ubicación</button>
    </div>

    <div class="employer-panel is-active" data-step="1">
        <h5>Datos de acceso</h5>
        <p class="employer-hint">Este correo será su usuario para ingresar a la plataforma.</p>
        <div class="row">
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('person_type') ? ' has-error' : '' }}">
                    <label>Tipo de persona</label>
                    <select name="person_type" class="form-control" required>
                        <option value="" disabled {{ old('person_type') ? '' : 'selected' }}>Seleccione</option>
                        <option value="natural" {{ old('person_type') === 'natural' ? 'selected' : '' }}>Persona natural</option>
                        <option value="juridica" {{ old('person_type') === 'juridica' ? 'selected' : '' }}>Persona jurídica</option>
                    </select>
                    @if ($errors->has('person_type')) <span class="help-block text-danger"><strong>{{ $errors->first('person_type') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Correo electrónico (usuario)</label>
                    <input type="email" name="email" class="form-control" required placeholder="correo@empresa.com" value="{{ old('email') }}">
                    @if ($errors->has('email')) <span class="help-block text-danger"><strong>{{ $errors->first('email') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required placeholder="Contraseña">
                    @if ($errors->has('password')) <span class="help-block text-danger"><strong>{{ $errors->first('password') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label>Confirmación de contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirme la contraseña">
                    @if ($errors->has('password_confirmation')) <span class="help-block text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span> @endif
                </div>
            </div>
        </div>
    </div>

    <div class="employer-panel" data-step="2">
        <h5>Información de la empresa</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="formrow{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>Nombre de la empresa</label>
                    <input type="text" name="name" class="form-control" required placeholder="Razón social o nombre" value="{{ old('name') }}">
                    @if ($errors->has('name')) <span class="help-block text-danger"><strong>{{ $errors->first('name') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('tipo_identificacion') ? ' has-error' : '' }}">
                    <label>Tipo de identificación</label>
                    <select name="tipo_identificacion" class="form-control" required>
                        <option value="" disabled {{ old('tipo_identificacion') ? '' : 'selected' }}>Seleccione</option>
                        <option value="NIT" {{ old('tipo_identificacion') === 'NIT' ? 'selected' : '' }}>NIT</option>
                        <option value="CC" {{ old('tipo_identificacion') === 'CC' ? 'selected' : '' }}>CC</option>
                        <option value="CE" {{ old('tipo_identificacion') === 'CE' ? 'selected' : '' }}>CE</option>
                    </select>
                    @if ($errors->has('tipo_identificacion')) <span class="help-block text-danger"><strong>{{ $errors->first('tipo_identificacion') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('identificacion') ? ' has-error' : '' }}">
                    <label>Número de identificación</label>
                    <input type="text" name="identificacion" class="form-control" required placeholder="N° de identificación" value="{{ old('identificacion') }}">
                    @if ($errors->has('identificacion')) <span class="help-block text-danger"><strong>{{ $errors->first('identificacion') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('industry_id') ? ' has-error' : '' }}">
                    <label>Sector productivo</label>
                    <select name="industry_id" class="form-control" required>
                        <option value="">Seleccione el sector productivo</option>
                        @foreach(($industries ?? []) as $id => $label)
                            <option value="{{ $id }}" {{ (string) old('industry_id') === (string) $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('industry_id')) <span class="help-block text-danger"><strong>{{ $errors->first('industry_id') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('ownership_type_id') ? ' has-error' : '' }}">
                    <label>Clasificación de entidad</label>
                    <select name="ownership_type_id" class="form-control" required>
                        <option value="">Seleccione tipo de entidad</option>
                        @foreach(($ownershipTypes ?? []) as $id => $label)
                            <option value="{{ $id }}" {{ (string) old('ownership_type_id') === (string) $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('ownership_type_id')) <span class="help-block text-danger"><strong>{{ $errors->first('ownership_type_id') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="formrow{{ $errors->has('no_of_employees') ? ' has-error' : '' }}">
                    <label>No. de empleados</label>
                    <select name="no_of_employees" class="form-control" required>
                        <option value="">Seleccione rango</option>
                        @foreach($employeeOptions as $id => $label)
                            <option value="{{ $id }}" {{ (string) old('no_of_employees') === (string) $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('no_of_employees')) <span class="help-block text-danger"><strong>{{ $errors->first('no_of_employees') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="formrow{{ $errors->has('established_in') ? ' has-error' : '' }}">
                    <label>Establecido en</label>
                    <select name="established_in" class="form-control" required>
                        <option value="">Seleccione año</option>
                        @foreach($yearOptions as $id => $label)
                            <option value="{{ $id }}" {{ (string) old('established_in') === (string) $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('established_in')) <span class="help-block text-danger"><strong>{{ $errors->first('established_in') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="formrow{{ $errors->has('website') ? ' has-error' : '' }}">
                    <label>Sitio web</label>
                    <input type="text" name="website" class="form-control" placeholder="https://www.misitioweb.com" value="{{ old('website') }}">
                    @if ($errors->has('website')) <span class="help-block text-danger"><strong>{{ $errors->first('website') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="formrow{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label>Descripción</label>
                    <textarea name="description" class="form-control" rows="4" required placeholder="Describa brevemente la empresa">{{ old('description') }}</textarea>
                    @if ($errors->has('description')) <span class="help-block text-danger"><strong>{{ $errors->first('description') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('logo') ? ' has-error' : '' }}">
                    <label>Logo de la empresa</label>
                    <input type="file" name="logo" id="reg_logo" class="form-control" accept="image/*">
                    <div id="reg_logo_preview" class="employer-file-preview"></div>
                    @if ($errors->has('logo')) <span class="help-block text-danger"><strong>{{ $errors->first('logo') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('camara_comercio') ? ' has-error' : '' }}">
                    <label>Cámara de comercio (PDF)</label>
                    <input type="file" name="camara_comercio" class="form-control" accept=".pdf,application/pdf">
                    @if ($errors->has('camara_comercio')) <span class="help-block text-danger"><strong>{{ $errors->first('camara_comercio') }}</strong></span> @endif
                </div>
            </div>
        </div>
    </div>

    <div class="employer-panel" data-step="3">
        <h5>Representante legal y contacto</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('ceo') ? ' has-error' : '' }}">
                    <label>Representante legal</label>
                    <input type="text" name="ceo" class="form-control" required placeholder="Nombre del representante" value="{{ old('ceo') }}">
                    @if ($errors->has('ceo')) <span class="help-block text-danger"><strong>{{ $errors->first('ceo') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('ceo_email') ? ' has-error' : '' }}">
                    <label>Correo del representante legal</label>
                    <input type="email" name="ceo_email" class="form-control" required placeholder="correo@dominio.com" value="{{ old('ceo_email') }}">
                    @if ($errors->has('ceo_email')) <span class="help-block text-danger"><strong>{{ $errors->first('ceo_email') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('tipo_identificacion_ceo') ? ' has-error' : '' }}">
                    <label>Tipo de identificación representante legal</label>
                    <select name="tipo_identificacion_ceo" class="form-control" required>
                        <option value="" disabled {{ old('tipo_identificacion_ceo') ? '' : 'selected' }}>Seleccione</option>
                        <option value="CC" {{ old('tipo_identificacion_ceo') === 'CC' ? 'selected' : '' }}>CC</option>
                        <option value="NIT" {{ old('tipo_identificacion_ceo') === 'NIT' ? 'selected' : '' }}>NIT</option>
                        <option value="CE" {{ old('tipo_identificacion_ceo') === 'CE' ? 'selected' : '' }}>CE</option>
                    </select>
                    @if ($errors->has('tipo_identificacion_ceo')) <span class="help-block text-danger"><strong>{{ $errors->first('tipo_identificacion_ceo') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('identificacion_ceo') ? ' has-error' : '' }}">
                    <label>N° identificación representante legal</label>
                    <input type="text" name="identificacion_ceo" class="form-control" required placeholder="Número de identificación" value="{{ old('identificacion_ceo') }}">
                    @if ($errors->has('identificacion_ceo')) <span class="help-block text-danger"><strong>{{ $errors->first('identificacion_ceo') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                    <label>Persona de contacto</label>
                    <input type="text" name="contact_name" class="form-control" required placeholder="Nombre de contacto" value="{{ old('contact_name') }}">
                    @if ($errors->has('contact_name')) <span class="help-block text-danger"><strong>{{ $errors->first('contact_name') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label>Teléfono</label>
                    <input type="text" name="phone" class="form-control" required placeholder="Teléfono de contacto" value="{{ old('phone') }}">
                    @if ($errors->has('phone')) <span class="help-block text-danger"><strong>{{ $errors->first('phone') }}</strong></span> @endif
                </div>
            </div>
        </div>
    </div>

    <div class="employer-panel" data-step="4">
        <h5>Ubicación y redes</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="formrow{{ $errors->has('country_id') ? ' has-error' : '' }}">
                    <label>País</label>
                    <select name="country_id" id="reg_country_id" class="form-control" required>
                        <option value="">Seleccione país</option>
                        @foreach(($countries ?? []) as $id => $label)
                            <option value="{{ $id }}" {{ (string) $defaultCountry === (string) $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('country_id')) <span class="help-block text-danger"><strong>{{ $errors->first('country_id') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="formrow{{ $errors->has('state_id') ? ' has-error' : '' }}">
                    <label>Departamento</label>
                    <span id="reg_state_dd">
                        <select name="state_id" id="state_id" class="form-control" required>
                            <option value="">Seleccione departamento</option>
                        </select>
                    </span>
                    @if ($errors->has('state_id')) <span class="help-block text-danger"><strong>{{ $errors->first('state_id') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="formrow{{ $errors->has('city_id') ? ' has-error' : '' }}">
                    <label>Ciudad</label>
                    <span id="reg_city_dd">
                        <select name="city_id" id="city_id" class="form-control" required>
                            <option value="">Seleccione ciudad</option>
                        </select>
                    </span>
                    @if ($errors->has('city_id')) <span class="help-block text-danger"><strong>{{ $errors->first('city_id') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="formrow{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label>Dirección</label>
                    <input type="text" name="location" class="form-control" required placeholder="Dirección del domicilio principal" value="{{ old('location') }}">
                    @if ($errors->has('location')) <span class="help-block text-danger"><strong>{{ $errors->first('location') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('facebook') ? ' has-error' : '' }}">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="{{ old('facebook') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('twitter') ? ' has-error' : '' }}">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" placeholder="Twitter" value="{{ old('twitter') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('linkedin') ? ' has-error' : '' }}">
                    <label>LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn" value="{{ old('linkedin') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="formrow{{ $errors->has('google_plus') ? ' has-error' : '' }}">
                    <label>Instagram</label>
                    <input type="text" name="google_plus" class="form-control" placeholder="Instagram" value="{{ old('google_plus') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">
                    <label class="employer-terms">
                        <input type="checkbox" value="1" name="terms_of_use" {{ old('terms_of_use') ? 'checked' : '' }} required>
                        <a href="https://bolsaempleo.iescinoc.edu.co/files/OFICIO Y ACUERDO POLITICA DE TRATAMIENTO DE DATOS.pdf" target="_blank">Acepto los términos de uso</a>
                    </label>
                    @if ($errors->has('terms_of_use')) <span class="help-block text-danger"><strong>{{ $errors->first('terms_of_use') }}</strong></span> @endif
                </div>
            </div>
        </div>
    </div>

    <div class="employer-nav">
        <button type="button" class="btn btn-default" id="employerPrevBtn" style="display:none;">Anterior</button>
        <button type="button" class="btn" id="employerNextBtn">Siguiente</button>
        <button type="submit" class="btn" id="employerSubmitBtn" style="display:none;">Registrar empresa</button>
    </div>
</form>
