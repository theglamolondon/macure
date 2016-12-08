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
        Schema::create('type_identite', function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
        });
        Schema::create('identite_acces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login',100)->unique();
            $table->string('password',150);
            $table->integer('type_identite_id',false,true);
            $table->string('remember_token')->nullable();
            $table->string('api_token')->nullable();
            $table->json('autorisation');
            //cléés étrangères
            $table->foreign('type_identite_id','fk_identite_typeidentite')->references('id')->on('type_identity');
        });
        Schema::create('utilisateur', function (Blueprint $table){
            $table->integer('identite_acces_id',false,true);
            $table->string('nom',50);
            $table->string('prenoms',50)->nullable();
            $table->string('telephone',50)->nullable();
            $table->string('email',150)->nullable();
            //clés
            $table->primary('identite_acces_id','pk_utilisateur');
            $table->foreign('identite_acces_id','fk_utilisateur_')->references('id')->on('identite_acces');
        });
        Schema::create('urgence',function (Blueprint $table){
            $table->increments('id');
            $table->integer('level')->unique();
            $table->string('libelle',50);
        });
        Schema::create('etat_bon',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('bon_travaux',function (Blueprint $table){
            $table->increments('id');
            $table->string('numerobon')->unique();
            $table->string('nomabonne',50)->nullable();
            $table->string('referenceabonne',30)->nullable();
            $table->integer('urgence_id')->unsigned();
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
            $table->integer('etat_bon_id')->unsigned();
            $table->integer('equipe_travaux_id')->unsigned()->nullable();
            $table->integer('preparation_action_maintenance_id')->unsigned()->nullable();
            $table->dateTime('dateheurecreation');
            $table->dateTime('dateheuremodification')->nullable();
            $table->integer('createur');
            $table->integer('modificateur')->nullable();
            //clés étrangères
            $table->foreign('etat_bon_id','fk_bon_travaux_etat_bon')->references('id')->on('etat_bon');
            $table->foreign('urgence_id','fk_bon_travaux_urgence')->references('id')->on('urgence');
            $table->foreign('equipe_travaux_id','fk_bon_travaux_equipe')->references('id')->on('equipe_travaux');
            $table->foreign('preparation_action_maintenance_id','fk_bon_travaux_preparation')->references('id')->on('preparation_action_maintenance');
            $table->foreign('createur','fk_bon_travaux_createur')->references('id')->on('identite_acces');
            $table->foreign('modificateur','fk_bon_travaux_modificateur')->references('id')->on('identite_acces');
        });
        Schema::create('intervenant',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom');
            $table->string('prenoms')->nullable();
            $table->string('niveau')->nullable();
            $table->integer('equipe_travaux_id',false,true);
            //clés
            //$table->primary('id','pk_intervenant');
            $table->foreign('equipe_travaux_id','fk_intervenant_intervenant')->references('id')->on('equipe_travaux');
        });
        Schema::create('equipe_travaux',function (Blueprint $table){
            $table->increments('id');
            $table->integer('identite_acces_id',false,true);
            $table->string('nom',50);
            $table->integer('chargemaintenance',false,true);
            $table->integer('chefequipe',false,true);
            //clés
            //$table->primary('id','pk_equipe_travaux');
            $table->foreign('identite_acces_id','fk_equipe_identite')->references('id')->on('identite_acces');
            $table->foreign('chargemaintenance','fk_equipe_charge_intervenant')->references('id')->on('intervenant');
            $table->foreign('chefequipe','fk_equipe_chef_intervenant')->references('id')->on('intervenant');
        });
        Schema::create('type_gamme',function (Blueprint $table){
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
        Schema::create('mode_operatoire',function (Blueprint $table){
            $table->integer('type_gamme_id',false,true);
            $table->string('libelle');
            $table->string('observation')->nullable();
            //clé étrangères
            $table->primary('type_gamme_id','pk_mode_operatoire');
            $table->foreign('type_gamme_id','fk_mode_operatoire_gamme')->references('id')->on('type_gamme');
        });
        Schema::create('checklist',function (Blueprint $table){
            $table->integer('type_gamme_id',false,true);
            $table->string('libelle');
            $table->boolean('realisation')->default(true);
            $table->boolean('resultat')->default(true);
            $table->string('observation')->nullable();
            //clés étrangères
            $table->primary('type_gamme_id','pk_checklist');
            $table->foreign('type_gamme_id','fk_checklist_type_gamme')->references('id')->on('type_gamme');
        });
        Schema::create('gamme',function (Blueprint $table){
            $table->increments('id');
            $table->integer('type_gamme_id',false,true);
            $table->integer('ouvrage_id',false,true)->nullable();
            $table->integer('moyen_logistique_id',false,true)->nullable();
            $table->string('analysecommentaire')->nullable();
            $table->boolean('controlefinal',100)->default(false);
            //clé étrangères
            $table->foreign('type_gamme_id','fk_gamme_type_gamme')->references('id')->on('type_gamme');
            $table->foreign('ouvrage_id','fk_gamme_ouvrage')->references('id')->on('ouvrage');
            $table->foreign('moyen_logistique_id','fk_gamme_moyen_logistique')->references('id')->on('moyen_logistique');
        });
        Schema::create('moyen_logistique',function (Blueprint $table){
            $table->integer('gamme_id',false,true);
            $table->string('typetransport',100);
            $table->string('outillage',100)->nullable();
            $table->string('outillagespeciaux',100)->nullable();
            $table->string('outillagespecifique',100)->nullable();
            $table->string('appareilmesure',100)->nullable();
            $table->string('autre',150)->nullable();
            //clés étrangères
            $table->primary('gamme_id','pk_moyen_logistique');
            $table->foreign('gamme_id','fk_moy_logistique_gamme')->references('id')->on('gamme');
        });
        Schema::create('ouvrage',function (Blueprint $table){
            $table->integer('gamme_id',false,true);
            $table->date('dateouvrage');
            $table->string('directionregionale')->nullable();
            $table->string('exploitation')->nullable();
            //clé
            $table->primary('gamme_id','pk_ouvrage');
            $table->foreign('gamme_id','fk_ouvrage_gamme')->references('id')->on('gamme');
        });
        Schema::create('cause_chantier',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
            //cle
            //$table->primary('id','pk_cause_chantier');
        });
        Schema::create('type_operation',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
            //cle
            //$table->primary('id','pk_type_operation');
        });
        Schema::create('preparation_action_maintenance',function (Blueprint $table){
            $table->increments('id');
            $table->date('dateprepa');
            $table->integer('bon_travaux_id',false,true);
            $table->string('numerofpam',20);
            $table->string('localisation',150);
            $table->string('equipement',200)->nullable();
            $table->integer('cause_chantier_id',false,true);
            $table->integer('equipe_travaux_id',false,true);
            $table->string('detailscause')->nullable();
            $table->integer('type_operation_id',false,true);
            $table->integer('titre_operation_id',false,true);
            $table->integer('urgence_id',false,true);
            /*
            $table->string('etudechantierpar')->nullable();
            $table->date('dateetudechantier')->nullable();
            */
            $table->text('recommendation')->nullable();
            $table->string('naturetravaux');
            $table->integer('gamme_id',false,true);
            /*
            $table->integer('joursprevisionel')->default(0);
            $table->integer('heureprevisionelle')->default(0);
            */
            $table->dateTime('dateheuredebutprevi');
            $table->dateTime('dateheurefinprevi');
            $table->string('ouvrageaconsigner');
            $table->boolean('ressoucedisponible')->default(true);
            $table->string('materielspecialdispo');
            $table->string('mesurepartdispo')->nullable();
            $table->string('moyenderemiseetatdispo')->default('RAS');
            $table->string('remarqueobs')->default('RAS');
            //clés
            //$table->primary('id','pk_prepa_action');
            $table->foreign('cause_chantier_id','fk_prepa_action_cause')->references('id')->on('cause_chantier');
            $table->foreign('type_operation_id','fk_prepa_action_type_ope')->references('id')->on('type_operation');
            $table->foreign('titre_operation_id','fk_prepa_action_titre_ope')->references('id')->on('type_operation');
            $table->foreign('urgence_id','fk_prepa_action_urgence')->references('id')->on('urgence');
            $table->foreign('gamme_id','fk_prepa_action_gamme')->references('id')->on('gamme');
            $table->foreign('equipe_travaux_id','fk_prepa_equipe')->references('id')->on('equipe_travaux');
        });
        Schema::create('moyen_humain',function (Blueprint $table){
            $table->integer('preparation_action_maintenance_id',false,true);
            $table->integer('nbrecadre')->default(0);
            $table->integer('nbreagentdemaitrise')->default(0);
            $table->integer('nbreagentemploye')->default(0);
            $table->integer('nbreagentouvrier')->default(0);
            $table->boolean('disponibiliteagentcie')->default(false);
            //clés
            $table->primary('preparation_action_maintenance_id','pk_moyen_humain');
            $table->foreign('preparation_action_maintenance_id','fk_moyen_humain_prepa_action')->references('id')->on('preparation_action_maintenance');
        });
        Schema::create('sollicitation_exterieure',function (Blueprint $table){
            $table->integer('preparation_action_maintenance_id',false,true);
            $table->string('interllocuteur')->nullable();
            $table->date('datecontact')->nullable();
            $table->string('solliciationexprimee')->nullable();
            $table->string('conclusion')->nullable();
            $table->date('rdv')->nullable();
            //cles
            $table->primary('preparation_action_maintenance_id','pk_sollicitation_ext');
            $table->foreign('preparation_action_maintenance_id','fk_sollicitation_prepa_action')->references('id')->on('preparation_action_maintenance');
        });
        Schema::create('document_joint',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom');
            $table->string('description')->nullable();
            $table->integer('preparation_action_maintenance_id',false,true);
            //clés
            //$table->primary('id','pk_documen_joint');
            $table->foreign('preparation_action_maintenance_id','fk_document_prepa_action')->references('id')->on('preparation_action_maintenance');
        });
        Schema::create('coordonnee_gps',function (Blueprint $table){
            $table->integer('preparation_action_maintenance_id',false,true);
            $table->double('longitude');
            $table->double('lattitude');
            //cles
            $table->primary('preparation_action_maintenance_id','pk_coordonnee_gps');
            $table->foreign('preparation_action_maintenance_id','fk_coordonnee_prepa_action')->references('id')->on('preparation_action_maintenance');
        });
        Schema::create('bon_realisation_travail',function (Blueprint $table){
            $table->increments('id');
        });
        Schema::create('rapport_technique_maintenance_curative',function (Blueprint $table){
            $table->integer('preparation_action_maintenance_id',false,true);
            $table->date('daterapport');
            $table->string('reference',50)->unique();
            $table->integer('equipe_travaux_id',false,true);
            //clés
            $table->primary('preparation_action_maintenance_id','pk_rapport_technique');
            $table->foreign('preparation_action_maintenance_id','fk_rapport_technique_prepa_action')->references('id')->on('preparation_action_maintenance');
            $table->foreign('equipe_travaux_id','fk_rapport_technique_equipe_travaux')->references('id')->on('equipe_travaux');
        });
        Schema::create('action_maintenance_curative',function (Blueprint $table){
            $table->integer('action_maintenance_curative_id',false,true);
            $table->string('tachesaccomplies');
            $table->string('intervention')->nullable();
            $table->string('remiseetat')->nullable();
            $table->string('recommandation')->default('RAS');
            $table->string('obsgenerale')->default('RAS');
            //clés
            $table->primary('action_maintenance_curative_id','pk_action_maintenance');
            $table->foreign('action_maintenance_curative_id','fk_action_maintenance_rapport_technique')
                ->references('preparation_action_maintenance_id')->on('rapport_technique_maintenance_curative');

        });
        Schema::create('indicateur_maintenance',function (Blueprint $table){
            $table->integer('action_maintenance_curative_id',false,true);
            $table->dateTime('dateheuredebut');
            $table->dateTime('dateheurefin');
            $table->integer('tempsannexe')->default(0);
            $table->integer('tempsindisponibilite')->default(0);
            //clés
            $table->primary('action_maintenance_curative_id','pk_indicateur_maintenance');
            $table->foreign('action_maintenance_curative_id','fk_indicateur_maintenance_rapport_technique')
                ->references('preparation_action_maintenance_id')->on('rapport_technique_maintenance_curative');
        });
        /*
        Schema::create('',function (Blueprint $table){

        });
        Schema::create('',function (Blueprint $table){

        });
        Schema::create('',function (Blueprint $table){

        });
        Schema::create('',function (Blueprint $table){

        });
        Schema::create('',function (Blueprint $table){

        });
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
        Schema::dropIfExists('type_identite');
        Schema::dropIfExists('identite_acces');
        Schema::dropIfExists('utilisateur');
        Schema::dropIfExists('urgence');
        Schema::dropIfExists('etat_bon');
        Schema::dropIfExists('bon_travaux');
        Schema::dropIfExists('ouvrage');
        Schema::dropIfExists('mode_operatoire');
        Schema::dropIfExists('type_gamme');
        Schema::dropIfExists('checklist');
        Schema::dropIfExists('moyen_logistique');
        Schema::dropIfExists('gamme');
        Schema::dropIfExists('preparation_action_maintenance');
        Schema::dropIfExists('type_operation');
        Schema::dropIfExists('moyen_humain');
        Schema::dropIfExists('sollicitation_exterieure');
        Schema::dropIfExists('coordonnee_gps');
        Schema::dropIfExists('document_joint');
        Schema::dropIfExists('cause_chantier');
        Schema::dropIfExists('equipe_travaux');
        Schema::dropIfExists('intervenant');
        Schema::dropIfExists('bon_realisation_travail');
        Schema::dropIfExists('rapport_technique_maintenance_curative');
        Schema::dropIfExists('action_maintenance_curative');
        Schema::dropIfExists('indicateur_maintenance');
    }
}
