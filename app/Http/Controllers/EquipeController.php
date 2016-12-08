<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipeController extends Controller
{
    use UserProfile, AuthorizationChecker;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        return view('admin.home');
    }
}
