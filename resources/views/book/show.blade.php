@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
        <div class="w-4/5 m-auto mt-10 pl-2">
            <p class="px-5 w-2/6 text-gray-50 bg-green-500 rounded-2xl py-4">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif

    <div class="w-4/5 m-auto text-left">
        {{-- <div class="sm:grid grid-cols-2 mx-auto pt-12 pb-7 ">
            <h1 class="titleInReadMore">
                {{ $book->title }}
            </h1> --}}

        {{-- /blog/{{ $book->slug }}/dislike --}}
        {{-- <div class="sm:flex sm:flex-wrap items-center gap-4 mx-auto">
                <form action="/blog/{{ $book->slug }}/dislike" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-3 px-6 rounded-3xl">
                        <i class="fas fa-thumbs-down"></i>
                    </button>
                </form>
                <div class="loveOnSlugs"> ♥ {{ $book->like }}</div>
                <form id="likeForm" action="/blog/{{ $book->slug }}/like" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if (Auth::check() && $book->likedByUser(Auth::user()))
                        <button id="likeButton" type="submit"
                            class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-3 px-6 rounded-3xl">
                            <i class="fas fa-thumbs-up"></i>
                        </button>
                    @else
                        <button id="likeButton" type="submit"
                            class="uppercase bg-gray-500 text-gray-100 text-lg font-extrabold py-3 px-6 rounded-3xl">
                            <i class="fas fa-thumbs-up"></i>
                        </button>
                    @endif
                </form>
                <div>
                </div>
            </div>
        </div> --}}
        {{-- // can try to use class="w-4/5 m-auto" ---they are same meaning --}}
        <div class="sm:grid grid-cols-2 mx-auto mt-12 gap-10">
            <div>
                <div class="detailImage">
                    <img src="{{ asset('images/' . $book->image_path) }}" alt="">
                </div>
            </div>
            <div>
                <h2 class="text-4xl font-semibold pb-2">
                    {{ $book->bookName }}
                </h2>
                <div class="text-gray-500 pb-2">
                    Authored by {{ $book->author }}, published on {{ date('jS M Y', strtotime($book->publishTime)) }}
                </div>
                <div class="text-lg font-semibold pb-3">Type: {{ $book->type }}</div>
                <div class="text-lg font-semibold pb-3">Page: {{ $book->pages }}</div>
                <div class="text-lg font-semibold pb-3 ">Price: {{ $book->price }}</div>
                @if ($book->stock > 0)
                    <form action="/cart" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="total_price" value="{{ $book->price }}">

                        <select name="quantity" class="form-select w-full mb-8 text-xl">
                            @for ($availableStock = 1; $availableStock <= min(10, $book->stock); $availableStock++)
                                <option value="{{ $availableStock }}">{{ $availableStock }}</option>
                            @endfor
                        </select>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold uppercase py-2 px-4 rounded">
                            add to cart
                        </button>
                    </form>
                @elseif($book->stock <= 0)
                    <h3>The book is sold out</h3>
                @endif
            </div>
        </div>
        <div class="w-4/5 m-auto pt-10">
            <h3 class="text-2xl font-semibold">Description</h3>
            {{-- <span class="text-gray-500">
            By <span class="font-bold italic text-gray-800">{{ $book->user->name }}</span>, Created on
            {{ date('jS M Y', strtotime($book->updated_at)) }}
            </span> --}}

            {{-- <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light"> --}}
            {{-- {{ $book->description }} --}}
            {{-- {!! nl2br(e($book->description)) !!} --}}
            @foreach (explode("\n", $book->description) as $paragraph)
                @if (!empty(trim($paragraph)))
                    <p class="text-xl text-gray-700 pt-4 leading-8 font-normal">{{ $paragraph }}</p>
                @endif
            @endforeach
            {{-- </p> --}}
        </div>
    </div>
    <span class="line w-3/4"></span>
    <div class="about-background-color">
        <div class="w-4/5 m-auto text-left py-3 mt-14">
            <div class="w-4/5 m-auto mb-7">
                <h3 class="text-2xl font-semibold">Customers Reviews ({{ count($book->reviews) }})</h3>

                @if ($book->reviews->isNotEmpty())
                    @php
                        $averageRating = $book->reviews->avg('rating');
                    @endphp
                    <div class="flex items-center">
                        <p class="text-3xl py-4 leading-8 font-bold">
                            {{ number_format($averageRating, 1) }}</p>
                        <div class="star-icon-display pl-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $averageRating)
                                    <span class="fa fa-star text-yellow-500"></span>
                                @elseif ($i - 1 < $averageRating && $i > $averageRating)
                                    <span class="fa-solid fa-star-half halfStar text-yellow-500"></span>
                                @endif
                            @endfor
                        </div>
                    </div>
                @endif
                @foreach ($book->reviews as $review)
                    <div class="review-container border-b border-gray-300">
                        <div class="sm:flex sm:h-10 sm:flex-row sm:items-center sm:justify-between">
                            <div class="reviewTime text-gray-500">
                                <span class="font-bold italic text-gray-800">{{ $review->user->name }}</span>
                            </div>

                            @if (Auth::check() && ($review->user_id === Auth::id() || Auth::user()->isAdmin()))
                                <div
                                    class="editButtonContainer sm:flex sm:h-10 sm:flex-row sm:items-center sm:justify-between">
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <button type="submit"
                                            class="uppercase text-sm font-extrabold py-2 px-4 text-red-600 rounded transition-colors duration-300">Delete</button> --}}
                                        <button type="submit"
                                            class="text-red-600 font-bold uppercase text-sm px-4 py-2 rounded hover:bg-red-500 hover:text-white transition-colors duration-300">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="star-icon-display ">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <span class="fa fa-star text-yellow-500"></span>
                                @else
                                    <span class="fa fa-star noRatingColor "></span>
                                @endif
                            @endfor
                        </div>
                        <div class="reviewTime text-gray-500">
                            Reviewed on
                            {{ date('jS M Y', strtotime($review->updated_at)) }}
                        </div>
                        <p class="editReviewContent text-xl text-gray-700 leading-8 font-normal py-2">
                            {{ $review->content }}</p>


                    </div>
                @endforeach
                @if ($book->reviews->isEmpty())
                    <div class="mx-auto py-5">
                        <h3 class="text-2xl font-medium text-center">There are no reviews yet</h3>
                    </div>
                @endif

                {{-- @if (Auth::check())
                    <h3 class="text-2xl font-semibold py-4">Create Reviews</h3>
                    <form class="flex flex-col items-start space-y-4" action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="star-icon flex space-x-1">
                            <input type="radio" id="rating1" name="rating" value="1" class="hidden">
                            <label for="rating1" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                            <input type="radio" id="rating2" name="rating" value="2" class="hidden">
                            <label for="rating2" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                            <input type="radio" id="rating3" name="rating" value="3" class="hidden">
                            <label for="rating3" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                            <input type="radio" id="rating4" name="rating" value="4" class="hidden">
                            <label for="rating4" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                            <input type="radio" id="rating5" name="rating" value="5" class="hidden" checked>
                            <label for="rating5" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                        </div>

                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <textarea id="reviewContent" name="content" placeholder="Add a Comment..."
                            class="p-2 bg-gray-100 block border-2 border-gray-300 w-full max-w-5xl h-32 text-lg outline-none mt-4 mb-5"></textarea>
                        <button id="reviewButton" type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold uppercase py-2 px-4 rounded">Review</button>
                    </form>
                @endif --}}

                @if (Auth::check())
                    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h3 class="text-2xl font-semibold text-gray-800  pt-3">Create a Review</h3>
                        <form class="flex flex-col space-y-4" action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <div class="star-icon flex space-x-1">
                                <input type="radio" id="rating1" name="rating" value="1" class="hidden">
                                <label for="rating1" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                                <input type="radio" id="rating2" name="rating" value="2" class="hidden">
                                <label for="rating2" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                                <input type="radio" id="rating3" name="rating" value="3" class="hidden">
                                <label for="rating3" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                                <input type="radio" id="rating4" name="rating" value="4" class="hidden">
                                <label for="rating4" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                                <input type="radio" id="rating5" name="rating" value="5" class="hidden" checked>
                                <label for="rating5" class="fa fa-star text-yellow-500 cursor-pointer"></label>
                            </div>

                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <textarea id="reviewContent" name="content" placeholder="Add a Comment..."
                                class="p-4 bg-white border border-gray-300 w-full h-36 text-lg rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 ease-in-out mt-4 mb-5"></textarea>
                            <button id="reviewButton" type="submit"
                                class="w-1/4 bg-blue-500 hover:bg-blue-700 text-white font-bold uppercase py-3 px-4 rounded shadow hover:shadow-md transition duration-300">Post
                                Review</button>

                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
    {{-- <div class="about-background-color">
<div class="w-4/5 m-auto text-left py-7 mt-14">
    <div class="w-4/5 m-auto mb-7">
        <h2 class="text-3xl font-semibold">Comments</h2>

        @foreach ($book->reviews as $review)
            <div class="review-container">
                <p class="editReviewContent text-xl text-gray-700 pt-8 leading-8 font-normal pb-2">
                    {{ $review->content }}</p>

                <form action="{{ route('reviews.update', $review->id) }}" method="POST"
                    class="hidden inputEditReviewForm ">
                    @csrf
                    @method('PUT')
                    <textarea name="content" placeholder="Add a Comment..."
                        class="inputEditComment p-2 leading-7 bg-transparent block border-2 w-full h-20 text-xl outline-none my-9 bg-gray-100">{{ $review->content }}</textarea>
                    <button type="submit"
                        class="editCommentButton uppercase button-color text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">Save</button>
                    <button id="cancelButton" name="cancelButton"
                        class="uppercase cancel-button-color text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">Cancel</button>
                </form>

                <div class="sm:flex sm:h-10 sm:flex-row sm:items-center sm:justify-between">
                    <div class="reviewTime text-gray-500">
                        By <span class="font-bold italic text-gray-800">{{ $review->user->name }}</span>,
                        Commented on
                        {{ date('jS M Y', strtotime($review->updated_at)) }}
                    </div>

                    @if (Auth::check() && $review->user_id === Auth::id())
                        <div class="editButtonContainer sm:flex sm:h-10 sm:flex-row sm:items-center sm:justify-between">
                            <button
                                class="editButton text-white mr-3 edit-button-color px-3 py-2.5 rounded">Edit</button>

                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white delete-button-color p-3 rounded">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        @if ($book->reviews->isEmpty())
            <div class="mx-auto py-5">
                <h3 class="text-2xl font-medium text-center">There are no reviews yet</h3>
            </div>
        @endif

        @if (Auth::check())
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <textarea id="reviewContent" name="content" placeholder="Add a Comment..."
                    class="p-2 leading-7 bg-transparent block border-2 w-full h-20 text-xl outline-none mt-9 mb-5 bg-gray-100"></textarea>
                <button id="reviewButton" type="submit"
                    class="uppercase button-color text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl mb-4 hidden">Comment</button>
            </form>
        @endif
    </div>
</div>
</div> --}}



    {{-- @if (isset(Auth::user()->id)) --}}
    {{-- <form 
action="{{ route('posts.updateLike', $book->slug) }}"

method="POST"
enctype="multipart/form-data">
@csrf
@method('PUT')

<input 
    type="text"
    name="like"
    value="{{ $book->like }}"
    class="px-2 bg-transparent block border-b-2 w-full h-20 text-5xl outline-none">

<button    
    type="submit"
    class="uppercase mt-12 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
    Update Post
</button>
</form> --}}
    {{-- @endif --}}
    {{-- <script>
        document.getElementById('quantity').addEventListener('change', function() {
            let quantity = this.value;
            let totalPrice = quantity * {{ $book->price }};
            document.getElementById('total_price').value = totalPrice;
        });
    </script> --}}

    <script>
        // document.getElementById('quantity').addEventListener('change', function() {
        //     let quantity = this.value;
        //     let totalPrice = quantity * {{ $book->price }};
        //     document.getElementById('total_price').value = totalPrice;
        // });
        // const likeForm = document.getElementById('likeForm');
        // const likeButton = document.getElementById('likeButton');
        const reviewContent = document.getElementById('reviewContent');
        const reviewButton = document.getElementById('reviewButton');

        // const cancelButtons = document.querySelectorAll('.cancelButton');
        // const editButtons = document.querySelectorAll('.editButton');


        // editButtons.forEach(editButton => {
        //     editButton.addEventListener('click', function(event) {
        //         const reviewContainer = event.target.closest('.review-container');
        //         const reviewContent = reviewContainer.querySelector('.editReviewContent');
        //         const editForm = reviewContainer.querySelector('.inputEditReviewForm');
        //         const reviewTimes = reviewContainer.querySelector('.reviewTime');
        //         const editButtonContainer = reviewContainer.querySelector('.editButtonContainer');

        //         reviewContent.style.display = 'none';
        //         reviewTimes.style.display = 'none';
        //         editForm.style.display = 'block';
        //         editButtonContainer.style.display = 'none';
        //     });
        // });


        // cancelButtons.forEach(cancelButton => {
        //     cancelButton.addEventListener('click', function(event) {
        //         const reviewContainer = event.target.closest('.review-container');
        //         const reviewContent = reviewContainer.querySelector('.editReviewContent');
        //         const editForm = reviewContainer.querySelector('.inputEditReviewForm');
        //         const reviewTimes = reviewContainer.querySelector('.reviewTime');
        //         const editButtonContainer = reviewContainer.querySelector('.editButtonContainer');

        //         reviewContent.style.display = 'block';
        //         reviewTimes.style.display = 'block';
        //         editForm.style.display = 'none';
        //         editButtonContainer.style.display = 'block';
        //     });
        // });


        // likeForm.addEventListener('submit', function(event) {
        //     event.preventDefault();

        //     const actionUrl = likeButton.classList.contains('liked') ? '/blog/{{ $book->slug }}/dislike' :
        //         '/blog/{{ $book->slug }}/like';

        //     likeForm.action = actionUrl;

        //     likeForm.submit();
        // });

        // likeButton.addEventListener('click', function() {
        //     likeButton.classList.toggle('liked');
        // });

        reviewContent.addEventListener('input', () => {
            if (reviewContent.value.trim() === "") {
                reviewButton.disabled = true;
                if (!reviewButton.classList.contains('hidden')) {
                    reviewButton.classList.add('hidden');
                }

            } else {
                reviewButton.disabled = false;
                reviewButton.classList.remove('hidden');
            }
        });

        document.getElementById('reviewContent').addEventListener('focus', function() {
            if (this.value === 'No comment provided') {
                this.value = ''; // Clear the text when it matches default text
                reviewButton.disabled = true;
                if (!reviewButton.classList.contains('hidden')) {
                    reviewButton.classList.add('hidden');
                }
            }
        });

        document.getElementById('reviewContent').addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.value = 'No comment provided'; // Restore default text if empty
                reviewButton.disabled = false;
                reviewButton.classList.remove('hidden');
            }
        });
    </script>
@endsection
