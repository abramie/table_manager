<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTableRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    //

    public function add(){
        $tag = new Tag();
        if(Str::contains(url()->previous(),"events")){
            session()->put('saved_table_input',session("_old_input"));
        }


        return view('table.tag.create', [
           'tag' => $tag
        ]);
    }

    public function store(Request $request){
        $tag = Tag::create($request->merge(['nom' => $request->nom_tag])->validate(['nom' => ['required', 'unique:tags']]));
        return redirect(session('links')[0])->withInput();
    }
}
