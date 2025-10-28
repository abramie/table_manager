<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTableRequest;
use App\Models\Settings;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    //

    public function add(){

    }

    public function store(Request $request){

    }

    public function edit(){

    }

    public function update(Request $request, Settings $setting){


        $setting->fill($request->all())->save();
        return redirect()->back()
            ->with('success', "LE settings a bien était modifier");
    }

    public function index(){
        return view('admin.settings', [
            'settings' => Settings::paginate(5)
        ]);
    }
}
