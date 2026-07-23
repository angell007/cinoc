<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileEducationNonFormal extends Model
{
    protected $table = 'education_non_formals';

    protected $fillable = ['training_type', 'institution', 'certification_status', 'program_name', 'country_id', 'state_id', 'city_id', 'duration', 'date'];

    // Relación con el país
    public function country()
    {
        return $this->belongsTo(\App\ountry::class);
    }

    // Relación con el estado/departamento
    public function state()
    {
        return $this->belongsTo(\App\State::class);
    }

    // Relación con la ciudad
    public function city()
    {
        return $this->belongsTo(\App\City::class);
    }
}
