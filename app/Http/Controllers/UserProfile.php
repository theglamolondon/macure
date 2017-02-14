<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 29/11/2016
 * Time: 08:09
 */

namespace App\Http\Controllers;


use App\IdentiteAcces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait UserProfile
{
    public function editProfil()
    {
        return view('auth.profile',[
            'me' => IdentiteAcces::where('id',Auth::user()->id)->with('equipeTravaux','utilisateur')->get()->toJson()
        ]);
    }
}