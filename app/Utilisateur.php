<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = "utilisateur";
    public $timestamps = false;
    protected $primaryKey = 'identite_acces_id';

    public function identite()
    {
        return $this->belongsTo('App\IdentiteAcces');
    }
}