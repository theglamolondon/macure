<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonTravaux extends Model
{
    protected $table = 'bon_travaux';
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'abonneabsent' => 'boolean',
        'abonnetrouve' => 'boolean',
        'abonnepanne' => 'boolean'
    ];

    function etatbon(){
        return $this->belongsTo('App\EtatBon','etat_bon_id');
    }

    function urgence(){
        return $this->belongsTo('App\Urgence');
    }
    function equipe(){
        return $this->belongsTo('App\EquipeTravaux');
    }

    function preparationactiontravaux(){
        return $this->hasOne('App\PreparationActionMaintenance');
    }

    function createur(){
        return $this->belongsTo('App\IdentiteAcces');
    }

    function modificateur(){
        return $this->belongsTo('App\IdentiteAcces');
    }
}