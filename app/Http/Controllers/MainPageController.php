<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    //
    public function index()
    {
        // You can pass data to your view if needed
        return view('index')
        ->with('books',Book::orderBy('updated_at','DESC')->get());
        
    }
}
