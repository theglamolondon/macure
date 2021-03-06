<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonTravaux extends Model
{
    protected $table = 'bontravaux';
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'abonneabsent' => 'boolean',
        'abonnetrouve' => 'boolean',
        'abonnepanne' => 'boolean'
    ];

    function etatbon(){
        return $this->belongsTo('App\EtatBon');
    }

    function urgence(){
        return $this->belongsTo('App\Urgence');
    }
    function equipe(){
        return $this->belongsTo('App\EquipeTravaux','equipetravaux_id');
    }

    function preparationactiontravaux(){
        return $this->hasOne('App\PreparationActionMaintenance','bontravaux_id');
    }

    function bonVoisins(){
        return $this->hasMany('App\Bontravaux','bonvoisin','id');
    }
    function bonVoisin(){
        return $this->belongsTo('App\Bontravaux','bonvoisin');
    }
}