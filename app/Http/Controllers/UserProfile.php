<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 29/11/2016
 * Time: 08:09
 */

namespace App\Http\Controllers;


trait UserProfile
{
    public function editProfil()
    {
        return view('auth.profile');
    }
}