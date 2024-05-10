{{-- resources/views/user/userinfo.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="mb-20">
    <div class="w-4/5 m-auto text-center">
        {{-- <h1 class="page_title text-blue-800"> --}}
            <h1 class="page_title text-blue-800 text-4xl font-semibold uppercase" style="font-family: 'Merriweather', serif;">
            User Information</h1>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border-2">Name</th>
                <th class="px-4 py-2 border-2">Email</th>
                <th class="px-4 py-2 border-2">Button</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            @if(!$user->isAdmin())
            <tr>
                <td class="border-2 px-4 py-2">{{ $user->name }}</td>
                <td class="border-2 px-4 py-2">{{ $user->email }}</td>
                <td class="border-2 px-4 py-2">
                    <div class="flex justify-evenly"> 
                    <a href="{{ route('user.sales', $user) }}" class="uppercase text-sm font-extrabold py-2 px-4 edit_button_color">View</a>
                    <form action="/userinfo/delete/{{ $user->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="uppercase text-sm font-extrabold py-2 px-4 delete_button_color" type="submit">Delete</button>
                    </form>
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
