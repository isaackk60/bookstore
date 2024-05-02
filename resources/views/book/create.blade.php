@extends('layouts.app')

 @section('content') 

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

<h2 class="text-center text-5xl font-semibold text-gray-700 my-5 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">Create Book</h2>
<div class="w-4/5 m-auto mb-20 rounded pt-5">
<form action="/book" method="POST" enctype="multipart/form-data" class="px-6 space-y-6 sm:px-10 sm:space-y-8">
    @csrf

    <div class="flex flex-col">
        {{-- <input type="text" name="slug" placeholder="Slug..." class="form-input w-full mb-8 text-xl"> --}}
        <input type="text" name="bookName" placeholder="Book Name" class="form-input w-full mb-8 text-xl">
        <input type="text" name="author" placeholder="Author" class="form-input w-full mb-8 text-xl">
        <input type="date" name="publishTime" placeholder="Publish Date" class="form-input w-full mb-8 text-xl">
        <input type="number" name="stock" placeholder="Stock" class="form-input w-full mb-8 text-xl">
        <input type="text" name="type" placeholder="Type" class="form-input w-full mb-8 text-xl">
        <input type="number" name="pages" placeholder="Pages" class="form-input w-full mb-8 text-xl">
        <input type="number" name="price" step="0.01" placeholder="Price" class="form-input w-full mb-8 text-xl">
        <textarea name="description" placeholder="Description" class="form-textarea w-full h-60"></textarea>

        <div class="bg-grey-lighter pt-15">
            <label id="fileUploadContainer"
                class="w-44 flex flex-col items-center px-2 py-3 bg-gray-100 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                <span id="fileUploadText" class="text-base leading-normal">
                    Upload Image
                </span>
                <input type="file" name="image" class="hidden" id="fileInput" onchange="fileUploaded()">
                {{-- <input type="file" name="image" class="hidden" id="fileInput" onchange="fileUploaded()"> --}}
            </label>
        </div>

        <button type="submit"
            class="mt-10 w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4 mb-8">Submit</button>
    </div>
</form>
</div>

<script>
function fileUploaded() {
    let fileInputContainer = document.getElementById('fileUploadContainer');
    let fileInput = document.getElementById('fileInput');
    let fileUploadText = document.getElementById('fileUploadText');

    if (fileInput.files.length > 0) {
        fileInputContainer.classList.remove('bg-grey-lighter');
        fileInputContainer.classList.add('bg-blue-500');
        fileInputContainer.classList.add('font-bold');
        fileUploadText.style.color = "white";
        fileUploadText.innerHTML = "Uploaded Image";
    }
}
</script>

@endsection
