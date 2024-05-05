<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->check()) {
            $cartItems = auth()->user()->cartItems()->orderBy('updated_at', 'DESC')->get();
            return view('cart', compact('cartItems'));
        } else {
            return redirect()->route('login');
        }

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'quantity' => 'required',
        ]);

        $book_id = $request->book_id;
        $quantity = $request->quantity;
        if (auth()->check()) {
            // Check if the user already has this book in the cart
            $existingCartItem = auth()->user()->cartItems()->where('book_id', $book_id)->first();

            if ($existingCartItem) {
                // If the book is already in the cart, update the quantity
                $newQuantity = $existingCartItem->quantity + $quantity;
                // Check if new quantity exceeds the maximum allowed quantity
                if ($newQuantity > 10) {
                    if ($newQuantity > $existingCartItem->book->stock && $existingCartItem->book->stock < 10) {
                        $newQuantity = $existingCartItem->book->stock;
                        $existingCartItem->update(['quantity' => $newQuantity]);
                        return redirect()->route('cart.index')->with('message', 'Quantity updated to maximum available stock.');
                    } else if ($newQuantity > $existingCartItem->book->stock && $existingCartItem->book->stock > 10) {
                        $existingCartItem->update(['quantity' => 10]);
                        return redirect()->route('cart.index')->with('message', 'Maximum quantity allowed per book is 10.');
                    } else if ($newQuantity < $existingCartItem->book->stock && $existingCartItem->book->stock > 10) {
                        $existingCartItem->update(['quantity' => 10]);
                        return redirect()->route('cart.index')->with('message', 'Maximum quantity allowed per book is 10.');
                    }
                }

                // Check if new quantity exceeds the available stock
                if ($newQuantity > $existingCartItem->book->stock) {
                    $newQuantity = $existingCartItem->book->stock;
                    $existingCartItem->update(['quantity' => $newQuantity]);
                    return redirect()->route('cart.index')->with('message', 'Quantity updated to maximum available stock.');
                }
                // Update the quantity
                $existingCartItem->update(['quantity' => $newQuantity]);
                return redirect()->route('cart.index')->with('message', 'Quantity updated successfully.');

            }

            $book = Book::findOrFail($book_id);

            // Create a new cart item
            Cart::create([
                'book_id' => $book_id,
                'quantity' => $quantity,
                'total_price' => $book->price * $quantity,
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('cart.index')->with('message', 'Item added to cart successfully.');
        } else {
            return redirect()->route('login');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->update([
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
        ]);

        return back()->with('message', 'Cart item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return back()->with('message', 'Cart item removed successfully');
    }
}
