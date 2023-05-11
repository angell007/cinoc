<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class JobFormRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {

        $sixMonthsAgo = Carbon::now()->addMonths(6)->toDateString();

        switch ($this->method()) {
            case 'PUT':
            case 'POST': {
                    $id = (int) $this->input('id', 0);
                    $job_unique = '';
                    if ($id > 0) {
                        $job_unique = ',id,' . $id;
                    }
                    return [
                        "id" => "",
                        "company_id" => "required",
                        "title" => "required",
                        "description" => "required",
                        "skills" => "required",
                        "country_id" => "required",
                        "state_id" => "required",
                        "city_id" => "required",
                        // "functional_area_id" => "required",
                        "job_type_id" => "required",
                        "expiry_date" => "required|date|before:" . $sixMonthsAgo,
                        "job_experience_id" => "required",
                        "is_active" => "required",
                        "is_featured" => "required",
                    ];
                }
            default:
                break;
        }
    }
    public function messages()
    {
        return [
            'company_id.required' => 'Please select Company.',
            'title.required' => 'Please enter Job title.',
            'description.required' => 'Please enter Job description.',
            'skills.required' => 'Please enter Job skills.',
            'country_id.required' => 'Please select Country.',
            'state_id.required' => 'Please select State.',
            'city_id.required' => 'Please select City.',
            'functional_area_id.required' => 'Please select functional area.',
            'job_type_id.required' => 'Please select job type.',
            'expiry_date.required' => 'Please enter Job expiry date.',
            'job_experience_id.required' => 'Please select job experience.',
            'is_active.required' => 'Is this Job active?',
            'is_featured.required' => 'Is this Job featured?',
        ];
    }

    public function attributes()
    {
        return ['expiry_date' => 'fecha de vencimiento de la vacante',];
    }
}
