<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 30/11/2016
 * Time: 21:05
 */

namespace App\Http\Controllers\Map;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapsApiController extends Controller
{
    //key=API_KEY
    private $google_api_key = "AIzaSyA7nl4IYZVJCWievWF7yv8xu8-WFind8CM";

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index(Request $request)
    {
        return view("rbom.map");
    }

    public function showItinerairePoinToPoint()
    {
        return view('rbom.pointopoint');
    }
}