<?php

namespace App\Http\Controllers;

use App\Mail\MailTest;
use App\Models\Triggerwarning;
use App\Services\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\Mailer\Exception\UnexpectedResponseException;

class TestController extends Controller
{
    //

    public function mail(){

       try{
            $result = Mail::to('abramie@proton.me')->send(new MailTest());
        }catch(UnexpectedResponseException $e){
           dd($e);
       }
        dd($result);
        return "ok mail envoyer";
    }
    public function add(){

    }

    public function bubble(Request $request)
    {
        //Session::flashOnly(['success', 'Messsage de test positive'])
//        $request->session()->now('success', 'Messsage de test positive');
//        $request->session()->now('echec', 'Messsage de test erreur');
//        $request->session()->now('info', 'Messsage de test info');
//        $request->session()->now('toast', [['type' => 'error', 'message'=>'Messsage de test echec']]);
//        $request->session()->now('toast', [['type' => 'success', 'message'=>'Tout marche correctement !']]);

        Services::toast()->success('test service');
        Services::toast()->success('Multiples ajouts');
        Services::toast()->info('Les toasts fonctionnent ! ');
        Services::toast()->warning('Attention !  ');
        Services::toast()->error('Le css est pas fini ');
        return view('todo');

    }



}
