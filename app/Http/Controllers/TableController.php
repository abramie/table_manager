<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTableRequest;
use App\Models\Creneau;
use App\Models\Evenement;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    public function show(Evenement $evenement, Creneau $creneau, Table $table, Request $request) {

        return view('table.show', [
            'table' => $table,
            'creneau' => $creneau,
            'evenement' => $evenement
        ]);

    }

    public function add(Evenement $evenement,Creneau $creneau){
        $table = new Table();
        $table->nom = "le nom de la table";
        //return "formulaire ajout d'evenement";
        return view('table.create', [
            'table' => $table,
            'evenement' => $evenement,
            'creneau' => $creneau,
            'creneaux' => Creneau::get()
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function store(Evenement $evenement,Creneau $creneau, FormTableRequest $request){
        //dd($request);
        $table = Table::create($request->validated());
        $creneau->tables()->save($table);

        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "La table a bien été ajouté");
    }


    public function edit(Evenement $evenement,Creneau $creneau,Table $table){

        return view('table.edit', [
            'table' => $table,
            'evenement' => $evenement,
            'creneau' => $creneau,
            'creneaux' => Creneau::get()
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function update(Evenement $evenement,Creneau $creneau,Table $table,FormTableRequest $request){


        $table->update($request->validated());

        return redirect()->route('events.one.creneau.table.show', ['evenement' => $evenement,'creneau' => $creneau->id,'table'=> $table])
            ->with('success', "Le table a bien été modifier");
    }

    public function todo (Evenement $evenement, Creneau $creneau, Table $table, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
