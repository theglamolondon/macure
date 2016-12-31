<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    protected $guarded = ['id'];
    protected $table = 'emprunt';
    public $timestamps = false;

    public function intervenant() {
        return $this->belongsTo('App\Intervenant');
    }

    public function equipe() {
        return $this->belongsTo('App\Equipe','equipe_id');
    }

    public function fpam() {
        return $this->belongsTo('App\PreparationActionMaintenance','');
    }
}
