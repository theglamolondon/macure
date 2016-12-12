<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipeTravaux extends Model
{
    protected $table = "equipetravaux";
    public $timestamps = false;

    public function identite()
    {
        return $this->belongsTo('App\IdentiteAcces');
    }

    public function chefEquipe()
    {
        return $this->belongsTo('App\Intervenant',"chefequipe");
    }

    public function chargeMaintenance()
    {
        return $this->belongsTo('App\Intervenant',"chargemaintenance");
    }

    public function intervenants()
    {
        return $this->hasMany('App\Intervenant');
    }

    public function bonRealisations()
    {
        return $this->hasMany('App\BonRealisationTravail');
    }

    public function rapportTechniques()
    {
        return $this->hasMany('App\RapportTechniqueMaintenanceCurrative');
    }
}