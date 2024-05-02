@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="py-15 border-b border-gray-200">
            <h1 class="text-6xl uppercase text-blue-800 font-semibold">
                Cart
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

    <div class="mb-20">
        @foreach ($cartItems as $cartItem)
            <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                <div class="image-padding">
                    <img src="{{ asset('images/' . $cartItem->book->image_path) }}" alt="">
                </div>
                <div>
                    <h2 class="text-gray-700 font-bold text-2xl pb-4">
                        {{ $cartItem->book->bookName }}
                    </h2>
                    <p class="text-base text-gray-700 pt-2 mb-3 leading-6 font-light">
                        {{ $cartItem->book->author }}
                    </p>
                    <p class="text-base text-gray-700 pt-2 mb-3 leading-6 font-light">
                        Price: {{ $cartItem->book->price }}
                    </p>
                    <br>
                    {{-- <p class="text-base text-gray-700 pt-2 mb-3 leading-6 font-light">
                        Quantity: {{ $cartItem->quantity }}
                    </p> --}}
                    <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                        @if (auth()->user()->id == $cartItem->user_id)
                            <div class="sm:flex sm:h-20 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" id="updateForm" onsubmit="submitForm()">
                                        @csrf
                                        @method('PUT')
                                        <label>Quantity: </label>
                                        <select name="quantity" class="form-select w-full mb-8 text-xl"
                                            onchange="updateTotalPrice()" id="quantity">
                                            @for ($availableStock = 1; $availableStock <= min(10, $cartItem->book->stock); $availableStock++)
                                                <option value="{{ $availableStock }}"
                                                    {{ $cartItem->quantity == $availableStock ? 'selected' : '' }}>
                                                    {{ $availableStock }}
                                                </option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="total_price" id="total_price"
                                            value="{{ $cartItem->book->price * $cartItem->quantity }}">
                                        <!-- Removed the Update button -->
                                    </form>
                                    <p class="text-base text-gray-700 pt-2 mb-3 leading-6 font-light">
                                        Total Price: {{ $cartItem->book->price * $cartItem->quantity }}
                                    </p>
                                </div>
                                <div>
                                    <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-white delete-button-color p-3 rounded" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach

    </div>
@endsection

<script>
    function updateTotalPrice() {
        let quantity = document.getElementById('quantity').value;
        let price = {{ $cartItem->book->price }};
        let totalPrice = quantity * price;
        document.getElementById('total_price').value = totalPrice;
    }

    function submitForm() {
        document.getElementById('updateForm').submit();
    }
</script>
