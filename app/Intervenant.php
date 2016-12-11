<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    protected $table = "intervenant";
    public $timestamps = false;

    public function equipe()
    {
        return $this->belongsTo('App\EquipeTravaux');
    }
}