<?php

namespace App\Http\Controllers;

use App\EquipeTravaux;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RtmController extends Controller
{
    use UserProfile, AuthorizationChecker;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function Index():View
    {
        return view('rtm.home');
    }

    public function showDetailsEquipe(int $id):View{
        return view();
    }

    public function showUpdateFormEquipe(Request $request, int $id)
    {
        try{
            return view('rtm.editequipe',[
                "equipe" => EquipeTravaux::with('chefEquipe','chargeMaintenance')->findOrFail($id),
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function sendResponseUpdateFormEquipe(Request $request, int $id): View
    {
        dd($request);
        return view();
    }

    public function showListEquipe():View
    {
        return view('rtm.listequipe',[
            "equipes" => EquipeTravaux::with('chefEquipe','chargeMaintenance')->get()
        ]);
    }
}