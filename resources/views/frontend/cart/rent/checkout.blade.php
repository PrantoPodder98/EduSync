@extends('frontend.layouts.master')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-[#5E5EDC] mb-8 text-center">Rent Item Checkout</h1>

        <form action="{{ route('rent.order.place') }}" method="POST">
            @csrf
            <div class="flex flex-wrap gap-8">
                <!-- Form Section -->
                <div class="flex-1 min-w-[60%] bg-white p-8 rounded-lg shadow">
                    <h2 class="text-xl text-indigo-700 font-semibold mb-6">Billing Information</h2>

                    <div class="flex gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First name"
                                class="w-full p-2 border border-gray-300 rounded @error('first_name') border-red-500 @enderror"
                                required>
                            @error('first_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last name"
                                class="w-full p-2 border border-gray-300 rounded @error('last_name') border-red-500 @enderror"
                                required>
                            @error('last_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Company Name <small>(Optional)</small></label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}"
                                placeholder="Company Name" class="w-full p-2 border border-gray-300 rounded">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Address *</label>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Street address"
                            class="w-full p-2 border border-gray-300 rounded @error('address') border-red-500 @enderror"
                            required>
                        @error('address')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Country</label>
                            <select name="country"
                                class="w-full p-2 border border-gray-300 rounded @error('country') border-red-500 @enderror"
                                required>
                                <option value="">Select...</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                                <option value="Pakistan">Pakistan</option>
                                <!-- Add more countries -->
                            </select>
                            @error('country')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">City</label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                class="w-full p-2 border border-gray-300 rounded @error('city') border-red-500 @enderror"
                                required>
                            @error('city')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Zip Code</label>
                            <input type="text" name="zip_code" value="{{ old('zip_code') }}"
                                class="w-full p-2 border border-gray-300 rounded @error('zip_code') border-red-500 @enderror"
                                required>
                            @error('zip_code')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}"
                                class="w-full p-2 border border-gray-300 rounded @error('email') border-red-500 @enderror">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Phone Number</label>
                            <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                                class="w-full p-2 border border-gray-300 rounded @error('phone_number') border-red-500 @enderror"
                                required>
                            @error('phone_number')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <h2 class="text-xl text-indigo-700 font-semibold mb-2">Additional Information</h2>
                    <label class="block mb-1 text-sm font-medium">Order Notes (optional)</label>
                    <textarea name="order_notes" rows="3" placeholder="Notes about your order, e.g. special notes for delivery"
                        class="w-full p-2 border border-gray-300 rounded">{{ old('order_notes') }}</textarea>
                </div>

                <!-- Summary Section -->
                <div class="flex-1 bg-white p-8 rounded-lg shadow min-w-[30%]">
                    <h3 class="text-lg font-semibold mb-4">Order Summary</h3>

                    <div class="flex items-center mb-4">
                        <img src="{{ asset($item->rentItem->images->first()->url ?? 'asset/frontend_asset/images/default.jpg') }}"
                            class="w-10 h-10 object-cover rounded mr-3" alt="{{ $item->rentItem->name }}">
                        <div class="flex-1">
                            <div class="text-sm font-medium">{{ $item->rentItem->name }}</div>
                            <small class="text-gray-500">{{ $item->rentItem->brand }} -
                                {{ $item->rentItem->item_state }}</small>
                            <div class="text-sm text-gray-600 mt-2">
                                <span>Duration: </span>
                                <span>{{ $item->rentItem->rent_duration ?? 'N/A' }}/{{ $item->rentItem->rent_type === 'daily' ? 'day(s)' : 'month(s)' }}</span>
                            </div>
                        </div>
                        <div class="text-sm font-semibold">BDT {{ number_format($item->rentItem->price) }}
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 mb-2">
                        Payment Option:
                        <span class="font-semibold bg-yellow-200 px-2 py-1 rounded">
                            {{ $item->rentItem->user_payment_option }}
                        </span>
                    </div>


                    <hr class="my-4">

                    <div class="flex justify-between mb-2">
                        <span>Subtotal (1 item):</span>
                        <span>{{ number_format($item->rentItem->price) }} *
                            {{ $item->rentItem->rent_duration ?? '1' }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Shipping:</span>
                        <span class="text-green-600">Free</span>
                    </div>
                    <div class="font-bold text-lg mt-4 flex justify-between border-t pt-4">
                        <span>Total:</span>
                        <span class="text-[#5E5EDC]">BDT {{ number_format($totalAmount) }}</span>
                    </div>

                    <button type="submit"
                        class="bg-[#5E5EDC] text-white mt-6 py-3 w-full rounded hover:bg-[#4a4ab8] font-semibold">
                        PLACE ORDER ➔
                    </button>
                    <a href="{{ route('rent.cart.index') }}"
                        class="w-full block text-center border border-gray-300 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-100 mt-3">
                        Back
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
