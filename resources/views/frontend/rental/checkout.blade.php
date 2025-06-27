@extends('frontend.layouts.master')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-[#5E5EDC] mb-8 text-center">Reserve Property</h1>

        <form action="{{ route('rental.reserve.process', $rentalNotice->id) }}" method="POST">
            @csrf
            <div class="flex flex-wrap gap-8">
                <!-- Form Section -->
                <div class="flex-1 min-w-[60%] bg-white p-8 rounded-lg shadow">
                    <h2 class="text-xl text-indigo-700 font-semibold mb-6">Reservation Information</h2>

                    <div class="flex gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">First Name *</label>
                            <input type="text" name="first_name"
                                value="{{ old('first_name', Auth::user()->first_name ?? '') }}" placeholder="First name"
                                class="w-full p-2 border border-gray-300 rounded @error('first_name') border-red-500 @enderror"
                                required>
                            @error('first_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Last Name *</label>
                            <input type="text" name="last_name"
                                value="{{ old('last_name', Auth::user()->last_name ?? '') }}" placeholder="Last name"
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
                            <label class="block mb-1 text-sm font-medium">Country *</label>
                            <select name="country"
                                class="w-full p-2 border border-gray-300 rounded @error('country') border-red-500 @enderror"
                                required>
                                <option value="">Select...</option>
                                <option value="Bangladesh" {{ old('country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh
                                </option>
                                <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan
                                </option>
                            </select>
                            @error('country')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">City *</label>
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="City"
                                class="w-full p-2 border border-gray-300 rounded @error('city') border-red-500 @enderror"
                                required>
                            @error('city')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Zip Code *</label>
                            <input type="number" name="zip_code" value="{{ old('zip_code') }}" placeholder="Zip Code"
                                class="w-full p-2 border border-gray-300 rounded @error('zip_code') border-red-500 @enderror"
                                required>
                            @error('zip_code')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Email *</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}"
                                class="w-full p-2 border border-gray-300 rounded @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1 text-sm font-medium">Phone Number *</label>
                            <input type="number" name="phone_number" value="{{ old('phone_number') }}"
                                placeholder="Phone Number"
                                class="w-full p-2 border border-gray-300 rounded @error('phone_number') border-red-500 @enderror"
                                required>
                            @error('phone_number')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <h2 class="text-xl text-indigo-700 font-semibold mb-4 mt-6">Payment Method</h2>
                    <div class="mb-6">
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer border rounded-lg p-4 hover:bg-gray-50 flex-1">
                                <input type="radio" name="payment_method" value="card" class="mr-3" required>
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                                    </svg>
                                    <span class="font-medium text-gray-700">Credit/Debit Card</span>
                                </div>
                            </label>
                            <label class="flex items-center cursor-pointer border rounded-lg p-4 hover:bg-gray-50 flex-1">
                                <input type="radio" name="payment_method" value="bkash" class="mr-3" required>
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 mr-3 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                    </svg>
                                    <span class="font-medium text-gray-700">bKash</span>
                                </div>
                            </label>
                        </div>
                        @error('payment_method')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <h2 class="text-xl text-indigo-700 font-semibold mb-2">Additional Information</h2>
                    <label class="block mb-1 text-sm font-medium">Reservation Notes (optional)</label>
                    <textarea name="order_notes" rows="3" placeholder="Any special requirements or notes about your reservation"
                        class="w-full p-2 border border-gray-300 rounded">{{ old('order_notes') }}</textarea>
                </div>

                <!-- Summary Section -->
                <div class="flex-1 bg-white p-8 rounded-lg shadow min-w-[30%]">
                    <h3 class="text-lg font-semibold mb-4">Property Details</h3>

                    <div class="mb-6">
                        @if ($rentalNotice->images->count() > 0)
                            <img src="{{ asset($rentalNotice->images->first()->url) }}"
                                class="w-full h-48 object-cover rounded-lg mb-4" alt="{{ $rentalNotice->title }}">
                        @endif

                        <h4 class="font-semibold text-lg mb-2">{{ $rentalNotice->title }}</h4>
                        <p class="text-gray-600 mb-2">{{ $rentalNotice->address }}</p>
                        <p class="text-sm text-gray-500 mb-4">Unit No: {{ $rentalNotice->unit_no }}</p>

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Property Type:</span>
                                <span class="font-medium">{{ ucfirst($rentalNotice->property_type) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Bedrooms:</span>
                                <span class="font-medium">{{ $rentalNotice->bedrooms }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Bathrooms:</span>
                                <span class="font-medium">{{ $rentalNotice->bathrooms }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Monthly Rent:</span>
                                <span class="font-medium">BDT {{ number_format($rentalNotice->rent_amount) }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Reservation/Advance Fee:</span>
                            <span>BDT {{ number_format($rentalNotice->advance_amount) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Processing Fee:</span>
                            <span class="text-green-600">Free</span>
                        </div>
                    </div>

                    <div class="font-bold text-lg mt-4 flex justify-between border-t pt-4">
                        <span>Total Amount:</span>
                        <span class="text-[#5E5EDC]">BDT {{ number_format($rentalNotice->advance_amount) }}</span>
                    </div>

                    <button type="submit"
                        class="bg-[#5E5EDC] text-white mt-6 py-3 w-full rounded hover:bg-[#4a4ab8] font-semibold">
                        PROCEED TO PAYMENT ➔
                    </button>

                    <a href="{{ route('rental-notice.show', $rentalNotice->id) }}"
                        class="w-full block text-center border border-gray-300 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-100 mt-3">
                        Back to Property
                    </a>
                </div>
            </div>
        </form>
    </div>

    <style>
        input[type="radio"]:checked+div svg {
            color: #5E5EDC !important;
        }

        input[type="radio"]:checked {
            accent-color: #5E5EDC;
        }
    </style>
@endsection
