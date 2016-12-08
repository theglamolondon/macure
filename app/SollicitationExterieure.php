<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SollicitationExterieure extends Model
{
    protected $table = "sollicitation_exterieure";
    public $timestamps = false;
    protected $guarded = [];

    public function preparationActionMaintenance()
    {
        return $this->belongsTo('App\PreparationActionMaintenance','preparation_action_maintenance_id') ;
    }
}
