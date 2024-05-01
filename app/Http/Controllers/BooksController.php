<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Cviebrock\EloquentSluggable\Services\SlugService;


class BooksController extends Controller
{
    public function index()
    {
        return view('book.index')
            ->with('books', Book::orderBy('updated_at', 'DESC')->get());
    }
    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bookName' => 'required',
            'type' => 'required',
            'pages' => 'required',
            'description' => 'required',
            'publishTime'=> 'required|date',
            'author'=> 'required',
            'stock'=> 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        Book::create([
            'bookName' => $request->input('bookName'),
            'type' => $request->input('type'),
            'pages' => $request->input('pages'),
            'description' => $request->input('description'),
            'publishTime' => date('d-m-Y', strtotime($request->input('publishTime'))),
            'author'=> $request->input('author'),
            'stock'=> $request->input('stock'),
            'slug' => SlugService::createSlug(Book::class, 'slug', $request->bookName),
            'image_path' => $newImageName,
            // 'user_id' => auth()->user()->id

            //,'like'=>0
        ]);

        return redirect()->route('book.index')
            ->with('success', 'Book has been created successfully.');
    }

    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'bookName' => 'required',
            'type' => 'required',
            'pages' => 'required',
            'description' => 'required',
            'publishTime'=> 'required|date',
            'author'=> 'required',
            'stock'=> 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:5048'
        ]);
        if ($request->hasFile('image')) {
            $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            Book::where('slug', $slug)
                ->update([
                    'bookName' => $request->input('bookName'),
                    'type' => $request->input('type'),
                    'pages' => $request->input('pages'),
                    'description' => $request->input('description'),
                    'publishTime' => date('d-m-Y', strtotime($request->input('publishTime'))),
                    'author'=> $request->input('author'),
                    'stock'=> $request->input('stock'),
                    'slug' => SlugService::createSlug(Book::class, 'slug', $request->bookName),
                    // 'user_id' => auth()->user()->id,
                ]);
        } else {
            Book::where('slug', $slug)
                ->update([
                    'bookName' => $request->input('bookName'),
                    'type' => $request->input('type'),
                    'pages' => $request->input('pages'),
                    'description' => $request->input('description'),
                    'publishTime' => date('d-m-Y', strtotime($request->input('publishTime'))),
                    'author'=> $request->input('author'),
                    'stock'=> $request->input('stock'),
                    'slug' => SlugService::createSlug(Book::class, 'slug', $request->bookName),
                    // 'user_id' => auth()->user()->id,
                ]);
        }

        return redirect()->route('book.index')
            ->with('message', 'Your post has been updated!');
    }

    public function destroy($slug)
    {
        $book = Book::where('slug', $slug);
        $book->delete();
        return redirect()->route('book.index')
            ->with('success', 'Book has been deleted successfully');
    }
}
