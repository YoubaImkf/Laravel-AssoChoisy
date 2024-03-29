<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mailController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsletterController;

/* SITE REALISER par Ait Ouali Ahmid, Remy Bazile, Bénédicte Loumou, 
                    Wayra Lopez, Imakhlaf Youba.                    */

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

Route::get('/',[ // pareil que acceuil 
    'as'=>'chemin_accueil',
    'uses'=>'App\Http\Controllers\pages@accueil'  

]);




/*--------------------------------ROUTE USERS------------------------------------------*/


Route::get('accueil',[
    'as'=>'chemin_accueil',
    'uses'=>'App\Http\Controllers\pages@accueil'  //faut mettre tout le chemin
]);

Route::get('activite/{id}',[
    'as'=>'chemin_activite',
    'uses'=>'App\Http\Controllers\pages@activite'  //faut mettre tout le chemin
]);

Route::get('article/{id}',[
    'as'=>'chemin_article',
    'uses'=>'App\Http\Controllers\pages@article'
]);

Route::get('apropos',[
    'as'=>'chemin_apropos',
    'uses'=>'App\Http\Controllers\pages@apropos'
]);

//                                            ↓ justilise celle de base ↓
// Route::view('reservation','vu_reservation')->name('chemin_reservation'); ↓
Route::get('reservation',[
    'as'=>'chemin_reservation',
    'uses'=>'App\Http\Controllers\pages@reservation'
]);

// Route::post('ajoutReservation',[
//     'as'=>'chemin_ajoutReservation',
//     'uses'=>'App\Http\Controllers\pages@ajoutReservation'
// ]);


Route::Post('/send',[mailController::class,'send'])->name('send.email');


Route::get('contact',[
    'as'=>'chemin_contact',
    'uses'=>'App\Http\Controllers\pages@contact'
]);

Route::Post('/send2',[mailController::class,'send2'])->name('send.email2');


Route::get('adherer',[
    'as'=>'chemin_adherer',
    'uses'=>'App\Http\Controllers\pages@adherer'
]);

Route::post('uplaodFichier',[
    'as'=>'chemin_uplaodFichier',
    'uses'=>'App\Http\Controllers\pages@uplaodFichier'
]);


Route::get('mentions-legales',[
    'as'=>'chemin_mentionLegal',
    'uses'=>'App\Http\Controllers\pages@mentionLegal'
]);


Route::get('politique-de-confidentialite',[
    'as'=>'chemin_confidentialite',
    'uses'=>'App\Http\Controllers\pages@confidentialite'
]);

// Route::get('interAsso',[
//     'as'=>'chemin_gestionFrais',
//     'uses'=>'gererFraisController@saisirFrais'
// ]);


/*--------------------------------ROUTE ADMINISTRER------------------------------------------*/

Route::get('connexion',[
    'as'=>'chemin_connexion',
    'uses'=>'App\Http\Controllers\administrer@connexion'
]);

Route::post('controler',[
    'as'=>'chemin_connecter',
    'uses'=>'App\Http\Controllers\administrer@connecter'
]);

Route::get('activite-Update/{id}',[
    'as'=>'chemin_activiteUpdate',
    'uses'=>'App\Http\Controllers\administrer@activiteUpdate'  //faut mettre tout le chemin
]);


Route::get('modifier/{id}',[
    'as'=>'chemin_modifier',
    'uses'=>'App\Http\Controllers\administrer@modifier'  //faut mettre tout le chemin
]);

Route::post('enregModification',[
    'as'=>'chemin_enregModification',
    'uses'=>'App\Http\Controllers\administrer@enregModification'
]);


Route::get('ajouter',[
    'as'=>'chemin_ajouter',
    'uses'=>'App\Http\Controllers\administrer@ajouter'
]);

Route::post('enregAjouter',[
    'as'=>'chemin_enregAjouter',
    'uses'=>'App\Http\Controllers\administrer@enregAjouter'
]);

Route::get('supprimer/{id}',[
    'as'=>'chemin_supprimer',
    'uses'=>'App\Http\Controllers\administrer@supprimer'
]);


Route::get('accueil-Admin',[
    'as'=>'chemin_accueilAdmin',
    'uses'=>'App\Http\Controllers\administrer@accueilAdmin'
]);







Route::get('deconnexion',[
    'as'=>'chemin_deconnexion',
    'uses'=>'App\Http\Controllers\administrer@deconnecter'
]);




//(---------------  NEWS-LETTER  -------------)
Route::post('newsletter/store',[NewsletterController::class,'store']);


