@extends('frontend.layouts.master')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#5E5EDC] mb-2">Secure Payment</h1>
            <p class="text-gray-600">Complete your property reservation</p>
        </div>

        <div class="flex flex-wrap gap-8">
            <!-- Payment Form -->
            <div class="flex-1 min-w-[60%] bg-white p-8 rounded-lg shadow-lg">
                <div class="flex items-center mb-6">
                    <svg class="w-8 h-8 text-green-500 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M10,17L6,13L7.41,11.59L10,14.18L16.59,7.59L18,9L10,17Z"/>
                    </svg>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">SSL Secured Payment</h2>
                        <p class="text-sm text-gray-600">Your payment information is protected</p>
                    </div>
                </div>

                <form action="{{ route('rental.payment.card.process', $reservation->id) }}" method="POST" id="cardPaymentForm">
                    @csrf
                    
                    <!-- Card Number -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Card Number *</label>
                        <div class="relative">
                            <input type="text" name="card_number" id="cardNumber" placeholder="1234 5678 9012 3456"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5E5EDC] focus:border-transparent @error('card_number') border-red-500 @enderror"
                                maxlength="19" required>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <div id="cardType" class="flex space-x-1">
                                    <img src="{{ asset('asset/frontend_asset/images/visa.jpg') }}" alt="Visa" class="h-6 opacity-30">
                                    <img src="{{ asset('asset/frontend_asset/images/master.jpg') }}" alt="Mastercard" class="h-6 opacity-30">
                                </div>
                            </div>
                        </div>
                        @error('card_number')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Cardholder Name -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Cardholder Name *</label>
                        <input type="text" name="card_holder_name" placeholder="JOHN SMITH"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5E5EDC] focus:border-transparent @error('card_holder_name') border-red-500 @enderror"
                            style="text-transform: uppercase;" required>
                        @error('card_holder_name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Expiry and CVV -->
                    <div class="flex gap-4 mb-6">
                        <div class="flex-1">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Expiry Date *</label>
                            <input type="text" name="expiry_date" id="expiryDate" placeholder="MM/YY"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5E5EDC] focus:border-transparent @error('expiry_date') border-red-500 @enderror"
                                maxlength="5" required>
                            @error('expiry_date')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block mb-2 text-sm font-medium text-gray-700">CVV *</label>
                            <div class="relative">
                                <input type="text" name="cvv" id="cvv" placeholder="123"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5E5EDC] focus:border-transparent @error('cvv') border-red-500 @enderror"
                                    maxlength="3" required>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.657-1.343 3-3 3s-3-1.343-3-3m0 8h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('cvv')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm">
                                <p class="text-blue-800 font-medium mb-1">Secure Payment</p>
                                <p class="text-blue-700">Your card details are encrypted and secure. We don't store your payment information.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="payButton"
                        class="w-full bg-[#5E5EDC] text-white py-4 rounded-lg font-semibold text-lg hover:bg-[#4a4ab8] transition-colors duration-300 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Pay BDT {{ number_format($reservation->reservation_fee, 2) }}
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="flex-1 bg-white p-8 rounded-lg shadow-lg min-w-[35%]">
                <h3 class="text-lg font-semibold mb-6 text-gray-800">Reservation Summary</h3>

                <!-- Property Details -->
                <div class="mb-6">
                    @if($reservation->rentalNotice->images->count() > 0)
                        <img src="{{ asset($reservation->rentalNotice->images->first()->url) }}" 
                            class="w-full h-32 object-cover rounded-lg mb-4" 
                            alt="{{ $reservation->rentalNotice->title }}">
                    @endif
                    
                    <h4 class="font-semibold text-gray-800 mb-2">{{ $reservation->rentalNotice->title }}</h4>
                    <p class="text-sm text-gray-600 mb-2">{{ $reservation->rentalNotice->location }}</p>
                    <p class="text-xs text-gray-500">Reservation ID: {{ $reservation->reservation_code }}</p>
                </div>

                <hr class="my-4">

                <!-- Reservation Details -->
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Reservation Fee:</span>
                        <span class="font-medium">BDT {{ number_format($reservation->reservation_fee, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Processing Fee:</span>
                        <span class="text-green-600 font-medium">Free</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Payment Method:</span>
                        <span class="font-medium">Credit/Debit Card</span>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Total -->
                <div class="flex justify-between text-lg font-bold">
                    <span>Total Amount:</span>
                    <span class="text-[#5E5EDC]">BDT {{ number_format($reservation->reservation_fee, 2) }}</span>
                </div>

                <!-- Owner Bank Info -->
                <div class="mt-6 pt-4 border-t">
                    <h4 class="font-semibold text-gray-800 mb-3">Owner Bank Information</h4>
                    <div class="space-y-2 text-sm">
                        <p class="text-gray-600">Bank Name: {{ $reservation->rentalNotice->bank_name }}</p>
                        <p class="text-gray-600">Account Number: {{ $reservation->rentalNotice->bank_account_number }}</p>
                        <p class="text-gray-600">Routing Number: {{ $reservation->rentalNotice->bank_routing_number }}</p>
                    </div>
                </div>

                <!-- Back Button -->
                <a href="{{ route('rental.reserve.checkout', $reservation->rentalNotice->id) }}"
                    class="w-full block text-center border border-gray-300 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-100 mt-6">
                    ← Back to Checkout
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript for card formatting -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Card number formatting
            const cardNumberInput = document.getElementById('cardNumber');
            const expiryInput = document.getElementById('expiryDate');
            const cvvInput = document.getElementById('cvv');

            // Format card number with spaces
            cardNumberInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
                let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                if (formattedValue !== value) {
                    e.target.value = formattedValue;
                }
            });

            // Format expiry date MM/YY
            expiryInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            });

            // Only allow numbers for CVV
            cvvInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });

            // Form submission with loading state
            const form = document.getElementById('cardPaymentForm');
            const payButton = document.getElementById('payButton');

            form.addEventListener('submit', function(e) {
                payButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing Payment...
                `;
                payButton.disabled = true;
            });

            // Card type detection (basic)
            cardNumberInput.addEventListener('input', function(e) {
                const value = e.target.value.replace(/\s/g, '');
                const cardType = document.getElementById('cardType');
                
                if (value.startsWith('4')) {
                    // Visa
                    cardType.innerHTML = '<img src="{{ asset("asset/frontend_asset/images/visa.jpg") }}" alt="Visa" class="h-6">';
                } else if (value.startsWith('5') || value.startsWith('2')) {
                    // Mastercard
                    cardType.innerHTML = '<img src="{{ asset("asset/frontend_asset/images/master.jpg") }}" alt="Mastercard" class="h-6">';
                } else {
                    cardType.innerHTML = `
                        <img src="{{ asset('asset/frontend_asset/images/visa.jpg') }}" alt="Visa" class="h-6 opacity-30">
                        <img src="{{ asset('asset/frontend_asset/images/master.jpg') }}" alt="Mastercard" class="h-6 opacity-30">
                    `;
                }
            });
        });
    </script>

    <style>
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
@endsection