<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GammeCheck extends Model
{
    protected $table ='gammecheck';
    public $timestamps = false;

    public function checkList()
    {
        return $this->belongsTo('App\CheckList');
    }

    public function gamme()
    {
        return $this->belongsTo('App\Gamme');
    }
}
