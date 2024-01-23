<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormEventRequest;
use App\Models\Creneau;
use App\Models\Evenement;
use App\Models\Image;
use App\Models\Settings;
use App\Models\Table;
use App\Models\User;
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
        return view('admin.deleted.events', [
            'evenements' => Evenement::onlyTrashed()->paginate(5)
        ]);
    }

    public function index_creneaux() : View{
        //dd(Evenement::paginate(3));
        $creneaux = Creneau::onlyTrashed()->whereHas('evenement', function ( $query) {
            $query->where('deleted_at', null);
        })->get();
        return view('admin.deleted.creneaux', [
            'creneaux' => Creneau::onlyTrashed()->whereHas('evenement', function ( $query) {
                $query->where('deleted_at', null);
            })->paginate(5)
        ]);
    }
    public function index_tables() : View{
        //dd(Evenement::paginate(3));
        return view('admin.deleted.tables', [
            'tables' => Table::onlyTrashed()->whereHas('creneaus', function ( $query) {
                $query->where('deleted_at', null);
            })->paginate(5)
        ]);
    }
    public function index_users() : View{
        //dd(Evenement::paginate(3));
        return view('admin.deleted.users', [
            'evenements' => User::onlyTrashed()->paginate(5)
        ]);
    }

    public function restore($type, $id) {
        //dd(Evenement::paginate(3));


        $model = $this->identify($type,$id);
       // dd($model);
        $model->restore();
        return redirect()->route('admin.deleted.'. lcfirst( $type))
            ->with('success', "Le ".$type." a bien été restorer");
    }

    public function delete($type, $id) {
        $model = $this->identify($type,$id);
        dd($model);
        return view('admin.deleted.users', [
            'evenements' => User::onlyTrashed()->paginate(5)
        ]);
    }

    private function identify($type, $id){
        switch($type){
            case "Evenement":
                $model = Evenement::onlyTrashed()->find($id);
                break;
            case "Creneau":
                $model = Creneau::onlyTrashed()->find($id);
                break;
            case "Table":
                $model = Table::onlyTrashed()->find($id);
                break;

        }
        return $model;
    }



}
