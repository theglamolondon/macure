<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    protected $table = "ouvrage";
    public $timestamps = false;

    public function gamme()
    {
        return $this->belongsTo('App\Gamme');
    }
}
