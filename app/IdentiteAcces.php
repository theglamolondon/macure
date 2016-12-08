<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class IdentiteAcces extends Authenticatable
{
    use Notifiable;

    protected $table = "identiteacces";
    public $timestamps = false;
    protected $guarded = [];

    public function typeIdentite()
    {
        return $this->belongsTo('App\TypeIdentite');
    }

    public function getComplement()
    {
        if($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_UTILISATEUR)
        {
            return $this::with('utilisateur')->first();
        }
        elseif($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_EQUIPE_TRAVAUX)
        {
            return $this::with('equipeTravaux')->first();
        }
    }

    public function name()
    {
        if($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_UTILISATEUR)
        {
            return $this->utilisateur->prenoms;
        }
        elseif($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_EQUIPE_TRAVAUX)
        {
            return $this->equipeTravaux->nom;
        }
    }

    public function hasRole($role)
    {
        return array_search($role,json_decode($this->autorisation));
    }

    public function getProfileUrl()
    {
        return 'profile_'.json_decode($this->autorisation)[0];
    }

    public function getHomeUrl()
    {
        return 'accueil_'.json_decode($this->autorisation)[0];
    }

    public function utilisateur()
    {
        return $this->hasOne('App\Utilisateur','identiteacces_id');
    }

    public function equipeTravaux()
    {
        return $this->hasOne('App\EquipeTravaux');
    }
}
