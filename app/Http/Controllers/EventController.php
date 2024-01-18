<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormEventRequest;
use App\Models\Creneau;
use App\Models\Evenement;
use App\Models\Image;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Contracts\Pagination\Paginator;
class EventController extends Controller
{
    //
    public function index() : View{
        //dd(Evenement::paginate(3));
        return view('evenement.index', [
            'evenements' => Evenement::paginate(5)
        ]);
        return Evenement::with('creneaux')->limit(10)->get();
    }

    public function add(){
        $evenement = new Evenement();
        $evenement->nom_evenement = "le nom de l'evenement";
        $settings = Settings::whereIn('name',  ['max_tables','nb_inscription_online_max' ])->get();
        //dd($settings);
        //$max_tables = $settings->firstWhere('value', 'like','8');

        $evenement->max_tables = $settings->firstWhere('name','max_tables')->value;
        $evenement->nb_inscription_online_max = $settings->firstWhere('name', 'nb_inscription_online_max')->value;

        //return "formulaire ajout d'evenement";
        return view('evenement.create', [
            'evenement' => $evenement,
            'settings' => $settings
        ]);
    }

    public function edit(Evenement $evenement){
        //return "formulaire edit d'evenement";
        $settings = Settings::whereIn('name',  ['max_tables','nb_inscription_online_max' ])->get();
        return view('evenement.edit', [
            'evenement' => $evenement,
            'settings' => $settings
        ]);
    }

    public function show(Evenement $evenement, Request $request){
        return view('evenement.show', [
            'evenement' => $evenement
        ]);;
    }

    /*
     * Sauvegarde un Evenement depuis un formulaire
     */
    public function store(FormEventRequest $request){
        $events = Evenement::create($request->validated());


        if($request->file('image')) {
            $title = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storePubliclyAs('images', $title, 'public');
            //$request->file('image')->storeAs('images' , $title);
            $save = new Image();
            $save->title = $title;
            $save->image_path = $path;
            $events->image()->save($save);
        }

        return redirect()->route('events.one.show', ['evenement' => $events->slug])
            ->with('success', "L'evenement a bien été ajouté");
    }

    /*
     * Mise à jour des données d'un event
     */
    public function update(Evenement $evenement, FormEventRequest $request){
//dd("test");
        $evenement->update($request->validated());

        if($request->file('image'))
        {
            $evenement->image()->delete();
            $title = uniqid().'.'.$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storePubliclyAs('images' , $title,'public');
            //$request->file('image')->storeAs('images' , $title);

            $save = new Image();
            $save->title = $title;
            $save->image_path = $path;
            $evenement->image()->save($save);

        }



        return redirect()->route('events.one.show', ['evenement' => $evenement->slug])
            ->with('success', "L'evenement a bien été editer");
    }

    public function delete(Evenement $evenement){
        $evenement->delete();
        return redirect()->route('events.index', ['evenement' => $evenement])
            ->with('success', "L'event a bien été supprimé");
    }
}
