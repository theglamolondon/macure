<?php

namespace App\Http\Controllers;

use App\BonTravaux;
use App\EquipeTravaux;
use App\Ouvrage;
use App\PreparationActionMaintenance;
use App\Tache;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function planningBT($jour=null,$mois=null,$annee=null)
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

        $pdf = PDF::loadView('pdf.planningbt', compact("bonDeLaSemaine",'planningbt','lundi',"mardi","mercredi","jeudi","vendredi","samedi","dimanche","equipes","date"))
                            ->setPaper('a4', 'landscape');
        return $pdf->download('planningbt.pdf');
    }

    public function planningOuvrage($annee = null)
    {
        $annee = $annee ? $annee : Carbon::now()->year;

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

            $mois  = [
                'M1' =>  RbomController::getMonth()[1], 'M1_' =>  1,
                'M2' =>  RbomController::getMonth()[2], 'M2_' =>  2,
                'M3' =>  RbomController::getMonth()[3], 'M3_' =>  3,
                'M4' =>  RbomController::getMonth()[4], 'M4_' =>  4,
                'M5' =>  RbomController::getMonth()[5], 'M5_' =>  5,
                'M6' =>  RbomController::getMonth()[6], 'M6_' =>  6,
                'M7' =>  RbomController::getMonth()[7], 'M7_' =>  7,
                'M8' =>  RbomController::getMonth()[8], 'M8_' =>  8,
                'M9' =>  RbomController::getMonth()[9], 'M9_' =>  9,
                'M10' =>  RbomController::getMonth()[10], 'M10_' =>  10,
                'M11' =>  RbomController::getMonth()[11], 'M11_' =>  11,
                'M12' =>  RbomController::getMonth()[12], 'M12_' =>  12,
            ];

        $pdf = PDF::loadView('pdf.planningouvrage', compact("mois","ouvrages","ouvragesExecutes","taches","annee"))
            ->setPaper('a4', 'landscape');
        return $pdf->download('planningouvrage.pdf');
    }

    public function planningFPAM($jour=null,$mois=null,$annee=null)
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

        $planning = PreparationActionMaintenance::with(['equipe'])->whereBetween('datedepannage',[$dimanche->toDateString(),$samedi->toDateString()])->get();
        $equipes = EquipeTravaux::with(["chargeMaintenance","chefEquipe"])->orderBy('chargemaintenance','asc')->get();

        $date = $d->format('d/m/Y');

        $pdf = PDF::loadView('pdf.planningfpam', compact("date","planning","equipes","lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"))
            ->setPaper('a4', 'landscape');
        return $pdf->download('planningfpam.pdf');
    }
}