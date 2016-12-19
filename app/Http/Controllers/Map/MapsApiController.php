<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 30/11/2016
 * Time: 21:05
 */

namespace App\Http\Controllers\Map;


use App\BonTravaux;
use App\Http\Controllers\Controller;
use App\PreparationActionMaintenance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MapsApiController extends Controller
{
    //key=API_KEY
    private $google_api_key = "AIzaSyA7nl4IYZVJCWievWF7yv8xu8-WFind8CM";
    const DJERA_POSITION_LATTITUDE = 5.3729066;
    const DJERA_POSITION_LONGITUDE = -3.9858144;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index(Request $request)
    {
        $fpamCoord = PreparationActionMaintenance::select(['longitude','lattitude','id','numerofpam'])->get();
        return view("rbom.map",['fpamCoord' => $fpamCoord]);
    }

    public function showItinerairePoinToPoint($bt, $fpam = null)
    {
        $FpreparationAM = null;
        try{
            if($fpam != null)
            {
                $FpreparationAM = PreparationActionMaintenance::where('numerofpam','=',$fpam)->firstOrFail();
            }else{
                $bt = BonTravaux::with('preparationactiontravaux')->where('numerobon','=',$bt)->firstOrFail();
                if($bt->preparationactiontravaux == null)
                {
                    throw new ModelNotFoundException('La fiche FPAM n\'a pas encore été éditée');
                }
                $FpreparationAM = $bt->preparationactiontravaux;
            }

            return view('rbom.pointopoint',["fpam" => $FpreparationAM]);

        }catch (ModelNotFoundException $e)
        {
            return back()->withErrors(['fpam' => "La fiche FPAM n'a pas encore été éditée ! Veuillez en créer une SVP"]);
        }catch (\Exception $e)
        {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }
}