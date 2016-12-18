<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table ='checklist';
    public $timestamps = false;
    public $guarded = ['id'];

    public function typegamme()
    {
        return $this->belongsTo('App\TypeGamme');
    }
}
