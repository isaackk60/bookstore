<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating'  => 'required',
            'content' => 'required|string',
            'book_id' => 'required|exists:books,id',
        ]);

        $review = new Review();
        $review->rating = $request->rating;
        $review->content = $request->content;
        $review->book_id = $request->book_id;
        $review->user_id = auth()->id();
        $review->save();

        return back()->with('message','Your review has been added!');
    }

    // public function update(Request $request, $id)
    // {
    //     $review = Review::findOrFail($id);

    //     if ($request->has('cancelButton')) {
    //         return back()->with('message','Review editing canceled.');
    //         // if have time can try to use redirect() id to review part 
    //         //return redirect()->route('route_name', ['#id']);
    //     }else{

    //     $request->validate([
    //         'content' => 'required',
    //     ]);

    //     $review->content = $request->input('content');
    //     $review->save();

    //     return back()->with('message','Your review has been updated!');
    // }
    // }




    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('message','Your review has been deleted!');
    }
}
