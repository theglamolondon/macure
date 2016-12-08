<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtatBon extends Model
{
    const Bon_enregistre = 1;
    const Etude_faite = 2;
    const Travaux_encours = 3;
    const Travaux_termines = 4;

    protected $table = "etatbon";
    public $timestamps = false;
}
