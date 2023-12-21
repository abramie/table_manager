<?php

namespace App\Http\Controllers;

use App\Models\Creneau;
use App\Models\Evenement;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    public function show(Evenement $evenement, Creneau $creneau, string $nom_table, Request $request) {
        return [
            "page" => "table",
            "nom_table" => $nom_table,
            "id_creneau" => $creneau->id,
            "name" => $request->input('name', 'non-stipuler')
        ];
    }

    public function add (Evenement $evenement, Creneau $creneau,  string $nom_table, Request $request) {
        return [
            "page" => "ajout de table",
            "id_creneau" => $creneau->id,
            "name" => $request->input('name', 'non-stipuler')
        ];
    }


    public function todo (Evenement $evenement, Creneau $creneau, string $nom_table, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
