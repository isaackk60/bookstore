<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Cviebrock\EloquentSluggable\Services\SlugService;


class BooksController extends Controller
{
    // public function index()
    // {
        // return view('book.index')
        //     ->with('books', Book::orderBy('updated_at', 'DESC')->get());

        public function index(Request $request)
    {
        $sort = $request->input('sort', 'publishTime');

        switch ($sort) {
            case 'publishTime_asc':
                $order = 'asc';
                $orderBy = 'publishTime';
                break;
            case 'price_asc':
                $order = 'asc';
                $orderBy = 'price';
                break;
            case 'price_desc':
                $order = 'desc';
                $orderBy = 'price';
                break;
            default:
                $order = 'desc';
                $orderBy = 'publishTime';
                break;
        }

        $books = Book::orderBy($orderBy, $order)->get();

        return view('book.index', compact('books'));
    }

    // }
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
            'price'=> 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);
        // if ($request->hasFile('image') && $request->file('image')->isValid()) {
        //     try {
                $newImageName = uniqid() . '-' . $request->bookName . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $newImageName);
        //     } catch (\Exception $e) {
        //         return back()->withErrors('Failed to save the image. Please try again.');
        //     }
        // } else if(!$request->hasFile('image')){
        //     return back()->withErrors('Not have image. Please upload a valid image.');
        // }else if($request->hasFile('image')&& !$request->file('image')->isValid()){
        //     return back()->withErrors('Invalid image file. Please upload a valid image.');
        // }
        


        Book::create([
            'bookName' => $request->input('bookName'),
            'type' => $request->input('type'),
            'pages' => $request->input('pages'),
            'description' => $request->input('description'),
            'publishTime' => date('Y-m-d', strtotime($request->input('publishTime'))),
            'author'=> $request->input('author'),
            'stock'=> $request->input('stock'),
            'price'=> $request->input('price'),
            'slug' => SlugService::createSlug(Book::class, 'slug', $request->bookName),
            'image_path' => $newImageName
            // 'user_id' => auth()->user()->id

            //,'like'=>0
        ]);

        return redirect()->route('book.index')
            ->with('message', 'Book has been created successfully.');
    }
    public function show($slug)
    {
        return view('book.show')
            ->with('book', Book::where('slug', $slug)->first());
    }

    public function edit($slug)
    {
        return view('book.edit')
            ->with('book', Book::where('slug', $slug)->first());
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
            'price'=> 'required',
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
                    'publishTime' => date('Y-m-d', strtotime($request->input('publishTime'))),
                    'author'=> $request->input('author'),
                    'stock'=> $request->input('stock'),
                    'price'=> $request->input('price'),
                    'slug' => SlugService::createSlug(Book::class, 'slug', $request->bookName),
                    // 'user_id' => auth()->user()->id,
                ]);
            // Book::create([
            //     'bookName' => $request->input('bookName'),
            //     'type' => $request->input('type'),
            //     'pages' => $request->input('pages'),
            //     'description' => $request->input('description'),
            //     'publishTime' => date('Y-m-d', strtotime($request->input('publishTime'))),
            //     'author' => $request->input('author'),
            //     'stock' => $request->input('stock'),
            //     'slug' => SlugService::createSlug(Book::class, 'slug', $request->bookName),
            //     'image_path' => $newImageName,
            // ]);
            
        // if ($request->hasFile('image') && $request->file('image')->isValid()) {
        //     $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $newImageName);
        
        //     Book::create([
        //         'bookName' => $request->input('bookName'),
        //             'type' => $request->input('type'),
        //             'pages' => $request->input('pages'),
        //             'description' => $request->input('description'),
        //             'publishTime' => date('Y-m-d', strtotime($request->input('publishTime'))),
        //             'author'=> $request->input('author'),
        //             'stock'=> $request->input('stock'),
        //'price'=> $request->input('price'),
        //             'slug' => SlugService::createSlug(Book::class, 'slug', $request->bookName),
        //         // your existing fields
        //         'image_path' => $newImageName,
        //     ]);
        
        //     return redirect()->route('book.index')->with('message', 'Book has been created successfully.');
        
        } else {
            Book::where('slug', $slug)
                ->update([
                    'bookName' => $request->input('bookName'),
                    'type' => $request->input('type'),
                    'pages' => $request->input('pages'),
                    'description' => $request->input('description'),
                    'publishTime' => date('Y-m-d', strtotime($request->input('publishTime'))),
                    'author'=> $request->input('author'),
                    'stock'=> $request->input('stock'),
                    'price'=> $request->input('price'),
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
            ->with('message', 'Book has been deleted successfully');
    }
}
