@extends('frontend.layouts.master')

@section('content')
    <div class="container mx-auto mt-20 mb-60 px-4">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-[#5E5EDC] mb-2">My Rental Notices</h1>
            <p class="text-gray-600">Manage your rental accommodation listings and reservations</p>
        </div>
        <div class="flex justify-end mb-4">
            <a href="{{ route('rental-notice.create') }}"
                class="inline-flex items-center px-3 py-1 bg-[#5E5EDC] text-white rounded font-semibold text-sm hover:bg-[#4A4AC8] transition-colors shadow">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Rental Notice
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table id="my-rental-notices-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r text-black">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider min-w-[200px]">
                                Property Info
                                <div class="text-xs font-normal text-gray-400 mt-1">Image, Title, Rent</div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Status
                                <div class="text-xs font-normal text-gray-400 mt-1">Property & Payment</div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider min-w-[300px]">
                                Latest Reservation Info
                                <div class="text-xs font-normal text-gray-400 mt-1">Booking Details & Customer Info</div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Actions
                                <div class="text-xs font-normal text-gray-400 mt-1">Manage Property</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($rentalNotices as $index => $notice)
                            @php
                                // Get the latest reservation if available
                                $latestReservation = $notice->reservations->sortByDesc('created_at')->first();
                            @endphp

                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 bg-[#5E5EDC] text-white rounded-full text-sm font-semibold">
                                        {{ $index + 1 }}
                                    </div>
                                </td>

                                <!-- Property Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset($notice->images->first()->url ?? 'asset/frontend_asset/images/default.jpg') }}"
                                                alt="{{ $notice->title }}"
                                                class="w-16 h-16 object-cover rounded-lg shadow-md border-2 border-gray-200">
                                        </div>
                                        <div class="flex-grow">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $notice->title }}</h3>
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="text-2xl font-bold text-[#5E5EDC]">৳{{ number_format($notice->rent_amount) }}</span>
                                                <span
                                                    class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ ucfirst($notice->rent_type) }}</span>
                                            </div>
                                            @if ($notice->property_type)
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <span class="font-medium">Type:</span> {{ $notice->property_type }}
                                                </p>
                                            @endif
                                            @if ($notice->area)
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Area:</span> {{ $notice->area }},
                                                    {{ $notice->division }}
                                                </p>
                                            @endif
                                            @if ($notice->bedrooms || $notice->bathrooms)
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Rooms:</span> {{ $notice->bedrooms }} bed,
                                                    {{ $notice->bathrooms }} bath
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="space-y-2">
                                        <!-- Property Status -->
                                        <div class="flex items-center space-x-2">
                                            @if ($notice->status == 'active')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-400 to-blue-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M7 10l2 2 4-4" stroke="#fff" stroke-width="2"
                                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Property Status: <span class="ml-1">Active</span>
                                                </span>
                                            @elseif ($notice->status == 'rented')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-400 to-green-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M10 6v4l2 2" stroke="#fff" stroke-width="2" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Property Status: <span class="ml-1">Rented</span>
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-red-400 to-red-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M7 7l6 6M13 7l-6 6" stroke="#fff" stroke-width="2"
                                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Property Status: <span class="ml-1">Inactive</span>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Payment Status -->
                                        <div class="flex items-center space-x-2 mt-2">
                                            @if ($latestReservation && $latestReservation->payment_status === 'paid')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-400 to-green-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M7 10l2 2 4-4" stroke="#fff" stroke-width="2"
                                                            fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Payment: <span class="ml-1">Paid</span>
                                                </span>
                                            @elseif ($latestReservation && $latestReservation->payment_status === 'pending')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-400 to-blue-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M10 6v4l2 2" stroke="#fff" stroke-width="2"
                                                            fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Payment: <span class="ml-1">Pending</span>
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-red-400 to-red-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10"
                                                            fill="currentColor" />
                                                        <path d="M10 6v4l2 2" stroke="#fff" stroke-width="2"
                                                            fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Payment: <span class="ml-1">Failed</span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Reservation Info -->
                                <td class="px-6 py-4">
                                    @if ($latestReservation)
                                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                            <!-- Reservation Code -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-gray-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ $latestReservation->reservation_code }}</span>
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    <span class="font-medium">Date:</span>
                                                    {{ $latestReservation->created_at->format('Y-m-d H:i') }}
                                                </div>
                                            </div>

                                            <!-- Customer Info -->
                                            <div class="border-t border-gray-200 pt-3">
                                                <div class="flex items-start space-x-3">
                                                    <img src="{{ asset('asset/frontend_asset/images/profile-icon.png') }}"
                                                        class="w-10 h-10 rounded-full border-2 border-white shadow-sm"
                                                        alt="Customer">
                                                    <div class="flex-grow">
                                                        <h4 class="text-sm font-semibold text-gray-900">
                                                            {{ $latestReservation->first_name }}
                                                            {{ $latestReservation->last_name }}
                                                        </h4>
                                                        @if ($latestReservation->company_name)
                                                            <p class="text-xs text-gray-600">
                                                                {{ $latestReservation->company_name }}</p>
                                                        @endif
                                                        <div class="space-y-1 text-xs text-gray-600">
                                                            <p class="flex items-center">
                                                                <svg class="w-3 h-3 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                </svg>
                                                                {{ $latestReservation->phone_number }}
                                                            </p>
                                                            <p class="flex items-center">
                                                                <svg class="w-3 h-3 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                </svg>
                                                                {{ $latestReservation->email }}
                                                            </p>
                                                            <p class="flex items-start">
                                                                <svg class="w-3 h-3 mr-1 mt-0.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                </svg>
                                                                <span
                                                                    class="break-words">{{ $latestReservation->address }},
                                                                    {{ $latestReservation->city }},
                                                                    {{ $latestReservation->country }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Payment Info -->
                                            <div class="border-t border-gray-200 pt-3">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-2">
                                                        <span class="text-xs font-medium text-gray-700">Payment:</span>
                                                        <span class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded">
                                                            {{ $latestReservation->payment_method }}
                                                        </span>
                                                    </div>
                                                    <div class="text-xs text-gray-600">
                                                        <span class="font-medium">Fee:</span>
                                                        ৳{{ number_format($latestReservation->reservation_fee) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Reservation Notes -->
                                            @if ($latestReservation->order_notes)
                                                <div class="border-t border-gray-200 pt-3">
                                                    <p class="text-xs text-gray-600">
                                                        <span class="font-medium">Notes:</span>
                                                        {{ Str::limit($latestReservation->order_notes, 50) }}
                                                    </p>
                                                </div>
                                            @endif

                                            <!-- Reservation Status -->
                                            <div class="border-t pt-3 flex items-center space-x-2">
                                                <span class="text-xs font-medium text-gray-700">Reservation Status:</span>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $latestReservation->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($latestReservation->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                    {{ ucfirst($latestReservation->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-8">
                                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="text-sm text-gray-500">No reservations yet</p>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-2">
                                        <!-- Property View -->
                                        <a href="{{ route('rental-notice.show', $notice->id) }}"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Property View
                                        </a>

                                        @if ($notice->status != 'rented')
                                            <!-- Edit Property -->
                                            <a href="{{ route('rental-notice.edit', $notice->id) }}"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit Property
                                            </a>
                                        @endif

                                        <!-- Reservation Status Update (only if reservation exists) -->
                                        @if ($latestReservation)
                                            <!-- Button to open modal -->
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200"
                                                data-modal-target="reservationStatusModal-{{ $latestReservation->id }}"
                                                data-modal-toggle="reservationStatusModal-{{ $latestReservation->id }}">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Update Reservation Status
                                            </button>

                                            <!-- Reservation Status Modal -->
                                            <div id="reservationStatusModal-{{ $latestReservation->id }}" tabindex="-1"
                                                aria-hidden="true"
                                                class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
                                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                                                    <button type="button"
                                                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600"
                                                        data-modal-hide="reservationStatusModal-{{ $latestReservation->id }}">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Reservation
                                                        Status</h3>
                                                    <form
                                                        action="{{ route('rental-reservations.update-status', $latestReservation->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label for="status-{{ $latestReservation->id }}"
                                                                class="block text-sm font-medium text-gray-700 mb-1">Reservation
                                                                Status</label>
                                                            <select id="status-{{ $latestReservation->id }}"
                                                                name="status"
                                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 bg-purple-50">
                                                                <option value="pending"
                                                                    {{ $latestReservation->status === 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="confirmed"
                                                                    {{ $latestReservation->status === 'confirmed' ? 'selected' : '' }}>
                                                                    Confirmed</option>
                                                                <option value="cancelled"
                                                                    {{ $latestReservation->status === 'cancelled' ? 'selected' : '' }}>
                                                                    Cancelled</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex justify-end space-x-2">
                                                            <button type="button"
                                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                                                data-modal-hide="reservationStatusModal-{{ $latestReservation->id }}">Cancel</button>
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Reservation success page -->
                                            <a href="{{ route('rental.reservation.success', $latestReservation->id) }}"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Reservation
                                            </a>
                                        @endif

                                        @if ($notice->status != 'rented')
                                            <!-- Delete Button to open modal -->
                                            <button type="button" onclick="openDeleteModal({{ $notice->id }})"
                                                class="w-full inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>

                                            <!-- Delete Confirmation Modal -->
                                            <div id="deleteNoticeModal-{{ $notice->id }}"
                                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
                                                <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 transform scale-95 transition-transform duration-300"
                                                    id="deleteModalContent-{{ $notice->id }}">
                                                    <div class="text-center">
                                                        <div
                                                            class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                                                            <svg class="h-8 w-8 text-red-600" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                            </svg>
                                                        </div>
                                                        <h3 class="text-xl font-bold text-gray-900 mb-3">Delete Rental
                                                            Notice
                                                        </h3>
                                                        <p class="text-gray-600 mb-8">Are you sure you want to delete this
                                                            rental notice? This action cannot be undone.</p>
                                                        <div class="flex justify-center space-x-4">
                                                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                                            onclick="closeDeleteModal({{ $notice->id }})">Cancel</button>
                                                            <form
                                                                action="{{ route('rental-notice.destroy', $notice->id) }}"
                                                                method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Property Found</h3>
                                        <p class="text-gray-500">You haven't listed any Property yet.</p>
                                        <a href="{{ route('rental-notice.create') }}"
                                            class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#5E5EDC] hover:bg-[#4A4AC8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5E5EDC]">
                                            Add Your First Property
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#my-rental-notices-table').DataTable({
                searching: true,
                paging: true,
                pageLength: 10,
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    targets: [1, 2, 3, 4],
                    orderable: false
                }],
                language: {
                    search: "Search rental notices:",
                    lengthMenu: "Show _MENU_ rental notices per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ rental notices",
                    infoEmpty: "No rental notices available",
                    zeroRecords: "No matching rental notices found",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });
    </script>
    <script>
        // Reservation Status Modal Functions
        function openReservationStatusModal(reservationId) {
            const modal = document.getElementById('reservationStatusModal-' + reservationId);
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeReservationStatusModal(reservationId) {
            const modal = document.getElementById('reservationStatusModal-' + reservationId);
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        // Delete Rental Notice Modal Functions
        function openDeleteModal(noticeId) {
            const modal = document.getElementById('deleteNoticeModal-' + noticeId);
            const content = document.getElementById('deleteModalContent-' + noticeId);

            if (modal && content) {
                modal.classList.remove('hidden');

                // Trigger animations
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }, 10);
            }
        }

        function closeDeleteModal(noticeId) {
            const modal = document.getElementById('deleteNoticeModal-' + noticeId);
            const content = document.getElementById('deleteModalContent-' + noticeId);

            if (modal && content) {
                modal.classList.add('opacity-0');
                content.classList.remove('scale-100');
                content.classList.add('scale-95');

                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        // Initialize all modal event listeners when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Reservation Status Modal event listeners
            document.querySelectorAll('[data-modal-toggle]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetModal = this.getAttribute('data-modal-target') || this.getAttribute(
                        'data-modal-toggle');
                    const modal = document.getElementById(targetModal);
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                });
            });

            // Modal hide event listeners
            document.querySelectorAll('[data-modal-hide]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetModal = this.getAttribute('data-modal-hide');
                    const modal = document.getElementById(targetModal);
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                });
            });

            // Close modals when clicking outside
            document.addEventListener('click', function(event) {
                const modals = document.querySelectorAll(
                    '[id^="reservationStatusModal-"], [id^="deleteNoticeModal-"]');
                modals.forEach(modal => {
                    if (event.target === modal) {
                        if (modal.id.includes('deleteNoticeModal')) {
                            const noticeId = modal.id.split('-')[1];
                            closeDeleteModal(noticeId);
                        } else if (modal.id.includes('reservationStatusModal')) {
                            modal.classList.add('hidden');
                        }
                    }
                });
            });
        });
    </script>
@endsection
