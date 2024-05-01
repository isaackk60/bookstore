{{-- @extends('layouts.app')

@section('content') --}}
    {{-- <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Update News
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
        News</h2>
    <div class="w-4/5 m-auto mb-20 rounded about-background-color pt-5">
        <form action="/book/{{ $book->slug }}" method="POST" enctype="multipart/form-data"
            class="px-6 space-y-6 sm:px-10 sm:space-y-8">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <input type="text" name="title" value="{{ $book->title }}" placeholder="Title..."
                    class="form-input w-full mb-8 text-xl">
                <textarea name="subtitle" placeholder="Subtitle..." class="form-textarea w-full mb-8 h-17 text-lg">{{ $book->subtitle }}</textarea>
                <textarea name="description" placeholder="Description..." class="form-textarea w-full h-60">{{ $book->description }}</textarea>
                <button type="submit"
                    class="mt-10 w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 button-color sm:py-4 mb-8">Update</button>
            </div>
        </form>
    </div>

{{-- 
@endsection --}}