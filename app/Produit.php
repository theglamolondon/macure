<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $guarded = [];
    protected $table = 'produit';
    public $timestamps = false;

    public function famille(){
        return $this->belongsTo('App\Famille','famille_id');
    }
}
