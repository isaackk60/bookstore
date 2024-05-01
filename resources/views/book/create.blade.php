{{-- @extends('layouts.app')--}}

{{-- @section('content')  --}}

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



<h2 class="text-center text-5xl font-semibold text-gray-700 my-5 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">Create
News</h2>
<div class="w-4/5 m-auto about-background-color mb-20 rounded pt-5">
<form action="/book" method="POST" enctype="multipart/form-data" class="px-6 space-y-6 sm:px-10 sm:space-y-8">
    @csrf
   
    <div class="flex flex-col">
        <input type="text" name="title" placeholder="Title..." class="form-input w-full mb-8 text-xl">
        <textarea name="subtitle" placeholder="Subtitle..." class="form-textarea w-full mb-8 h-17 text-lg"></textarea>
        <textarea name="description" placeholder="Description..." class="form-textarea w-full h-60"></textarea>
        <div class="bg-grey-lighter pt-15">
            <label id="fileUploadContainer"
                class="w-44 flex flex-col font-medium items-center px-2 py-3 bg-gray-100 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                <span id="fileUploadText" class="text-base leading-normal">
                    Upload Image
                </span>
                <input type="file" name="image" class="hidden" id="fileInput" onchange="fileUploaded()">
            </label>

        </div>
        <button type="submit"
            class="mt-10 w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 button-color sm:py-4 mb-8">Submit</button>
    </div>
</form>
</div>


<script>
function fileUploaded() {
    let fileInputContainer = document.getElementById('fileUploadContainer');
    let fileInput = document.getElementById('fileInput');
    let fileUploadText = document.getElementById('fileUploadText')

    if (fileInput.files.length > 0) {
        fileInputContainer.classList.remove('bg-grey-lighter');
        fileInputContainer.classList.remove('font-medium');
        fileInputContainer.classList.add('bg-blue-500');
        fileInputContainer.classList.add('font-bold');
        fileUploadText.style.color = "white"
        fileUploadText.innerHTML = "Uploaded Image"
    }
}
</script>

{{-- @endsection --}}