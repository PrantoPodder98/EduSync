@extends('frontend.layouts.master')

@section('content')
<div class="max-w-md mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-6">
            <div class="w-20 h-20 mx-auto mb-4 bg-white border-4 border-pink-200 rounded-full flex items-center justify-center shadow">
                <img src="{{ asset('asset/frontend_asset/images/bkash-w.jpg') }}" alt="bKash" class="w-12 h-12 object-contain">
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Bkash Payment</h1>
            <p class="text-gray-600 mt-2">Complete your payment securely</p>
        </div>

        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Amount to Pay:</span>
                <span class="text-2xl font-bold text-pink-600">৳{{ number_format($amount) }}</span>
            </div>
        </div>

        <form action="{{ route('payment.bkash.process') }}" method="POST" id="bkashForm">
            @csrf
            
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Bkash Account Number *</label>
                <input type="text" name="bkash_number" value="{{ old('bkash_number') }}" 
                       placeholder="01XXXXXXXXX" maxlength="11"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 @error('bkash_number') border-red-500 @enderror" 
                       required>
                @error('bkash_number')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Bkash PIN *</label>
                <input type="password" name="bkash_pin" placeholder="Enter your PIN" maxlength="6"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 @error('bkash_pin') border-red-500 @enderror" 
                       required>
                @error('bkash_pin')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" id="payBtn" 
                    class="w-full bg-pink-600 text-white py-3 rounded-lg font-semibold hover:bg-pink-700 focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition duration-200">
                <span id="payBtnText">Pay ৳{{ number_format($amount) }}</span>
                <span id="payBtnLoader" class="hidden">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>
            </button>

            <div class="mt-4 text-center">
                <a href="{{ route('cart.checkout') }}" class="text-gray-600 hover:text-gray-800 text-sm">
                    ← Back to Checkout
                </a>
            </div>
        </form>

        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="font-semibold text-blue-800 mb-2">Demo Payment Instructions:</h3>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>• Use any valid BD mobile number (01XXXXXXXXX)</li>
                <li>• Enter any 4-6 digit PIN</li>
                <li>• Payment will be processed automatically</li>
            </ul>
        </div>
    </div>
</div>

<script>
document.getElementById('bkashForm').addEventListener('submit', function() {
    const payBtn = document.getElementById('payBtn');
    const payBtnText = document.getElementById('payBtnText');
    const payBtnLoader = document.getElementById('payBtnLoader');
    
    payBtn.disabled = true;
    payBtnText.classList.add('hidden');
    payBtnLoader.classList.remove('hidden');
});
</script>
@endsection