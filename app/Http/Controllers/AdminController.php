<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('book.index');
        }

        $users = User::orderBy('updated_at', 'DESC')->get();
        return view('user.userinfo', compact('users'));
    }




}