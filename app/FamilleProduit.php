<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilleProduit extends Model
{
    protected $guarded = ['id'];
    protected $table = 'familleproduit';
    public $timestamps = false;
}
