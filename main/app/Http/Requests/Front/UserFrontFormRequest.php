<?php

namespace App\Http\Requests\Front;

use Auth;
use App\Http\Requests\Request;

class UserFrontFormRequest extends Request
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
        $id = Auth::user()->id;
        $id_str = ',' . $id;
        $password = '';
        return [
            'first_name' => 'required|max:80',
            //'middle_name' => 'max:80',
            //'last_name' => 'required|max:80',
            'email' => 'required|unique:users,email' . $id_str . '|email|max:100',
            'password' => 'max:50',
            //'father_name' => 'required|max:80',
            'date_of_birth' => 'required',
            //'gender_id' => 'required',
            //'marital_status_id' => 'required',
            'nationality_id' => 'required',
            //'national_id_card_number' => 'required|max:80',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required|max:18',
            //'mobile_num' => 'required|max:22',
            //'job_experience_id' => 'required',
            //'career_level_id' => 'required',
            'industry_id' => 'required',
            'functional_area_id' => 'required',
           // 'current_salary' => 'required|max:11',
            //'expected_salary' => 'required|max:11',
            //'salary_currency' => 'required|max:5',
            'street_address' => 'required|max:230',
            'image' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('Nombre es requerido'),
            //'middle_name.required' => __('Middle Name es requerido'),
            //'last_name.required' => __('Last Name es requerido'),
            'email.required' => __('Email es requerido'),
            'email.email' => __('El email debe ser una direccion valida'),
            'email.unique' => __('Este email ya ha sido registrado'),
            'password.required' => __('Contraseña es requerida'),
            'password.min' => __('La contraseña debe tener mas de tres caracteres'),
            //'father_name.required' => __('Father Name es requerido'),
            'date_of_birth.required' => __('Fecha de nacimiento es requerido'),
            //'gender_id.required' => __('Seleccione gender'),
           // 'marital_status_id.required' => __('Seleccione marital status'),
            'nationality_id.required' => __('Seleccione una nacionalidad'),
            //'national_id_card_number.required' => __('National ID card# required'),
            'country_id.required' => __('Seleccione país'),
            'state_id.required' => __('Seleccione departamento'),
            'city_id.required' => __('Seleccione ciudad'),
            'phone.required' => __('Ingrese telefono'),
            //'mobile_num.required' => __('Ingrese mobile number'),
           // 'job_experience_id.required' => __('Seleccione experience'),
           // 'career_level_id.required' => __('Seleccione career level'),
            'industry_id.required' => __('Seleccione industria'),
            'functional_area_id.required' => __('Seleccione area funcional'),
           // 'current_salary.required' => __('Ingrese current salary'),
           // 'expected_salary.required' => __('Ingrese expected salary'),
           // 'salary_currency.required' => __('Seleccione salary currency'),
            'street_address.required' => __('Ingrese dirección'),
            'image.image' => __('Solo imagenes pueden ser subidas'),
        ];
    }

}
