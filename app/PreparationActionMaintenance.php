<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreparationActionMaintenance extends Model
{
    protected $table = 'fpactionmaintenance';
    public $timestamps = false;
    protected $guarded = [];

    function bonTravaux()
    {
        return $this->belongsTo('App\Bontravaux','bontravaux_id');
    }

    public function moyensHumains()
    {
        return $this->hasOne('App\MoyenHumain');
    }

    public function sollicitationExterieure()
    {
        return $this->hasOne('App\SollicitationExterieure');
    }

    public function gamme()
    {
        return $this->belongsTo('App\Gamme');
    }

    public function typeOperation()
    {
        return $this->belongsTo('App\TypeOperation','typeoperation_id');
    }

    public function titreOperation()
    {
        return $this->belongsTo('App\TypeOperation','titreoperation_id');
    }
}