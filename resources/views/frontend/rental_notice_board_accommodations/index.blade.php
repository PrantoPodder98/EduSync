@extends('frontend.layouts.master')

@section('content')
    <h1 class="text-3xl font-bold text-[#5E5EDC] mt-6 text-center">Rental Notice Board For Accommodation</h1>
    <div class="min-h-screen">

        <div class="px-8 py-10 max-w-7xl mx-auto">
            <!-- Enhanced Filter Form -->
            <form method="GET" class="bg-white/80 backdrop-blur-sm shadow-2xl rounded-2xl p-5 mb-8 border border-white/20">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Smart Filters</h2>
                    </div>
                    <div class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                        {{ $accommodations->total() ?? 0 }} found
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Division -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 flex items-center space-x-1">
                            <span class="text-indigo-500">📍</span>
                            <span>Location</span>
                        </label>
                        <select name="division"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all bg-white/90">
                            <option value="">All Divisions</option>
                            @foreach (['Dhaka', 'Chattogram', 'Khulna', 'Rajshahi', 'Barishal', 'Sylhet', 'Rangpur', 'Mymensingh'] as $division)
                                <option value="{{ $division }}"
                                    {{ ($filters['division'] ?? '') == $division ? 'selected' : '' }}>
                                    {{ $division }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Property Type -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 flex items-center space-x-1">
                            <span class="text-purple-500">🏠</span>
                            <span>Property Type</span>
                        </label>
                        <select name="property_type"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all bg-white/90">
                            <option value="">All Types</option>
                            @foreach (['Flat', 'Apartment', 'Hostel', 'Mess', 'Shared', 'House', 'Single Room', 'Studio', 'Duplex'] as $type)
                                <option value="{{ $type }}"
                                    {{ ($filters['property_type'] ?? '') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rent Type -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 flex items-center space-x-1">
                            <span class="text-green-500">💰</span>
                            <span>Rent Period</span>
                        </label>
                        <select name="rent_type"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all bg-white/90">
                            <option value="">All Periods</option>
                            <option value="monthly" {{ ($filters['rent_type'] ?? '') == 'monthly' ? 'selected' : '' }}>
                                Monthly</option>
                            <option value="daily" {{ ($filters['rent_type'] ?? '') == 'daily' ? 'selected' : '' }}>Daily
                            </option>
                            <option value="weekly" {{ ($filters['rent_type'] ?? '') == 'weekly' ? 'selected' : '' }}>Weekly
                            </option>
                        </select>
                    </div>

                    <!-- Bedrooms -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 flex items-center space-x-1">
                            <span class="text-pink-500">🛏️</span>
                            <span>Bedrooms</span>
                        </label>
                        <select name="bedrooms"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all bg-white/90">
                            <option value="">Any</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ ($filters['bedrooms'] ?? '') == $i ? 'selected' : '' }}>
                                    {{ $i }}{{ $i == 5 ? '+' : '' }} Bedroom{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Advanced Filters Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <!-- Price Range -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-2 flex items-center space-x-1">
                            <span class="text-emerald-500">💵</span>
                            <span>Budget Range (৳)</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="relative flex-1">
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-xs">৳</span>
                                <input type="number" name="min_price" min="0" placeholder="Min"
                                    value="{{ $filters['min_price'] ?? '' }}"
                                    class="w-full border border-gray-200 rounded-lg pl-6 pr-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all bg-white/90" />
                            </div>
                            <div class="text-gray-400 text-xs">to</div>
                            <div class="relative flex-1">
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-xs">৳</span>
                                <input type="number" name="max_price" min="0" placeholder="Max"
                                    value="{{ $filters['max_price'] ?? '' }}"
                                    class="w-full border border-gray-200 rounded-lg pl-6 pr-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all bg-white/90" />
                            </div>
                        </div>
                    </div>

                    <!-- Bathrooms -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 flex items-center space-x-1">
                            <span class="text-blue-500">🛁</span>
                            <span>Bathrooms</span>
                        </label>
                        <select name="bathrooms"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all bg-white/90">
                            <option value="">Any</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}"
                                    {{ ($filters['bathrooms'] ?? '') == $i ? 'selected' : '' }}>
                                    {{ $i }}{{ $i == 4 ? '+' : '' }} Bathroom{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center mt-5 space-y-3 sm:space-y-0">
                    <div class="flex space-x-3">
                        <button type="submit"
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-2 rounded-lg font-semibold shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center space-x-1 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Search</span>
                        </button>
                        <a href="{{ route('rental-notice.index') }}"
                            class="text-indigo-600 hover:text-indigo-800 px-4 py-2 rounded-lg border border-indigo-200 hover:border-indigo-300 font-medium transition-all duration-300 flex items-center space-x-1 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span>Reset</span>
                        </a>
                    </div>
                    <div class="text-xs text-gray-500 flex items-center space-x-1">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                        <span>Live updates</span>
                    </div>
                </div>
            </form>

            <!-- Properties Grid -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('rental-notice.create') }}"
                    class="inline-flex items-center px-3 py-1 bg-[#5E5EDC] text-white rounded font-semibold text-sm hover:bg-[#4A4AC8] transition-colors shadow">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Property
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($accommodations as $accommodation)
                    <div
                        class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset($accommodation->images[0]->url ?? 'default.jpg') }}"
                                class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500"
                                alt="Property Image">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    {{ ucfirst($accommodation->rent_type) }}
                                </span>
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                                <div class="text-white">
                                    <div class="text-2xl font-bold">
                                        ৳{{ number_format($accommodation->rent_amount) }}
                                        <span
                                            class="text-sm font-normal opacity-90">/{{ $accommodation->rent_type }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="mb-4">
                                <h4 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">
                                    {{ $accommodation->address }}</h4>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-700 shadow-sm">
                                        <svg class="w-4 h-4 mr-1 text-purple-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6">
                                            </path>
                                        </svg>
                                        {{ $accommodation->property_type }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center text-gray-600 text-sm mb-4">
                                <div class="flex items-center space-x-1">
                                    <span class="text-lg">🛏️</span>
                                    <span class="font-medium">{{ $accommodation->bedrooms }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="text-lg">🛁</span>
                                    <span class="font-medium">{{ $accommodation->bathrooms }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="text-lg">📐</span>
                                    <span class="font-medium">{{ $accommodation->size_sqft }} sqft</span>
                                </div>
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('rental-notice.show', $accommodation->id) }}"
                                    class="flex-1 text-center bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white py-3 rounded-xl font-semibold text-sm transform hover:scale-105 transition-all duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="w-32 h-32 mx-auto mb-8 opacity-50">
                            <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-gray-400">
                                <path
                                    d="M3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7M3 7L12 14L21 7M3 7L12 2L21 7"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Properties Found</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            We couldn't find any properties matching your criteria. Try adjusting your filters or check back
                            later for new listings.
                        </p>
                        <a href="{{ route('rental-notice.index') }}"
                            class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-8 py-3 rounded-xl font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all duration-300">
                            View All Properties
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-16">
                {{ $accommodations->appends(request()->query())->links('frontend.components.custom-pagination') }}
            </div>
        </div>
    </div>

    <!-- Floating Action Button for Mobile -->
    <div class="fixed bottom-6 right-6 z-50 lg:hidden">
        <button
            class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-full shadow-2xl flex items-center justify-center transform hover:scale-110 transition-all duration-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
        </button>
    </div>
@endsection
