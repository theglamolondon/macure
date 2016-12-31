<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    protected $table = "intervenant";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function equipe()
    {
        return $this->belongsTo('App\EquipeTravaux','equipetravaux_id');
    }

    public function habilitation()
    {
        return $this->belongsToMany('App\Habilitation','intervenant_habilitation','intervenant_id','habilitation_id');
    }
}