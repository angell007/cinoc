<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendedCvs extends Model
{
    protected $fillable = [
        'date',
        'company',
        'position',
        'name',
        'id_number',
        'programa',
        'email',
        'contacto',
        'rol',
        'gender',
        'segmento'

    ];

}
