<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoyenLogistique extends Model
{
    protected $table = "moyen_logistique";
    public $timestamps = false;

    public function gamme()
    {
        return $this->belongsTo('App\Gamme');
    }
}