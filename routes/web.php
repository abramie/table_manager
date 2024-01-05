<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CreneauController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TriggerwarningController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

/*
 * Pages relatives aux actions admins
 */
Route::prefix('/admin')->name('admin.')->group(function () {

    Route::view('/', 'admin.index')->name('index');
    Route::get('/{slug}-{id}', function (string $slug, string $id, Request $request) {
        return [
            "slug" => $slug,
            "id" => $id,
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
Route::prefix('/events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');;

    //Page d'ajout d'un evennement (formulaire)
    Route::get('/add', [EventController::class, 'add'])->name('add');
    //Pour le retour de formulaire
    Route::post('/add', [EventController::class, 'store']);


    //Gere un evenement specifique
    Route::prefix('/{evenement:slug}')->name('one.')->where([
        'evenement' => '[a-z0-9\-]+'
    ])->group(function () {

        Route::get('/', [EventController::class, 'show'])->name('show');

        //Page d'edition d'un evennement (formulaire)
        Route::get('/edit', [EventController::class, 'edit'])->name('edit');
        Route::post('/edit', [EventController::class, 'update']);
        //Ajout creneau
        Route::get('/add', [CreneauController::class, 'add'])->name('add');
        Route::post('/add', [CreneauController::class, 'store']);

        Route::prefix('/creneau-{creneau:id}')->where(['creneau' => '[0-9]+'])->name('creneau.')->group(function () {
            //Affiche un creneau
            Route::get('/', [CreneauController::class, 'index'])->name('tablesindex');//->withoutScopedBindings();
            //Edit creneau
            Route::get('/edit', [CreneauController::class, 'edit'])->name('edit');
            Route::post('/edit', [CreneauController::class, 'update'])->name('edit');
            Route::get('/delete', [CreneauController::class, 'delete'])->name('delete');


            //Formulaires

            Route::get('/add-table', [TableController::class, 'add'])->name('tables.add');
            Route::post('/add-table', [TableController::class, 'store']);

            Route::prefix('/table-{table}')->where(['table' => '[0-9]+'])->name('table.')->group(function () {
                //Affiche une table specifique du creneau
                Route::get('/edit', [TableController::class, 'edit'])->name('edit');
                Route::post('/edit', [TableController::class, 'update']);
                Route::get('/', [TableController::class, 'show'])->name('show');
                Route::get('/inscription', [TableController::class, 'todo'])->name('inscription');
            });
        });
    });
});


Route::prefix('/tags')->name('tags.')->group(function () {
    Route::get('/add', [TagsController::class, 'add'])->name('add');
    Route::post('/add', [TagsController::class, 'store']);
});

Route::prefix('/triggerwarning')->name('tw.')->group(function () {
    Route::get('/add', [TriggerwarningController::class, 'add'])->name('add');
    Route::post('/add', [TriggerwarningController::class, 'store']);
});
/*
 * Pages relatives aux jeux
 */
Route::prefix('/jeux')->name('jeux.')->group(function () {
    //Affiche la liste de jeux sur le site
    Route::get('/', function () {
        return [
            "link" => \route('page.show', ['slug' => 'article', 'id' => 13])
        ];
    })->name('index');;

    //Page d'ajout d'un jeu. (Vue formulaire ? )
    Route::get('/add', function () {
        return [
            "link" => \route('page.show', ['slug' => 'article', 'id' => 13])
        ];
    })->name('add');

    //Affiche un jeu specifique
    Route::get('/{slug}-{id}', function (string $slug, string $id, Request $request) {
        return [
            "slug" => $slug,
            "id" => $id,
            "name" => $request->input('name', 'non-stipuler')
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
});
require __DIR__.'/auth.php';
