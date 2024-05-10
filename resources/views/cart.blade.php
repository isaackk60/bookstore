@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto text-center">
        <div class="border-b border-gray-200">
            {{-- <h1 class="page_title text-blue-800"> --}}
                <h1 class="page_title text-blue-800 text-4xl font-semibold uppercase" style="font-family: 'Merriweather', serif;">
                Shopping Cart
            </h1>
        </div>

        @if (session()->has('message'))
            <div class="w-4/5 mx-auto mt-10 pl-2">
                <p class="px-5 w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                    {{ session()->get('message') }}
                </p>
            </div>
        @endif
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


        @if (count($cartItems) == 0)
           <div class="my-10">
                <span class="text-3xl font-bold text-gray-700 mb-5">Your cart is empty</span>
           </div>
           <a href="/book" class="bg-slate-800 hover:bg-slate-700 text-white py-2 px-4 rounded mt-2 inline-block ">
            Go Shopping
        </a>
        @else
            <div class="mx-auto  max-w-7xl">
                @php
                    $totalPrice = 0;
                    $cartItemsArray = [];
                @endphp

                @foreach ($cartItems as $cartItem)
                
                    @if ($cartItem->quantity <= $cartItem->book->stock)
                        {{-- <div class="flex flex-col md:flex-row justify-center py-5 border-b border-gray-200"> --}}
                        <div class="flex flex-col md:flex-row justify-center items-center py-5 border-b border-gray-200">
                            <a href="/book/{{ $cartItem->book->slug }}">
                            <div class="w-32 h-48 overflow-hidden aspect-w-3 aspect-h-4 mb-4 md:mb-0">
                                <img src="{{ asset('images/' . $cartItem->book->image_path) }}"
                                    alt="{{ $cartItem->book->bookName }}" class="w-full h-full object-cover">
                            </div>
                        </a>
                            <div class="w-3/5 ml-8 text-center md:text-left">
                                <h1 class="text-3xl font-bold text-gray-700 mb-5">
                                    {{ $cartItem->book->bookName }}
                                </h1>
                                <p class="text-sm text-gray-700 mb-5 font-bold">
                                    Authored by <span class="font-bold ">{{ $cartItem->book->author }}</span>
                                </p>
                                <p class="text-sm text-gray-700 font-bold ">
                                    Price: <span class="font-medium">€ {{ number_format($cartItem->book->price, 2) }}</span>
                                </p>

                                <div class="flex items-center mt-4">
                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="updateForm">
                                        @csrf
                                        @method('PUT')
                                        <label>Quantity: </label>
                                        <select name="quantity" class="form-select w-full mb-8 text-xl"
                                            onchange="updateTotalPrice(this,{{ $cartItem->book->price }})"  id="quantity">
                                            @for ($availableStock = 1; $availableStock <= min(10, $cartItem->book->stock); $availableStock++)
                                                <option value="{{ $availableStock }}"
                                                    {{ $cartItem->quantity == $availableStock ? 'selected' : '' }}>
                                                    {{ $availableStock }}
                                                </option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="total_price" class="total_price"
                                            value="{{ $cartItem->book->price * $cartItem->quantity }}">
                                    </form>
                                </div>
                                {{-- <div class="flex items-center mt-4">
                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="flex items-center updateForm">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="text-lg px-3 py-1 border rounded-l-md border-gray-300 bg-gray-200 hover:bg-gray-300"
                                                onclick="changeQuantity(false, '{{ $cartItem->id }}', {{ $cartItem->book->stock }}, 10)">-</button>
                                        <input type="text" name="quantity" value="{{ $cartItem->quantity }}" class="w-12 text-center border-t border-b border-gray-300"
                                               id="quantity-{{ $cartItem->id }}" readonly>
                                        <button type="button" class="text-lg px-3 py-1 border rounded-r-md border-gray-300 bg-gray-200 hover:bg-gray-300"
                                                onclick="changeQuantity(true, '{{ $cartItem->id }}', {{ $cartItem->book->stock }}, 10)">+</button>
                                        <input type="hidden" name="total_price" class="total_price" value="{{ $cartItem->book->price * $cartItem->quantity }}">
                                    </form>
                                </div> --}}
                                <p class="text-base text-gray-700 pt-2 mb-3 leading-6 font-light">
                                    Total Price: €{{ $cartItem->book->price * $cartItem->quantity }}
                                </p>
                            </div>

                            <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                                @if (auth()->user()->id == $cartItem->user_id)
                                    <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                                                    type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @php
                                $cartItemsArray[] = [
                                    'image' => asset('images/' . $cartItem->book->image_path),
                                    'name' => $cartItem->book->bookName,
                                    'price' => $cartItem->book->price,
                                    'quantity' => $cartItem->quantity,
                                ];

                            $totalPrice += $cartItem->book->price * $cartItem->quantity; @endphp
                        </div>
                    @else
                        <div
                            class="flex flex-col md:flex-row justify-center items-center py-5 border-b border-gray-200 soldOutBg">
                            <a href="/book/{{ $cartItem->book->slug }}">
                            <div class="w-32 h-48 overflow-hidden aspect-w-3 aspect-h-4 mb-4 md:mb-0">
                                <img src="{{ asset('images/' . $cartItem->book->image_path) }}"
                                    alt="{{ $cartItem->book->bookName }}" class="w-full h-full object-cover">
                            </div>
                            </a>
                            <div class="w-3/5 ml-8 text-center md:text-left">
                                <h1 class="text-3xl font-bold text-gray-700 mb-5">
                                    {{ $cartItem->book->bookName }}
                                </h1>
                                <p class="text-sm text-gray-700 mb-5 font-bold">
                                    Authored by <span class="font-bold ">{{ $cartItem->book->author }}</span>
                                </p>
                                <p class="text-sm text-gray-700 font-bold ">
                                    Price: <span class="font-medium">€
                                        {{ number_format($cartItem->book->price, 2) }}</span>
                                </p>
                                @if($cartItem->book->stock==0)
                                <div class="mt-5">
                                    <span class="font-medium">Out of Stock</span>
                                </div>
                                @else
                                <div class="mt-5">
                                    <span class="font-medium">Only {{ $cartItem->book->stock }} left</span>
                                </div>
                                @endif

                                @php  $totalPrice +=0; @endphp
                            </div>


                            <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                                @if (auth()->user()->id == $cartItem->user_id)
                                    <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                                                    type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="text-lg font-bold py-4">
                    Total price: €{{ number_format($totalPrice, 2) }}
                </div>
            </div>
            <form action="/sales" method="POST">

                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="order_date" value="{{ now()->toDateTimeString() }}">

                <input type="hidden" name="books" value="{{ json_encode($cartItemsArray) }}">

                <input type="hidden" name="order_price" value="{{ $totalPrice }}">

                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-blue-500 text-white px-10 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Checkout
                    </button>
                </div>
            </form>
@endif
    </div>
@endsection

<script>
    function updateTotalPrice(selectedQuantity, price) {
        let form = selectedQuantity.closest('.updateForm');
        let quantity = selectedQuantity.value;
        let totalPrice = quantity * price;
        form.querySelector('.total_price').value = totalPrice;
        form.submit();
    }

    // function changeQuantity(isIncrement, id, maxStock) {
    //     const quantityInput = document.getElementById('quantity-' + id);
    //     let currentQuantity = parseInt(quantityInput.value);
    //     if (isIncrement && currentQuantity < maxStock) {
    //         currentQuantity++;
    //     } else if (!isIncrement && currentQuantity > 1) {
    //         currentQuantity--;
    //     }
    //     quantityInput.value = currentQuantity;

    //     // Update the total price before submitting
    //     const totalPriceInput = quantityInput.closest('.updateForm').querySelector('.total_price');
    //     const pricePerItem = totalPriceInput.value /
    //         currentQuantity; // Adjust this if your price per item calculation differs
    //     totalPriceInput.value = pricePerItem * currentQuantity;

    //     quantityInput.closest('.updateForm').submit(); // Automatically submit the form
    // }
</script>
