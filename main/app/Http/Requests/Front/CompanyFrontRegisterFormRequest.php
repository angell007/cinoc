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
            'ceo' => 'required|max:150',
            'ceo_email' => 'required|email|max:100',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'contact_name' => 'required|max:150',
            'phone' => 'required|max:30',
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
            'name.required' => 'La razón social o nombre es requerido',
            'tipo_identificacion.required' => 'Debe seleccionar el tipo de identificación',
            'identificacion.required' => 'El NIT o documento de identificación es requerido',
            'ceo.required' => 'El nombre del representante legal es requerido',
            'ceo_email.required' => 'El correo del representante legal es requerido',
            'ceo_email.email' => 'El correo del representante legal no es válido',
            'country_id.required' => 'Debe seleccionar el país',
            'state_id.required' => 'Debe seleccionar el departamento',
            'city_id.required' => 'Debe seleccionar la ciudad',
            'contact_name.required' => 'El nombre de la persona de contacto es requerido',
            'phone.required' => 'El teléfono de contacto es requerido',
            'email.required' => 'Email es requerido',
            'email.email' => 'El Email no es valido',
            'email.unique' => 'El Email ya se encuentra en uso ',
            'password.required' => __('Password is required'),
            'password.string' => __('Password should be string'),
            'password.min' => __('The password should be more than 3 characters long'),
            'password.confirmed' => 'La confirmación de contraseña no coincide',
            'password.regex' => 'La contraseña debe tener al menos un número y una letra mayúscula y minúscula',
            'terms_of_use.required' => __('Please accept terms of use'),
        ];
    }
}
