<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembreEquipe extends Model
{
    protected $table = "membreequipe";
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = ['fpam','equipetravaux_id','intervenant_id'];

    public function intervenant()
    {
        return $this->belongsTo('App\Intervenant','intervenant_id');
    }

    public function equipeTravaux()
    {
        return $this->belongsTo('App\EquipeTravaux','equipetravaux_id');
    }
}