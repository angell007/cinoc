<?php

namespace App;

use App;
use App\Traits\Lang;
use App\Traits\IsDefault;
use App\Traits\Active;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use Lang;

    use IsDefault;

    use Active;

    use Sorted;



    protected $table = 'sliders';

    public $timestamps = true;

    protected $guarded = ['id'];

    //protected $dateFormat = 'U';

    protected $dates = ['created_at', 'updated_at'];



    public static function defaultSliders()
    {

        $array = Slider::isDefault()->active()->sorted()->get();

        return $array;

    }



    public static function langSliders()
    {

        $array = Slider::lang()->active()->sorted()->get();

        if ((int) count($array) === 0) {

            $array = self::defaultSliders();

        }

        return $array;

    }

    public function getSliderHeadingAttribute($value)
    {
        return self::normalizeHeading($value);
    }

    public static function normalizeHeading($value)
    {
        $heading = trim((string) $value);
        $heading = preg_replace('/\bIES[\s\-]+/i', '', $heading);
        $heading = preg_replace('/\s+/', ' ', $heading);

        if ($heading === '' || preg_match('/UNIOC.*TRANSFORMAR COMUNIDADES/i', $heading)) {
            return 'LA UNIOC EL MEJOR ALIADO PARA TRANSFORMAR COMUNIDADES';
        }

        return $heading;
    }

}
