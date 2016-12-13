<?php

namespace App\Http\Controllers;

use App\BonTravaux;
use App\CauseChantier;
use App\CoordonneeGPS;
use App\EquipeTravaux;
use App\EtatBon;
use App\Gamme;
use App\Http\HelperFunctions;
use App\MoyenHumain;
use App\Ouvrage;
use App\Planning;
use App\PreparationActionMaintenance;
use App\SollicitationExterieure;
use App\TypeGamme;
use App\TypeOperation;
use App\Urgence;
use Carbon\Carbon;
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
        $this->middleware('auth');
    }

    public function Index(Request $request)
    {
        return view('rtm.home');
    }

    public function showNewFormBT(BonTravaux $bonTravaux)
    {
        $urgence = Urgence::all();

        return view('rbom.editbt',[
            'urgences' => $urgence,
            'today' => date('d/m/Y H:i')
        ]);
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

    public function sendResponseNewFPAM($initiateur, Request $request)
    {
        try {
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
                    "longitude.required"=>"Veuillez autoriser la détermination de votre position SVP",
                    "longitude.numeric"=>"Vos coordonnées GPS sont dans un format inconnu",
                    "lattitude.required" => "Veuillez autoriser la détermination de votre position SVP",
                    "lattitude.numeric" => "Vos coordonnées GPS sont dans un format inconnu",
                ]
            );

            DB::beginTransaction();

            //création de la fiche FPAM
            $fpam = new PreparationActionMaintenance($request->except(['_token', 'dateprepa', "gamme", "dateheurepanne", "nbrecadre", "nbreagentdemaitrise",'disponibiliteagentcie',
                "nbreagentemploye", "nbreagentouvrier", "interllocuteur", "datecontact", "solliciationexprimee", "rdv", "conclusion", "document","datecontact"]));

            $fpam->dateprepa = Carbon::createFromFormat('d/m/Y', $request->input('dateprepa'))->toDateString();
            $fpam->dateheuredebutprevi = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheuredebutprevi'))->toDateString();
            $fpam->dateheurefinprevi = Carbon::createFromFormat('d/m/Y H:i', $request->input('dateheurefinprevi'))->toDateString();
            $fpam->saveOrFail();

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
            DB::commit();

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

    public function showListBT()
    {
        return view('rbom.listebt',[
            "bons" => BonTravaux::with(['etatbon','urgence'])->offset(0)->limit(20)->get()
        ]);
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

        $bonTravaux = new BonTravaux($request->except(['_token','dateheurepanne','dateexecution','abonnepanne','abonneabsent','abonnetrouve','dateheuredep']));
        $bonTravaux->dateheurepanne = Carbon::createFromFormat('d/m/Y H:i',$request->input('dateheurepanne'))->toDateTimeString();
        $bonTravaux->dateexecution = Carbon::createFromFormat('d/m/Y',$request->input('dateexecution'))->toDateString();
        $bonTravaux->abonnepanne = $request->has('abonnepanne') ? true : false;
        $bonTravaux->abonneabsent = $request->has('abonneabsent') ? true : false;
        $bonTravaux->abonnetrouve = $request->has('abonnetrouve') ? true : false;
        $bonTravaux->etatbon_id = EtatBon::Bon_enregistre;
        $bonTravaux->save();

        $this->withSuccess([Lang::get('rbom.btajout')]);
        return redirect()->route('liste_bt');
    }

    public function showListFPAM()
    {
        $data = PreparationActionMaintenance::all();
        return view('rbom.listefpam',[
            'data' => $data,
            'equipes'  => EquipeTravaux::all()
        ]);
    }

    public function showEditFormBT()
    {
        return view('rbom.editbt');
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
        $lundi = null;
        $mardi = null;
        $mercredi = null;
        $jeudi = null;
        $vendredi = null;

        if($jour == null){
            $lundi = Carbon::now()->addDay(-($d->dayOfWeek-1));
            $mardi = Carbon::now()->addDay(Carbon::TUESDAY -1);
            $mercredi = Carbon::now()->addDay(Carbon::WEDNESDAY-1);
            $jeudi = Carbon::now()->addDay(Carbon::THURSDAY-1);
            $vendredi = Carbon::now()->addDay(Carbon::FRIDAY-1);
        }else{
            $d = Carbon::createFromDate($annee,$mois,$jour);
            $lundi = Carbon::createFromDate($annee,$mois,$jour)->addDay(-($d->dayOfWeek-1));
            $mardi = Carbon::createFromDate($annee,$mois,$jour)->addDay(Carbon::TUESDAY -1);
            $mercredi = Carbon::createFromDate($annee,$mois,$jour)->addDay(Carbon::WEDNESDAY-1);
            $jeudi = Carbon::createFromDate($annee,$mois,$jour)->addDay(Carbon::THURSDAY-1);
            $vendredi = Carbon::createFromDate($annee,$mois,$jour)->addDay(Carbon::FRIDAY-1);
        }

        $planning = Planning::with(['equipe','actionmaintenance'])->whereBetween('datedepannage',[$lundi->toDateString(),$vendredi->toDateString()])->get();
        $equipes = EquipeTravaux::with(["chargeMaintenance","chefEquipe"])->orderBy('chargemaintenance','asc')->get();

        return view('rbom.planning',[
            "planning" => $planning,
            "lundi" => $lundi,
            "mardi" => $mardi,
            "mercredi" => $mercredi,
            "jeudi" => $jeudi,
            "vendredi" => $vendredi,
            "equipes" => $equipes,
            "date" => $d->format('d/m/Y'),
        ]);
    }
}
