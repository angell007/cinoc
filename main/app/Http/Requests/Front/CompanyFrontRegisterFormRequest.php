<?php

namespace App\Http\Requests\Front;

use Auth;
use App\Http\Requests\Request;

class CompanyFrontRegisterFormRequest extends Request
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
            'name' => 'required|max:150',
            'email' => 'required|unique:companies,email|email|max:100',
            'terms_of_use' => 'required',
            'password' => [
            'required',
            'string',
            'min:6',
            'regex:/[a-z]/',     
            'regex:/[A-Z]/',     
            'regex:/[0-9]/',     
          ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'email.required' => 'Email es requerido',
            // 'email.required' => __('Email is required'),
            'email.email' => 'El Email no es valido',
            // 'email.email' => __('The email must be a valid email address'),
            'email.unique' => 'El Email ya se encuentra en uso ',
            // 'email.unique' => __('This Email has already been taken'),
            'password.required' => __('Password is required'),
            'password.string' => __('Password should be string'),
            'password.required' => __('Password is required'),
            'password.min' => __('The password should be more than 3 characters long'),
            'password.regex' => 'La contraseña debe tener al menos un carácter especial un número y una letra mayúscula y minúscula',
            'terms_of_use.required' => __('Please accept terms of use'),
            //'g-recaptcha-response.required' => __('Please verify that you are not a robot'),
            //'g-recaptcha-response.captcha' => __('Captcha error! try again later or contact site admin'),
        ];
    }

}
