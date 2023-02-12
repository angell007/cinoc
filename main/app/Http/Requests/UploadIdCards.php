<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UploadIdCards extends Request
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
            'file' => 'required|max:50000|mimetypes:application/csv,application/excel',
        ];
    }

    public function messages()
    {
        return [
            'file' => 'Necesitas un archivo excel'
        ];
    }

}
