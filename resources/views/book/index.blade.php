@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="border-b border-gray-200">
            <h1 class="page_title text-blue-800">
                Book
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

    <div class="w-4/5 mx-auto my-10">
        <form action="/book" method="GET">
            <label for="sort">Sort by:</label>
            <select name="sort" onchange="this.form.submit()" class="ml-3 cursor-pointer pl-2 pr-5 border-2 border-gray-500">
                <option value="publishTime" {{ request()->get('sort') == 'publishTime' ? 'selected' : '' }}>Most Recent</option>
                <option value="publishTime_asc" {{ request()->get('sort') == 'publishTime_asc' ? 'selected' : '' }}>Oldest First</option>
                <option value="price_asc" {{ request()->get('sort') == 'price_asc' ? 'selected' : '' }}>Price Low to High</option>
                <option value="price_desc" {{ request()->get('sort') == 'price_desc' ? 'selected' : '' }}>Price High to Low</option>
            </select>
        </form>
    </div>
    

    @if (isset(Auth::user()->id) && Auth::user()->isAdmin())
        <div class="pb-10 w-4/5 m-auto">
            <a href="/book/create" class="create_book_button">
                Create Book
            </a>
        </div>
    @endif




    {{-- <div class="w-4/5 mx-auto pt-15">
    <form action="/book" method="GET">
        <label for="sort">Sort by</label>
        <select name="sort" onchange="this.form.submit()"
            class="ml-3 cursor-pointer pl-2 pr-5 border-2 border-gray-500">
            <option value="updated_at" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'updated_at') {
                echo 'selected';
            } ?>>Most Recent</option>
            <option value="updated_at_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'updated_at_asc') {
                echo 'selected';
            } ?>>Oldest First</option>
            <option value="like" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'like') {
                echo 'selected';
            } ?>>Most Liked</option>
            <option value="like_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'like_asc') {
                echo 'selected';
            } ?>>Least Liked</option>
        </select>
    </form>
</div> --}}
    <div class="mb-20">
        <div class="sm:grid grid-cols-4 gap-10 w-4/5 mx-auto py-15">
            @foreach ($books as $book)
                
                    <!-- Main book div wrapped in a link except edit and delete -->

                    <div class="each_book_container">
                        <a href="/book/{{ $book->slug }}" class="no-underline hover:no-underline flex flex-col justify-between">
                            <div class="flex flex-col justify-center">
                                <img src="{{ asset('images/' . $book->image_path) }}" alt="{{ $book->bookName }}">
                            </div>
                            <div>
                                <h2 class="text-gray-700 font-bold text-2xl pb-4">
                                    {{ $book->bookName }}
                                </h2>

                                <div class="text-gray-500">
                                     By <span class="font-bold italic text-gray-800">{{ $book->author }}</span>,
                                    published
                                    on
                                    {{ date('jS M Y', strtotime($book->publishTime)) }}
                                </div>
                                <div class="text-gray-500">
                                    Type: <span class="font-bold italic text-gray-800">{{ $book->type }}</span>
                                </div>
                                {{-- <?php
                                $wordCount = str_word_count($book->description);
                                
                                if ($wordCount > 40) {
                                    $words = explode(' ', $book->description);
                                    $shortDescription = implode(' ', array_slice($words, 0, 40));
                                    $shortDescription .= ' ...';
                                } else {
                                    $shortDescription = $book->description;
                                }
                                
                                echo "<p class='text-base text-red-700 pt-2 mb-3 leading-6 font-light'>$shortDescription</p>";
                                ?> --}}
                                <div class="text-gray-500">
                                     €<span class="font-bold italic text-gray-800">{{ $book->price }}</span>
                                </div>
                            </div>
                        </a>

                        <!-- Admin actions outside of the main clickable area -->
                        @if (isset(Auth::user()->id) && Auth::user()->isAdmin())
                            <div class="flex flex-row items-center justify-evenly mt-5">
                                <div>
                                    <a href="/book/{{ $book->slug }}/edit"
                                        class="uppercase text-sm font-extrabold py-2 px-4 edit_button_color">
                                        Edit
                                    </a>
                                </div>
                                <div>
                                    <form action="/book/{{ $book->slug }}" method="POST" class="none">
                                        @csrf
                                        @method('delete')

                                        <button
                                            class="uppercase text-sm font-extrabold py-2 px-4 delete_button_color"
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

