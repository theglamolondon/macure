<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseFirst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeidentite', function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
        });
        Schema::create('identiteacces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login',100)->unique();
            $table->string('password',150);
            $table->integer('typeidentite_id',false,true);
            $table->string('remember_token')->nullable();
            $table->string('api_token')->nullable();
            $table->json('autorisation');
            $table->integer('totaltimeconnect')->default(0);
            $table->string('policy')->nullable();
            $table->dateTime('lastlogin')->nullable();
            $table->dateTime('lastlogout')->nullable();
            $table->integer('totalattemptconnect')->default(0);
            $table->string('profileimage')->default('default.png');
            //cléés étrangères
            $table->foreign('typeidentite_id','fk_identite_typeidentite')->references('id')->on('typeidentity');
        });
        Schema::create('utilisateur', function (Blueprint $table){
            $table->integer('identiteacces_id',false,true);
            $table->string('nom',50);
            $table->string('prenoms',50)->nullable();
            $table->string('telephone',50)->nullable();
            $table->string('email',150)->nullable();
            //clés
            $table->primary('identiteacces_id','pk_utilisateur');
            $table->foreign('identiteacces_id','fk_utilisateur_identiteacces')->references('id')->on('identiteacces');
        });
        Schema::create('urgence',function (Blueprint $table){
            $table->increments('id');
            $table->integer('level')->unique();
            $table->string('libelle',50);
        });
        Schema::create('etatbon',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('familleproduit',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('produit',function (Blueprint $table){
            $table->increments('id');
            $table->string('reference')->unique();
            $table->string('libelle');
            $table->integer('quantite')->default(0);
            $table->integer('famille_id')->default(0);
            //clés
            $table->foreign('famille_id','fk_produit_famille')->references('id')->on('familleproduit');
        });
        Schema::create('equipetravaux',function (Blueprint $table){
            $table->increments('id');
            $table->integer('identiteacces_id',false,true);
            $table->string('nom',50);
            $table->integer('chargemaintenance',false,true);
            $table->integer('chefequipe',false,true);
            //clés
            $table->foreign('identiteacces_id','fk_equipe_identite')->references('id')->on('identiteacces');
            $table->foreign('chargemaintenance','fk_equipe_charge_intervenant')->references('id')->on('intervenant');
            $table->foreign('chefequipe','fk_equipe_chef_intervenant')->references('id')->on('intervenant');
        });
        Schema::create('typeouvrage',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('direction',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
            $table->string('couleur',10)->nullable();
        });
        Schema::create('tache',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('ouvrage',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
            $table->date('datedebutetude');
            $table->date('datefinetude');
            $table->date('datedebutexecution')->nullable();
            $table->date('datefinexecution')->nullable();
            $table->integer('typeouvrage_id');
            $table->integer('direction_id');
            $table->foreign('typeouvrage_id','fk_ouvrage_typeouvrage')->references('id')->on('typeouvrage');
            $table->foreign('direction_id','fk_ouvrage_direction')->references('id')->on('direction');
        });
        Schema::create('tacheouvrage',function (Blueprint $table){
            $table->integer('ouvrage_id');
            $table->integer('tache_id');
            $table->primary(['ouvrage_id','tache_id']);
            $table->foreign('ouvrage_id','fk_to_ouvrage')->references('id')->on('ouvrage');
            $table->foreign('tache_id','fk_to_tache')->references('id')->on('tache');
        });
        Schema::create('bontravaux',function (Blueprint $table){
            $table->increments('id');
            $table->string('numerobon')->unique();
            $table->string('nomabonne',50)->nullable();
            $table->string('referenceabonne',30)->nullable();
            $table->dateTime('dateheurepanne');
            $table->string('descriptionpanne')->default('RAS');
            $table->string('ouvertpar',50);
            $table->string('observationabonne')->nullable();
            $table->string('chefdepanneur',50);
            $table->integer('typedepannage')->default(1);
            $table->boolean('abonnepanne')->default(false);
            $table->string('observationdepanneur')->nullable();
            $table->boolean('abonneabsent')->default(false);
            $table->boolean('abonnetrouve')->default(false);
            $table->string('chargeconsigne',50);
            $table->string('chargetravaux',50);
            $table->string('imputation')->nullable();
            $table->string('codeuo')->nullable();
            $table->integer('nbreuo')->default(0);
            $table->string('responsablebt',50);
            $table->date('dateexecution')->nullable();
            $table->date('dateplannification')->nullable();
            $table->integer('urgence_id')->unsigned();
            $table->integer('etatbon_id')->unsigned();
            $table->integer('equipetravaux_id')->unsigned()->nullable();
            $table->integer('ouvrage_id')->unsigned();
            //clés étrangères
            $table->foreign('etatbon_id','fk_bontravaux_etatbon')->references('id')->on('etatbon');
            $table->foreign('urgence_id','fk_bontravaux_urgence')->references('id')->on('urgence');
            $table->foreign('equipetravaux_id','fk_bontravaux_equipe')->references('id')->on('equipetravaux');
            $table->foreign('ouvrage_id','fk_bontravaux_ouvrage')->references('id')->on('ouvrage');
        });
        Schema::create('habilitation',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('intervenant',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom');
            $table->string('prenoms')->nullable();
            $table->string('niveau')->nullable();
            $table->integer('equipetravaux_id',false,true);
            $table->boolean('emprunte')->default(false);
            //clés
            $table->foreign('equipetravaux_id','fk_intervenant_equipetravaux')->references('id')->on('equipetravaux');
        });
        Schema::create('intervenant_habilitation',function (Blueprint $table){
            $table->integer('intervenant_id');
            $table->integer('habilitation_id');
            //clés
            $table->primary(['intervenant_id','habilitation_id'],'pk_intervenant_habilitation');
            $table->foreign('intervenant_id','fk_intervenant')->references('id')->on('intervenant');
            $table->foreign('habilitation_id','fk_habilitation')->references('id')->on('habilitation');
        });
        Schema::create('causechantier',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
        });
        Schema::create('typeoperation',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
        });
        Schema::create('fpactionmaintenance',function (Blueprint $table){
            $table->increments('id');
            $table->date('dateprepa');
            $table->integer('bontravaux_id',false,true);
            $table->string('numerofpam',20)->unique();
            $table->string('localisation',150);
            $table->string('equipement',200)->nullable();
            $table->integer('causechantier_id',false,true);
            $table->integer('equipetravaux_id',false,true);
            $table->string('detailscause')->nullable();
            $table->integer('typeoperation_id',false,true);
            $table->integer('titreoperation_id',false,true);
            $table->integer('urgence_id',false,true);
            $table->text('recommendation')->nullable();
            $table->string('naturetravaux');
            $table->dateTime('dateheuredebutprevi');
            $table->dateTime('dateheurefinprevi');
            $table->string('ouvrageaconsigner');
            $table->boolean('ressoucedisponible')->default(true);
            $table->string('materielspecialdispo');
            $table->string('mesurepartdispo')->nullable();
            $table->string('moyenderemiseetatdispo')->default('RAS');
            $table->string('remarqueobs')->default('RAS');
            $table->string('longitude',50);
            $table->string('lattitude',50);
            $table->integer('habilitation_id')->nullable();
            $table->integer('statut');
            //clés
            $table->foreign('causechantier_id','fk_prepa_action_cause')->references('id')->on('causechantier');
            $table->foreign('typeoperation_id','fk_prepa_action_type_ope')->references('id')->on('typeoperation');
            $table->foreign('titreoperation_id','fk_prepa_action_titre_ope')->references('id')->on('typeoperation');
            $table->foreign('urgence_id','fk_prepa_action_urgence')->references('id')->on('urgence');
            $table->foreign('equipetravaux_id','fk_prepa_equipe')->references('id')->on('equipetravaux');
            $table->foreign('habilitation_id','fk_prepa_habilitation')->references('id')->on('habilitation');
            $table->foreign('statut','fk_prepa_etat')->references('id')->on('etatbon');
        });
        Schema::create('typegamme',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
            $table->string('reference')->unique();
            $table->integer('indice',false,true);
            $table->integer('niveau',false,true);
            $table->string('periodicite',50)->nullable();
            $table->integer('temps',false,true);
            $table->integer('nbreagents',false,true);
            $table->string('habilitation',20);
        });
        Schema::create('checklist',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
            $table->integer('typegamme_id',false,true);
            //clés étrangères
            $table->foreign('typegamme_id','fk_checklist_type_gamme')->references('id')->on('typegamme');
        });
        Schema::create('gamme',function (Blueprint $table){
            $table->increments('id');
            $table->integer('fpactionmaintenance_id');
            $table->integer('typegamme_id',false,true);
            $table->string('analysecommentaire')->nullable();
            $table->boolean('controlefinal',100)->default(false);
            $table->boolean('realisation')->default(true);
            $table->boolean('resultat')->default(true);
            $table->string('observation')->nullable();
            //clé étrangères
            $table->foreign('typegamme_id','fk_gamme_type_gamme')->references('id')->on('typegamme');
            $table->foreign('fpactionmaintenance_id','fk_gamme_fpam')->references('id')->on('fpactionmaintenance');
        });
        Schema::create('gammecheck',function (Blueprint $table){
            $table->integer('checklist_id');
            $table->integer('gamme_id');
            $table->boolean('realisation')->default(true);
            $table->boolean('resultat')->default(true);
            $table->string('observation')->nullable();
            //clés
            $table->primary(['checklist_id','gamme_id'],'pk_gammecheck');
            $table->foreign('checklist_id','fk_ckeckgamme_checklist')->references('id')->on('checklist');
            $table->foreign('gamme_id','fk_ckeckgamme_gamme')->references('id')->on('gamme');
        });
        Schema::create('moyenhumain',function (Blueprint $table){
            $table->integer('fpactionmaintenance_id',false,true);
            $table->integer('nbrecadre')->default(0);
            $table->integer('nbreagentdemaitrise')->default(0);
            $table->integer('nbreagentemploye')->default(0);
            $table->integer('nbreagentouvrier')->default(0);
            $table->boolean('disponibiliteagentcie')->default(false);
            //clés
            $table->primary('fpactionmaintenance_id','pk_moyenhumain');
            $table->foreign('fpactionmaintenance_id','fk_moyenhumain_fpam')->references('id')->on('fpactionmaintenance');
        });
        Schema::create('sollicitationexterieure',function (Blueprint $table){
            $table->integer('fpactionmaintenance_id',false,true);
            $table->string('interllocuteur')->nullable();
            $table->date('datecontact')->nullable();
            $table->string('solliciationexprimee')->nullable();
            $table->string('conclusion')->nullable();
            $table->date('rdv')->nullable();
            //cles
            $table->primary('fpactionmaintenance_id','pk_sollicitation_ext');
            $table->foreign('fpactionmaintenance_id','fk_sollicitation_fpam')->references('id')->on('fpactionmaintenance');
        });
        Schema::create('documentjoint',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom');
            $table->string('description')->nullable();
            $table->integer('fpactionmaintenance_id',false,true);
            //clés
            $table->foreign('fpactionmaintenance_id','fk_document_fpam')->references('id')->on('fpactionmaintenance');
        });
        Schema::create('fpam_produit',function (Blueprint $table){
            $table->integer('fpam_id');
            $table->integer('produit_id');
            $table->integer('quantite');
            //cles
            $table->primary(['fpam_id','produit_id'],'pk_fpam_produit');
            $table->foreign('fpam_id','fk_fpam')->references('id')->on('fpactionmaintenance');
            $table->foreign('produit_id','fk_produit')->references('id')->on('produit');
        });
        Schema::create('bonrealisationtravail',function (Blueprint $table){
            $table->increments('id');
        });
        Schema::create('rtmaintenancecurative',function (Blueprint $table){
            $table->integer('preparation_action_maintenance_id',false,true);
            $table->date('daterapport');
            $table->string('reference',50)->unique();
            $table->integer('equipetravaux_id',false,true);
            //clés
            $table->primary('preparation_action_maintenance_id','pk_rapport_technique');
            $table->foreign('preparation_action_maintenance_id','fk_rtmc_fpam')->references('id')->on('fpactionmaintenance');
            $table->foreign('equipetravaux_id','fk_rtmc_equipetravaux')->references('id')->on('equipetravaux');
        });
        Schema::create('actionmaintenancecurative',function (Blueprint $table){
            $table->integer('actionmaintenancecurative_id',false,true);
            $table->string('tachesaccomplies');
            $table->string('intervention')->nullable();
            $table->string('remiseetat')->nullable();
            $table->string('recommandation')->default('RAS');
            $table->string('obsgenerale')->default('RAS');
            //clés
            $table->primary('actionmaintenancecurative_id','pk_action_maintenance');
            $table->foreign('actionmaintenancecurative_id','fk_action_maintenance_rapport_technique')
                ->references('fpactionmaintenance_id')->on('rtmaintenancecurative');
        });
        Schema::create('indicateurmaintenance',function (Blueprint $table){
            $table->integer('actionmaintenancecurative_id',false,true);
            $table->dateTime('dateheuredebut');
            $table->dateTime('dateheurefin');
            $table->integer('tempsannexe')->default(0);
            $table->integer('tempsindisponibilite')->default(0);
            //clés
            $table->primary('actionmaintenancecurative_id','pk_indicateurmaintenance');
            $table->foreign('actionmaintenancecurative_id','fk_indicateurmaintenance_rtmaintenancecurative')
                ->references('fpactionmaintenance_id')->on('rtmaintenancecurative');
        });
        Schema::create('planning',function (Blueprint $table){
            $table->integer('equipe_id',false,true);
            $table->integer('actionmaintenance_id',false,true)->unique();
            $table->date('datedepannage');
            //clés
            $table->primary(['equipe_id','actionmaintenance_id'],'pk_planning');
            $table->foreign('equipe_id','fk_planning_equipetravaux')->references('id')->on('equipetravaux');
            $table->foreign('actionmaintenance_id','fk_planning_fpam')->references('id')->on('fpactionmaintenance');
        });
        /*
        Schema::create('',function (Blueprint $table){

        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typeidentite');
        Schema::dropIfExists('identiteacces');
        Schema::dropIfExists('utilisateur');
        Schema::dropIfExists('urgence');
        Schema::dropIfExists('etatbon');
        Schema::dropIfExists('bontravaux');
        Schema::dropIfExists('typegamme');
        Schema::dropIfExists('checklist');
        Schema::dropIfExists('gamme');
        Schema::dropIfExists('gammecheck');
        Schema::dropIfExists('fpactionmaintenance');
        Schema::dropIfExists('typeoperation');
        Schema::dropIfExists('moyenhumain');
        Schema::dropIfExists('sollicitationexterieure');
        Schema::dropIfExists('documentjoint');
        Schema::dropIfExists('causechantier');
        Schema::dropIfExists('equipetravaux');
        Schema::dropIfExists('intervenant');
        Schema::dropIfExists('bonrealisationtravail');
        Schema::dropIfExists('rtmaintenancecurative');
        Schema::dropIfExists('actionmaintenancecurative');
        Schema::dropIfExists('indicateurmaintenance');
        Schema::dropIfExists('planning');
        Schema::dropIfExists('habilitation');
        Schema::dropIfExists('produit');
        Schema::dropIfExists('familleproduit');
        Schema::dropIfExists('fpam_produit');
        Schema::dropIfExists('intervenant_habilitation');
        Schema::dropIfExists('tacheouvrage');
        Schema::dropIfExists('typeouvrage');
        Schema::dropIfExists('ouvrage');
        Schema::dropIfExists('tache');
        Schema::dropIfExists('direction');
        Schema::dropIfExists('typeouvrage');
    }
}
