<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreparationActionMaintenance extends Model
{
    protected $table = 'preparation_action_maintenance';
    public $timestamps = false;
    protected $guarded = [];

    function bontravaux()
    {
        return $this->belongsTo('App\Bontravaux');
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
}