@extends('frontend.layouts.master')

@section('content')
    <main class="bg-gradient-to-br from-gray-50 to-white min-h-screen">
        <h1 class="text-3xl font-bold text-[#5E5EDC] mt-6 text-center">Rental Notice Board For Accommodation</h1>
        <h2 class="text-2xl font-semibold text-gray-800 text-center">
            {{ $rentalNotice->title }} Details
        </h2>


        <div class="max-w-7xl mx-auto px-8 py-8">
            <!-- Property Header -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-3xl font-bold text-gray-900">{{ $rentalNotice->title }}</h2>
                        <div class="flex items-center space-x-2">
                            <span
                                class="inline-block px-4 py-2 rounded-full text-sm font-semibold
                                @if ($rentalNotice->status === 'active') bg-green-100 text-green-800
                                @elseif($rentalNotice->status === 'rented') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($rentalNotice->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Property Type & Location Badge -->
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-medium">
                            Property Type: <span class="font-bold">{{ ucfirst($rentalNotice->property_type) }}
                            </span></span>
                        <span class="text-gray-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $rentalNotice->area }}, {{ $rentalNotice->division }}
                        </span>
                    </div>

                    <!-- Image Gallery -->
                    @if ($rentalNotice->images && $rentalNotice->images->count() > 0)
                        <div class="mb-8">
                            <!-- Main Image -->
                            <div class="mb-4">
                                <img id="mainImage" src="{{ asset($rentalNotice->images->first()->url) }}"
                                    class="w-full h-96 object-cover rounded-xl shadow-lg cursor-pointer hover:shadow-2xl transition-shadow duration-300"
                                    alt="Property Image" onclick="openImageModal(this.src)" />
                            </div>

                            <!-- Thumbnail Gallery -->
                            @if ($rentalNotice->images->count() > 1)
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                                    @foreach ($rentalNotice->images as $index => $image)
                                        <img src="{{ asset($image->url) }}"
                                            class="w-full h-24 object-cover rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-all duration-300 hover:scale-105 {{ $index === 0 ? 'ring-2 ring-indigo-500' : '' }}"
                                            alt="Property Image {{ $index + 1 }}"
                                            onclick="changeMainImage(this.src, this)" />
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div
                            class="bg-gradient-to-br from-gray-100 to-gray-200 h-96 rounded-xl flex items-center justify-center mb-8">
                            <div class="text-center">
                                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-gray-500 text-lg">No images available</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Property Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Property Features Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            Property Features
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $rentalNotice->bedrooms }}</p>
                                    <p class="text-sm text-gray-600">Bedroom(s)</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-green-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M10.5 3L12 2l1.5 1H21l-9 18L3 3h7.5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $rentalNotice->bathrooms }}</p>
                                    <p class="text-sm text-gray-600">Bathroom(s)</p>
                                </div>
                            </div>
                            @if ($rentalNotice->balcony > 0)
                                <div class="flex items-center space-x-3">
                                    <div class="bg-purple-100 p-3 rounded-lg">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 005.5 8h-.5a2 2 0 00-2 2V16a2 2 0 002 2h.5A2.5 2.5 0 008 20.5v1.565M15 8a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $rentalNotice->balcony }}</p>
                                        <p class="text-sm text-gray-600">Balcony/Balconies</p>
                                    </div>
                                </div>
                            @endif
                            @if ($rentalNotice->size_sqft)
                                <div class="flex items-center space-x-3">
                                    <div class="bg-orange-100 p-3 rounded-lg">
                                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ number_format($rentalNotice->size_sqft) }}</p>
                                        <p class="text-sm text-gray-600">Square Feet</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($rentalNotice->unit_no)
                            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600">Unit Number</p>
                                <p class="font-semibold text-gray-900">{{ $rentalNotice->unit_no }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Description Card -->
                    @if ($rentalNotice->description)
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h4 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Description
                            </h4>
                            <div class="prose prose-gray max-w-none">
                                <p class="text-gray-700 leading-relaxed">{!! $rentalNotice->description !!}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Location Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Location Details
                        </h4>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg mt-1">
                                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Address</p>
                                    <p class="text-gray-700">{{ $rentalNotice->address }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="bg-blue-100 p-2 rounded-lg mt-1">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Area & Division</p>
                                    <p class="text-gray-700">{{ $rentalNotice->area }}, {{ $rentalNotice->division }}</p>
                                </div>
                            </div>
                            @if ($rentalNotice->map_link)
                                <div class="mt-4 rounded-lg overflow-hidden shadow-lg">
                                    <iframe
                                        src="https://maps.google.com/maps?q={{ urlencode($rentalNotice->address . ', ' . $rentalNotice->area . ', ' . $rentalNotice->division) }}&output=embed"
                                        width="100%" height="300" style="border:0;" allowfullscreen=""
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Booking & Contact -->
                <div class="space-y-6">
                    <!-- Pricing Card -->
                    <div
                        class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl shadow-2xl p-8 top-8">
                        <div class="text-center mb-6">
                            <p class="text-4xl font-bold mb-2">
                                ৳{{ number_format($rentalNotice->rent_amount) }}
                                <span class="text-lg font-normal opacity-90">/ {{ $rentalNotice->rent_type }}</span>
                            </p>
                        </div>

                        <!-- Additional Costs -->
                        @if ($rentalNotice->advance_amount || $rentalNotice->utility_bill)
                            <div class="bg-white bg-opacity-20 rounded-xl p-4 mb-6">
                                <h5 class="font-semibold mb-3">Additional Costs</h5>
                                <div class="space-y-2 text-sm">
                                    @if ($rentalNotice->advance_amount)
                                        <div class="flex justify-between">
                                            <span>Advance Payment</span>
                                            <span>৳{{ number_format($rentalNotice->advance_amount) }}</span>
                                        </div>
                                    @endif
                                    @if ($rentalNotice->utility_bill)
                                        <div class="flex justify-between">
                                            <span>Utility Bill</span>
                                            <span>৳{{ number_format($rentalNotice->utility_bill) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Contact Information -->
                        @if ($rentalNotice->user)
                            <div class="flex items-center space-x-4 mb-6">
                                @if ($rentalNotice->user->avatar)
                                    <img src="{{ asset('storage/' . $rentalNotice->user->avatar) }}"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-white"
                                        alt="Host" />
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-white bg-opacity-30 flex items-center justify-center border-2 border-white">
                                        <span
                                            class="text-white font-semibold">{{ substr($rentalNotice->contact_name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold">{{ $rentalNotice->contact_name }}</p>
                                    <p class="text-sm opacity-90">Property Owner</p>
                                </div>
                            </div>
                        @endif

                        <!-- Action Button -->
                        @if ($rentalNotice->status === 'active')
                            <a href="tel:{{ $rentalNotice->contact_number }}"
                                class="w-full bg-white text-indigo-600 py-4 rounded-xl font-bold text-center block hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                Call {{ $rentalNotice->contact_number }}
                            </a>
                            <form {{-- action="{{ route('rental.reserve', $rentalNotice->id) }}" --}} method="POST" class="mt-4">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-green-400 hover:bg-green-500 text-indigo-900 font-bold py-3 rounded-xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    Reserve Property
                                </button>
                            </form>
                        @else
                            <button class="w-full bg-gray-400 text-white py-4 rounded-xl font-bold cursor-not-allowed"
                                disabled>
                                {{ $rentalNotice->status === 'rented' ? '🏠 Property Rented' : '❌ Not Available' }}
                            </button>
                        @endif
                    </div>

                    <!-- Host Information Card -->
                    @if ($rentalNotice->user)
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Posted By</h3>
                            <div class="flex items-start space-x-4">
                                @if ($rentalNotice->user->avatar)
                                    <img src="{{ asset('storage/' . $rentalNotice->user->avatar) }}"
                                        class="w-16 h-16 rounded-full object-cover" alt="Host" />
                                @else
                                    <div
                                        class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                        <span
                                            class="text-white font-bold text-xl">{{ substr($rentalNotice->user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900 text-lg">{{ $rentalNotice->user->name }}</p>
                                    <p class="text-sm text-gray-600 mb-3">Member since
                                        {{ $rentalNotice->user->created_at->format('Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Back to Listings Button -->
                    <div class="mt-6 bg-white rounded-2xl shadow-lg p-8">
                        <a href="{{ route('rental-notice.index') }}"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-bold text-center block hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Back to Listings
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Modal -->
        <div id="imageModal"
            class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
            <div class="relative max-w-4xl max-h-full">
                <button onclick="closeImageModal()"
                    class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <img id="modalImage" src="" class="w-full h-full object-contain rounded-lg"
                    alt="Full size image" />
            </div>
        </div>
    </main>

@endsection

@section('custom_js')
    <script>
        function changeMainImage(src, element) {
            document.getElementById('mainImage').src = src;

            // Remove active class from all thumbnails
            document.querySelectorAll('.grid img').forEach(img => {
                img.classList.remove('ring-2', 'ring-indigo-500');
            });

            // Add active class to clicked thumbnail
            element.classList.add('ring-2', 'ring-indigo-500');
        }

        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endsection
