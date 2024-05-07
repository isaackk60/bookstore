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
        return redirect()->route('book.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'books' => 'required',
            'order_date' => 'required|date_format:Y-m-d H:i:s',
            'order_price' => 'required',
        ]);

        $books = json_decode($request->books, true);

        Sale::create([
            'user_id' => $request->user_id,
            'books' => $books,
            'order_date' => $request->order_date,
            'order_price' => $request->order_price,
        ]);

        auth()->user()->cartItems()->delete();

        return redirect()->route('sales.index')->with('message', 'Order created successfully.');
    }


    public function show($id)
    {
        return redirect()->route('book.index');
        // $sale = Sale::findOrFail($id);
        // return view('sales.show', compact('sale'));
    }

    // public function destroy($id)
    // {
    //     // Sale::findOrFail($id)->delete();
    //     // return redirect()->route('sales.index')->with('message', 'Sale deleted successfully.');
    //     return redirect()->route('book.index');
    // }
}
