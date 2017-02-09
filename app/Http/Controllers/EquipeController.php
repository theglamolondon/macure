<?php

namespace App\Http\Controllers;

use App\{Checklist, EquipeTravaux, GammeCheck, Planning, PreparationActionMaintenance, TypeGamme };
use App\Http\HelperFunctions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipeController extends Controller
{
    use UserProfile, AuthorizationChecker, HelperFunctions;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function Index()
    {
        return $this->showPlanning();
        //return view('equipe.home');
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

    public function showPlanning($jour=null,$mois=null,$annee=null)
    {
        $d = Carbon::now();
        $lundi = null;  $mardi = null;  $mercredi = null;  $jeudi = null;
        $vendredi = null;  $samedi = null;  $dimanche = null;

        if($jour == null){
            $lundi = Carbon::now()->addDay(-($d->dayOfWeek-1));
            $mardi = Carbon::now()->addDay(-($d->dayOfWeek-1) + Carbon::TUESDAY -1);
            $mercredi = Carbon::now()->addDay(-($d->dayOfWeek-1) + Carbon::WEDNESDAY-1);
            $jeudi = Carbon::now()->addDay(-($d->dayOfWeek-1) + Carbon::THURSDAY-1);
            $vendredi = Carbon::now()->addDay(-($d->dayOfWeek-1) + Carbon::FRIDAY-1);
            $samedi = Carbon::now()->addDay(-($d->dayOfWeek-1) + Carbon::SATURDAY-1);
            $dimanche = Carbon::now()->addDay(-($d->dayOfWeek-1) + Carbon::SUNDAY-1);
        }else{
            $d = Carbon::createFromDate($annee,$mois,$jour);
            $lundi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1));
            $mardi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::TUESDAY -1));
            $mercredi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::WEDNESDAY-1));
            $jeudi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::THURSDAY-1));
            $vendredi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::FRIDAY-1));
            $samedi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::SATURDAY-1));
            $dimanche = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::SUNDAY-1));
        }

        $planning = Planning::with(['equipe','actionmaintenance'])
                    ->where('equipe_id',Auth::user()->equipeTravaux->id ?? 0)
                    ->whereBetween('datedepannage',[$dimanche->toDateString(),$samedi->toDateString()])->get();
        $equipes = EquipeTravaux::with(["chargeMaintenance","chefEquipe"])->orderBy('chargemaintenance','asc')->get();

        return view('equipe.planning',[
            "planning" => $planning,
            "lundi" => $lundi,
            "mardi" => $mardi,
            "mercredi" => $mercredi,
            "jeudi" => $jeudi,
            "vendredi" => $vendredi,
            "samedi" => $samedi,
            "dimanche" => $dimanche,
            "equipes" => $equipes,
            "date" => $d->format('d/m/Y'),
        ]);
    }
}
