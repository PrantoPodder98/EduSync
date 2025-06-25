@extends('frontend.layouts.master')
@section('content')
    <section class="px-8 my-20 text-center">
        <h1 class="text-3xl text-[#5E5EDC] font-bold mb-2">Lost &amp; Found Section</h1>
        <h2 class="text-2xl text-[#5E5EDC] font-semibold mb-8">Found Items</h2>

        <!-- Search + Report -->
        <div class="flex justify-center items-center space-x-8 mb-12">
            <!-- Search bar -->
            <div class="flex items-center w-[400px] border border-green-500 rounded-full px-4 py-2">
                <img src="{{ asset('asset/frontend_asset') }}/images/filter-icon.png" alt="Filter" class="w-4 h-4 mr-3" />
                <input type="text" placeholder="Item Name" class="flex-1 outline-none text-sm" />
                <img src="{{ asset('asset/frontend_asset') }}/images/search-icon.png" alt="Search" class="w-4 h-4 ml-3" />
            </div>

            <!-- Report Button -->
            <a href="{{ route('lost-found.found.report') }}"
                class="flex items-center bg-[#709EF2] text-white px-6 py-3 rounded-xl shadow hover:bg-blue-600 transition">
                <span class="mr-2 text-lg font-medium">Report</span>
                <img src="{{ asset('asset/frontend_asset') }}/images/report-icon.png" alt="Report Icon" class="w-6 h-6" />
            </a>
        </div>

        <!-- Cards -->
        <div class="flex justify-center flex-wrap gap-6 px-10">
            <!-- Card Template (repeat for each item) -->
            <div class="w-60 bg-white rounded-xl shadow border p-4 text-left">
                <div class="flex items-center space-x-3 mb-3">
                    <img src="{{ asset('asset/frontend_asset') }}/images/profile-icon.png" alt="profile-icon"
                        class="w-8 h-8 rounded-full bg-gray-300">
                    <div>
                        <p class="font-semibold text-sm">Item Name</p>
                        <p class="text-xs text-gray-500">Date</p>
                    </div>
                </div>
                <p class="text-sm font-semibold">Title</p>
                <p class="text-xs text-gray-500 mb-2">Location</p>
                <p class="text-xs text-gray-600 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
                <p class="text-xs text-gray-500 mb-2">Posted by: <span class="font-semibold">Username</span></p>
                <button class="bg-[#A680F2] text-white text-xs px-4 py-1 rounded-full hover:bg-purple-600 transition">
                    Contact
                </button>
            </div>

            <!-- Duplicate 3 more times for visual accuracy -->
            <div class="w-60 bg-white rounded-xl shadow border p-4 text-left">
                <div class="flex items-center space-x-3 mb-3">
                    <img src="{{ asset('asset/frontend_asset') }}/images/profile-icon.png" alt="profile-icon"
                        class="w-8 h-8 rounded-full bg-gray-300">
                    <div>
                        <p class="font-semibold text-sm">Item Name</p>
                        <p class="text-xs text-gray-500">Date</p>
                    </div>
                </div>
                <p class="text-sm font-semibold">Title</p>
                <p class="text-xs text-gray-500 mb-2">Location</p>
                <p class="text-xs text-gray-600 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
                <p class="text-xs text-gray-500 mb-2">Posted by: <span class="font-semibold">Username</span></p>
                <button class="bg-[#A680F2] text-white text-xs px-4 py-1 rounded-full hover:bg-purple-600 transition">
                    Contact
                </button>
            </div>

            <div class="w-60 bg-white rounded-xl shadow border p-4 text-left">
                <div class="flex items-center space-x-3 mb-3">
                    <img src="{{ asset('asset/frontend_asset') }}/images/profile-icon.png" alt="profile-icon"
                        class="w-8 h-8 rounded-full bg-gray-300">
                    <div>
                        <p class="font-semibold text-sm">Item Name</p>
                        <p class="text-xs text-gray-500">Date</p>
                    </div>
                </div>
                <p class="text-sm font-semibold">Title</p>
                <p class="text-xs text-gray-500 mb-2">Location</p>
                <p class="text-xs text-gray-600 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
                <button class="bg-[#A680F2] text-white text-xs px-4 py-1 rounded-full hover:bg-purple-600 transition">
                    Contact
                </button>
            </div>

            <div class="w-60 bg-white rounded-xl shadow border p-4 text-left">
                <div class="flex items-center space-x-3 mb-3">
                    <img src="{{ asset('asset/frontend_asset') }}/images/profile-icon.png" alt="profile-icon"
                        class="w-8 h-8 rounded-full bg-gray-300">
                    <div>
                        <p class="font-semibold text-sm">Item Name</p>
                        <p class="text-xs text-gray-500">Date</p>
                    </div>
                </div>
                <p class="text-sm font-semibold">Title</p>
                <p class="text-xs text-gray-500 mb-2">Location</p>
                <p class="text-xs text-gray-600 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
                <button class="bg-[#A680F2] text-white text-xs px-4 py-1 rounded-full hover:bg-purple-600 transition">
                    Contact
                </button>
            </div>
        </div>

        <div class="my-10">
            <a href="{{ route('lost-found') }}"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 my-20">Back</a>
        </div>

    </section>
@endsection
