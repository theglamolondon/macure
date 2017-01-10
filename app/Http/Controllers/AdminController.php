<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\EquipeTravaux;
use App\Http\HelperFunctions;
use App\IdentiteAcces;
use App\Intervenant;
use App\TypeGamme;
use App\TypeIdentite;
use App\Utilisateur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class AdminController extends Controller
{
    use UserProfile, AuthorizationChecker, HelperFunctions;

    public function __construct()
    {
        //$this->middleware('auth');
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
        return view('admin.home',['utilisateurs' => IdentiteAcces::with('equipeTravaux','utilisateur')->get()]);
    }

    public function showNewFormUser()
    {
        $types = TypeIdentite::all();

        return view('admin.utilisateurs.edit',[
            "types" => $types,
            "intervenants" => Intervenant::orderBy('nom','asc')->orderBy('prenoms','asc')->get(),
        ]);
    }

    public function sendResponseFormUser(Request $request)
    {
        //dd($request);
        $this->valideRequest($request);

        try{
            //Identité d'accès
            $identite = new IdentiteAcces($request->only(['login','typeidentite_id']));
            $identite->password = bcrypt($request->input('password')); //Hash du mot de passe
            $identite->autorisation = json_encode($request->input('autorisation'));
            //Policy
            $d = null;
            foreach ($request->input('jours') as $j) {
                if($d){$d .= ',';}
                $d .= $j;
            }
            $d = '-d '.$d;
            $h = '-t '.str_replace('-',' ',$request->input('horaires'));
            $identite->policy = $d.' | '.$h;

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
            return view('admin.utilisateurs.update',[
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
        $this->validate($request,[
            "login" => "required|exists:identiteacces,login",
            "password" => "confirmed",
            "typeidentite_id" => "required|numeric",
            "autorisation" => "required|array",
            "nom" => "required",
            "chargemaintenance" => "required_if:typeidentite_id,2|numeric",
            "chefequipe" => "required_if:typeidentite_id,2|numeric",
            "prenoms" => "required_if:typeidentite_id,1",
        ],[
            "login.exists" => "Le login est introuvable. Vérifirier que votre dans l'application.",
            "password.confirmed" => "Les deux mots de passe ne concordent pas.",
            "nom.required" => "Le nom est requis pour la création.",
            "prenoms.required_if" => "Un prénom est au moins requis pour la création de l'utilisateur"
        ]);

        try {
            $identite = IdentiteAcces::with('utilisateur','equipeTravaux')->where('login', $request->input('login'))->firstOrFail();
            $updater = [];
            if(!empty($request->input('password'))) {
                $updater['password'] = bcrypt($request->input('password'));
            }
            $updater['autorisation'] = json_encode($request->input('autorisation'));
            //Policy
            $d = null;
            foreach ($request->input('jours') as $j) {
                if($d){$d .= ',';}
                $d .= $j;
            }
            $d = '-d '.$d;
            $h = '-t '.str_replace('-',' ',$request->input('horaires'));
            $updater['policy'] = $d.' | '.$h;

            $identite->update($updater);


            $updater = [];
            if($identite->utilisateur){
                $updater['nom'] = $request->input('nom');
                $updater['prenoms'] = $request->input('prenoms');
                $updater['telephone'] = $request->input('telephone');
                $updater['email'] = $request->input('email');
                $identite->utilisateur->update($updater);
            }

            $updater2 = [];
            if($identite->equipeTravaux){
                $updater['nom'] = $request->input('nom');
                $updater['chargemaintenance'] = $request->input('chargemaintenance');
                $updater['chefequipe'] = $request->input('chefequipe');
                $identite->equipeTravaux->update($updater);
            }

            $this->withSuccess(['L\'utilisateur a été modifié avec succès']);
            return redirect()->route('liste_users');

        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function showListUsers()
    {
        $identites = IdentiteAcces::with(['utilisateur','equipeTravaux','typeIdentite'])->get();
        return view('admin.utilisateurs.liste',[
            'identites' => $identites,
        ]);
    }

    public function showNewFormIntervenant()
    {
        return view('admin.intervenants.edit',[
            'equipes' => EquipeTravaux::all(),
        ]);
    }

    private function validateItervenant(Request $request){
        $this->validate($request,[
            "nom" => "required|string",
            "prenoms" => "required|string",
            "niveau" => "nullable",
            "equipetravaux_id" => "required|numeric"
        ],[
            "nom.required" => 'Le nom de l\'intervenant est requis pour l\'enregistrement',
            "prenoms.required" => 'Un prénom est requis pour l\'enregistrement',
        ]);
    }
    public function sendResponseNewIntervenant(Request $request)
    {
        $this->validateItervenant($request);

        try{
            Intervenant::create([$request->except(['_token'])]);
            $this->withSuccess(['Nouveau intervenant ajouté avec succès !']);
            return redirect()->route('liste_intervenants');
        }catch (ModelNotFoundException $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function showUpdateIntervenantForm($id){
        $id = intval($id);
        try {
            $intervenant = Intervenant::findOrFail($id);
            return view('admin.intervenants.update',[
                "intervenant" => $intervenant,
                'equipes' => EquipeTravaux::all(),
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function sendResponseUpdateIntervenant(Request $request, $id){
        $this->validateItervenant($request);
        try {
            $intervenant = Intervenant::findOrFail($id);
            $intervenant->update($request->except('_token'));
            $this->withSuccess(['Modification réussie']);
            return redirect()->route('liste_intervenants');
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function showListIntervenants()
    {
        $intervenants = Intervenant::with('equipe')->get();
        return view('admin.intervenants.liste',[
            'intervenants' => $intervenants,
        ]);
    }

    public function showFormRestriction($id = null){
        return view('admin.utilisateurs.restriction',['id' => $id]);
    }

    public function sendResponseRestriction($id = null){

    }

    private function validateTypeGamme(Request $request){
        $this->validate($request,[
            'reference' => 'required',
            'libelle' => 'required',
            'indice' => 'required|numeric',
            'niveau' => 'required|numeric',
            'temps' => 'required|numeric',
            'habilitation' => 'required',
        ]);
    }

    public function showNewTypeGammeForm()
    {
        return view('admin.typegamme.edit');
    }

    public function sendResponseNewTypeGamme(Request $request)
    {
        $this->validateTypeGamme($request);
        try {
            TypeGamme::create($request->except('_token'));
            $this->withSuccess(['Nouveau type de gamme ajoutée avec succès']);
            return redirect()->route('liste_typegamme');
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }catch (\Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function showUpdateTypeGamme($id)
    {
        try{
            $typeGamme = TypeGamme::findOrFail($id);
            return view('admin.typegamme.update',['typegamme' => $typeGamme]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage());
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function sendResponseUpdateTypeGamme(Request $request,$id)
    {
        $this->validateTypeGamme($request);
        try{
            $typeGamme = TypeGamme::findOrFail($id);
            $typeGamme->update($request->except('_token'));
            $this->withSuccess(['Modification réussie']);
            return redirect()->route('liste_typegamme');
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }catch (\Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function showListTypeGamme()
    {
        return view('admin.typegamme.liste',['typegammes' => TypeGamme::all()]);
    }

    public function showNewChecklist()
    {
        return view('admin.checklist.edit',['typegammes' => TypeGamme::all()]);
    }

    private function validateChecklist(Request $request){
        $this->validate($request,[
            'libelle' => 'required',
            'typegamme_id' => 'required|numeric'
        ],[
            'libelle.required' => 'Le libelle de l\'élement de la check-list ne peut être vide',
            'typegamme_id.numeric' => 'La gamme sélectionnée n\'est pas disponible',
            'typegamme_id.required' => 'La gamme sélectionnée est requise',
        ]);
    }

    public function sendResponseNewChecklist(Request $request)
    {
        $this->validateChecklist($request);
        try{
            Checklist::create($request->except('_token'));
            $this->withSuccess(['Nouvel élément de check-list ajouté']);

            return redirect()->route('liste_checklist');
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }catch (\Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function showUpdateChecklist($id)
    {
        try {
            return view('admin.checklist.update', [
                'check' => Checklist::findOrFail(intval($id)),
                'typegammes' => TypeGamme::all()
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }catch (\Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function sendResponseUpdateChecklist(Request $request, $id)
    {
        $this->validateChecklist($request);
        try {
            $check = Checklist::findOrFail(intval($id));
            $check->update($request->except('_token'));

            $this->withSuccess(['Modification de la chekclist réussie']);
            return redirect()->route('liste_checklist');
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }catch (\Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function showListeChecklist()
    {
        return view('admin.checklist.liste',[
            'checklists' => Checklist::all(),
            "typegammes" => TypeGamme::orderBy("libelle","asc")->get(),
        ]);
    }

    public function jsonListeChecklist($id)
    {
        $data = Checklist::where("typegamme_id",intval($id))->get();
        return response()->json($data,200,[],JSON_UNESCAPED_UNICODE);
    }
}