<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view('user.userinfo')->with('users', User::orderBy('updated_at', 'DESC')->get());
    }



}
