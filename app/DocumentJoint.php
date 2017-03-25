<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentJoint extends Model
{
    protected $table = "documentjoint";
    public $timestamps = false;

    public function preparationaction()
    {
        return $this->belongsTo('App\PreparationActionMaintenance');
    }
}