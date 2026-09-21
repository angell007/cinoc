<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Rules\IsPL;
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
                    "title" => "required|max:180",
                    "position" => "required",
                    "description" => "required",
                    "country_id" => "required",
                    "state_id" => "required",
                    "city_id" => "required",
                    "job_type_id" => "required",
                    "expiry_date" => "required|date|before:" . $sixMonthsAgo,
                    "job_experience_id" => "required",
                    "degree_level_id" => new IsPL(),
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
            'company_id.required' => __('Please select Company'),
            'title.required' => __('Please enter Job title'),
            'position.required' => __('Please enter a position'),
            'description.required' => __('Please enter Job description'),
            'country_id.required' => __('Please select Country'),
            'state_id.required' => __('Please select State'),
            'city_id.required' => __('Please select City'),
            'job_type_id.required' => __('Please select job type'),
            'expiry_date.required' => __('Please enter Job expiry date'),
            'job_experience_id.required' => __('Please select job experience'),
            'is_active.required' => '¿Esta vacante está activa?',
            'is_featured.required' => '¿Esta vacante está destacada?',
        ];
    }

    public function attributes()
    {
        return ['expiry_date' => 'fecha de vencimiento de la vacante',];
    }
}
