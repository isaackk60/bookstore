@extends('layouts.app')

@section('content')
    {{-- <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Update Book
            </h1>
        </div>
    </div> --}}

    @if ($errors->any())
        <div class="w-4/5 m-auto mt-10 pl-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4 px-5">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="text-center text-5xl font-semibold text-gray-700 my-5 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">Update
        Book</h2>
    <div class="w-4/5 m-auto mb-20 rounded pt-5">
        <form action="/book/{{ $book->slug }}" method="POST" enctype="multipart/form-data"
            class="px-6 space-y-6 sm:px-10 sm:space-y-8">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <input type="text" name="bookName" value="{{ $book->bookName }}" placeholder="Book Name"
                    class="form-input w-full mb-8 text-xl">
                <input type="text" name="author" value="{{ $book->author }}" placeholder="Author"
                    class="form-input w-full mb-8 text-xl">
                {{-- <input type="date" name="publishTime" value="{{ $book->publishTime }}" --}}
                <input type="date" name="publishTime" placeholder="Publish Date" max="{{ now()->toDateString() }}" 
                    class="form-input w-full mb-8 text-xl">
                <input type="number" name="stock" value="{{ $book->stock }}" placeholder="Stock"
                    class="form-input w-full mb-8 text-xl">
                    <input type="number" name="price" step="0.01" value="{{ $book->price }}" placeholder="Price"
                    class="form-input w-full mb-8 text-xl">
                <input type="text" name="type" value="{{ $book->type }}" placeholder="Type"
                    class="form-input w-full mb-8 text-xl">
                <input type="number" name="pages" value="{{ $book->pages }}" placeholder="Pages"
                    class="form-input w-full mb-8 text-xl">
                <textarea name="description" placeholder="Description" class="form-textarea w-full h-60">{{ $book->description }}</textarea>
                {{-- <div class="bg-grey-lighter pt-15">
                    <label class="w-44 flex flex-col items-center px-2 py-3 bg-gray-100 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                        <span class="text-base leading-normal">
                            Change Image
                        </span>
                        <input type="file" name="image_path" class="hidden">
                    </label>
                </div> --}}
                <button type="submit"
                    class="mt-10 w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4 mb-8">Update</button>
            </div>
        </form>
    </div>

@endsection
