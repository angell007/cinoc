<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use App\User;

class documento_contratado extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documento_contratados';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_empresa', 'id_candidato', 'fecha', 'notas'];
    
    public function company(){
      return $this->hasOne(Company::class, 'id', 'id_empresa');
    }
    
    public function candidate(){
      return $this->hasOne(User::class, 'id', 'id_candidato');
    }

    
}
