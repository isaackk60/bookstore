@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto text-center">
        <div class="py-15 border-b border-gray-200 m-20">
            <h1 class="text-5xl uppercase text-blue-800 font-semibold">
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

        <div class="mx-auto  max-w-7xl">
            @php $totalPrice = 0; @endphp
            @foreach ($cartItems as $cartItem)
                {{-- <div class="flex flex-col md:flex-row justify-center py-5 border-b border-gray-200"> --}}
                    <div class="flex flex-col md:flex-row justify-center items-center py-5 border-b border-gray-200">
                    <div class="w-32 h-48 overflow-hidden aspect-w-3 aspect-h-4 mb-4 md:mb-0">
                        <img src="{{ asset('images/' . $cartItem->book->image_path) }}" alt="{{ $cartItem->book->bookName }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="w-3/5 ml-8 text-center md:text-left">
                        <h1 class="text-3xl font-bold text-gray-700 mb-5">
                            {{ $cartItem->book->bookName }}
                        </h1>
                        <p class="text-sm text-gray-700 mb-5 font-bold" >
                            Authored by <span class="font-bold ">{{ $cartItem->book->author }}</span>
                        </p>
                        <p class="text-sm text-gray-700 font-bold ">
                            Price: <span class="font-medium">€ {{ number_format($cartItem->book->price, 2) }}</span>
                        </p>

                        <div class="flex items-center mt-4">
                            <form action="{{ route('cart.update', $cartItem->id) }}" method="POST"
                                class="flex items-center updateForm">
                                @csrf
                                @method('PUT')
                                <button type="button"
                                    class="text-lg px-3 py-1 border rounded-l-md border-gray-300 bg-gray-200 hover:bg-gray-300"
                                    onclick="changeQuantity(false, '{{ $cartItem->id }}', {{ $cartItem->book->stock }})">-</button>
                                <input type="text" name="quantity" value="{{ $cartItem->quantity }}"
                                    class="w-12 text-center border-t border-b border-gray-300"
                                    id="quantity-{{ $cartItem->id }}" readonly>
                                <button type="button"
                                    class="text-lg px-3 py-1 border rounded-r-md border-gray-300 bg-gray-200 hover:bg-gray-300"
                                    onclick="changeQuantity(true, '{{ $cartItem->id }}', {{ $cartItem->book->stock }})">+</button>
                                <input type="hidden" name="total_price" class="total_price"
                                    value="{{ $cartItem->book->price * $cartItem->quantity }}">
                            </form>
                        </div>
                        <p class="text-base text-gray-700 pt-2 mb-3 leading-6 font-light">
                            Total Price: {{ $cartItem->book->price * $cartItem->quantity }}
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
                    @php $totalPrice += $cartItem->book->price * $cartItem->quantity; @endphp
                </div>
            @endforeach
            <div class="text-lg font-bold py-4">
                Total price: €{{ number_format($totalPrice, 2) }}
            </div>
            <div class="flex justify-center">
                <button
                    class="bg-blue-500 text-white px-10 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Checkout
                </button>
            </div>
        </div>
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

    function changeQuantity(isIncrement, id, maxStock) {
        const quantityInput = document.getElementById('quantity-' + id);
        let currentQuantity = parseInt(quantityInput.value);
        if (isIncrement && currentQuantity < maxStock) {
            currentQuantity++;
        } else if (!isIncrement && currentQuantity > 1) {
            currentQuantity--;
        }
        quantityInput.value = currentQuantity;

        // Update the total price before submitting
        const totalPriceInput = quantityInput.closest('.updateForm').querySelector('.total_price');
        const pricePerItem = totalPriceInput.value /
            currentQuantity; // Adjust this if your price per item calculation differs
        totalPriceInput.value = pricePerItem * currentQuantity;

        quantityInput.closest('.updateForm').submit(); // Automatically submit the form
    }
</script>
