<?php

use App\Http\Controllers\CreateCompteController;
use App\Http\Controllers\DetailEmployeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DossiersController;
use App\Http\Controllers\ListeEmployerController;
use App\Http\Controllers\PersController;
use App\Http\Controllers\EmployeurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return view('index_accueil');
})->name('accueil_perso');

Route::get('sign_in', function () {
    return view('auth.connexion');
})->name('sign-in');



Route::get('create-compte', [CreateCompteController::class,'index'])->name('create-compte');
Route::post('create+compte+client',[CreateCompteController::class,"nouveau_compte_entreprise"])->name('new_create_compte');


Route::get('/info_legale', function () {
    return view('/info_legale');
});
Route::get('contact', function () {
    return view('contact');
});
Route::get('contacts', function () {
    return view('contacts');
});
Route::get('/politique_confidentialite', function () {
    return view('/politique_confidentialite');
})->name('politique_confidentialite');

Route::get('/politique_confidentialites', function () {
    return view('/politique_confidentialites');
});
Route::get('/tarifs', function () {
    return view('/tarif');
});

Route::get('condition_generale_de_vente', 'ConditionController@index')->name('condition_generale_de_vente');
Route::post('/employe', [HomeController::class, 'detail_historique_employe'])->name('historique_employe');

Route::post('/employe', [HomeController::class, 'detail_historique_employe'])->name('historique_employe');
Route::get('/employe.liste', [HomeController::class, 'liste_employe'])->name('employe.liste');
Route::post('/ajout_historique_salaire', [HomeController::class, 'nouveau_historique_salaire'])->name('new_histo_salaire');

Route::post('/ajout_historique_emploi', [HomeController::class, 'ajout_historique_emploi'])->name('new_histo_emploi');
Route::get('/detail+personnel', [PersController::class, 'getDetailPers'])->name('detail_employe');

Route::get('/detail+salaire', [HomeController::class, 'getDetailSalaire'])->name('details_salaire');

Route::get('/detail+emploi', [HomeController::class, 'getDetailEmploi'])->name('details_emploi');

Route::post('/ajout_pers_a_charge', [HomeController::class, 'storePersCharge'])->name('charge_pers');

Route::post('/ajout_contact_urgence', [HomeController::class, 'storeContactUrgence'])->name('contact_urgence');
// Route détails personnels

Route::get('/details_pers', [HomeController::class, 'detailsPers'])->name('details_pers');

Route::post('/ajout_materiel', [PersController::class, 'ajoutMateriel'])->name('ajout_materiel');

Route::get('/rendre+materiel/{id}' ,[PersController::class,'rendreMateriel'])->name('rendre_materiel');
Route::get('Information+generale+employe/rendre+materiel/{id}' ,[DetailEmployeController::class,'rendreMateriel']);


Route::post('/information_sanitaire', [HomeController::class, 'infoamation_sanitaire'])->name('InsertInfo');

Route::post('', [HomeController::class, 'infoamation_sanitaire'])->name('InsertInfo');
// Modification Niaina

Route::post('/detail+personnel/{id}', [PersController::class, 'updateDetailPers'])->name('update_employe');

Route::post('/contact+personnel/{id}', [PersController::class, 'updateContact'])->name('update_contact');

Route::post('/add+pers_charge', [PersController::class, 'setPersCharge'])->name('add_persCharge');

Route::post('/add+contact_urgence', [PersController::class, 'setContactUrgence'])->name('add_contactUrgence');

Route::post('/noveau_contrat', [HomeController::class, 'nouveau_contrat'])->name('noveau_contrat');

Route::get('/detail+sanction', [HomeController::class,'getDetailSanction'])->name('details_sanctions');
Route::get('/detail+dossier',[DossiersController::class,'getDetailDossier'])->name('details_dossiers');
Route::get('/ajout+document',[DossiersController::class,'InsertDocument'])->name('ajout_document');

Route::post('/ajout_historique_sanctions', [Homecontroller::class,'ajoutSanction'])->name('new_histo_sanctions');


Route::get('/lever+sanction/{id}', [HomeController::class, 'changeSupprimer'])->name('lever_sanction');

Route::post('/modifier+sanction', [HomeController::class, 'modifierSanction'])->name('modifier_sanction');

Route::get('/restaurer+sanction/{id}', [HomeController::class, 'restaurerSanction'])->name('restaurer_sanction');

Route::get('/getDureeSanction/{sanction_id}',[HomeController::class,'getDureeSanction']);

Route::post('/information_sanitaire', [HomeController::class, 'infoamation_sanitaire'])->name('InsertInfo');

Route::post('', [HomeController::class, 'infoamation_sanitaire'])->name('InsertInfo');

Route::get('/getGroupeEmploi/{categ_id}', [HomeController::class, 'getGroupeEmploi']);

Route::get('Information+generale+employe/{id}', [DetailEmployeController::class, 'getDetailEmploye'])->name('detail.employe');

Route::get('detail+emploi+employe/{id}', [DetailEmployeController::class, 'getDetailEmplois'])->name('detail.emploi');

Route::get('detail+salaire+employe/{id}', [DetailEmployeController::class, 'getDetailSalaires'])->name('detail.salaire');

Route::get('detail+sanction+employe/{id}', [DetailEmployeController::class, 'getDetailSanction'])->name('detail.sanction');

Route::get('/liste_employer_grille', [ListeEmployerController::class, 'listes_employes_par_grille']);

Route::get('/liste_employer_list',[ListeEmployerController::class,'liste_employe_par_liste']);

Route::get('/recherche_departement/{id}',[ListeEmployerController::class,'recherche_departement']);

Route::get('/recherche_branche/{id}',[ListeEmployerController::class,'recherche_branche']);

Route::post('/detail+personnel/{id}', [PersController::class, 'updateDetailPers'])->name('update_employe');

Route::post('/contact+personnel/{id}', [PersController::class, 'updateContact'])->name('update_contact');

Route::post('/organisme+sociale/{id}', [PersController::class, 'updateOrganismeSocials'])->name('update_organisme_sociale');

Route::post('/add+pers_charge', [PersController::class, 'setPersCharge'])->name('add_persCharge');

Route::post('/delete+pers_charge', [PersController::class, 'deletePersCharge'])->name('delete_persCharge');

Route::post('/refresh+contact_urgence', [PersController::class, 'refreshContactUrgence'])->name('refresh_contactUrgence');

Route::post('/delete+contact_urgence',[PersController::class,'deleteContactUrgence'])->name('delete_contactUrgence');

Route::post('/mettre_demission',[HomeController::class,'mettre_demission'])->name('mettre_demission');

Route::post('/add+prime',[HomeController::class,'addPrime'])->name('add_prime');

Route::post('/add+av_nat', [HomeController::class, 'addAvNat'])->name('add_av_nat');
Route::get('/detail_salaire', [HomeController::class, 'informprime_indemnite']);
Route::post('/detail+salaire', [HomeController::class, 'insertprime_indemnite'])->name('insertprime_indemnite');

Route::get('/detail_salaire', [HomeController::class, 'insertformAvantageEnNature']);
Route::post('/detail_salaire', [HomeController::class, 'insertAvantageEnNature'])->name('insertAvantageEnNature');


Route::get('/employes.export.verify_matricule_stg',[EmployerController::class,'verify_matricule_stg'])->name('employes.export.verify_matricule_stg');
Route::get('/employes.export.verify_email_stg',[EmployerController::class,'verify_email_stg'])->name('employes.export.verify_email_stg');
Route::get('/employes.export.verify_cin_stg',[EmployerController::class,'verify_cin_stg'])->name('employes.export.verify_cin_stg');
Route::post('/save_multi_stagiaire_exproter_excel',[EmployerController::class,'save_multi_stagiaire'])->name('save_multi_stagiaire_exproter_excel');
Route::post('/employeur',[EmployeurController::class,'store'])->name('employeur.store');

Route::get('affichage_role',[CreateCompteController::class,'affichage_role'])->name('affichage_role');

Route::get('change_role_user/{user_id}/{role_id}',[CreateCompteController::class,'change_role_user'])->name('change_role_user');
require __DIR__ . '/auth.php';
