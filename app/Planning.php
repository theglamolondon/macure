<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = "planning";

    public function equipe()
    {
        return $this->belongsTo("App\EquipeTravaux","equipe_id");
    }

    public function actionmaintenance()
    {
        return $this->belongsTo("App\PreparationActionMaintenance","actionmaintenance_id");
    }
}
