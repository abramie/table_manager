<?php

namespace App\Http\Controllers;

use App\Mail\MailTest;
use App\Models\Triggerwarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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


}
