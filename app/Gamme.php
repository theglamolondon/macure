<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamme extends Model
{
    protected $table = "gamme";
    public $timestamps = false;

    public function typegamme()
    {
        return $this->belongsTo('App\TypeGamme','typegamme_id');
    }

    public function ouvrage()
    {
        return $this->hasOne('App\Ouvrage');
    }

    public function moyenLogistique()
    {
        return $this->hasOne('App\MoyenLogistique');
    }

    public function preparationActionMaintenance()
    {
        return $this->belongsTo('App\PreparationActionMaintenance','fpactionmaintenance_id');
    }
}
