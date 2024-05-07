@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto text-center">
        <div class="py-15 border-b border-gray-200 m-20">
            <h1 class="text-5xl uppercase text-blue-800 font-semibold">
                Purchase History
            </h1>
        </div>

        @if (session()->has('message'))
            <div class="w-4/5 mx-auto mt-10 pl-2">
                <p class="px-5 w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                    {{ session()->get('message') }}
                </p>
            </div>
        @endif

        <div class="mx-auto  max-w-7xl">
            @foreach ($sales as $sale)
                <div>
                    <p>Order Date: {{ date('Y-m-d H:i:s', strtotime($sale->order_date)) }}</p>
                    <ul>
                        @foreach ($sale->books as $book)
                            <li>
                                <img src="{{ $book['image'] }}" alt="Book Image">
                                <p> Book Name: {{ $book['name'] }}</p>
                                <p> Price: {{ $book['price'] }}</p>
                                <p> Quantity: {{ $book['quantity'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <p>Total Price: {{ $sale->order_price }}</p>
                </div>
            @endforeach

        </div>
    </div>
@endsection
