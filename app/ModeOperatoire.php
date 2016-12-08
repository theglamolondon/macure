<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeOperatoire extends Model
{
    protected $table = "mode_operatoire";
    public $timestamps = false;

    public function typeGamme()
    {
        return $this->belongsTo('App\TypeGamme');
    }
}
