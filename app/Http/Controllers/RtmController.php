<?php

namespace App\Http\Controllers;

use App\EquipeTravaux;
use App\Http\HelperFunctions;
use App\Intervenant;
use App\MembreEquipe;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RtmController extends Controller
{
    use UserProfile, AuthorizationChecker;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function Index()
    {
        return view('rtm.home');
    }

    public function showDetailsEquipe( $id){
        return view();
    }

    public function showUpdateFormEquipe(Request $request, $id)
    {
        try{
            return view('rtm.editequipe',[
                "equipe" => EquipeTravaux::with('chefEquipe','chargeMaintenance')->findOrFail($id),
                "intervenants" => Intervenant::all(),
                "membres" => MembreEquipe::whereNull('fpam')->where('equipetravaux_id',$id)->get()
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function sendResponseUpdateFormEquipe(Request $request, $id)
    {
        $this->validate($request,[
            "intervenants" => "required|array"
        ],[
            "intervenants.required" => "La liste des intervants de cette équipe est requise",
            "intervenants.array" => "La liste des intervants de cette équipe est requise",
        ]);

        $membres = Intervenant::whereIn('id',$request->input('intervenants'))->get();
        foreach ($membres as $membre){
            $membre->update(["equipetravaux_id" => $id]);
        }

        /*
        //recherche des membres actuels
        $membresActuels = MembreEquipe::whereNull('fpam')->where('equipetravaux_id',$id)->get()->toArray();

        var_dump($membresActuels);
        var_dump($request->input('intervenants'));
        var_dump(array_column($membresActuels,'intervenant_id'));

        $diff = array_diff($request->input('intervenants'),array_column($membresActuels,'intervenant_id'));
        foreach ($diff as $IDintervenant){
            $m = MembreEquipe::where("intervenant_id",$IDintervenant)->whereNull("fpam")->first();
            if($m == null){
                MembreEquipe::create([
                    "dateparticipation" => Carbon::now()->toDateString(),
                    "intervenant_id" => $IDintervenant,
                    "equipetravaux_id" => $id
                ]);
            }else{
                $m->equipetravaux_id = $id;
                $m->dateparticipation = Carbon::now()->toDateString();
                $m->save();
            }
        }
        //dd();
        */
        $this->withSuccess('la liste des membre de l\'équipe a été mise à jour avec succès !');
        return redirect()->route('liste_equipe');
    }

    public function showListEquipe()
    {
        return view('rtm.listequipe',[
            "equipes" => EquipeTravaux::with('chefEquipe','chargeMaintenance')->get()
        ]);
    }
}