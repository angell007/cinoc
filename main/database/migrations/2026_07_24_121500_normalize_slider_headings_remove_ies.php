<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class NormalizeSliderHeadingsRemoveIes extends Migration
{
    public function up()
    {
        if (!DB::getSchemaBuilder()->hasTable('sliders')) {
            return;
        }

        $sliders = DB::table('sliders')->select('id', 'slider_heading')->get();

        foreach ($sliders as $slider) {
            $heading = trim((string) $slider->slider_heading);
            $normalized = preg_replace('/\bIES[\s\-]+/i', '', $heading);
            $normalized = preg_replace('/\s+/', ' ', (string) $normalized);
            $normalized = trim((string) $normalized);

            if ($normalized === '' || preg_match('/UNIOC.*TRANSFORMAR COMUNIDADES/i', $normalized)) {
                $normalized = 'LA UNIOC EL MEJOR ALIADO PARA TRANSFORMAR COMUNIDADES';
            }

            if ($normalized !== $heading) {
                DB::table('sliders')
                    ->where('id', $slider->id)
                    ->update(['slider_heading' => $normalized]);
            }
        }
    }

    public function down()
    {
        // No revertimos textos institucionales.
    }
}
