<?php

namespace App\Http\Requests\Front;

use Auth;
use App\Http\Requests\Request;
use App\Rules\RegisteredIdNumber;

class UserFrontRegisterFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'first_name' => 'required|max:80',
            'middle_name' => 'max:80',
            // 'first_lastname' => 'required|max:80',
            'rol' => 'required',
            // 'last_name' => 'required|max:80',
            // 'last_name' => 'required|max:80',
            'email' => 'required|unique:users,email|email|max:100',
            'password' => 'required|confirmed|min:6|max:50',
            'national_id_card_number' => 'required',
            'national_id_card_number' => ['required', new RegisteredIdNumber],
            'terms_of_use' => 'required',
            //'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages()
    {

        return [
            // 'first_name.required' => __('First Name is required'),
            // 'middle_name.required' => __('Segundo '),
            'last_name.required' => __('Apellidos es requerido'),
            // 'email.required' => __('Email is required'),
            // 'email.email' => __('The email must be a valid email address'),
            // 'email.unique' => __('This Email has already been taken'),
            // 'password.required' => __('Password is required'),
            // 'password.min' => __('The password should be more than 3 characters long'),
            'terms_of_use.required' => __('Debes aceptar terminos de uso'),
            'national_id_card_number.required' => __('Identificación es requerida'),
            //'g-recaptcha-response.required' => __('Please verify that you are not a robot'),
            //'g-recaptcha-response.captcha' => __('Captcha error! try again later or contact site admin'),


            'first_name.required' => __('Nombre es requerido'),
            
            'email.required' => __('Email es requerido'),
            'email.email' => __('El email debe ser una direccion valida'),
            'email.unique' => __('Este email ya ha sido registrado'),
            'password.required' => __('Contraseña es requerida'),
            'password.min' => __('La contraseña debe tener mas de tres caracteres'),
            // 'date_of_birth.required' => __('Fecha de nacimiento es requerido'),
            
            // 'nationality_id.required' => __('Seleccione una nacionalidad'),
            // 'country_id.required' => __('Seleccione país'),
            // 'state_id.required' => __('Seleccione departamento'),
            // 'city_id.required' => __('Seleccione ciudad'),
            // 'phone.required' => __('Ingrese telefono'),
            
            // 'industry_id.required' => __('Seleccione industria'),
            // 'functional_area_id.required' => __('Seleccione area funcional'),
            
            // 'street_address.required' => __('Ingrese dirección'),
            // 'image.image' => __('Solo imagenes pueden ser subidas'),
        ];
    }
}
