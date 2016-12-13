<?php

namespace App\Http\Controllers;

use App\EquipeTravaux;
use App\Http\HelperFunctions;
use App\IdentiteAcces;
use App\Intervenant;
use App\TypeIdentite;
use App\Utilisateur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use UserProfile, AuthorizationChecker, HelperFunctions;

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function valideRequest(Request $request)
    {
        $this->validate($request,[
            "login" => "required|unique:identiteacces",
            "password" => "required|confirmed",
            "typeidentite_id" => "required|numeric",
            "autorisation" => "required|array",
            "nom" => "required",
            "chargemaintenance" => "required_if:typeidentite_id,2",
            "chefequipe" => "required_if:typeidentite_id,2",
            "prenoms" => "required_if:typeidentite_id,1",
        ],[
            "login.unique" => "Ce nom d'utilisateur est déjà utilisé.",
            "password.confirmed" => "Les deux mots de passe ne concordent pas.",
            "nom.required" => "Le nom est requis pour la création.",
            "prenoms.required_if" => "Un prénom est au moins requis pour la création de l'utilisateur"
        ]);
    }

    public function Index()
    {
        return view('admin.home');
    }

    public function showNewFormUser()
    {
        $types = TypeIdentite::all();

        return view('admin.edituser',[
            "types" => $types,
            "intervenants" => Intervenant::orderBy('nom','asc')->orderBy('prenoms','asc')->get(),
        ]);
    }

    public function sendResponseFormUser(Request $request)
    {
        $this->valideRequest($request);

        try{
            //Identité d'accès
            $identite = new IdentiteAcces($request->only(['login','typeidentite_id']));
            $identite->password = bcrypt($request->input('password')); //Hash du mot de passe
            $identite->autorisation = json_encode($request->input('autorisation'));
            $identite->saveOrFail();

            //Switch
            if(intval($request->input('typeidentite_id')) === TypeIdentite::TYPE_IDENTITE_UTILISATEUR){
                $utilisateur = new Utilisateur($request->only(['nom','prenoms','telephone','email']));
                $utilisateur->identite()->associate($identite);
                $utilisateur->saveOrFail();
            }elseif (intval($request->input('typeidentite_id')) === TypeIdentite::TYPE_IDENTITE_UTILISATEUR){
                $equipe = new EquipeTravaux($request->only([]));
                $equipe->identite()->associate($identite);
                $equipe->saveOrFail();
            }else{
                return back()->withInput()->withErrors(['execption'=>'Le ttype d\'identité d\'accès est inconnu']);
            }

            $this->withSuccess(['L\'utilisateur a été créé avec succès']);
            return back();

        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors(['execption'=>$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withInput()->withErrors(['execption'=>$e->getMessage()]);
        }
    }

    public function showUpdateFormUser($id)
    {
        $types = TypeIdentite::all();
        try{
            $identite = IdentiteAcces::with(['utilisateur','equipeTravaux'])->findOrFail(intval($id));
            //dd($identite);
            return view('admin.updateuser',[
                "types" => $types,
                "identite" => $identite,
                "intervenants" => Intervenant::orderBy('nom','asc')->orderBy('prenoms','asc')->get(),
            ]);
        }catch (ModelNotFoundException $e) {
            back()->withErrors(['L\'utilisateur demandé est introuvable']);
        }
    }

    public function sendResponseUpdateUser(Request $request)
    {
        $this->valideRequest($request);

    }

    public function showListUsers()
    {

    }
}