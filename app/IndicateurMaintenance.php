<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicateurMaintenance extends Model
{
    protected $table = "indicateur_maintenance";
    public $timestamps = false;

    public function rapportTechnique()
    {
        return $this->belongsTo('App\RapportTechniqueMaintenanceCurrative');
    }
}
