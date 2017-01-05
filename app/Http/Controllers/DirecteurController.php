<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
