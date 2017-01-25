<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'tache';
    public $timestamps = false;
    protected $guarded = [];
}
