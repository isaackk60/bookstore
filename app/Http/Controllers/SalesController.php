<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sales = $user->sales;
    
        return view('sales', compact('sales'));
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'books' => 'required|array',
        'order_date' => 'required|date',
        'total_price' => 'required|numeric',
    ]);

    Sale::create([
        'user_id' => $request->user_id,
        'books' => $request->books,
        'order_date' => $request->order_date,
        'total_price' => $request->total_price,
    ]);

    return redirect()->route('sales')->with('message', 'Order created successfully.');
}

    // public function show($id)
    // {
    //     $sale = Sale::findOrFail($id);
    //     return view('sales.show', compact('sale'));
    // }

    public function destroy($id)
    {
        Sale::findOrFail($id)->delete();
        return redirect()->route('sales.index')->with('message', 'Sale deleted successfully.');
    }
}
