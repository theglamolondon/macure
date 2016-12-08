<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoordonneeGPS extends Model
{
    protected $table = "coordonnee_gps";
    public $timestamps = false;
    protected $guarded = [];

    public function preparationaction()
    {
        return $this->belongsTo('App\PreparationActionMaintenance','preparation_action_maintenance_id');
    }
}
