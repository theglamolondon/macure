<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\GammeCheck;
use App\Http\HelperFunctions;
use App\PreparationActionMaintenance;
use App\TypeGamme;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
{
    use UserProfile, AuthorizationChecker, HelperFunctions;

    public function __construct()
    {
        $this->middleware(['auth','policy']);
    }

    public function Index()
    {
        return view('equipe.home');
    }

    public function showNewFormCheckGamme($fpam)
    {
        try {
            $fpam = PreparationActionMaintenance::with(['gamme'])->where('numerofpam', $fpam)->firstOrFail();
            $idTypeGamme = $fpam->gamme->typegamme_id;

            $checklists = Checklist::where('typegamme_id',$idTypeGamme)->get();
            return view('equipe.checkgamme',[
                "checklists" => $checklists,
                "typegamme" => TypeGamme::find($idTypeGamme),
                "IDgamme" => $fpam->gamme->id
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors(["exception" => $e->getMessage()]);
        }catch (\Exception $e) {
            return back()->withErrors(["exception" => $e->getMessage()]);
        }
    }

    public function sendResponseCheckList(Request $request)
    {
        $this->validate($request, [
            'realisation' => 'array',
            'resultat' => 'array',
            'observation' => 'array',
            'gamme_id' => 'required|numeric',
            'checklist_id' => 'array',
        ],[
            'gamme_id.required' => 'Gamme non identifiée',
            'gamme_id.numeric' => 'Gamme non identifiée',
            'checklist_id.required' => 'Checklist non identifiée',
            'checklist_id.numeric' => 'Checklist non identifiée',
        ]);

        //echo($request->input('ckecklist_id')[1]);

        try {
            for($i=0;$i <= count($request->input('observation'))-1;$i++){
                GammeCheck::create([
                    "gamme_id" => $request->input('gamme_id'),
                    "realisation" => $request->input('realisation')[$i],
                    "resultat" => $request->input('resultat')[$i],
                    "observation" => $request->input('observation')[$i],
                    "checklist_id" => $request->input('checklist_id')[$i],
                ]);
            }

            $this->withSuccess(["ok" => "La check-list a été validée"]);

            return redirect()->route('edit_gamme',["fpam" => ""]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function showNewFormGamme($fpam)
    {
        return view("equipe.gamme");
    }
}
