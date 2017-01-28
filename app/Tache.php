<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'tache';
    public $timestamps = false;
    protected $guarded = [];

    public function ouvrages() {
        return $this->belongsToMany('App\Ouvrage','tacheouvrage','ouvrage_id','tache_id');
    }
}
