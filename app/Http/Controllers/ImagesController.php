<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTableRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    //

    public function add(){

        return view('todo');
    }

    public function store(Request $request){

        return view('todo');
    }
}
