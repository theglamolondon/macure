<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class IdentiteAcces extends Authenticatable
{
    use Notifiable;

    protected $table = "identiteacces";
    public $timestamps = false;
    protected $guarded = [];

    public function getComplement()
    {
        $r = null;
        if($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_UTILISATEUR){
            $r = $this->utilisateur;
        }elseif($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_EQUIPE_TRAVAUX){
            $r = $this->equipeTravaux;
        }
        return $r;
    }

    public function name()
    {
        $n = null;
        if($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_UTILISATEUR){
            $n = $this->utilisateur->prenoms;
        }elseif($this->typeidentite_id == TypeIdentite::TYPE_IDENTITE_EQUIPE_TRAVAUX){
            $n = $this->equipeTravaux->nom;
        }
        return $n;
    }

    public function hasRole($role)
    {
        if(array_search($role,json_decode($this->autorisation)) === false)
            return false;
        else
            return true;
    }

    public function getProfileUrl(){
        return 'profile_'.json_decode($this->autorisation)[0];
    }

    public function getHomeUrl(){
        return 'accueil_'.json_decode($this->autorisation)[0];
    }

    public function utilisateur(){
        return $this->hasOne('App\Utilisateur','identiteacces_id');
    }

    public function equipeTravaux(){
        return $this->hasOne('App\EquipeTravaux','identiteacces_id');
    }

    public function typeIdentite()
    {
        return $this->belongsTo('App\TypeIdentite','typeidentite_id');
    }
}
