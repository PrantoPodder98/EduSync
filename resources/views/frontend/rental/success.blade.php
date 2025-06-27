@extends('frontend.layouts.master')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-green-600 mb-2">Reservation Confirmed!</h1>
            <p class="text-gray-600 text-lg">Your property reservation has been successfully processed</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8 mb-8" id="reservation-details">
            <div class="border-b pb-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Reservation Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">Reservation Code</p>
                        <p class="text-lg font-semibold text-[#5E5EDC]">{{ $reservation->reservation_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            ✓ Confirmed
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Reservation Date</p>
                        <p class="font-medium">{{ $reservation->created_at->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Payment Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            ✓ Paid
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Property Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Property Information</h3>
                    @if($reservation->rentalNotice->images->count() > 0)
                        <img src="{{ asset($reservation->rentalNotice->images->first()->url) }}" 
                            class="w-full h-48 object-cover rounded-lg mb-4" 
                            alt="{{ $reservation->rentalNotice->title }}">
                    @endif
                    
                    <h4 class="font-semibold text-gray-800 mb-2">{{ $reservation->rentalNotice->title }}</h4>
                    <p class="text-gray-600">{{ $reservation->rentalNotice->address }}</p>
                    <p class="text-gray-500 mb-2">Unit No: <span class="bold">{{ $reservation->rentalNotice->unit_no }}</span></p>

                    
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Property Type:</span>
                            <span class="font-medium">{{ ucfirst($reservation->rentalNotice->property_type) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bedrooms:</span>
                            <span class="font-medium">{{ $reservation->rentalNotice->bedrooms }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bathrooms:</span>
                            <span class="font-medium">{{ $reservation->rentalNotice->bathrooms }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">
                                {{ $reservation->rentalNotice->rent_type == 'monthly' ? 'Monthly Rent:' : 'Daily Rent'}}
                            </span>
                            <span class="font-medium">BDT {{ number_format($reservation->rentalNotice->rent_amount) }}</span>
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <h5 class="font-semibold text-blue-800 mb-2">Owner Contact</h5>
                        <p class="text-sm text-blue-700">{{ $reservation->rentalNotice->contact_name }}</p>
                        <p class="text-sm text-blue-700">{{ $reservation->rentalNotice->contact_number }}</p>
                        {{-- <p class="text-sm text-blue-700">{{ $reservation->rentalNotice->user->email }}</p> --}}
                    </div>
                </div>

                <!-- Payment & Contact Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Summary</h3>
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Reservation Fee:</span>
                                <span class="font-medium">BDT {{ number_format($reservation->reservation_fee, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Processing Fee:</span>
                                <span class="text-green-600">Free</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Payment Method:</span>
                                <span class="font-medium">{{ ucfirst($reservation->payment_method) }}</span>
                            </div>
                            @if($reservation->payment_details)
                                @php
                                    $paymentDetails = is_array($reservation->payment_details) ? $reservation->payment_details : json_decode($reservation->payment_details, true);
                                @endphp
                                <div class="flex justify-between">
                                    <span>Transaction ID:</span>
                                    <span class="font-medium">{{ $paymentDetails['transaction_id'] ?? 'N/A' }}</span>
                                </div>
                            @endif
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between font-semibold">
                            <span>Total Paid:</span>
                            <span class="text-[#5E5EDC]">BDT {{ number_format($reservation->reservation_fee, 2) }}</span>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Your Contact Information</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-600">Name:</span> {{ $reservation->full_name }}</p>
                        <p><span class="text-gray-600">Email:</span> {{ $reservation->email }}</p>
                        <p><span class="text-gray-600">Phone:</span> {{ $reservation->phone_number }}</p>
                        <p><span class="text-gray-600">Address:</span> {{ $reservation->address }}, {{ $reservation->city }}, {{ $reservation->country }}</p>
                        @if($reservation->order_notes)
                            <p><span class="text-gray-600">Notes:</span> {{ $reservation->order_notes }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- What's Next Section -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-yellow-800 mb-3">What's Next?</h3>
            <div class="space-y-2 text-sm text-yellow-700">
                <p class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    The property owner will contact you within 24 hours to discuss viewing arrangements
                </p>
                <p class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    Your reservation fee will be adjusted against the security deposit or first month's rent
                </p>
                <p class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    You can contact the owner directly using the contact information provided above
                </p>
                <p class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    Keep your reservation code for future reference
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('rental-notice.index') }}" 
                class="bg-[#5E5EDC] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#4a4ab8] transition-colors duration-300 text-center">
                Browse More Properties
            </a>
            <a href="{{ route('user.reservations') }}" 
                class="border border-[#5E5EDC] text-[#5E5EDC] px-8 py-3 rounded-lg font-semibold hover:bg-[#5E5EDC] hover:text-white transition-colors duration-300 text-center">
                View My Reservations
            </a>
            <button onclick="printReservationDetails()" 
                class="border border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                Print Receipt
            </button>
            <script>
                function printReservationDetails() {
                    var printContents = document.getElementById('reservation-details').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                    location.reload();
                }
            </script>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection