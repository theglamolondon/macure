<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\PreparationActionMaintenance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    use UserProfile, AuthorizationChecker;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        return view('admin.home');
    }

    public function showNewFormGamme($fpam)
    {
        try {
            $fpam = PreparationActionMaintenance::with(['gamme'])->where('numerofpam', $fpam)->firstOrFail();
            $idTypeGamme = $fpam->gamme->typegamme_id;

            $checklists = Checklist::where('typegamme_id',$idTypeGamme)->get();
            return view('equipe.gamme',[
                "checklist" => $checklists
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors(["exception" => $e->getMessage()]);
        }catch (\Exception $e) {
            return back()->withErrors(["exception" => $e->getMessage()]);
        }
    }
}
