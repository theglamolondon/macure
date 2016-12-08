<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 28/11/2016
 * Time: 21:54
 */

namespace App\Http\Controllers;


trait AuthorizationChecker
{
    private function boot()
    {
        return false;
    }

    public function check()
    {
        return array_search(json_decode(session('user')->autorisation));
    }
}