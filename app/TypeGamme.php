<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeGamme extends Model
{
    protected $table = "typegamme";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function gamme()
    {
        return $this->hasMany('App\Gamme');
    }
}
