<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminFormRequest extends Request
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
        $id = (int) $this->input('id', 0);
        $pass_required = 'required|min:3|max:100';
        $id_str = '';
        if ($id > 0) {
            $id_str = ',' . $id;
            $pass_required = '';
        }
        //echo $id_str;exit;
        return [
            'name' => 'required|unique:admins,name' . $id_str . '|max:50',
            'email' => 'required|unique:admins,email' . $id_str . '|email|max:100',
            'password' => $pass_required,
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre es requerido',
            'name.unique' => 'El nombre ya ha sido registrado.',
            'name.max' => 'El nombre no debe ser de mas de  50 caracteres.',
            'email.required' => 'Email es requerido',
            'email.email' => 'El email debe ser valido.',
            'email.unique' => 'el Email ya ha sido registrado.',
            'name.max' => 'El email no debe ser de mas de  100 caracteres.',
            'password.required' => 'Contraseña es requerido',
            'password.min' => 'The contraseña debe ser de mas de 3 caracteres long.',
            'password.max' => 'The contraseña no debe ser de mas de  100 caracteres.',
            'role_id.required' => 'Seleccione un rol',
        ];
    }

}
