<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreparationActionMaintenance extends Model
{
    protected $table = 'fpactionmaintenance';
    public $timestamps = false;
    protected $guarded = [];

    function bonTravaux() {
        return $this->belongsTo('App\Bontravaux','bontravaux_id');
    }

    public function moyensHumains() {
        return $this->hasOne('App\MoyenHumain','fpactionmaintenance_id');
    }

    public function sollicitationExterieure() {
        return $this->hasOne('App\SollicitationExterieure');
    }

    public function gamme() {
        return $this->hasOne('App\Gamme','fpactionmaintenance_id');
    }

    public function typeOperation() {
        return $this->belongsTo('App\TypeOperation','typeoperation_id');
    }

    public function titreOperation() {
        return $this->belongsTo('App\TypeOperation','titreoperation_id');
    }

    public function statut() {
        return $this->belongsTo('App\EtatBon','statut');
    }

    public function habilitation() {
        return $this->belongsTo('App\Habilitation','habilitation_id');
    }

    public function produits() {
        return $this->belongsToMany('App\Produit','fpam_produit','fpam_id','produit_id');
    }
}