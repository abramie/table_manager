<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\FormTableRequest;
use App\Http\Requests\InscriptionTableRequest;
use App\Http\Requests\ProfilRequest;
use App\Models\Compte;
use App\Models\Creneau;
use App\Models\Description;
use App\Models\Evenement;
use App\Models\Inscrit;
use App\Models\Jeu;
use App\Models\Settings;
use App\Models\Table;
use App\Models\Tag;
use App\Models\Triggerwarning;
use App\Models\Profile;
use App\Models\types\TypeInscription;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class TableController extends Controller
{
    //
    public function show(Evenement $evenement, Creneau $creneau, Table $table, Request $request) {
        $settings = Settings::whereIn('name',  ['nom_trigger'])->get();
        return view('table.show', [
            'table' => $table,
            'creneau' => $creneau,
            'evenement' => $evenement,
            'settings' => $settings,
        ]);

    }

    /** Methode controleur avec Livewire*/
    public function add(Evenement $evenement,Creneau $creneau)
    {
        $descriptions = Description::whereIn('name',  ['trigger_warnings' ])->get();
        $table = new Table();
        $table->nom = "le nom de la table";
        $table->nb_joueur_min = 3;
        $table->nb_joueur_max = 3;
        $table->max_preinscription = $creneau->nb_inscription_online_max;

        $table->duree = $creneau->duree;
        $table->debut_table = $creneau->debut_creneau;
        $table->creneau()->associate($creneau);


        return view('table.create', ['table' => $table,'evenement' => $evenement,
            'creneau' => $creneau,'descriptions' => $descriptions]);

    }

    /*
     * Sauvegarde une Table depuis un formulaire
     */
    public function store(Evenement $evenement,Creneau $creneau, FormTableRequest $request){

        $table = Table::create($request->validated());
        $creneau->tables()->save($table);
        $table->inscrits()->syncWithPivotValues($request->validated('inscrits') ,[ 'type_inscription_id' => TypeInscription::findCode('INS')->id]);
        $table->tags()->sync($request->validated('tags'));
        //Desinscrit le mj de toute les tables où il est inscrit si il ouvre une table.
        if($request->validated('mj') == Auth::user()->currentProfile->id){
            $desincription = $creneau->desinscrit_user(Auth::user()->currentProfile);
        }else{
            $desincription = 0;
        }

        if($request->validated('nom_jeu')){
            $jeu = new Jeu;
            $jeu->nom = $request->validated('nom_jeu');
            $jeu->description = $request->validated('description_jeu') ?? '';

            if($jeu->save()){
                $table->jeu()->associate($jeu);
                $table->save();
            }
        }


        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "La table a bien été ajouté." . ($desincription>0 ? "Et vous avez était desinscrit de vos tables" : "" ));
    }


    public function edit(Evenement $evenement,Creneau $creneau,Table $table){

        if(!(auth()->user()?->can('manage_tables_all') ||
            (auth()->user()?->can('manage_tables_own') &&  $table->mjs == auth()->user()->currentProfile)
        )){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
                ->with('echec', "Vous n'avez pas l'autorisation de modifier cette table");
        }
        $descriptions = Description::whereIn('name',  ['trigger_warnings' ])->get();




        return view('table.edit', ['table' => $table,'evenement' => $evenement,
            'creneau' => $creneau,'descriptions' => $descriptions]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function update(Evenement $evenement,Creneau $creneau,Table $table,FormTableRequest $request){

        $table->update($request->validated());
        $table->tags()->sync($request->validated('tags'));

        if($request->validated('inscrits'))
            $table->inscrits()->syncWithPivotValues($request->validated('inscrits') ,[ 'type_inscription_id' => TypeInscription::findCode('INS')->id]);
        return redirect()->route('events.one.creneau.table.show', ['evenement' => $evenement,'creneau' => $creneau,'table'=> $table])
            ->with('success', "Le table a bien été modifier");
        //return redirect()->route('events.one.creneau.table.show', ['evenement' => $evenement,'creneau' => $creneau->id,'table'=> $table])->with('success', "Le table a bien été modifier");
    }

    public function delete(Evenement $evenement,Creneau $creneau,Table $table){
        if(!(auth()->user() && (auth()->user()?->can('manage_tables_all') ||
                (auth()->user()?->can('manage_tables_own')&&  $table->mjs->name ==auth()->user()->currentProfile->name)))){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "Vous n'avez pas l'autorisation de modifier cette table");
        }
        $table->delete();
        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
            ->with('success', "La table a bien été supprimé");
    }


    public function inscription_table(Evenement $evenement,Creneau $creneau,Table $table, Profile|null $profile = null){
        //Do the attach
        $maxInscription =  $table->max_preinscription;

        if(Auth::check() || $profile ) {
            if($profile == null){
               $profile =  Auth::user()->currentProfile;
            }
            //dd($table->inscrits);
            //Verifie dans le creneau de la table si l'utilisateur est inscrit sur une des tables existante, à l'exception de la table "sans table"
            if (($table->sans_table && $table->inscritsPrenantUnePlace->contains($profile))
                || $creneau->tables()->with('inscritsPrenantUnePlace')->where("inscription_restrainte", "=", "1")->get()->pluck('inscrits')->flatten()->contains('id', $profile->id)) {
                return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau])
                    ->with('echec', "Vous êtes deja inscrit sur une table ");
            } elseif ($table->sans_table) {
                try{

                    $inscription = $table->inscriptions()->where( 'profile_id', "=", $profile->id)->firstOrFail();
                    $inscription->type_inscription()->associate(TypeInscription::findCode('INS'));
                    $inscription->save();
                }catch(ModelNotFoundException $e ){
                    $table->inscrits()->withPivotValue('type_inscription_id',TypeInscription::findCode('INS')->id)->attach($profile);
                }

                return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau])
                    ->with('success', "Inscription en \"" . $table->nom);
            } elseif ($table->mjs == $profile) {
                return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau])
                    ->with('echec', "Tu ne peut pas t'inscrire sur ta propre table, comment tu es arrivé là ??? ");
            } elseif ($creneau->tables()->with('mjs')->where("inscription_restrainte", "=", "1")->get()->pluck('mjs')->flatten()->contains('id', $profile->id)) {
                return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau])
                    ->with('echec', "Tu es MJ sur ce creneau, tu ne peux pas t'inscrire");
            } elseif (!$table->sans_table && $table->inscrits->count() > $maxInscription) {
                return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau])
                    ->with('echec', "Ce creneau impose une limite au nombre de personnes pouvant s'inscrire via la platforme à une table.Cette limite est de : " . $maxInscription);
            } elseif ($table->inscrits->count() < $table->nb_joueur_max) {

                try{
                    $inscription = $table->inscriptions()->where( 'profile_id', "=", $profile->id)->firstOrFail();
                    $inscription->type_inscription()->associate(TypeInscription::findCode('INS'));
                    $inscription->save();
                }catch(ModelNotFoundException $e ){
                    $table->inscrits()->withPivotValue('type_inscription_id',TypeInscription::findCode('INS')->id)->attach($profile);
                }

                //Ajouter email desinscription si pas de Compte
                if($profile->compte()->doesntExist()){
                    //Do email
                }

                //Desinscrit de sans table uniquement si on s'inscrit sur une table restreinte (une vrai table et pas du bénévolat ou qqch)
                if ($table->inscription_restrainte) {


                       try{
                           $sanstable = $creneau->tables()->where("sans_table", "=", "1")->get()->firstOrFail();
                           $inscription = $sanstable->inscriptions()->where('profile_id', "=", $profile->id)->firstOrFail();

                           $inscription->type_inscription()->associate(TypeInscription::findCode('DES-INS'));

                           $inscription->save();
                       }catch(ModelNotFoundException $e ){

                       }


                }

                return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau])
                    ->with('success', "Inscription validée sur la table \"" . $table->nom);
            } else {
                return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau])
                    ->with('echec', "La table n'a plus de place ");
            }
        }else{
            //Si on tente de s'inscrire sans être connecter ?
            return redirect()->route('events.one.creneau.table.inscriptionLoggedOut', ['evenement' => $evenement, 'creneau' => $creneau, "table" => $table]);
        }

    }

    public function inscriptionLoggedOut(Evenement $evenement,Creneau $creneau,Table $table){
        return view('table.inscription_unlogged', ['evenement' => $evenement, 'creneau' => $creneau, "table" => $table]);
    }

    public function inscriptionLogin(LoginRequest $request, Evenement $evenement, Creneau $creneau, Table $table){
        $request->authenticate();
        $user = Auth::user();

        $request->session()->regenerate();

//dd($user);
        $request->session()->put('currentProfile', $user->mainProfile->name);
        return $this->inscription_table($evenement, $creneau, $table);
    }
    public function inscriptionRegister(Request $request, Evenement $evenement, Creneau $creneau, Table $table){
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Compte::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Compte::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('joueur');

        event(new Registered($user));

        Auth::login($user);
        $request->session()->put('currentProfile', $user->mainProfile->name);

        return $this->inscription_table($evenement, $creneau, $table);
    }
    public function inscriptionProfil(ProfilRequest $request, Evenement $evenement, Creneau $creneau, Table $table){

        if(Profile::where('name', '=', $request->name)->whereHas('compte')->exists()){
            return redirect()->back()
                ->with('echec', "Ce pseudo est déjà utilisé ");
        }else{
            if(Profile::where('name', '=', $request->name)->doesntExist()){
                $profile = Profile::create($request->validated());
            }else{
                $profile = Profile::where('name', '=', $request->validated('name'))->first();
            }


            return $this->inscription_table($evenement, $creneau, $table, $profile);

        }
    }

        public function desinscription_user_from_table(Evenement $evenement, Creneau $creneau, Table $table, Profile $profile = new Profile() , InscriptionTableRequest $request){

        if($profile == Auth::user()->currentProfile){
                $success_message = "Vous vous êtes bien désinscrit de la table : ".$table->nom;
        }else{
            $success_message = "L'utilisateur {$profile->name} a bien été désinscrit de la table : ".$table->nom;

        }
//        dump($profile);
//        dump($table->inscriptions);
//dd($table->inscriptions()->where( 'profile_id', "=", $profile->id)->get());
            try{
                $inscription = $table->inscriptions()->where( 'profile_id', "=", $profile->id)->firstOrFail();

                $inscription->type_inscription()->associate(TypeInscription::findCode('DES-INS'));

                $inscription->save();
                return redirect()->route('events.one.creneau.tablesindex', [$evenement, $creneau])->with('success', $success_message);
                return redirect()->back()
                    ->with('success', $success_message);
            }catch(ModelNotFoundException $e){

                return redirect()->back()
                    ->with('error', "Oh no, la personne n'était pas inscrite ???");
            }
        }
    public function desinscription_table(Evenement $evenement, Creneau $creneau, Table $table,InscriptionTableRequest $request){
        //Do the attach

        $profile = Auth::user()->currentProfile;
        return $this->desinscription_user_from_table($evenement, $creneau, $table,$profile, request: $request);

    }

    public function todo (Evenement $evenement, Creneau $creneau, Table $table, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
