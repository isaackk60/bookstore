@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="py-15 border-b border-gray-200 m-20">
            <h1 class="text-5xl uppercase text-blue-800 font-semibold">
                Shopping Cart
            </h1>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="w-4/5 m-auto mt-10 pl-2">
            <p class="px-5 w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif

    <div class="mx-auto mb-20 max-w-7xl">
        @php $totalPrice = 0; @endphp
        @foreach ($cartItems as $cartItem)
        <div class="flex items-center justify-between py-10 border-b border-gray-200">
            <div class="flex-shrink-0 w-48 h-64 overflow-hidden aspect-w-3 aspect-h-4">
                <img src="{{ asset('images/' . $cartItem->book->image_path) }}" alt="{{ $cartItem->book->bookName }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-grow">
                <h2 class="text-2xl font-bold text-gray-700">
                    {{ $cartItem->book->bookName }}
                </h2>
                <p class="text-sm text-gray-700">
                    Authored by <span class="font-medium">{{ $cartItem->book->author }}</span>
                </p>
                <p class="text-sm text-gray-700">
                    Price: <span class="font-medium">${{ number_format($cartItem->book->price, 2) }}</span>
                </p>
                <div class="mt-4 flex items-center space-x-4">
                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="flex items-center">
                        @csrf
                        @method('PUT')
                        <label for="quantity-{{ $cartItem->id }}" class="block text-sm font-medium text-gray-700">Quantity:</label>
                        <select id="quantity-{{ $cartItem->id }}" name="quantity" class="ml-2 block form-select w-16 text-lg border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            onchange="updateTotalPrice(this,{{ $cartItem->book->price }})">
                            @for ($availableStock = 1; $availableStock <= min(10, $cartItem->book->stock); $availableStock++)
                            <option value="{{ $availableStock }}" {{ $cartItem->quantity == $availableStock ? 'selected' : '' }}>
                                {{ $availableStock }}
                            </option>
                            @endfor
                        </select>
                    </form>
                    <p class="text-gray-700">
                        Total Price: <span class="font-semibold">${{ number_format($cartItem->book->price * $cartItem->quantity, 2) }}</span>
                    </p>
                    <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @php $totalPrice += $cartItem->book->price * $cartItem->quantity; @endphp
        </div>
        @endforeach
        {{-- <div>
            <p class="text-gray-700">
                Total Price: <span class="font-semibold">${{ number_format($cartItem->book->price * $cartItem->quantity, 2) }}</span>
            </p>
        </div> --}}
        <div class="text-lg font-bold py-4">
            Total price: ${{ number_format($totalPrice, 2) }}
        </div>
    </div>
    
    
@endsection

<script>

    function updateTotalPrice(selectedQuantity,price) {
        let form = selectedQuantity.closest('.updateForm');
        let quantity = selectedQuantity.value;
        let totalPrice = quantity * price;
        form.querySelector('.total_price').value = totalPrice;
        form.submit();
    }
</script>
