<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoyenHumain extends Model
{
    protected $table = "moyenhumain";
    public $timestamps = false;
    protected $guarded = [];

    public function preparationActionMaintenance()
    {
        return $this->belongsTo('App\PreparationActionMaintenance');
    }
}
