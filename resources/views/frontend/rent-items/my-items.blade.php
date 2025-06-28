@extends('frontend.layouts.master')

@section('content')
    <div class="container mx-auto mt-20 mb-60 px-4">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-[#5E5EDC] mb-2">My Products for Rent</h1>
            <p class="text-gray-600">Manage your rent product listings and orders</p>
        </div>
        <div class="flex justify-end mb-4">
            <a href="{{ route('rent-items.create') }}"
                class="inline-flex items-center px-3 py-1 bg-[#5E5EDC] text-white rounded font-semibold text-sm hover:bg-[#4A4AC8] transition-colors shadow">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Rent Item
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table id="my-rent-items-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r text-black">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider min-w-[200px]">
                                Product Info
                                <div class="text-xs font-normal text-gray-400 mt-1">Image, Name, Price</div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Status
                                <div class="text-xs font-normal text-gray-400 mt-1">Product & Payment</div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider min-w-[300px]">
                                Latest Order Info
                                <div class="text-xs font-normal text-gray-400 mt-1">Order Details & Customer Info</div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Actions
                                <div class="text-xs font-normal text-gray-400 mt-1">Manage Product</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($rentItems as $index => $rentItem)
                            @php
                                // Get the latest rentOrderItem if available
                                $latestRentOrderItem = $rentItem->rentOrderItems->sortByDesc('created_at')->first();
                                $latestOrder = $latestRentOrderItem ? $latestRentOrderItem->order : null;
                                $customer = $latestOrder ? $latestOrder->user : null;
                            @endphp

                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 bg-[#5E5EDC] text-white rounded-full text-sm font-semibold">
                                        {{ $index + 1 }}
                                    </div>
                                </td>

                                <!-- Product Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset($rentItem->images->first()->url ?? 'asset/frontend_asset/images/default.jpg') }}"
                                                alt="{{ $rentItem->name }}"
                                                class="w-16 h-16 object-cover rounded-lg shadow-md border-2 border-gray-200">
                                        </div>
                                        <div class="flex-grow">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $rentItem->name }}</h3>
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="text-2xl font-bold text-[#5E5EDC]">৳{{ number_format($latestRentOrderItem->order->total_amount) }}</span>
                                                <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ number_format($rentItem->price ?? 0) }}/{{ $rentItem->rent_type === 'daily' ? 'day' : 'month' }}</span>
                                            </div>
                                            @if ($rentItem->brand)
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <span class="font-medium">Brand:</span> {{ $rentItem->brand }}
                                                </p>
                                            @endif
                                            @if ($rentItem->item_type)
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Item Type:</span> {{ $rentItem->item_type }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="space-y-2">
                                        <!-- Product Status -->
                                        <div class="flex items-center space-x-2">
                                            @if ($rentItem->status == 1)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-400 to-green-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M7 10l2 2 4-4" stroke="#fff" stroke-width="2"
                                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Product: <span class="ml-1">Available</span>
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
                                                    Product: <span class="ml-1">Rented</span>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Payment Status -->
                                        <div class="flex items-center space-x-2 mt-2">
                                            @if ($latestOrder && $latestOrder->payment_status === 'completed')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-400 to-blue-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M7 10l2 2 4-4" stroke="#fff" stroke-width="2"
                                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Payment: <span class="ml-1">Paid</span>
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-yellow-400 to-yellow-600 text-white shadow">
                                                    <svg class="w-3 h-3 mr-2 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="10" fill="currentColor" />
                                                        <path d="M10 6v4l2 2" stroke="#fff" stroke-width="2" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Payment: <span class="ml-1">Pending</span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Order Info -->
                                <td class="px-6 py-4">
                                    @if ($latestOrder)
                                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                            <!-- Order Number -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-gray-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ $latestOrder->order_number }}</span>
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    <span class="font-medium">Date:</span>
                                                    {{ $latestOrder->created_at->format('Y-m-d H:i') }}
                                                </div>
                                            </div>

                                            <!-- Rental Period -->
                                            @if ($latestRentOrderItem)
                                                <div class="border-t border-gray-200 pt-3">
                                                    <div class="flex items-center space-x-2 text-sm">
                                                        <svg class="w-4 h-4 text-gray-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        <span class="font-medium text-gray-700">Rental Period:</span>
                                                    </div>
                                                    <div class="mt-1 text-xs text-gray-600">
                                                        <p><span class="font-medium">Start:</span>
                                                            {{ \Carbon\Carbon::parse($latestRentOrderItem->created_at)->format('Y-m-d') }}
                                                        </p>
                                                        <p><span class="font-medium">End:</span>
                                                            @if($rentItem->rent_duration)
                                                                {{ \Carbon\Carbon::parse($latestRentOrderItem->created_at)->addDays($rentItem->rent_duration)->format('Y-m-d') }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </p>
                                                        <p><span class="font-medium">Days:</span>
                                                            {{ $rentItem->rent_duration ?? '' }} days</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Customer Info -->
                                            <div class="border-t border-gray-200 pt-3">
                                                <div class="flex items-start space-x-3">
                                                    <img src="{{ asset('asset/frontend_asset/images/profile-icon.png') }}"
                                                        class="w-10 h-10 rounded-full border-2 border-white shadow-sm"
                                                        alt="Customer">
                                                    <div class="flex-grow">
                                                        <h4 class="text-sm font-semibold text-gray-900">
                                                            {{ $latestOrder->first_name }} {{ $latestOrder->last_name }}
                                                        </h4>
                                                        <div class="space-y-1 text-xs text-gray-600">
                                                            <p class="flex items-center">
                                                                <svg class="w-3 h-3 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                </svg>
                                                                {{ $latestOrder->phone_number }}
                                                            </p>
                                                            <p class="flex items-center">
                                                                <svg class="w-3 h-3 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                </svg>
                                                                {{ $latestOrder->email }}
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
                                                                <span class="break-words">{{ $latestOrder->address }},
                                                                    {{ $latestOrder->city }}</span>
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
                                                            {{ $latestOrder->payment_method }}
                                                        </span>
                                                    </div>
                                                    @if ($latestOrder->bkash_number)
                                                        <span
                                                            class="text-xs text-gray-600">{{ $latestOrder->bkash_number }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Order Notes -->
                                            @if ($latestOrder->order_notes)
                                                <div class="border-t border-gray-200 pt-3">
                                                    <p class="text-xs text-gray-600">
                                                        <span class="font-medium">Notes:</span>
                                                        {{ Str::limit($latestOrder->order_notes, 50) }}
                                                    </p>
                                                </div>
                                            @endif

                                            <!-- Order Status -->
                                            <div class="border-t pt-3 flex items-center space-x-2">
                                                <span class="text-xs font-medium text-gray-700">Order Status:</span>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $latestOrder->status === 'completed' ? 'bg-green-100 text-green-800' : ($latestOrder->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                    {{ ucfirst($latestOrder->status) }}
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
                                            <p class="text-sm text-gray-500">No orders yet</p>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-2">
                                        <!-- Product View -->
                                        <a href="{{ route('rent-items.show', $rentItem->id) }}"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Product View
                                        </a>

                                        @if ($rentItem->status == 1)
                                            <!-- Edit Product -->
                                            <a href="{{ route('rent-items.edit', $rentItem->id) }}"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit Product
                                            </a>
                                        @endif

                                        <!-- Order Status Update (only if order exists) -->
                                        @if ($latestOrder)
                                            <!-- Button to open modal -->
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200"
                                                data-modal-target="orderStatusModal-{{ $latestOrder->id }}"
                                                data-modal-toggle="orderStatusModal-{{ $latestOrder->id }}">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Update Order Status
                                            </button>

                                            <!-- Order Status Modal -->
                                            <div id="orderStatusModal-{{ $latestOrder->id }}" tabindex="-1"
                                                aria-hidden="true"
                                                class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
                                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                                                    <button type="button"
                                                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600"
                                                        data-modal-hide="orderStatusModal-{{ $latestOrder->id }}">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Order
                                                        Status</h3>
                                                    <form action="{{ route('rent-items.order.update-status', $latestOrder->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label for="status-{{ $latestOrder->id }}"
                                                                class="block text-sm font-medium text-gray-700 mb-1">Order
                                                                Status</label>
                                                            <select id="status-{{ $latestOrder->id }}" name="status"
                                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 bg-purple-50">
                                                                <option value="pending"
                                                                    {{ $latestOrder->status === 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="processing"
                                                                    {{ $latestOrder->status === 'processing' ? 'selected' : '' }}>
                                                                    Processing</option>
                                                                <option value="shipped"
                                                                    {{ $latestOrder->status === 'shipped' ? 'selected' : '' }}>
                                                                    Shipped</option>
                                                                <option value="delivered"
                                                                    {{ $latestOrder->status === 'delivered' ? 'selected' : '' }}>
                                                                    Delivered</option>
                                                                <option value="cancelled"
                                                                    {{ $latestOrder->status === 'cancelled' ? 'selected' : '' }}>
                                                                    Cancelled</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex justify-end space-x-2">
                                                            <button type="button"
                                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                                                data-modal-hide="orderStatusModal-{{ $latestOrder->id }}">Cancel</button>
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($rentItem->status == 1)
                                            <!-- Delete Button to open modal -->
                                            <button type="button" onclick="openDeleteModal({{ $rentItem->id }})"
                                                class="w-full inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>

                                            <!-- Delete Confirmation Modal -->
                                            <div id="deleteProductModal-{{ $rentItem->id }}"
                                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
                                                <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 transform scale-95 transition-transform duration-300"
                                                    id="deleteModalContent-{{ $rentItem->id }}">
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
                                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Are you sure
                                                            you want to delete this rent item?</h3>
                                                        <p class="text-sm text-gray-600 mb-6">This action cannot be undone.
                                                        </p>
                                                        <div class="flex justify-center space-x-4">
                                                            <button type="button"
                                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                                                onclick="closeDeleteModal({{ $rentItem->id }})">Cancel</button>
                                                            <form
                                                                action="{{ route('rent-items.destroy', $rentItem->id) }}"
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
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Products Found</h3>
                                        <p class="text-gray-500">You haven't listed any second-hand products yet.</p>
                                        <a href="#"
                                            class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#5E5EDC] hover:bg-[#4A4AC8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5E5EDC]">
                                            Add Your First Product
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
            // Initialize DataTable for rent items
            $('#my-rent-items-table').DataTable({
                searching: true,
                paging: true,
                pageLength: 10,
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    targets: [1, 2, 3, 4], // Make Product Info, Status, Order Info, and Actions columns non-orderable
                    orderable: false
                }],
                language: {
                    search: "Search rent items:",
                    lengthMenu: "Show _MENU_ rent items per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ rent items",
                    infoEmpty: "No rent items available",
                    zeroRecords: "No matching rent items found",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });

        // Order Status Modal Functions
        function openOrderStatusModal(orderId) {
            const modal = document.getElementById('orderStatusModal-' + orderId);
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeOrderStatusModal(orderId) {
            const modal = document.getElementById('orderStatusModal-' + orderId);
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        // Delete Product Modal Functions
        function openDeleteModal(productId) {
            const modal = document.getElementById('deleteProductModal-' + productId);
            const content = document.getElementById('deleteModalContent-' + productId);

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

        function closeDeleteModal(productId) {
            const modal = document.getElementById('deleteProductModal-' + productId);
            const content = document.getElementById('deleteModalContent-' + productId);

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
            // Order Status Modal event listeners
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
                    '[id^="orderStatusModal-"], [id^="deleteProductModal-"]');
                modals.forEach(modal => {
                    if (event.target === modal) {
                        if (modal.id.includes('deleteProductModal')) {
                            const productId = modal.id.split('-')[1];
                            closeDeleteModal(productId);
                        } else if (modal.id.includes('orderStatusModal')) {
                            modal.classList.add('hidden');
                        }
                    }
                });
            });

            // Close modal on Escape key press
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    // Close all open modals
                    const openModals = document.querySelectorAll(
                        '[id^="orderStatusModal-"]:not(.hidden), [id^="deleteProductModal-"]:not(.hidden)');
                    openModals.forEach(modal => {
                        if (modal.id.includes('deleteProductModal')) {
                            const productId = modal.id.split('-')[1];
                            closeDeleteModal(productId);
                        } else if (modal.id.includes('orderStatusModal')) {
                            modal.classList.add('hidden');
                        }
                    });
                }
            });
        });
    </script>
@endsection


