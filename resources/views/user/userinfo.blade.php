{{-- resources/views/user/userinfo.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">User Information</h1>
    <div class="list-group">
        @foreach ($users as $user)
            <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $user->name }}</h5>
                </div>
                <p class="mb-1">{{ $user->email }}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
