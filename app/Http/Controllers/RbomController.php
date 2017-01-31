<?php

namespace App\Http\Controllers;

use App\BonTravaux;
use App\CauseChantier;
use App\CoordonneeGPS;
use App\Direction;
use App\EquipeTravaux;
use App\EtatBon;
use App\Gamme;
use App\Http\HelperFunctions;
use App\MoyenHumain;
use App\Ouvrage;
use App\Planning;
use App\PreparationActionMaintenance;
use App\SollicitationExterieure;
use App\Tache;
use App\TypeGamme;
use App\TypeOperation;
use App\TypeOuvrage;
use App\Urgence;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class RbomController extends Controller
{
    use AuthorizationChecker, UserProfile, HelperFunctions;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function Index(Request $request)
    {
        return view('rtm.home');
    }

    public function showNewFormBT(BonTravaux $bonTravaux,$reference = null)
    {
        $urgence = Urgence::all();

        return view('rbom.editbt',[
            'urgences' => $urgence,
            'today' => date('d/m/Y H:i'),
            'reference' => $reference
        ]);
    }

    public function JsonListBT(Request $request)
    {
        //$perPage = intval($request->length);
        $offset  = intval($request->start);
        $data = BonTravaux::with(['etatbon','urgence'])->offset($offset)->limit(20)->get();

        return response()->json([
            "draw" => $request->draw,
            "recordsTotal" => count($data),
            "record" => count($data),
            "data" => $data
        ]);
    }

    public function showListBT()
    {
        return view('rbom.listebt',[
            "bons" => BonTravaux::with(['etatbon','urgence'])->offset(0)->limit(20)->get()
        ]);
    }

    public function showUpadetFormBT($initiateur)
    {
        try{
            $bt = BonTravaux::where('numerobon',$initiateur)->firstorFail();

            return view('rbom.updatebt',[
                'bt' => $bt,
                'urgences' => Urgence::all(),
                'today' => date('d/m/Y H:i')
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function sendResponseUpdateBT(Request $request,$initiateur)
    {
        $this->validate($request,[
            "nomabonne" => "required",
            "dateheurepanne" => "date_format:d/m/Y H:i",
            "dateexecution" => "date_format:d/m/Y",
        ],[
            "nomabonne.required" => "Veuillez saisir le nom de l\'abonné SVP",
            "dateheurepanne.date_format" => "Le format de la date de panne doit-être au format JJ/MM/AAAA HH:MM",
            "dateexecution.date_format" => "Le format de la date d\' dexécution doit-être au format JJ/MM/AAAA HH:MM",
        ]);

        try {
            //Récupération du BT
            $bonTravaux = BonTravaux::where('numerobon',$initiateur)->firstOrFail();

            $update = $request->except(['_token', 'dateheurepanne', 'dateexecution', 'abonnepanne', 'abonneabsent', 'abonnetrouve', 'dateheuredep']);
            $update['dateheurepanne'] = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheurepanne'))->toDateTimeString();
            $update['dateexecution'] = Carbon::createFromFormat('d/m/Y', $request->input('dateexecution'))->toDateString();
            $update['abonnepanne'] = $request->has('abonnepanne') ? true : false;
            $update['abonneabsent'] = $request->has('abonneabsent') ? true : false;
            $update['abonnetrouve'] = $request->has('abonnetrouve') ? true : false;
            $update['etatbon_id'] = EtatBon::Bon_enregistre;

            $bonTravaux->update($update);

            $this->withSuccess([Lang::get('rbom.btmodifie')]);
            return redirect()->route('liste_bt');
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function sendResponseDeleteBT($initiateur)
    {
        try{
            $bt = BonTravaux::where('numerobon',$initiateur)->firstorFail();
            $bt->delete();
            $this->withSuccess(['Suppression réussie']);
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function sendResponseNewBT(Request $request)
    {
        $this->validate($request,[
            "nomabonne" => "required",
            "dateheurepanne" => "date_format:d/m/Y H:i",
            "dateexecution" => "date_format:d/m/Y",
        ],[
            "nomabonne.required" => "Veuillez saisir le nom de l\'abonné SVP",
            "dateheurepanne.date_format" => "Le format de la date de panne doit-être au format JJ/MM/AAAA HH:MM",
            "dateexecution.date_format" => "Le format de la date d\' dexécution doit-être au format JJ/MM/AAAA HH:MM",
        ]);

        try {
            $bonTravaux = new BonTravaux($request->except(['_token', 'dateheurepanne', 'dateexecution', 'abonnepanne', 'abonneabsent', 'abonnetrouve', 'dateheuredep','bonvoisin']));
            $bonTravaux->dateheurepanne = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheurepanne'))->toDateTimeString();
            $bonTravaux->dateexecution = Carbon::createFromFormat('d/m/Y', $request->input('dateexecution'))->toDateString();
            $bonTravaux->abonnepanne = $request->has('abonnepanne') ? true : false;
            $bonTravaux->abonneabsent = $request->has('abonneabsent') ? true : false;
            $bonTravaux->abonnetrouve = $request->has('abonnetrouve') ? true : false;
            $bonTravaux->etatbon_id = EtatBon::Bon_enregistre;
            if($request->input('bonvoisin')){ $bonTravaux->bonvoisin = BonTravaux::where('numerobon',$request->input('bonvoisin'))->firstOrFaild()->id; }
            $bonTravaux->saveOrFail();

            $this->withSuccess([Lang::get('rbom.btajout')]);
            return redirect()->route('liste_bt');
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function showNewFormFPAM($initiateur)
    {
        $bonTravaux = BonTravaux::where('numerobon',$initiateur)->get()->first();
        $prepa = new PreparationActionMaintenance();
        $prepa->bontravaux = $bonTravaux;
        return view('rbom.editfpam',[
            "bon" => $bonTravaux,
            "today" => date('d/m/Y'),
            "todaytime" => date('d/m/Y H:i'),
            "urgences" => Urgence::all(),
            "causes" => CauseChantier::all(),
            "types" => TypeOperation::all(),
            "equipes" => EquipeTravaux::with('chefEquipe')->get(),
            "gammes" => TypeGamme::all(),
        ]);
    }

    private function validateFpamFrom(Request $request){
        $this->validate($request,[
            "localisation" => "required",
            "bontravaux_id" => "required|numeric|not_in:0",
            "nbrecadre" => "numeric|present",
            "interllocuteur" => "required_if:solliciationexprimee,*",
            "nbreagentdemaitrise" => "numeric|present",
            "nbreagentemploye" => "numeric",
            "nbreagentouvrier" => "numeric",
            "dateheurepanne" => "date_format:d/m/Y H:i",
            "datecontact" => "date_format:d/m/Y",
            "rdv" => "date_format:d/m/Y",
            "longitude" => "required|numeric",
            "lattitude" => "required|numeric",
        ],[
                "localisation.required" => "Veuillez saisir la localisation de panne SVP",
                "interllocuteur.required_if" => "Veuillez saisir l\'interllocuteur de la prestation extérieure SVP",
                "longitude.required"=>"Veuillez autoriser la détermination de votre position GPS SVP",
                "longitude.numeric"=>"Vos coordonnées GPS sont dans un format inconnu",
                "lattitude.required" => "Veuillez autoriser la détermination de votre position SVP",
                "lattitude.numeric" => "Vos coordonnées GPS sont dans un format inconnu",
            ]
        );
    }

    public function sendResponseNewFPAM($initiateur, Request $request)
    {
        try {
            $this->validateFpamFrom($request);
            //création de la fiche FPAM
            $fpam = new PreparationActionMaintenance($request->except(['_token', 'dateprepa', "gamme", "dateheurepanne", "nbrecadre", "nbreagentdemaitrise",'disponibiliteagentcie',
                "nbreagentemploye", "nbreagentouvrier", "interllocuteur", "datecontact", "solliciationexprimee", "rdv", "conclusion", "document","datecontact"]));

            $fpam->dateprepa = Carbon::createFromFormat('d/m/Y', $request->input('dateprepa'))->toDateString();
            $fpam->dateheuredebutprevi = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheuredebutprevi'))->toDateString();
            $fpam->dateheurefinprevi = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheurefinprevi'))->toDateString();
            $fpam->statut = EtatBon::Bon_enregistre;
            $fpam->saveOrFail();

            //Mise à jour du BT
            $bt = $fpam->bonTravaux();
            $bt->update(['etatbon_id'=>EtatBon::Etude_faite]);

            // creation de la gamme
            $typegamme = TypeGamme::findOrFail($request->input('gamme'));
            $gamme = new Gamme();
            $gamme->typegamme()->associate($typegamme);
            $gamme->preparationActionMaintenance()->associate($fpam);
            $gamme->saveOrFail();

            // creation de moyens humains
            if (intval($request->input("nbrecadre"))+
                intval($request->input("nbreagentdemaitrise"))+
                intval($request->input("nbreagentemploye"))+
                intval($request->input("nbreagentouvrier")) != 0)
            {
                $moyensHumains = new MoyenHumain($request->only('nbrecadre','nbreagentdemaitrise','nbreagentemploye','nbreagentouvrier'));
                $moyensHumains->disponibiliteagentcie = $request->has('disponibiliteagentcie') ? true : false;
                $moyensHumains->preparationActionMaintenance()->associate($fpam);
                $fpam->save();
            }

            //Solicitation extérieures
            if(!empty($request->input('interllocuteur')))
            {
                $sollicitation = new SollicitationExterieure($request->only(['interllocuteur','solliciationexprimee','conclusion']));
                $sollicitation->datecontact = Carbon::createFromFormat('d/m/Y', $request->input('datecontact'))->toDateString();
                $sollicitation->rdv = Carbon::createFromFormat('d/m/Y', $request->input('rdv'))->toDateString();
                $sollicitation->preparationActionMaintenance()->associate($fpam);
                $sollicitation->saveOrFail();
            }

            $this->withSuccess(["Nouvelle fiche de préparation d\'action de maintenance crée avec succès !"]);
            return redirect()->route('liste_fpam');

        }catch (TokenMismatchException $e){
            DB::rollback();
            return back()->withInput($request->input())->withErrors(["token" => Lang::get('rbom.token_miss')]);
        }catch (ModelNotFoundException $e){
            DB::rollback();
            return back()->withInput()->withErrors(['status' => Lang::get('rbom.failfpam')]);
        }catch (\Exception $e){
            DB::rollback();
            return back()->withInput()->withErrors(['status' => $e->getMessage()]);
        }
    }

    public function showUpdateFormFPAM($initiateur)
    {
        try {
            return view('rbom.updatefpam', [
                'fpam' => PreparationActionMaintenance::with('bonTravaux','gamme','moyensHumains')->where('numerofpam', $initiateur)->firstOrFail(),
                "urgences" => Urgence::all(),
                "causes" => CauseChantier::all(),
                "types" => TypeOperation::all(),
                "equipes" => EquipeTravaux::with('chefEquipe')->get(),
                "gammes" => TypeGamme::all(),
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors('La FPAM demandée n\'est pas disponible');
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function sendResponseUpdateFPAM(Request $request,$initiateur)
    {
        $this->validateFpamFrom($request);

        try{
            $fpam = PreparationActionMaintenance::with('gamme','bonTravaux','moyensHumains')->where('numerofpam', $initiateur)->firstOrFail();

            //FPAM
            $update = $request->except(['_token', 'dateprepa', "gamme", "dateheurepanne", "nbrecadre", "nbreagentdemaitrise",'disponibiliteagentcie',
                "nbreagentemploye", "nbreagentouvrier", "interllocuteur", "datecontact", "solliciationexprimee", "rdv", "conclusion", "document","datecontact",'longitude','lattitude']);
            $update['dateprepa'] = Carbon::createFromFormat('d/m/Y', $request->input('dateprepa'))->toDateString();
            $update['dateheuredebutprevi'] = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheuredebutprevi'))->toDateString();
            $update['dateheurefinprevi'] = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheurefinprevi'))->toDateString();
            $fpam->update($update);

            //Mise à jour du BT
            $bt = $fpam->bonTravaux;
            $bt->update(['etatbon_id'=>EtatBon::Etude_faite]);

            //Moyens Humains
            if($fpam->moyensHumains){
                $mh = $fpam->moyensHumain();
                $mh->update($request->only(['nbrecadre','nbreagentdemaitrise','nbreagentemploye','nbreagentouvrier']));
            }elseif(intval($request->input("nbrecadre"))+
                    intval($request->input("nbreagentdemaitrise"))+
                    intval($request->input("nbreagentemploye"))+
                    intval($request->input("nbreagentouvrier")) != 0)
            {
                $moyensHumains = new MoyenHumain($request->only('nbrecadre','nbreagentdemaitrise','nbreagentemploye','nbreagentouvrier'));
                $moyensHumains->disponibiliteagentcie = $request->has('disponibiliteagentcie') ? true : false;
                $moyensHumains->preparationActionMaintenance()->associate($fpam);
                $fpam->save();
            }

            $this->withSuccess(Lang::get('rbom.updatefpam'));
            return redirect()->route('liste_fpam');
        }catch (ModelNotFoundException $e){
            return back()->withErrors('Impossible de modifier cette FPAM. <small>'.$e->getMessage().'</small>');
        }catch (\Exception $e){

        }
    }

    public function sendResponseDeleteFPAM($initiateur)
    {
        try{
            $bt = PreparationActionMaintenance::where('numerofpam',$initiateur)->firstorFail();
            $bt->delete();
            $this->withSuccess(['Suppression réussie']);
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function JsonListFPAM(Request $request)
    {
        //$perPage = intval($request->length);
        $offset  = intval($request->start);
        $data = PreparationActionMaintenance::with(['titreoperation','typeoperation','bontravaux'])->offset($offset)->limit(20)->get();

        return response()->json([
            "draw" => $request->draw,
            "recordsTotal" => count($data),
            "record" => count($data),
            "data" => $data
        ]);
    }

    public function showListFPAM()
    {
        $data = PreparationActionMaintenance::all();
        return view('rbom.listefpam',[
            'data' => $data,
            'equipes'  => EquipeTravaux::all()
        ]);
    }

    public function sendResponsePlanning(Request $request)
    {
        $this->validate($request,[
            "datedepannage"=> 'required|date_format:d/m/Y',
            "equipe_id"=> 'required|numeric',
            "actionmaintenance_id"=> 'required|numeric'
        ]);

        try
        {
            $p = new Planning($request->except(["_token","datedepannage"]));
            $p->datedepannage = Carbon::createFromFormat("d/m/Y",$request->input("datedepannage"))->toDateString();
            $p->saveOrFail();
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors(["exception" => "La planification de cette FPAM à déjà été réalisée"]);
        }catch (\PDOException $e){
            return back()->withErrors(["exception" => "La planification de cette FPAM à déjà été réalisée"]);
        }catch (\Exception $e){
            return back()->withErrors(["exception" => $e->getMessage()]);
        }
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

        $planning = Planning::with(['equipe','actionmaintenance'])->whereBetween('datedepannage',[$dimanche->toDateString(),$samedi->toDateString()])->get();
        $equipes = EquipeTravaux::with(["chargeMaintenance","chefEquipe"])->orderBy('chargemaintenance','asc')->get();
        //dd($planning);

        return view('rbom.planning',[
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

    public function planningBT($annee=null, $mois=null, $jour=null)
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

        $bonDeLaSemaine = BonTravaux::with(['equipe','urgence','etatbon'])
            ->whereNull('dateplannification')
            ->whereBetween('dateexecution',[$dimanche->toDateString(),$samedi->toDateString()])
            ->orderBy('dateexecution')->get();

        $planningbt = BonTravaux::with(['equipe'])
            ->whereBetween('dateplannification',[$dimanche->toDateString(),$samedi->toDateString()])
            ->select(['id','numerobon','dateplannification','equipetravaux_id'])
            ->orderBy('dateexecution')->get();

        $equipes = EquipeTravaux::with(["chargeMaintenance","chefEquipe"])->orderBy('chargemaintenance','asc')->get();

        return view('rbom.planning_bt',[
            "planningbt" => $planningbt,
            "bonDeLaSemaine" => $bonDeLaSemaine,
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

    public function listeBTofWeek($annee,$mois,$jour){
        $d = Carbon::createFromDate($annee,$mois,$jour);
        $samedi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::SATURDAY-1));
        $dimanche = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1) + (Carbon::SUNDAY-1));

        $bonDeLaSemaine = BonTravaux::with(['equipe','urgence','etatbon'])
            ->whereNull('dateplannification')
            ->whereBetween('dateexecution',[$dimanche->toDateString(),$samedi->toDateString()])
            ->orderBy('dateexecution')->get();
        return $bonDeLaSemaine->toJson(JSON_UNESCAPED_UNICODE);
    }

    public function angularTemplate($jour,$mois,$annee){
        return view('partials._planningBT',[
            'equipes' => EquipeTravaux::with(["chargeMaintenance","chefEquipe"])->orderBy('chargemaintenance','asc')->get(),
            "date" => Carbon::now()->format('d/m/Y'),
        ]);
    }

    public function sendResponseMakePlanBT()
    {
        try{
            $bt = BonTravaux::where('numerobon',request('numerobon'))->firstOrFail();
            $updater = request()->except(['_token']);
            $updater['dateplannification'] = Carbon::createFromFormat('d/m/Y',request('dateplannification'))->toDateString();
            $bt->update($updater);
            $this->withSuccess(['Le BT N° '.$bt->numerobon.' a été plannifier avec succès !']);
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage());
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function showNewOuvrageForm()
    {
        return view('rbom.newouvrage',[
            'taches' => Tache::all(),
            'directions' => Direction::all(),
            'typeouvrages' => TypeOuvrage::all(),
        ]);
    }

    public function sendResponseNewOuvrageForm(Request $request){
        $this->validate($request,[
            'libelle' => 'required',
            'typeouvrage_id' => 'required|numeric',
            'direction_id' => 'required|numeric',
            'datedebutetude' => 'required|date_format:d/m/Y',
            'datefinetude' => 'required|date_format:d/m/Y',
            'taches' => 'array'
        ],[
            'libelle.required' => "Le nom de l'ouvrage est requis svp!",
            'datedebutetude.date_format' => "Veuillez saisir une date au format JJ/MM/AAAA svp!",
            'datefinetude.date_format' => "Veuillez saisir une date au format JJ/MM/AAAA svp!",
        ]);

        try{
            $ouvrage = new Ouvrage($request->except(['_token','taches','datedebutetude','datefinetude','datedebutexecution','datefinexecution']));
            $ouvrage->datedebutetude = Carbon::createFromFormat('d/m/Y',$request->input('datedebutetude'));
            $ouvrage->datefinetude = Carbon::createFromFormat('d/m/Y',$request->input('datefinetude'));

            //Détermination de la date d'exécutionn
            if(
                $request->input(['datedebutexecution']) != $request->input(['datefinexecution'])
                && $request->input(['datedebutexecution']) != Carbon::today()->format('d/m/Y')
            ){
                $ouvrage->datedebutexecution = Carbon::createFromFormat('d/m/Y',$request->input('datedebutexecution'));
                $ouvrage->datefinexecution = Carbon::createFromFormat('d/m/Y',$request->input('datefinexecution'));
            }

            $ouvrage->saveOrFail();
            $ouvrage->taches()->attach($request->input('taches'));

            $this->withSuccess(['Nouvel ouvrage créé avec succès !']);
            return redirect()->route('planning_ouvrage_trimestriel');
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function showUpdateOuvrageForm($id){
        try{
            return view('rbom.updateouvrage',[
                'ouvrage' => Ouvrage::with('taches')->findOrFail(intval($id)),
                'taches' => Tache::leftjoin('tacheouvrage','tache.id','=','tacheouvrage.tache_id')->where('tacheouvrage.ouvrage_id',$id)->get(),
                'directions' => Direction::all(),
                'typeouvrages' => TypeOuvrage::all(),
            ]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors(["L'ouvrage demandé est introuvable"]);
        }catch ( \Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function sendResponseUpdateOuvrageForm(Request $request,$id){

        $this->validate($request,[
            'libelle' => 'required',
            'typeouvrage_id' => 'required|numeric',
            'direction_id' => 'required|numeric',
            'datedebutetude' => 'required|date_format:d/m/Y',
            'datefinetude' => 'required|date_format:d/m/Y',
            'taches' => 'array'
        ],[
            'libelle.required' => "Le nom de l'ouvrage est requis svp!",
            'datedebutetude.date_format' => "Veuillez saisir une date au format JJ/MM/AAAA svp!",
            'datefinetude.date_format' => "Veuillez saisir une date au format JJ/MM/AAAA svp!",
        ]);

        try{
            $ouvrage = Ouvrage::findOrFail(intval($id));
            $update = $request->except(['_token','taches','datedebutetude','datefinetude','datedebutexecution','datefinexecution']);
            $update["datedebutetude"] = Carbon::createFromFormat('d/m/Y',$request->input('datedebutetude'));
            $ouvrage["datefinetude"] = Carbon::createFromFormat('d/m/Y',$request->input('datefinetude'));

            //Détermination de la date d'exécutionn
            if(
                $request->input(['datedebutexecution']) != $request->input(['datefinexecution'])
                && $request->input(['datedebutexecution']) != Carbon::today()->format('d/m/Y')
            ){
                $ouvrage["datedebutexecution"] = Carbon::createFromFormat('d/m/Y',$request->input('datedebutexecution'));
                $ouvrage["datefinexecution"] = Carbon::createFromFormat('d/m/Y',$request->input('datefinexecution'));
            }

            $ouvrage->update($update);
            //$ouvrage->taches()->attach($request->input('taches'));

            $this->withSuccess(["Modification de l'ouvrage pris en compte avec succès !"]);
            return redirect()->route('planning_ouvrage_annuel');
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function showListOuvrage()
    {
        $ouvrages = Ouvrage::with('direction','typeOuvrage')->orderBy('datedebutetude','desc')->paginate(30);

        return view('rbom.listeouvrage',[
            "ouvrages" => $ouvrages
        ]);
    }

    private function getMonth(){
        return [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars',
            4 => 'Avril', 5 => 'Mai', 6 => 'Juin',
            7 => 'Juillet', 8 => 'Août', 9 => 'Septembre',
            10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];
    }

    public function planningOuvrageAnnuel(Request $request, $annee = null){
        $annee = $annee ? intval($annee) : Carbon::now()->year;

        //Toutes les taches de la période
        $ouvrages = Ouvrage::join('tacheouvrage','tacheouvrage.ouvrage_id','=','ouvrage.id')
            ->join('tache','tache.id','=','tacheouvrage.tache_id')
            ->join('direction','direction.id','=','ouvrage.direction_id')
            ->whereMonth('datedebutetude','<=',12)
            ->whereMonth('datefinetude','>=',1)
            ->whereYear('datefinetude','<=',$annee)
            ->select(['direction.libelle AS direction','ouvrage.*','tache.libelle AS tache','tacheouvrage.*','couleur'])
            ->get();

        //Toutes les taches de la période
        $taches = Tache::join('tacheouvrage','tacheouvrage.tache_id','=','tache.id')
            ->join('ouvrage','ouvrage.id','=','tacheouvrage.ouvrage_id')
            ->whereMonth('datedebutetude','<=',12)
            ->whereMonth('datefinetude','>=',1)
            ->whereYear('datefinetude','<=',$annee)
            ->orderBy('id')
            ->distinct()
            ->select('tache.id','tache.libelle')
            ->get();

        $ouvragesExecutes = Ouvrage::with('direction','typeOuvrage')
            ->whereMonth('datedebutexecution','<=',12)
            ->whereMonth('datefinexecution','>=',1)
            ->whereYear('datefinexecution','<=',$annee)
            ->get();

        return view('rbom.planning_ouvrage_annee',[
            'mois' => [
                'M1' =>  $this->getMonth()[1], 'M1_' =>  1,
                'M2' =>  $this->getMonth()[2], 'M2_' =>  2,
                'M3' =>  $this->getMonth()[3], 'M3_' =>  3,
                'M4' =>  $this->getMonth()[4], 'M4_' =>  4,
                'M5' =>  $this->getMonth()[5], 'M5_' =>  5,
                'M6' =>  $this->getMonth()[6], 'M6_' =>  6,
                'M7' =>  $this->getMonth()[7], 'M7_' =>  7,
                'M8' =>  $this->getMonth()[8], 'M8_' =>  8,
                'M9' =>  $this->getMonth()[9], 'M9_' =>  9,
                'M10' =>  $this->getMonth()[10], 'M10_' =>  10,
                'M11' =>  $this->getMonth()[11], 'M11_' =>  11,
                'M12' =>  $this->getMonth()[12], 'M12_' =>  12,
            ],
            'ouvrages' => $ouvrages,
            'ouvragesExecutes' => $ouvragesExecutes,
            'taches' => $taches
        ]);
    }

    public function planningOuvrageTrimestriel($annee = null, $trimestre = null){
        $trimestre = $trimestre ? intval($trimestre) : ceil(Carbon::now()->month/3);
        $annee = $annee ? intval($annee) : Carbon::now()->year;

        //Déterminnation des mois du trimestre
        $m1 = intval(($trimestre*3)-2) ;
        $m2 = intval(($trimestre*3)-1);
        $m3 = intval(($trimestre*3)-0);

        //Tous les ouvrages de la période
        $ouvrages = Ouvrage::join('tacheouvrage','tacheouvrage.ouvrage_id','=','ouvrage.id')
            ->join('tache','tache.id','=','tacheouvrage.tache_id')
            ->join('direction','direction.id','=','ouvrage.direction_id')
            ->whereMonth('datedebutetude','<=',$m3)
            ->whereMonth('datefinetude','>=',$m1)
            ->whereYear('datefinetude','<=',$annee)
            ->select(['direction.libelle AS direction','ouvrage.*','tache.libelle AS tache','tacheouvrage.*','couleur'])
            ->get();

        //Toutes les taches de la période
        $taches = Tache::join('tacheouvrage','tacheouvrage.tache_id','=','tache.id')
            ->join('ouvrage','ouvrage.id','=','tacheouvrage.ouvrage_id')
            ->whereMonth('datedebutetude','<=',$m3)
            ->whereMonth('datefinetude','>=',$m1)
            ->whereYear('datefinetude','<=',$annee)
            ->orderBy('id')
            ->distinct()
            ->select('tache.id','tache.libelle')
            ->get();

        $ouvragesExecutes = Ouvrage::with('direction','typeOuvrage')
            ->whereMonth('datedebutexecution','<=',$m3)
            ->whereMonth('datefinexecution','>=',$m1)
            ->whereYear('datefinexecution','<=',$annee)
            ->get();

        return view('rbom.planning_ouvrage_trimestriel',[
            'mois' => [
                'M1' =>  $this->getMonth()[$m1],
                'M1_' =>  $m1,
                'M2' =>  $this->getMonth()[$m2],
                'M2_' =>  $m2,
                'M3' =>  $this->getMonth()[$m3],
                'M3_' =>  $m3,
            ],
            'ouvrages' => $ouvrages,
            'ouvragesExecutes' => $ouvragesExecutes,
            'taches' => $taches,
        ]);
    }

    public function planningOuvrageMensuel( $annee = null, $mois = null){
        $mois = $mois ? intval($mois) : Carbon::now()->month;

        return view('rbom.planning_ouvrage_mensuel');
    }
}
