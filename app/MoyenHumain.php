<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoyenHumain extends Model
{
    protected $table = "moyen_humain";
    public $timestamps = false;
    protected $guarded = [];

    public function preparationActionMaintenance()
    {
        return $this->belongsTo('App\PreparationActionMaintenance');
    }
}
