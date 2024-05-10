@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="border-b border-gray-200">
            <h1 class="page_title text-blue-800 text-4xl font-semibold uppercase" style="font-family: 'Merriweather', serif;">
               All Books
            </h1>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="w-4/5 m-auto mt-10 pl-2">
            <p class="px-5 w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif

    <div class="w-4/5 m-auto mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">
        <img src="https://www.bookstation.ie/wp-content/uploads/2024/03/BTHP-2403.jpg" alt="Book Cover" class="rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
        <img src="https://www.bookstation.ie/wp-content/uploads/2024/04/The-Trial.jpg" alt="Book Cover" class="rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
    </div>
    <span class="line"></span>

    @if (isset(Auth::user()->id) && Auth::user()->isAdmin())
        <div class="my-10 w-4/5 m-auto">
            <a href="/book/create" class="create_book_button">
                Create Book
            </a>
        </div>
    @endif

    <div class="w-4/5 mx-auto my-10 flex justify-between items-center">
        <form action="/book" method="GET">
            <label>Sort by:</label>
            <select name="sort" onchange="this.form.submit()" class="ml-3 cursor-pointer pl-2 pr-8 border-2 border-gray-500">
                <option value="publishTime" {{ request()->get('sort') == 'publishTime' ? 'selected' : '' }}>Most Recent</option>
                <option value="publishTime_asc" {{ request()->get('sort') == 'publishTime_asc' ? 'selected' : '' }}>Oldest First</option>
                <option value="price_asc" {{ request()->get('sort') == 'price_asc' ? 'selected' : '' }}>Price Low to High</option>
                <option value="price_desc" {{ request()->get('sort') == 'price_desc' ? 'selected' : '' }}>Price High to Low</option>
            </select>
            <input type="hidden" name="query" value="{{ request()->get('query') }}">
        </form>
    
        <form action="/book" method="GET">
            <input type="hidden" name="sort" value="{{ request()->get('sort') }}">
            <input type="text" name="query" value="{{ request()->get('query') }}" placeholder="Search" class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-blue-500">
            <button type="submit" class="ml-2 px-4 py-2.5 create_book_button text-white rounded-md hover:bg-blue-600">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    
   
    <div class="mb-20">
        <div class="sm:grid grid-cols-4 gap-10 w-4/5 mx-auto py-15">
            @foreach ($books as $book)
                <div
                    class="each_book_container bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <a href="/book/{{ $book->slug }}"
                        class="no-underline hover:no-underline flex flex-col justify-between p-4">
                        <div class="flex flex-col justify-center items-center">
                            <img src="{{ asset('images/' . $book->image_path) }}" alt="{{ $book->bookName }}"
                                class="max-h-52 rounded">
                        </div>
                        <div>
                            <h2 class="text-gray-700 font-bold text-xl mt-4 text-center">
                                {{ $book->bookName }}
                            </h2>

                            <p class="text-gray-500 mt-2 text-center">
                                By <span class="font-bold text-gray-800">{{ $book->author }}</span>
                            </p>
                            <p class="text-gray-500 text-center mt-2">
                                Type: <span class="font-bold italic text-gray-800 ">{{ $book->type }}</span>
                            </p>
                            <p class="text-gray-500 font-bold text-lg mt-2 text-center">
                                €{{ $book->price }}
                            </p>
                        </div>
                    </a>

                    @if (isset(Auth::user()->id) && Auth::user()->isAdmin())
                        <div class="flex flex-row items-center justify-evenly mb-6">
                            <div>
                                <a href="/book/{{ $book->slug }}/edit"
                                    class="uppercase text-sm font-extrabold py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors duration-300">
                                    Edit
                                </a>
                            </div>
                            <div>
                                <form action="/book/{{ $book->slug }}" method="POST" class="none">
                                    @csrf
                                    @method('delete')

                                    <button
                                        class="uppercase text-sm font-extrabold py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600 transition-colors duration-300"
                                        type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
