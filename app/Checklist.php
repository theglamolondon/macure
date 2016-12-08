<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table ='checklist';
    public $timestamps = false;

    public function typegamme()
    {
        return $this->belongsTo('App\TypeGamme');
    }
}
