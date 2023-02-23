<?php



namespace App\Rules;



use App\Models\IdcardsNumber;

use Illuminate\Contracts\Validation\Rule;



class IsPL implements Rule

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

        if (request()->get('is_pl')) {

            if (in_array(request()->get('degree_level_id'), [111, 109, 110, 107, 104])) {
                return true;
            }

            return false;
        }

        return true;
    }



    /**

     * Get the validation error message.

     *

     * @return string

     */

    public function message()

    {

        return "Para practicas laborales el nivel de estudio debe ser minimo Técnico";
    }
}
