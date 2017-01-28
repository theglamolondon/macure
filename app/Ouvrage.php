<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    protected $table = 'ouvrage';
    public $timestamps = false;
    protected $guarded = [];

    public function direction()
    {
        return $this->belongsTo('App\Direction','direction_id');
    }

    public function typeOuvrage(){
        return $this->belongsTo('App\TypeOuvrage','typeouvrage_id');
    }

    public function taches(){
        return $this->belongsToMany('App\Tache','tacheouvrage','ouvrage_id','tache_id');
    }
}
