<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormEventRequest;
use App\Models\Creneau;
use App\Models\Evenement;
use App\Models\Image;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Contracts\Pagination\Paginator;
class GestionDeletedController extends Controller
{
    //
    public function index_event() : View{
        //dd(Evenement::paginate(3));
        return view('evenement.index', [
            'evenements' => Evenement::onlyTrashed()->paginate(5)
        ]);
    }


}
