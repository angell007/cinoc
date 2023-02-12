<?php

namespace App\Rules;

use App\Models\IdcardsNumber;
use Illuminate\Contracts\Validation\Rule;

class RegisteredIdNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if (IdcardsNumber::firstWhere('id_number', $value)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Su número de cédula no se encuentra inscrita en la base de datos de nuestros estudiantes o egresados, contáctenos para mayor información";
    }
}
