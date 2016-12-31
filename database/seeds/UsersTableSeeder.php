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
        DB::table('typeidentite')->insert([
            ['libelle' => 'Utilisateur'],
            ['libelle' => 'Groupe Travaux']
        ]);
        DB::table('identiteacces')->insert([
            [
                'login' => 'glamolondon@gmail.com',
                'password' => bcrypt('flavie'),
                'typeidentite_id'=>1,
                'autorisation' => json_encode(['admin','cie','rtmdoc','rbom','directeur','stock']),
                'policy' => null
            ],
            [
                'login' => 'akejeansidoine@yahoo.fr',
                'password' => bcrypt('leandre'),
                'typeidentite_id'=>1,
                'autorisation' => json_encode(['admin','cie','rtmdoc','rbom','directeur','stock']),
                'policy' => '-t 08:00 16:20',
            ],
            [
                'login' => 'groupe1',
                'password' => bcrypt('macure'),
                'typeidentite_id'=>2,
                'autorisation' => json_encode(['equipe']),
                'policy' => null
            ],
            [
                'login' => 'groupe2',
                'password' => bcrypt('macure'),
                'typeidentite_id'=>2,
                'autorisation' => json_encode(['equipe']),
                'policy' => null
            ],
            [
                'login' => 'groupe3',
                'password' => bcrypt('macure'),
                'typeidentite_id'=>2,
                'autorisation' => json_encode(['equipe']),
                'policy' => null
            ],
        ]);
        DB::table('utilisateur')->insert([
            [
                'nom' => 'Koffi',
                'prenoms' => 'Bérenger Wilfried',
                'telephone' => '+225 47631443',
                'email' => 'glamolondon@gmail.com',
                'identiteacces_id' => 1
            ],
            [
                'nom' => 'Ake',
                'prenoms' => 'Jean Sidoine',
                'telephone' => null,
                'email' => null,
                'identiteacces_id' => 2
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
        DB::table('etatbon')->insert([
            ['libelle' => 'Bon enregistré'],
            ['libelle' => 'Etude faite'],
            ['libelle' => 'Travaux encours de réalisation'],
            ['libelle' => 'Travaux terminés']
        ]);
        DB::table('equipetravaux')->insert([
            [
                "identiteacces_id" => 3,
                "nom" => "Equipe 1",
                "chargemaintenance" => 1,
                "chefequipe" => 2
            ],
            [
                "identiteacces_id" => 4,
                "nom" => "Equipe 2",
                "chargemaintenance" => 1,
                "chefequipe" => 3
            ],
            [
                "identiteacces_id" => 5,
                "nom" => "Equipe 3",
                "chargemaintenance" => 4,
                "chefequipe" => 7
            ],
        ]);
        DB::table('intervenant')->insert([
            [
                "nom" => "Kouassi",
                "prenoms" => "Eugène",
                "niveau" => "Ingénieur de technique",
                "equipetravaux_id" => 1,
            ],[
                "nom" => "Mael",
                "prenoms" => "Franck",
                "niveau" => "Technicien BT",
                "equipetravaux_id" => 1
            ],[
                "nom" => "Atébi",
                "prenoms" => "Yaro Francis",
                "niveau" => "Ingénieur de technique",
                "equipetravaux_id" => 1
            ],[
                "nom" => "Ohoucou",
                "prenoms" => "Sandrine",
                "niveau" => "Ingénieur de technique",
                "equipetravaux_id" => 2
            ],[
                "nom" => "Kouassi",
                "prenoms" => "Eugène",
                "niveau" => "Technicien",
                "equipetravaux_id" => 2
            ],[
                "nom" => "Traoré",
                "prenoms" => "Aboubakar",
                "niveau" => "Technicien",
                "equipetravaux_id" => 2
            ],[
                "nom" => "Adjéhi",
                "prenoms" => "Lucien",
                "niveau" => "Ingénieur de technique",
                "equipetravaux_id" => 3
            ],[
                "nom" => "Toungblé",
                "prenoms" => "Martial",
                "niveau" => "Ingénieur de technique",
                "equipetravaux_id" => 3
            ],[
                "nom" => "Sylla",
                "prenoms" => "Fofana",
                "niveau" => "Ingénieur de technique",
                "equipetravaux_id" => 3
            ],
        ]);
        DB::table("causechantier")->insert([
           ["libelle" => 'Incident' ],
           ["libelle" => 'Avarie' ],
           ["libelle" => 'Incendie' ]
        ]);
        DB::table("typeoperation")->insert([
            ["libelle" => 'Visite'],
            ["libelle" => 'Réparation'],
            ["libelle" => 'Modification'],
            ["libelle" => 'Rénovation']
        ]);
        DB::table("typegamme")->insert([
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

            DB::table("bontravaux")->insert([
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
                'etatbon_id' => \App\EtatBon::Bon_enregistre,
                'dateexecution' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);
        }

        DB::table('checklist')->insert([
            ["typegamme_id" => 1 ,"libelle" => "Porter les équipements individuels de protection"],
            ["typegamme_id" => 1 ,"libelle" => "S'assurer de la consignation effective du départ concerné"],
            ["typegamme_id" => 1 ,"libelle" => "Recevoir du chargé de consignation une attestation de consignation pour travaux"],
            ["typegamme_id" => 1 ,"libelle" => "Tester l'état de bon fonctionnement du détecteur sonore de tension"],
            ["typegamme_id" => 1 ,"libelle" => "Vérifier l'absence de tension à l'aide du détecteur de tension sonore"],
            ["typegamme_id" => 1 ,"libelle" => "Informer le ou les clients"],
            ["typegamme_id" => 1 ,"libelle" => "Déclencher le ou les disjoncteurs"],
            ["typegamme_id" => 1 ,"libelle" => "Ouvrir le coffret à fusible et retirer les fusibles"],
            ["typegamme_id" => 1 ,"libelle" => "Déconnecter un à un les câbles et les marquer au fur et à mésure"],
            ["typegamme_id" => 1 ,"libelle" => "Déposer l'ancienne grille"],
            ["typegamme_id" => 1 ,"libelle" => "Poser la nouvelle grille"],
            ["typegamme_id" => 1 ,"libelle" => "Passer les câbles et les raccorder au fur et à mésure en respectant le repérage et en les serrant convenablement"],
            ["typegamme_id" => 1 ,"libelle" => "Ranger le matériel et nettoyer le chantier"],
            ["typegamme_id" => 1 ,"libelle" => "Restituer l'avis de fin de travail"],
            ["typegamme_id" => 1 ,"libelle" => "Mettre la grille sous tension"],
            ["typegamme_id" => 1 ,"libelle" => "Mesurer les tensions simples et composées pour le contrôle de la livraison du produit (230 à 410 V)"],
            ["typegamme_id" => 1 ,"libelle" => "Plomber la grille"],
            ["typegamme_id" => 1 ,"libelle" => "Enclencher le ou les disjoncteurs"],
            ["typegamme_id" => 1 ,"libelle" => "Informer le ou les clients de la fin du travail"],
            ["typegamme_id" => 1 ,"libelle" => "Remplir le check list au fil de l'eau"],
            ["typegamme_id" => 1 ,"libelle" => "Rédiger et faire signer le compte rendu d'intervention"],
            ["typegamme_id" => 1 ,"libelle" => "Rédiger le compte rendu d'intervention"]
        ]);
        DB::table('familleproduit')->insert([
            ['libelle' => 'Vehicule'],
            ['libelle' => 'Electrique'],
            ['libelle' => 'Mecanique'],
            ['libelle' => 'Materiel'],
            ['libelle' => 'Pièce de rechange et consommables'],
        ]);
        DB::table('produit')->insert([
            [
                'reference' => 'V0001',
                'libelle' => 'Vehicule de maintenance',
                'quantite' => 5,
                'famille' => 1
            ],[
                'reference' => 'V0002',
                'libelle' => 'Pince ampermetrique',
                'quantite' => 40,
                'famille' => 1
            ],
        ]);
        /*
         *
                'longitude' => 5.3144139 + rand(0.0001500,0.1999000),
                'lattitude' => -3.9943673 - rand(0.0001500,0.1999000),
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