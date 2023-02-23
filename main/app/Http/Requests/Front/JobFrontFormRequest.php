<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\Request;
use App\Rules\IsPL;
use Carbon\Carbon;

class JobFrontFormRequest extends Request
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
                    return [
                        "title" => "required|max:180",
                        "description" => "required",
                        // "skills" => "required",
                        "country_id" => "required",
                        "state_id" => "required",
                        "city_id" => "required",
                        "position" => "required",
                        "functional_area_id" => "required",
                        "job_type_id" => "required",
                        "expiry_date" => "required|date|before:" . $sixMonthsAgo,
                        "job_experience_id" => "required",
                        "degree_level_id" => new IsPL(),
                    ];
                }
            default:
                break;
        }
    }
    public function attributes()
    {
        return ['expiry_date' => 'fecha de vencimiento de la vacante',];
    }
    public function messages()
    {
        return [
            'title.required' => __('Please enter Job title'),
            'description.required' => __('Please enter Job description'),
            'skills.required' => __('Please enter Job skills'),
            'country_id.required' => __('Please select Country'),
            'state_id.required' => __('Please select State'),
            'city_id.required' => __('Please select City'),
            'functional_area_id.required' => __('Please select functional area'),
            'job_type_id.required' => __('Please select job type'),
            'expiry_date.required' => __('Please enter Job expiry date'),
            'job_experience_id.required' => __('Please select job experience'),
            'position.required' => __('Please enter a position'),
        ];
    }
}
