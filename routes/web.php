<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * Pages relatives aux actions admins
 */
Route::prefix('/admin')->name('admin.')->group(function() {
    Route::get('/', function () {
        return [
            "link" => \route('page.show',['slug' => 'article', 'id' => 13])
        ];
    })->name('index');;

    Route::get('/{slug}-{id}', function (string $slug, string $id, Request $request) {
        return [
            "slug"=> $slug,
            "id"=> $id,
            "name" => $request->input('name', 'non-stipuler')
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
});

/*
 * Pages relatives aux evenements
 * aka la soirée jeu
 */
Route::prefix('/events')->name('events.')->group(function() {
    Route::get('/', [EventController::class,'index'])->name('index');;

    //Page d'ajout d'un evennement (formulaire)
    Route::get('/add', [EventController::class,'add'])->name('add');
    //Pour le retour de formulaire
    Route::post('/add', [EventController::class,'store']);
    //Page d'edition d'un evennement (formulaire)
    Route::get('/edit', [EventController::class,'edit'])->name('edit');
    //Pour le retour de formulaire
    Route::post('/edit', [EventController::class,'update']);

    //Gere un evenement specifique
    Route::prefix('/{event:slug}')->name('one.')->group(function() {

        Route::get('/', [EventController::class,'show'] )->where([
            'event' => '[a-z0-9\-]+'
        ])->name('show');

        //Affiche un creneau
        Route::get('/creneau-{id_creneau}', function (string $slug, string $id,string $id_creneau,  Request $request) {
            return [
                "page" => "creneau",
                "id_creneau" => $id_creneau,
                "name" => $request->input('name', 'non-stipuler')
            ];
        })->where([
            'id_creneau' => '[0-9]+'
        ])->name('tablesindex');

        //Affiche une table specifique du creneau
        Route::get('creneau-{id_creneau}/table-{nom_table}', function (string $slug, string $id,string $id_creneau, string $nom_table, Request $request) {
            return [
                "page" => "table",
                "nom_table" => $nom_table,
                "id_creneau" => $id_creneau,
                "name" => $request->input('name', 'non-stipuler')
            ];
        })->where([
            'id_creneau' => '[0-9]+'
        ])->name('tables.show');

        Route::get('creneau-{id_creneau}/add-table', function (string $slug, string $id,string $id_creneau, Request $request) {
            return [
                "page" => "ajout de table",
                "id_creneau" => $id_creneau,
                "name" => $request->input('name', 'non-stipuler')
            ];
        })->where([
            'id' => '[0-9]+',
            'slug' => '[a-z0-9\-]+'
        ])->name('tables.ajout');
    });
});

/*
 * Pages relatives aux jeux
 */
Route::prefix('/jeux')->name('jeux.')->group(function() {
    //Affiche la liste de jeux sur le site
    Route::get('/', function () {
        return [
            "link" => \route('page.show',['slug' => 'article', 'id' => 13])
        ];
    })->name('index');;

    //Page d'ajout d'un jeu. (Vue formulaire ? )
    Route::get('/add', function () {
        return [
            "link" => \route('page.show',['slug' => 'article', 'id' => 13])
        ];
    })->name('add');

    //Affiche un jeu specifique
    Route::get('/{slug}-{id}', function (string $slug, string $id, Request $request) {
        return [
            "slug"=> $slug,
            "id"=> $id,
            "name" => $request->input('name', 'non-stipuler')
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
});
