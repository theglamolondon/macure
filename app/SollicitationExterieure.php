<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SollicitationExterieure extends Model
{
    protected $table = "sollicitationexterieure";
    public $timestamps = false;
    protected $guarded = [];

    public function preparationActionMaintenance()
    {
        return $this->belongsTo('App\PreparationActionMaintenance','fpactionmaintenance_id') ;
    }
}
