<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentJoint extends Model
{
    protected $table = "document_joint";
    public $timestamps = false;

    public function preparationaction()
    {
        return $this->belongsTo('App\PreparationActionMaintenance');
    }
}
