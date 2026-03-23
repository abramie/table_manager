<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class ToastService
{
    public function __construct()
    {
    }

    public function addToast(string $type, string $message){

        if(Session::has('toast')){
            $toast = Session::pull('toast');
            $toast[] = ['type' => $type, 'message'=>$message];
            Session::flash('toast', $toast);
        }else{
            Session::flash('toast', [['type' => $type, 'message'=>$message]]);
        }

    }
    public function success(string $message){
        $this->addToast('success', $message);

    }

    public function error(string $message){
        $this->addToast('error', $message);

    }

    public function warning(string $message){
        $this->addToast('warning', $message);

    }

    public function info(string $message){
        $this->addToast('info', $message);

    }
}
