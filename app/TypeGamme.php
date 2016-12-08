<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeGamme extends Model
{
    protected $table = "type_gamme";
    public $timestamps = false;

    public function gamme()
    {
        return $this->hasMany('App\Gamme');
    }
}
