<?php

namespace App\Http\Controllers;

use App\Http\HelperFunctions;
use App\PolicyChecker;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use UserProfile, AuthorizationChecker, HelperFunctions;

    public function index()
    {
        PolicyChecker::checkPolicy();
    }

    public function showNewFormProduit()
    {
        return view('rgs.nouveauproduit');
    }

    public function sensResponseNewProduit(Request $request)
    {

    }
}
