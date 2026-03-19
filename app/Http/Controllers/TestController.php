<?php

namespace App\Http\Controllers;

use App\Mail\MailTest;
use App\Models\Triggerwarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TestController extends Controller
{
    //

    public function mail(){

        dd(Mail::to(Auth::user()->email)->send(new MailTest()));
        return "ok mail envoyer";
    }
    public function add(){

    }


}
