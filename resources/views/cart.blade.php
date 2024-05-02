@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="py-15 border-b border-gray-200">
            <h1 class="text-6xl uppercase text-blue-800 font-semibold">
                Cart
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

    @if (Auth::check())
        <div class="pt-15 w-4/5 m-auto">
            <a href="/blog/create"
                class="button-color uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                Create post
            </a>
        </div>
    @endif

    <div class="w-4/5 mx-auto pt-15">
        <form action="/blog" method="GET">
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
    </div>
    <div class="mb-20">
        @foreach ($posts as $post)
            <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                <div class="image-padding">
                    <img src="{{ asset('images/' . $post->image_path) }}" alt="">
                </div>
                <div>
                    <h2 class="text-gray-700 font-bold text-2xl pb-4">
                        {{ $post->title }}
                    </h2>

                    <span class="text-gray-500">
                        By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on
                        {{ date('jS M Y', strtotime($post->updated_at)) }}
                    </span>

                    {{-- <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {{ $post->description }}
            </p> --}}
                    <?php
                    $wordCount = str_word_count($post->description);
                    
                    if ($wordCount > 40) {
                        $words = explode(' ', $post->description);
                        $shortDescription = implode(' ', array_slice($words, 0, 40));
                        $shortDescription .= ' ...';
                    } else {
                        $shortDescription = $post->description;
                    }
                    
                    echo "<p class='text-base text-gray-700 pt-2 mb-3 leading-6 font-light'>$shortDescription</p>";
                    ?>
                    <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <a href="/blog/{{ $post->slug }}"
                                class="uppercase button-color text-gray-100 text-lg font-extrabold py-3.5 px-8 rounded-2xl">
                                Read More
                            </a>
                        </div>

                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                            <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <a href="/blog/{{ $post->slug }}/edit"
                                        class="text-white mr-3 edit-button-color px-3 py-2.5 rounded">
                                        Edit
                                    </a>
                                </div>
                                <div>
                                    <form action="/blog/{{ $post->slug }}" method="POST" class="none">
                                        @csrf
                                        @method('delete')

                                        <button class="text-white delete-button-color p-3 rounded" type="submit">
                                            Delete
                                        </button>

                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
