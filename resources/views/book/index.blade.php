@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl uppercase text-blue-800 font-semibold">
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

@if (isset(Auth::user()->id) && Auth::user()->isAdmin())
    <div class="pt-15 w-4/5 m-auto">
        <a href="/book/create"
            class="uppercase bg-transparent text-red-500 text-xs font-extrabold py-3 px-5 rounded-3xl">
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
    @foreach ($books as $book)
    @if($book->stock>0)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
            <div class="image-padding">
                <img src="{{ asset('images/' . $book->image_path) }}" alt="">
            </div>
            <div>
                <h2 class="text-gray-700 font-bold text-2xl pb-4">
                    {{ $book->bookName }}
                </h2>

                <span class="text-gray-500">
                    Authored By <span class="font-bold italic text-gray-800">{{ $book->author }}</span>, published on
                    {{ date('jS M Y', strtotime($book->publishTime)) }}
                </span>
                <div class="text-gray-500">
                    Type: <span class="font-bold italic text-gray-800">{{ $book->type }}</span>
                </div>
                <?php
                $wordCount = str_word_count($book->description);
                
                if ($wordCount > 40) {
                    $words = explode(' ', $book->description);
                    $shortDescription = implode(' ', array_slice($words, 0, 40));
                    $shortDescription .= ' ...';
                } else {
                    $shortDescription = $book->description;
                }
                
                echo "<p class='text-base text-red-700 pt-2 mb-3 leading-6 font-light'>$shortDescription</p>";
                ?>
                <div class="text-gray-500">
                    Price: €<span class="font-bold italic text-gray-800">{{ $book->price }}</span>
                </div>

                <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <a href="/book/{{ $book->slug }}"
                            class="uppercase bg-transparent text-red-500 text-xs font-extrabold py-3 px-5 rounded-3xl">
                            Read More
                        </a>
                    </div>

                    @if (isset(Auth::user()->id) && Auth::user()->isAdmin())
                        <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <a href="/book/{{ $book->slug }}/edit"
                                    class="uppercase bg-transparent text-red-500 text-xs font-extrabold py-3 px-5 rounded-3xl">
                                    Edit
                                </a>
                            </div>
                            <div>
                                <form action="/book/{{ $book->slug }}" method="POST" class="none">
                                    @csrf
                                    @method('delete')

                                    <button class="uppercase bg-transparent text-red-500 text-xs font-extrabold py-3 px-5 rounded-3xl" type="submit">
                                        Delete
                                    </button>

                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection