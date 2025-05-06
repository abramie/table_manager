<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\Profile::paginate('20') ;
        return view('admin.users', ['users' => $users]);
    }


}
