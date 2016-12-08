<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_identite')->insert([
            ['libelle' => 'Utilisateur'],
            ['libelle' => 'Groupe Travaux']
        ]);
        DB::table('identite_acces')->insert([
            [
                'login' => 'glamolondon@gmail.com',
                'password' => bcrypt('flavie'),
                'type_identite_id'=>1,
                'autorisation' => json_encode(['admin','cie','rtmdoc','rbom','directeur'])
            ],
            [
                'login' => 'akejeansidoine@yahoo.fr',
                'password' => bcrypt('leandre'),
                'type_identite_id'=>1,
                'autorisation' => json_encode(['admin','cie','rtmdoc','rbom','directeur'])
            ],
            [
                'login' => 'groupe1',
                'password' => bcrypt('macure'),
                'type_identite_id'=>2,
                'autorisation' => json_encode(['equipe'])
            ],
            [
                'login' => 'groupe2',
                'password' => bcrypt('macure'),
                'type_identite_id'=>2,
                'autorisation' => json_encode(['equipe'])
            ],
            [
                'login' => 'groupe3',
                'password' => bcrypt('macure'),
                'type_identite_id'=>2,
                'autorisation' => json_encode(['equipe'])
            ],
        ]);
        DB::table('utilisateur')->insert([
            [
                'nom' => 'Koffi',
                'prenoms' => 'Bérenger Wilfried',
                'telephone' => '+225 47631443',
                'email' => 'glamolondon@gmail.com',
                'identite_acces_id' => 1
            ],
            [
                'nom' => 'Ake',
                'prenoms' => 'Jean Sidoine',
                'telephone' => null,
                'email' => null,
                'identite_acces_id' => 2
            ],
        ]);
        DB::table('urgence')->insert([
            [
                'level' => 1,
                'libelle' => 'Moyen terme'
            ],
            [
                'level' => 2,
                'libelle' => 'Court terme'
            ],
            [
                'level' => 3,
                'libelle' => 'Urgent'
            ],
        ]);
        DB::table('etat_bon')->insert([
            ['libelle' => 'Bon enregistré'],
            ['libelle' => 'Etude faite'],
            ['libelle' => 'Travaux encours de réalisation'],
            ['libelle' => 'Travaux terminés']
        ]);
        DB::table('equipe_travaux')->insert([
            [
                "identite_acces_id" => 3,
                "nom" => "Equipe 1",
                "chargemaintenance" => 1,
                "chefequipe" => 2
            ],
            [
                "identite_acces_id" => 4,
                "nom" => "Equipe 2",
                "chargemaintenance" => 1,
                "chefequipe" => 3
            ],
            [
                "identite_acces_id" => 5,
                "nom" => "Equipe 3",
                "chargemaintenance" => 4,
                "chefequipe" => 2
            ],
        ]);
        DB::table('intervenant')->insert([
            [
                "nom" => "Kouassi",
                "prenoms" => "Eugène",
                "niveau" => "Ingénieur de technique",
                "equipe_travaux_id" => 1
            ],[
                "nom" => "Mael",
                "prenoms" => "Franck",
                "niveau" => "Technicien BT",
                "equipe_travaux_id" => 1
            ],[
                "nom" => "Atébi",
                "prenoms" => "Yaro Francis",
                "niveau" => "Ingénieur de technique",
                "equipe_travaux_id" => 1
            ],[
                "nom" => "Ohoucou",
                "prenoms" => "Sandrine",
                "niveau" => "Ingénieur de technique",
                "equipe_travaux_id" => 2
            ],[
                "nom" => "Kouassi",
                "prenoms" => "Eugène",
                "niveau" => "Technicien",
                "equipe_travaux_id" => 2
            ],[
                "nom" => "Traoré",
                "prenoms" => "Aboubakar",
                "niveau" => "Technicien",
                "equipe_travaux_id" => 2
            ],[
                "nom" => "Adjéhi",
                "prenoms" => "Lucien",
                "niveau" => "Ingénieur de technique",
                "equipe_travaux_id" => 3
            ],[
                "nom" => "Toungblé",
                "prenoms" => "Martial",
                "niveau" => "Ingénieur de technique",
                "equipe_travaux_id" => 3
            ],[
                "nom" => "Sylla",
                "prenoms" => "Fofana",
                "niveau" => "Ingénieur de technique",
                "equipe_travaux_id" => 3
            ],
        ]);
        DB::table("cause_chantier")->insert([
           ["libelle" => 'Incident' ],
           ["libelle" => 'Avarie' ],
           ["libelle" => 'Incendie' ]
        ]);
        DB::table("type_operation")->insert([
            ["libelle" => 'Visite'],
            ["libelle" => 'Réparation'],
            ["libelle" => 'Modification'],
            ["libelle" => 'Rénovation']
        ]);
        DB::table("type_gamme")->insert([
            [
                "libelle" => 'Gamme de remplacement d\'une grille de dérivation',
                "reference" => 'GAM IT 688',
                "indice" => '02',
                "niveau" => '2',
                "periodicite" => 'Selon besoin',
                "temps" => '1',
                "nbreagents" => '2',
                "habilitation" => 'BR'
            ]
        ]);

        //Préchargement des datas de BT
        $abonnees = ["Koffi Wilfried","Koné Mamadou","Traoré Samba", "Sidoine Aké", "Virgile Ekra", "Koblan Jean Philippe","Kouassi Marcelin","Aké Aké Paul",
            "Marc Aurèle Aglégbé","Gbégbé Désiré","Gogbeu Guy-Roland","Allui Jean-Hugues","Léandre Glako","Sienou Adama","Tano Arthur","Arthur Vadi",
            "Marcos Williams","Diamant Brut","Assebian Michel","Fatou Keïta"];
        $raisons = explode(", ","Lorem ipsum dolor sit amet, consectetur adipiscing elit, Mauris vulputate tellus ut porttitor malesuada, Aliquam non ullamcorper mauris, Integer sit amet lectus eget justo consectetur, viverra nec non orci, Ut faucibus magna ac augue blandit, ut tristique lacus semper, Ut tempor porttitor lectus, Donec iaculis condimentum tortor, at scelerisque eros bibendum et, Proin sollicitudin dictum ipsum, nec pulvinar eros fringilla, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vulputate tellus ut porttitor malesuada. Aliquam non ullamcorper mauris, Integer sit amet lectus eget justo consectetur viverra nec non orci, Ut faucibus magna ac augue blandit, ut tristique lacus semper, Ut tempor porttitor lectus, Donec iaculis condimentum tortor, at scelerisque eros bibendum et, Proin sollicitudin dictum ipsum, nec pulvinar eros fringilla");

        for($i = 0 ; $i < 100 ; $i++)
        {
            $rand = array_rand($abonnees,4);
            $rais = array_rand($raisons,1);
            $date = rand(2015,2016).'-'.rand(01,12).'-'.rand(01,28);
            $heure = ' '.rand(00,23).':'.rand(0,59);

            DB::table("bon_travaux")->insert([
                'numerobon' => 145800266450+$i,
                'nomabonne' => $abonnees[$rand[0]],
                'referenceabonne' => '10004586550'.$i,
                'urgence_id' => rand(1,3),
                'dateheurepanne' => $date.$heure,
                'descriptionpanne' => $raisons[$rais],
                'ouvertpar' => $abonnees[$rand[1]],
                'observationabonne' => '',
                'chefdepanneur' => '',
                'typedepannage' => rand(1,2),
                'abonnepanne' => rand(0,1),
                'observationdepanneur' => '',
                'abonneabsent' => rand(0,1),
                'abonnetrouve' => rand(0,1),
                'chargeconsigne' => '',
                'chargetravaux' => $abonnees[$rand[2]],
                'imputation' => '45460AZH00524500'.$i,
                'codeuo' => null,
                'nbreuo' => 0,
                'responsablebt' => $abonnees[$rand[3]],
                'etat_bon_id' => EtatBon::Bon_enregistre,
                'createur' => Auth::user()->id,
                'dateheurecreation' => Carbon::now()->toDateTimeString(),
            ]);
        }
        /*
        DB::table('type_identite')->insert([
            ['libelle' => 'Utilisateur'],
            ['libelle' => 'Groupe Travaux']
        ]);
        DB::table('type_identite')->insert([
            'name' => 'Bonjour le monde',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        */
    }
}