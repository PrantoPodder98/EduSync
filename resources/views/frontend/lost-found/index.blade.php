@extends('frontend.layouts.master')
@section('content')
    <main class="text-center my-20 px-8">
        <h1 class="text-3xl text-[#5E5EDC] font-semibold mb-10">Lost &amp; Found Section</h1>

        <!-- Buttons -->
        <div class="flex flex-col items-center space-y-6 mb-16">
            <a href="{{ route('lost-found.lost') }}"
                class="flex items-center justify-between px-8 py-4 bg-[#709EF2] text-white font-semibold rounded-xl shadow-md w-60 text-lg hover:bg-blue-600 transition">
                <span>Lost</span>
                <img src="{{ asset('asset/frontend_asset') }}/images/lost-icon.png" alt="Lost" class="w-6 h-6 ml-4">
            </a>
            <a href="{{ route('found-items.index') }}"
                class="flex items-center justify-between px-8 py-4 bg-[#A680F2] text-white font-semibold rounded-xl shadow-md w-60 text-lg hover:bg-purple-600 transition">
                <span>Found</span>
                <img src="{{ asset('asset/frontend_asset') }}/images/found-icon.png" alt="Found" class="w-6 h-6 ml-4">
            </a>
        </div>

        <!-- Image Row -->
        <div class="flex justify-center space-x-[-40px]">
            <img src="{{ asset('asset/frontend_asset') }}/images/item1.jpg" alt="Lost Item" class="w-40 h-40 object-cover rounded-lg shadow-md z-10">
            <img src="{{ asset('asset/frontend_asset') }}/images/item2.jpg" alt="Lost Item" class="w-40 h-40 object-cover rounded-lg shadow-md z-20">
            <img src="{{ asset('asset/frontend_asset') }}/images/item3.jpg" alt="Lost Item" class="w-40 h-40 object-cover rounded-lg shadow-md z-30">
            <img src="{{ asset('asset/frontend_asset') }}/images/item4.jpg" alt="Lost Item" class="w-40 h-40 object-cover rounded-lg shadow-md z-40">
        </div>
    </main>
@endsection