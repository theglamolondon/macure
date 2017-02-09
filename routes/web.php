<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
*/
// Authentication Routes...
Route::get('/','Auth\LoginController@showLoginForm');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Notifications routes
Route::get('notifications/{user}', 'NotificationController@index')->name('mes_notifications');
Route::get('notification/{notification}','NotificationController@update')->name('lire_notification');
Route::post('notification/commentaire/nouveau','NotificationController@addNewCommentForUser')->name('nouveau_commentaire');

//PDF
Route::get('pdf/planning/bontravaux/{annee?}/{mois?}/{jour?}','PdfController@planningBT')->name('pdf_planning_bt');
Route::get('pdf/planning/ouvrage/{annee?}','PdfController@planningOuvrage')->name('pdf_planning_ouvrage');
Route::get('pdf/planning/fpam/{annee?}/{mois?}/{jour?}','PdfController@planningFPAM')->name('pdf_planning_fpam');

Route::group(['prefix' => \App\Autorisation::DIRECTEUR, 'middleware' => ['auth','policy','role']],function (){
    Route::get('/','DirecteurController@index');
    Route::get('/home','DirecteurController@index')->name('accueil_'.\App\Autorisation::DIRECTEUR);
    Route::get('/profile','DirecteurController@editProfil')->name('profile_'.\App\Autorisation::DIRECTEUR);
    Route::get('/tableaubord','AdminController@index')->name('tableau_bord');
    Route::get('/statistique','DirecteurController@statistiques')->name('statistiques');
    Route::get('/planning/ouvrage/{annee?}','DirecteurController@ouvrage')->name('plan_ouvrage_directeur');
    Route::get('/planning/bontravaux/{annee?}/{mois?}/{jour?}','DirecteurController@bontravaux')->name('plan_bt_directeur');
    Route::get('/planning/fpam/{jour?}/{mois?}/{annee?}','DirecteurController@fpam')->name('plan_fpam_directeur');
});

Route::group(['prefix' => \App\Autorisation::RBOM, 'middleware' => ['auth','policy','role']],function (){
    Route::get('/','RtmController@index');
    Route::get('home','RbomController@index')->name('accueil_'.\App\Autorisation::RBOM);
    Route::get('profile','RbomController@editProfil')->name('profile_'.\App\Autorisation::RBOM);
    //Bon travaux
    Route::get('bontravaux/nouveau/{reference?}','RbomController@showNewFormBT')->name('nouveau_bt');
    Route::post('bontravaux/nouveau','RbomController@sendResponseNewBT');
    Route::get('bontravaux/{initiateur}/modifier','RbomController@showUpadetFormBT')->name('modifier_bt');
    Route::post('bontravaux/{initiateur}/modifier','RbomController@sendResponseUpdateBT');
    Route::get('bontravaux/{initiateur}/supprimer','RbomController@sendResponseDeleteBT')->name('supprimer_bt');
    Route::get('bontravaux','RbomController@showListBT')->name('liste_bt');
    Route::get('bontravaux/json','RbomController@JsonListBT')->name('liste_bt_json');
    Route::get('bontravaux/planning/{annee?}/{mois?}/{jour?}','RbomController@planningBT')->name('planning_bt');
    Route::get('bontravaux/planning/week/{annee}/{mois}/{jour}','RbomController@listeBTofWeek')->name('planning_bt_json');
    Route::get('bontravaux/plan/week/{jour?}/{mois?}/{annee?}','RbomController@angularTemplate')->name('template_angular');
    Route::post('bontravaux/planning','RbomController@sendResponseMakePlanBT')->name('plan_bt');
    //Ouvrage
    Route::get('ouvrage/nouveau','RbomController@showNewOuvrageForm')->name('nouveau_ouvrage');
    Route::post('ouvrage/nouveau','RbomController@sendResponseNewOuvrageForm');
    Route::get('ouvrage/{id}/modifier','RbomController@showUpdateOuvrageForm')->name('modifier_ouvrage');
    Route::post('ouvrage/{id}/modifier','RbomController@sendResponseUpdateOuvrageForm');
    Route::get('ouvrages','RbomController@showListOuvrage')->name('liste_ouvrage');
    Route::get('ouvrage/planning/annuel/{annee?}','RbomController@planningOuvrageAnnuel')->name('planning_ouvrage_annuel');
    Route::get('ouvrage/planning/trimestriel/{annee?}/{trimestre?}','RbomController@planningOuvrageTrimestriel')->name('planning_ouvrage_trimestriel');
    Route::get('ouvrage/planning/mensuel/{mois?}/{annee?}','RbomController@planningOuvrageMensuel')->name('planning_ouvrage_mensuel');
    //Maps
    Route::get('map','Map\MapsApiController@Index')->name('map');
    Route::get('map/pointopoint/BT{bt}FPAM{fpam?}','Map\MapsApiController@showItinerairePoinToPoint')->name('pointopoint');
    //Fpam
    Route::post('fpam/{initiateur}/nouveau','RbomController@sendResponseNewFPAM');
    Route::get('fpam/{initiateur}/nouveau','RbomController@showNewFormFPAM')->name('nouveau_fpam');
    Route::get('fpam/{initiateur}/modifier','RbomController@showUpdateFormFPAM')->name('modifier_fpam');
    Route::post('fpam/{initiateur}/modifier','RbomController@sendResponseUpdateFPAM');
    Route::get('fpam','RbomController@showListFPAM')->name('liste_fpam');
    Route::get('fpam/json','RbomController@JsonListFPAM')->name('liste_fpam_json');
    Route::get('fpam/{initiateur}/supprimer','RbomController@sendResponseDeleteFPAM')->name('supprimer_fpam');
    //Planning
    Route::get('planning/{jour?}/{mois?}/{annee?}','RbomController@showPlanning')->name('planning');
    Route::post('planning/edit','RbomController@sendResponsePlanning')->name('save_planning');
});

Route::group(['prefix' => \App\Autorisation::ADMIN, 'middleware' => ['auth','policy','role']],function (){
    Route::get('/','AdminController@index');
    Route::get('home','AdminController@index')->name('accueil_'.\App\Autorisation::ADMIN);
    Route::get('profile','AdminController@editProfil')->name('profile_'.\App\Autorisation::ADMIN);
    //Utilisateurs
    Route::get('utilisateur/nouveau','AdminController@showNewFormUser')->name('nouveau_user');
    Route::post('utilisateur/nouveau','AdminController@sendResponseFormUser');
    Route::get('utilisateur/identite/{id}/modifier','AdminController@showUpdateFormUser')->name('modif_utilisateur');
    Route::post('utilisateur/identite/{id}/modifier','AdminController@sendResponseUpdateUser');
    Route::get('utilisateurs','AdminController@showListUsers')->name('liste_users');
    //Intervenants
    Route::get('intervenants','AdminController@showListIntervenants')->name('liste_intervenants');
    Route::get('intervenant/nouveau','AdminController@showNewFormIntervenant')->name('nouveau_intervenant');
    Route::post('intervenant/nouveau','AdminController@sendResponseNewIntervenant');
    Route::get('intervenant/{id}/modifier','AdminController@showUpdateIntervenantForm')->name('modif_intervenant');
    Route::post('intervenant/{id}/modifier','AdminController@sendResponseUpdateIntervenant');
    //Type de gamme
    Route::get('typegamme/nouveau','AdminController@showNewTypeGammeForm')->name('nouveau_typegamme');
    Route::post('typegamme/nouveau','AdminController@sendResponseNewTypeGamme');
    Route::get('typegammes/gamme/{id}/modfier','AdminController@showUpdateTypeGamme')->name('modif_typegamme');
    Route::post('typegammes/gamme/{id}/modfier','AdminController@sendResponseUpdateTypeGamme');
    Route::get('typegammes','AdminController@showListTypeGamme')->name('liste_typegamme');
    //Check-list
    Route::get('checklist/nouveau','AdminController@showNewChecklist')->name('nouveau_checklist');
    Route::post('checklist/nouveau','AdminController@sendResponseNewChecklist');
    Route::get('checklist/{id}/modifier','AdminController@showUpdateChecklist')->name('modif_ckecklist');
    Route::post('checklist/{id}/modifier','AdminController@sendResponseUpdateChecklist');
    Route::get('checklists','AdminController@showListeChecklist')->name('liste_checklist');
    Route::get('checklists/{id}','AdminController@jsonListeChecklist')->name('json_checklist');
});

Route::group(['prefix' => \App\Autorisation::RTM, 'middleware' => ['auth','policy','role']],function (){
    Route::get('/','RtmController@index');
    Route::get('home','RtmController@index')->name('accueil_'.\App\Autorisation::RTM);
    Route::get('profile','RtmController@editProfil')->name('profile_'.\App\Autorisation::RTM);
    Route::get('equipe/{id}/modifier','RtmController@showUpdateFormEquipe')->name('modifier_equipe');
    Route::post('equipe/{id}/modifier','RtmController@sendResponseUpdateFormEquipe');
    Route::get('equipe/{id}/details','RtmController@showDetailsEquipe')->name('details_equipe');
    Route::get('equipes','RtmController@showListEquipe')->name('liste_equipe');
});

Route::group(['prefix' => \App\Autorisation::RGS, 'middleware' => ['auth','policy','role']],function (){
    Route::get('/','StockController@index');
    Route::get('home','StockController@index')->name('accueil_'.\App\Autorisation::RGS);
    Route::get('profile','StockController@editProfil')->name('profile_'.\App\Autorisation::RGS);
    Route::get('produit/nouveau','StockController@showNewFormProduit')->name('nouveau_produit');
    Route::get('famille/nouvelle','StockController@showNewFormFamille')->name('nouvelle_famille');
    Route::post('produit/nouveau','StockController@sensResponseNewProduit');
    Route::post('famille/nouvelle','StockController@sensResponseNewFamille');
    Route::get('produit/{reference}/modifier','StockController@showFormUpdateProduit')->name('modifier_produit');
    Route::get('famille/{id}/modifier','StockController@showFormUpdateFamille')->name('modifier_famille');
    Route::post('produit/{reference}/modifier','StockController@sensResponseUpdateProduit');
    Route::post('famille/{id}/modifier','StockController@sensResponseUpdateFamille');
    Route::get('produit/{reference}/supprimer','StockController@sendResponseDeleteProduit')->name('supprimer_produit');
    Route::get('famille/{id}/supprimer','StockController@sendResponseDeleteFamille')->name('supprimer_famille');
    Route::get('produit','StockController@showListProduit')->name('liste_produit');
    Route::get('famille','StockController@showListFamille')->name('liste_famille');
});

Route::group(['prefix' => \App\Autorisation::EQUIPE_TRAVAUX, 'middleware' => ['auth','policy','role']],function (){
    Route::get('/','EquipeController@index');
    Route::get('home','EquipeController@index')->name('accueil_'.\App\Autorisation::EQUIPE_TRAVAUX);
    Route::get('gamme/verification/{fpam}/edit','EquipeController@showNewFormCheckGamme')->name('edit_checkgamme');
    Route::post('gamme/checklist/add','EquipeController@sendResponseCheckList')->name('save_checklist');
    Route::get('profile','EquipeController@editProfil')->name('profile_'.\App\Autorisation::EQUIPE_TRAVAUX);
    Route::get('gamme/{fpam}/edit','EquipeController@showNewFormGamme')->name('edit_gamme');
    Route::get('planning/{jour?}/{mois?}/{annee?}','EquipeController@showPlanning')->name('planning_equipe');
});

Route::group(['prefix' => \App\Autorisation::CIE, 'middleware' => ['auth','policy','role']],function (){
    Route::get('/','CieController@index');
    Route::get('home','CieController@index')->name('accueil_'.\App\Autorisation::CIE);
    Route::get('profile','CieController@editProfil')->name('profile_'.\App\Autorisation::CIE);
});