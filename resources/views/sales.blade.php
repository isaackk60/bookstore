@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto text-center">
        <div class="border-b border-gray-200">
            {{-- <h1 class="page_title text-blue-800"> --}}
                <h1 class="page_title text-blue-800 text-4xl font-semibold uppercase" style="font-family: 'Merriweather', serif;">
                Purchase History
            </h1>
        </div>

        @if (session()->has('message'))
            <div class="w-4/5 mx-auto mt-10">
                <p class="px-5 mb-4 bg-green-500 text-gray-50 rounded-xl py-4">
                    {{ session()->get('message') }}
                </p>
            </div>
        @endif

        @if (count($sales) == 0)
           <div class="my-10">
                <span class="text-3xl font-bold text-gray-700 mb-5">You haven't placed any orders yet</span>
           </div>
           <a href="/book" class="bg-slate-800 hover:bg-slate-700 text-white py-2 px-4 rounded mt-2 inline-block ">
            Go Shopping
        </a>
        @else
        <div class="mx-auto max-w-7xl px-4 saleWidth">
            @foreach ($sales as $sale)
                <div class="mt-8 p-6 bg-white shadow-md rounded-lg">
                    <h3 class="text-xl font-semibold mb-4">Order Details # {{ $sale->id }}</h3>
                    <p class="font-medium">Order Date: {{ date('Y-m-d H:i:s', strtotime($sale->order_date)) }}</p>
                    <div class="mt-4">
                        <ul class="space-y-4">
                            @foreach ($sale->books as $book)
                                <li class="bg-gray-100 rounded-lg p-4 gap-4 saleContainer">
                                    <img class=" h-32 object-cover rounded-md" src="{{ $book['image'] }}" alt="Book Image">
                                    <div class="flex-1">
                                        <p class="text-lg font-semibold">{{ $book['name'] }}</p>
                                        <p>Price: €{{ number_format($book['price'], 2) }}</p>
                                        <p>Quantity: {{ $book['quantity'] }}</p>
                                        <p>Total price: €{{ number_format($book['price'] * $book['quantity'], 2) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <p class="mt-4 text-right font-semibold">Total Price: €{{ number_format($sale->order_price, 2) }}</p>
                </div>
            @endforeach
        </div>
        @endif
    </div>
@endsection


