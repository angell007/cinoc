<?php

namespace App;

use App;
use App\Admin;
use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{

    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    

    public function admins()
    {
      return $this->belongsToMany(Admin::class);
    }

}
