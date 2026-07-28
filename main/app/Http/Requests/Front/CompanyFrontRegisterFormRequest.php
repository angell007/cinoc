<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\Request;

class CompanyFrontRegisterFormRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'person_type' => 'required|in:natural,juridica',
            'name' => 'required|max:150',
            'tipo_identificacion' => 'required|in:NIT,CC,CE',
            'identificacion' => 'required|max:50',
            'industry_id' => 'required|integer',
            'ownership_type_id' => 'required|integer',
            'description' => 'required',
            'no_of_employees' => 'required|max:15',
            'established_in' => 'required|max:12',
            'website' => 'nullable|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'camara_comercio' => 'nullable|file|mimes:pdf|max:10240',
            'ceo' => 'required|max:150',
            'ceo_email' => 'required|email|max:100',
            'tipo_identificacion_ceo' => 'required|in:CC,NIT,CE',
            'identificacion_ceo' => 'required|max:50',
            'contact_name' => 'required|max:150',
            'phone' => 'required|max:30',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'location' => 'required|max:150',
            'facebook' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'linkedin' => 'nullable|max:255',
            'google_plus' => 'nullable|max:255',
            'email' => 'required|unique:companies,email|email|max:100',
            'terms_of_use' => 'required',
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'person_type.required' => 'Debe seleccionar el tipo de persona',
            'name.required' => 'El nombre de la empresa es requerido',
            'tipo_identificacion.required' => 'Debe seleccionar el tipo de identificación',
            'identificacion.required' => 'El número de identificación es requerido',
            'industry_id.required' => 'Debe seleccionar el sector productivo',
            'ownership_type_id.required' => 'Debe seleccionar la clasificación de entidad',
            'description.required' => 'La descripción es requerida',
            'no_of_employees.required' => 'Debe seleccionar el número de empleados',
            'established_in.required' => 'Debe seleccionar el año de establecimiento',
            'ceo.required' => 'El nombre del representante legal es requerido',
            'ceo_email.required' => 'El correo del representante legal es requerido',
            'ceo_email.email' => 'El correo del representante legal no es válido',
            'tipo_identificacion_ceo.required' => 'Debe seleccionar el tipo de identificación del representante legal',
            'identificacion_ceo.required' => 'El número de identificación del representante legal es requerido',
            'contact_name.required' => 'El nombre de la persona de contacto es requerido',
            'phone.required' => 'El teléfono es requerido',
            'country_id.required' => 'Debe seleccionar el país',
            'state_id.required' => 'Debe seleccionar el departamento',
            'city_id.required' => 'Debe seleccionar la ciudad',
            'location.required' => 'La dirección es requerida',
            'email.required' => 'Email es requerido',
            'email.email' => 'El Email no es válido',
            'email.unique' => 'El Email ya se encuentra en uso',
            'password.required' => __('Password is required'),
            'password.min' => __('The password should be more than 3 characters long'),
            'password.confirmed' => 'La confirmación de contraseña no coincide',
            'password.regex' => 'La contraseña debe tener al menos un número y una letra mayúscula y minúscula',
            'terms_of_use.required' => __('Please accept terms of use'),
            'logo.image' => 'El logo debe ser una imagen válida',
            'camara_comercio.mimes' => 'La Cámara de Comercio debe ser un PDF',
            'camara_comercio.max' => 'La Cámara de Comercio no debe superar 10 MB',
        ];
    }
}
