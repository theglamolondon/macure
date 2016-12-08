<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicateurMaintenance extends Model
{
    protected $table = "indicateurmaintenance";
    public $timestamps = false;

    public function rapportTechnique()
    {
        return $this->belongsTo('App\RapportTechniqueMaintenanceCurrative');
    }
}
