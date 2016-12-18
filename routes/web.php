<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
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

Route::group(['prefix' => \App\Autorisation::DIRECTEUR],function (){
    Route::get('/','DirecteurController@index');
    Route::get('/home','DirecteurController@index')->name('accueil_'.\App\Autorisation::DIRECTEUR);
    Route::get('/profile','DirecteurController@editProfil')->name('profile_'.\App\Autorisation::DIRECTEUR);
});
Route::group(['prefix' => \App\Autorisation::RBOM],function (){
    Route::get('/','RtmController@index');
    Route::get('home','RbomController@index')->name('accueil_'.\App\Autorisation::RBOM);
    Route::get('profile','RbomController@editProfil')->name('profile_'.\App\Autorisation::RBOM);
    //Bon travaux
    Route::get('bontravaux/nouveau','RbomController@showNewFormBT')->name('nouveau_bt');
    Route::post('bontravaux/nouveau','RbomController@sendResponseNewBT');
    Route::get('bontravaux/{initiateur}/modifier','RbomController@showEditFormBT')->name('modifier_bt');
    Route::post('bontravaux/{initiateur}/modifier','RbomController@sendResponseEditFormBT');
    Route::get('bontravaux/{initiateur}/supprimer','RbomController@sendResponseDeleteBT')->name('supprimer_bt');
    Route::get('bontravaux','RbomController@showListBT')->name('liste_bt');
    Route::get('bontravaux/json','RbomController@JsonListBT')->name('liste_bt_json');
    //Maps
    Route::get('map','Map\MapsApiController@Index')->name('map');
    Route::get('map/pointopoint/BT{bt}FPAM{fpam?}','Map\MapsApiController@showItinerairePoinToPoint')->name('pointopoint');
    //Fpam
    Route::post('fpam/{initiateur}/nouveau','RbomController@sendResponseNewFPAM');
    Route::get('fpam/{initiateur}/nouveau','RbomController@showNewFormFPAM')->name('nouveau_fpam');
    Route::get('fpam/{initiateur}/modifier','RbomController@showUpdateFormFPAM')->name('modifier_fpam');
    Route::get('fpam','RbomController@showListFPAM')->name('liste_fpam');
    Route::get('fpam/json','RbomController@JsonListFPAM')->name('liste_fpam_json');
    Route::get('fpam/{initiateur}/supprimer','RbomController@sendResponseDeleteFPAM')->name('supprimer_fpam');
    //Planning
    Route::get('planning/{jour?}/{mois?}/{annee?}','RbomController@showPlanning')->name('planning');
    Route::post('planning/edit','RbomController@sendResponsePlanning')->name('save_planning');
});
Route::group(['prefix' => \App\Autorisation::ADMIN],function (){
    Route::get('/','adminController@index');
    Route::get('home','adminController@index')->name('accueil_'.\App\Autorisation::ADMIN);
    Route::get('profile','adminController@editProfil')->name('profile_'.\App\Autorisation::ADMIN);
    //Utilisateurs
    Route::get('utilisateur/nouveau','adminController@showNewFormUser')->name('nouveau_user');
    Route::post('utilisateur/nouveau','adminController@sendResponseFormUser');
    Route::get('utilisateur/Identite/{id}/modifier','adminController@showUpdateFormUser')->name('modif_utilisateur');
    Route::post('utilisateur/Identite/{id}/modifier','adminController@sendResponseUpdateUser');
    Route::get('utilisateurs','adminController@showListUsers')->name('liste_users');
    //Intervenants
    Route::get('intervenants','adminController@showListIntervenants')->name('liste_intervenants');
    Route::get('intervenant/nouveau','adminController@showNewFormIntervenant')->name('nouveau_intervenant');
    Route::post('intervenant/nouveau','adminController@sendResponseNewIntervenant');
    Route::get('intervenant/{id}/modifier','adminController@showUpdateIntervenantForm')->name('modif_intervenant');
    Route::post('intervenant/{id}/modifier','adminController@sendResponseUpdateIntervenant');
    //Type de gamme
    Route::get('typegamme/nouveau','adminController@showNewTypeGammeForm')->name('nouveau_typegamme');
    Route::post('typegamme/nouveau','adminController@sendResponseNewTypeGamme');
    Route::get('typegammes/gamme/{id}/modfier','adminController@showUpdateTypeGamme')->name('modif_typegamme');
    Route::post('typegammes/gamme/{id}/modfier','adminController@sendResponseUpdateTypeGamme');
    Route::get('typegammes','adminController@showListTypeGamme')->name('liste_typegamme');
    //Check-list
    Route::get('checklist/nouveau','adminController@showNewChecklist')->name('nouveau_checklist');
    Route::post('checklist/nouveau','adminController@sendResponseNewChecklist');

    Route::get('checklists','adminController@showListeChecklist')->name('liste_checklist');
    Route::get('checklists/{id}','adminController@jsonListeChecklist')->name('json_checklist');
});

Route::group(['prefix' => \App\Autorisation::RTM],function (){
    Route::get('/','RtmController@index');
    Route::get('home','RtmController@index')->name('accueil_'.\App\Autorisation::RTM);
    Route::get('profile','RtmController@editProfil')->name('profile_'.\App\Autorisation::RTM);
});
Route::group(['prefix' => \App\Autorisation::EQUIPE_TRAVAUX],function (){
    Route::get('/','EquipeController@index');
    Route::get('home','EquipeController@index')->name('accueil_'.\App\Autorisation::EQUIPE_TRAVAUX);
    Route::get('gamme/verification/{fpam}/edit','EquipeController@showNewFormCheckGamme')->name('edit_checkgamme');
    Route::post('gamme/checklist/add','EquipeController@sendResponseCheckList')->name('save_checklist');
    Route::get('profile','EquipeController@editProfil')->name('profile_'.\App\Autorisation::EQUIPE_TRAVAUX);
    Route::get('gamme/{fpam}/edit','EquipeController@showNewFormGamme')->name('edit_gamme');

});
Route::group(['prefix' => \App\Autorisation::CIE],function (){
    Route::get('/','CieController@index');
    Route::get('home','CieController@index')->name('accueil_'.\App\Autorisation::CIE);
    Route::get('profile','CieController@editProfil')->name('profile_'.\App\Autorisation::CIE);
});