<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOuvrage extends Model
{
    protected $table = 'typeouvrage';
    public $timestamps = false;
    protected $guarded = [];
}
