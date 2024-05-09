@extends('layouts.app')

@section('content')
    <div class="background-image grid grid-cols-1 m-auto relative mt-10" style="height: 600px; overflow: hidden;">
        <div class="slide" id="slide1"></div>
        <div class="slide" id="slide2"></div>
        <div class="slide" id="slide3"></div>

        <div class="flex text-gray-100 pt-10 absolute top-0 left-0 w-full h-full">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="text-5xl uppercase font-bold text-shadow-md pb-14 pt-40">
                    Dive Into Books
                </h1>
                <h3 class="text-2xl uppercase italic font-bold text-shadow-md pb-14">
                    Discover your next great read, explore untold stories, and classic literature from around the globe
                </h3>
                <a href="/book"
                    class="text-center bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase bookstartbutton">
                    Start Finding
                </a>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-2 mt-8 gap-20 w-4/5 mx-auto py-15">
        <div class="pb-8">
            <img src="https://img.freepik.com/free-photo/book-composition-with-open-book_23-2147690555.jpg?w=826&t=st=1715256393~exp=1715256993~hmac=ce0afd47f9396f0a271709f646eb630f0d9c9309304d2082157e079f6e76299b"
                alt="">
        </div>
        <div class="flex flex-col justify-center">
            <h2 class="text-3xl font-semibold mb-4">Bookish Escapes: Your Online Literary Haven</h2>
            <p class="text-lg font-medium text-gray-700 leading-relaxed mb-6">Welcome to our online bookstore, where
                literary journeys await at the click of a button! Dive into a world where stories come alive and
                imaginations soar. Our virtual shelves are brimming with an extensive collection of books spanning every
                genre imaginable, curated to cater to the voracious reader in you.</p>
        </div>
    </div>

    <div class="text-center mt-8 px-6 py-4 shadow-lg rounded-lg bg-white featured-book">
        <h4 class="text-gray-800 text-xl font-bold mb-2">Featured Book of the Month</h4>
        <p class="text-gray-600 text-md mb-5">
            "Infinite Jest" by David Foster Wallace offers an in-depth exploration of human emotions and modern society, a
            must-read for lovers of complex narratives and rich, engaging storytelling.
        </p>
        <a href="/book" class="bg-slate-800 hover:bg-slate-700 text-white py-2 px-4 rounded mt-2 inline-block ">
            Learn More
        </a>
    </div>
    <div class="w-4/5 m-auto">
        <div class="grid grid-cols-3 gap-4 ">
            @foreach ($books->take(6) as $book)
                <a href="/book/{{ $book->slug }}" class="book-item">
                    <img src="{{ asset('images/' . $book->image_path) }}" alt="{{ $book->bookName }}" class="book-image">
                    <div>
                        <h2 class="text-2xl font-semibold">
                            {{ $book->bookName }}
                        </h2>
                        <div class="text-gray-500">
                            Authored By <span class="font-bold italic text-gray-800">{{ $book->author }}</span>,
                            published on {{ date('jS M Y', strtotime($book->publishTime)) }}
                        </div>
                        <div class="text-gray-500 ">
                            Price: €<span class="font-bold italic text-gray-800">{{ $book->price }}</span>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endsection
