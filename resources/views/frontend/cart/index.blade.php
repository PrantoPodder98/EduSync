@extends('frontend.layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8 my-20">
        <h1 class="text-3xl font-bold text-[#5E5EDC] mb-8 text-center">Your Shopping Cart</h1>

        @if ($cartItems->isEmpty())
            <div class="text-center py-16">
                <div class="text-gray-500 text-6xl mb-4">🛒</div>
                <h2 class="text-2xl font-semibold text-gray-600 mb-4">Your cart is empty</h2>
                <p class="text-gray-500 mb-8">Add product to your cart to see them here!</p>
                <a href="{{ route('second-hand-products.index') }}"
                    class="bg-[#5E5EDC] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#4a4ab8]">
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="bg-white border rounded-lg p-6 shadow-sm">
                            <div class="flex items-center space-x-6">
                                <!-- Product Image -->
                                <div class="w-24 h-24 flex-shrink-0">
                                    <img src="{{ asset($item->secondHandProduct->images->first()->url ?? 'asset/frontend_asset/images/default.jpg') }}"
                                        alt="{{ $item->secondHandProduct->name }}"
                                        class="w-full h-full object-cover rounded-lg">
                                </div>

                                <!-- Product Details -->
                                <div class="flex-grow">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $item->secondHandProduct->name }}
                                    </h3>
                                    <p class="text-sm text-gray-600">{{ $item->secondHandProduct->brand }}</p>
                                    <p class="text-sm text-gray-600">Condition: {{ $item->secondHandProduct->item_state }}
                                    </p>
                                    <p class="text-lg font-bold text-[#5E5EDC] mt-2">
                                        BDT {{ number_format($item->secondHandProduct->price) }}
                                    </p>
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col items-end space-y-2">
                                    <!-- Remove Button -->
                                    <!-- Remove Button with Modal Trigger -->
                                    <button type="button"
                                        class="text-red-600 hover:text-red-800 text-sm font-medium"
                                        onclick="document.getElementById('remove-modal-{{ $item->id }}').classList.remove('hidden')">
                                        Remove
                                    </button>

                                    <!-- Modal -->
                                    <div id="remove-modal-{{ $item->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                                        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
                                            <h2 class="text-lg font-semibold mb-4 text-gray-800 text-center">Remove Item</h2>
                                            <p class="mb-6 text-gray-600">Are you sure you want to remove <span class="font-bold">{{ $item->secondHandProduct->name }}</span> from your cart?</p>
                                            <div class="flex justify-end space-x-3">
                                                <button type="button"
                                                    class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300"
                                                    onclick="document.getElementById('remove-modal-{{ $item->id }}').classList.add('hidden')">
                                                    Cancel
                                                </button>
                                                <form action="{{ route('cart.remove', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 font-semibold">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item Total -->
                                    <p class="text-sm font-semibold text-gray-800">
                                        BDT {{ number_format($item->total_price) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="bg-white border rounded-lg p-6 shadow-sm h-fit">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>

                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span>Items ({{ $cartItems->count() }})</span>
                            <span>BDT {{ number_format($totalAmount) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Shipping</span>
                            <span class="text-green-600">FREE</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-[#5E5EDC]">BDT {{ number_format($totalAmount) }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('cart.checkout') }}"
                            class="w-full block text-center bg-[#5E5EDC] text-white py-3 rounded-lg font-semibold hover:bg-[#4a4ab8]">
                            Proceed to Checkout
                        </a>
                        {{-- <form action="{{ route('cart.clear') }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full block text-center bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to clear your cart?')">
                                Clear Cart
                            </button>
                        </form> --}}
                        <a href="{{ route('second-hand-products.index') }}"
                            class="w-full block text-center border border-gray-300 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-100">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
