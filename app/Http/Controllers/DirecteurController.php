<?php

namespace App\Http\Controllers;

use App\BonTravaux;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirecteurController extends Controller
{
    use UserProfile, AuthorizationChecker;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function Index()
    {
        return view('directeur.home');
    }

    public function statistiques()
    {
        $bt = DB::table('bontravaux')->select(DB::raw('count(id) AS total, month(dateexecution) AS mois'))
        ->groupBy('mois')
        ->get();

        dd($bt);

        return view('directeur.statistiques');
    }
}
