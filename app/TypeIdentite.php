<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeIdentite extends Model
{
    const TYPE_IDENTITE_UTILISATEUR = 1;
    const TYPE_IDENTITE_EQUIPE_TRAVAUX = 2;

    protected $table = "typeidentite";
    public $timestamps = false;
}
