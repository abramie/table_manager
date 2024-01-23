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
    return redirect('/events');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/user-{user:name}/change_role', [ProfileController::class, 'update_role'])->name('profile.change_role');

    Route::post('/toggleMJ', [ProfileController::class, 'toggleMJ'])->name('profile.toggle-mj');
    Route::view('/profile/optionMJ', 'profile.mj')->name("profile.mj");
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

/*
 * Pages relatives aux actions admins
 */
Route::prefix('/admin')->name('admin.')->middleware('auth')->middleware('role:admin')->group(function () {

    Route::view('/', 'admin.index')->name('index');

    Route::prefix('/gestion_deleted')->name('deleted')->group(function(){
        Route::get('/', function(){return redirect('/admin/gestion_deleted/events');});
        Route::get('/events', [\App\Http\Controllers\GestionDeletedController::class, 'index_event'])->name('.evenement');
        Route::get('/users', [\App\Http\Controllers\GestionDeletedController::class, 'index_users'])->name('.user');
        Route::get('/creneaux', [\App\Http\Controllers\GestionDeletedController::class, 'index_creneaux'])->name('.creneau');
        Route::get('/tables', [\App\Http\Controllers\GestionDeletedController::class, 'index_tables'])->name('.table');

        Route::get('/restore/{type}/{id}', [\App\Http\Controllers\GestionDeletedController::class, 'restore'])->name('.restore');
        Route::get('/delete/{type}/{id}', [\App\Http\Controllers\GestionDeletedController::class, 'delete'])->name('.delete');
    });
    Route::view('/users', 'admin.users')->name('users');
    Route::prefix('/settings')->name('settings')->group(function(){
        Route::get('/', [\App\Http\Controllers\SettingsController::class, 'index']);
        Route::post('/{setting}', [\App\Http\Controllers\SettingsController::class, 'update'])->name(".update");
    });


});

/*
 * Pages relatives aux evenements
 * aka la soirée jeu
 */
Route::prefix('/events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');;

    //Page d'ajout d'un evennement (formulaire)
    Route::get('/add', [EventController::class, 'add'])->name('add')->middleware('auth')->middleware('permission:ajout_events');
    //Pour le retour de formulaire
    Route::post('/add', [EventController::class, 'store'])->middleware('auth')->middleware('permission:ajout_events');


    //Gere un evenement specifique
    Route::prefix('/{evenement:slug}')->name('one.')->where([
        'evenement' => '[a-z0-9\-]+'
    ])->group(function () {

        Route::get('/', [EventController::class, 'show'])->name('show');

        //Page d'edition d'un evennement (formulaire)
        Route::get('/edit', [EventController::class, 'edit'])->name('edit')->middleware('auth')->middleware('permission:ajout_events');
        Route::post('/edit', [EventController::class, 'update'])->middleware('auth')->middleware('permission:ajout_events');
        //Ajout creneau
        Route::get('/add', [CreneauController::class, 'add'])->name('add')->middleware('auth')->middleware('permission:ajout_events');
        Route::post('/add', [CreneauController::class, 'store'])->middleware('auth')->middleware('permission:ajout_events');

        Route::get('/delete', [EventController::class, 'delete'])->name('delete')->middleware('auth')->middleware('permission:ajout_events');

        Route::prefix('/creneau-{creneau:id}')->where(['creneau' => '[0-9]+'])->name('creneau.')->group(function () {
            //Affiche un creneau
            Route::get('/', [CreneauController::class, 'index'])->name('tablesindex');//->withoutScopedBindings();
            //Edit creneau
            Route::get('/edit', [CreneauController::class, 'edit'])->name('edit')->middleware('auth')->middleware('permission:ajout_events');
            Route::post('/edit', [CreneauController::class, 'update'])->name('edit')->middleware('auth')->middleware('permission:ajout_events');
            Route::get('/delete', [CreneauController::class, 'delete'])->name('delete')->middleware('auth')->middleware('permission:ajout_events');


            //Formulaires

            Route::get('/add-table', [TableController::class, 'add'])->name('tables.add')->middleware('auth')->middleware('permission:ajout_tables');
            Route::post('/add-table', [TableController::class, 'store'])->middleware('auth')->middleware('permission:ajout_tables');;

            Route::prefix('/table-{table}')->where(['table' => '[0-9]+'])->name('table.')->group(function () {
                //Affiche une table specifique du creneau
                Route::get('/edit', [TableController::class, 'edit'])->name('edit')->middleware('auth')->middleware('permission:manage_tables_all|manage_tables_own');
                Route::post('/edit', [TableController::class, 'update'])->middleware('auth')->middleware('permission:manage_tables_all|manage_tables_own');
                Route::get('/delete', [TableController::class, 'delete'])->name('delete')->middleware('permission:manage_tables_all|manage_tables_own');
                Route::get('/', [TableController::class, 'show'])->name('show');
                Route::post('/inscription', [TableController::class, 'inscription_table'])->name('inscription')->middleware('auth');
                Route::post('/desinscription', [TableController::class, 'desinscription_table'])->name('desinscription')->middleware('auth');

            });
        });
    });
});


Route::prefix('/tags')->name('tags.')->group(function () {
    Route::get('/add', [TagsController::class, 'add'])->name('add')->middleware('auth')->middleware('permission:ajout_tags');
    Route::post('/add', [TagsController::class, 'store'])->middleware('auth')->middleware('permission:ajout_tags');
});

Route::prefix('/triggerwarning')->name('tw.')->group(function () {
    Route::get('/add', [TriggerwarningController::class, 'add'])->name('add')->middleware('auth')->middleware('permission:ajout_tws');
    Route::post('/add', [TriggerwarningController::class, 'store'])->middleware('auth')->middleware('permission:ajout_tws');
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
