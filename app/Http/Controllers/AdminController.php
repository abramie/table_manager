<?php

namespace App\Http\Controllers;

use App\Models\types\TypeInscription;
use App\Services\Services;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexTypeInscriptions()
    {

        return view('admin.index_type_inscriptions', [
            'type_inscriptions' => TypeInscription::paginate(5)
        ]);
    }

    public function updateTypeInscription(Request $request, TypeInscription $type_inscription){


        $type_inscription->fill($request->all())->save();
        Services::toast()->success(__('Le settings a bien était modifier'));
        return redirect()->back();
    }


}
