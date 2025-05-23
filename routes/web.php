<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\CreneauController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Profiles\JoueursPageController;
use App\Http\Controllers\Profiles\MJPageController;
use App\Http\Controllers\Profiles\ProfileController;
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

Route::get('/test/mail', [\App\Http\Controllers\TestController::class, 'mail'])->name('test.mail');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/{compte}')->middleware('auth')->group(function () {

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::prefix('/{profile}')->group(function () {

            Route::get('/optionMJ', [MJPageController::class, 'show'])->name("mj");
            Route::get('/optionJoueur', [JoueursPageController::class, 'show'])->name("joueur");
            Route::get('/change', [ProfileController::class, 'change'])->name('change');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
        });

        Route::get('/show', [ProfileController::class, 'show'])->name('show');
        Route::post('/store', [ProfileController::class, 'store'])->name('store');
    });



    Route::prefix('/compte')->name("compte.")->group( function () {
        Route::get('/', [CompteController::class, 'edit'])->name('edit');
        Route::patch('/', [CompteController::class, 'update'])->name('update');
        Route::delete('/', [CompteController::class, 'destroy'])->name('destroy');

        Route::post('/change_role', [CompteController::class, 'update_role'])->name('change_role');
        Route::post('/toggleMJ', [CompteController::class, 'toggleMJ'])->name('toggle-mj');
    });
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

route::get('/deleteResetToken/{passwordReset:token}',[\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'deleteResetLink'])->name('deleteToken');
route::get('/reset/token/{passwordReset:token}', [\App\Http\Controllers\Auth\NewPasswordController::class, 'resetPassword'])->name('reset_password');
route::post('/reset/token/{passwordReset:token}', [\App\Http\Controllers\Auth\NewPasswordController::class, 'storeNewPassword'])->name('store_new_password');



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
    Route::get('/users', [\App\Http\Controllers\CompteController::class, 'index'])->name('users');
    Route::prefix('/settings')->name('settings')->group(function(){
        Route::get('/', [\App\Http\Controllers\SettingsController::class, 'index']);
        Route::post('/{setting}', [\App\Http\Controllers\SettingsController::class, 'update'])->name(".update");
    });

    route::get('/reset/{user}', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'generateResetLink'])->name('generate_reset_link');
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
        Route::get('/archive', [EventController::class, 'archive'])->name('archive')->middleware('auth')->middleware('permission:ajout_events');
        Route::get('/unarchive', [EventController::class, 'unarchive'])->name('unarchive')->middleware('auth')->middleware('permission:ajout_events');

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
                Route::post('/inscription/{profile?}', [TableController::class, 'inscription_table'])->name('inscription');
                Route::get('/attempt/inscription', [TableController::class, 'inscriptionLoggedOut'])->name('inscriptionLoggedOut');
                Route::post('/attempt/inscription/login', [TableController::class, 'inscriptionLogin'])->name('inscriptionLogin');
                Route::post('/attempt/inscription/register', [TableController::class, 'inscriptionRegister'])->name('inscriptionRegister');
                Route::post('/attempt/inscription/profil', [TableController::class, 'inscriptionProfil'])->name('inscriptionProfil');

                Route::post('/desinscription', [TableController::class, 'desinscription_table'])->name('desinscription')->middleware('auth');
                Route::post('/desinscription/{profile?}', [TableController::class, 'desinscription_table'])->name('desinscription')->middleware('auth')->middleware('permission:manage_tables_all');
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
