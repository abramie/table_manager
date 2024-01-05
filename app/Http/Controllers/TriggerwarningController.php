<?php

namespace App\Http\Controllers;

use App\Models\Triggerwarning;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TriggerwarningController extends Controller
{
    //

    public function add(){
        $triggerwarning = new Triggerwarning();
        if(Str::contains(url()->previous(),"events")){
            session()->put('saved_table_input',session("_old_input"));
        }


        return view('table.triggerwarning.create', [
            'triggerwarning' => $triggerwarning
        ]);
    }

    public function store(Request $request){
        $triggerwarning = Triggerwarning::create($request->merge(['nom' => $request->nom_triggerwarning])->validate(['nom' => ['required', 'unique:triggerwarnings']]));

        return redirect(session('links')[0])->withInput();
    }
}
