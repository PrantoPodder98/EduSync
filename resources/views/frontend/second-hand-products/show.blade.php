@extends('frontend.layouts.master')

@section('content')
    <h1 class="text-3xl font-bold text-[#5E5EDC] my-6 text-center">Second-Hand Marketplace Section</h1>

    <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Product Details</h2>

    <main class="max-w-6xl mx-auto p-10 mb-20">
        <div class="grid grid-cols-3 gap-10">
            <!-- Image Gallery -->
            <div class="col-span-1 space-y-4">
                <!-- Main Image -->
                <div class="overflow-hidden rounded-xl border shadow relative">
                    <img id="mainImage"
                        src="{{ asset(optional($secondHandProduct->images->first())->url ?? 'asset/frontend_asset/images/default.jpg') }}"
                        alt="{{ $secondHandProduct->item_name }}"
                        class="w-full transition-transform duration-300 ease-in-out cursor-zoom-in"
                        onclick="toggleZoom(this)">
                </div>

                <!-- Thumbnails -->
                @if ($secondHandProduct->images->count() > 1)
                    <div class="grid grid-cols-3 gap-3">
                        @foreach ($secondHandProduct->images as $image)
                            <img src="{{ asset($image->url) }}"
                                onclick="document.getElementById('mainImage').src = this.src"
                                class="w-full h-20 object-cover rounded-lg border cursor-pointer hover:opacity-80" />
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="col-span-2">

                <h1 class="text-2xl font-bold mb-2"><span class="text-[#5E5EDC]">{{ $secondHandProduct->name }}</span> -
                    <span class="text-xl">{{ $secondHandProduct->brand }}</span></h1>
                <p class="text-md mb-2 font-medium">Type: <span
                        class="text-gray-800">{{ $secondHandProduct->item_type }}</span></p>
                <div class="mb-4 flex items-center space-x-3">
                    <span
                        class="inline-block bg-gradient-to-r from-green-400 to-blue-500 text-white px-4 py-2 rounded-lg shadow font-bold text-xl animate-pulse">
                        BDT {{ number_format($secondHandProduct->price) }}
                    </span>
                    <span class="text-gray-500 font-medium">Special Offer!</span>
                </div>
                <p class="text-sm text-gray-600 mb-6">Condition: {{ $secondHandProduct->item_state }} |
                    Posted: {{ $secondHandProduct->created_at->format('F j, Y') }}</p>

                <p class="text-sm text-gray-700 leading-relaxed mb-6">
                    {{ $secondHandProduct->description }}
                </p>

                <!-- Seller Info -->
                <div class="flex items-center space-x-4 mb-6">
                    <img src="{{ asset('asset/frontend_asset/images/profile-icon.png') }}" class="w-12 h-12 rounded-full"
                        alt="Seller">
                    <div>
                        <p class="font-semibold">{{ $secondHandProduct->user_name }}</p>
                        <p class="text-sm text-gray-500">Located in: {{ $secondHandProduct->user_location }}</p>
                        <p class="text-sm text-gray-500">Contact:
                            <span class="text-blue-600">{{ $secondHandProduct->user_contact }}</span>
                        </p>
                    </div>
                </div>

                <!-- Contact Buttons -->
                <div class="flex space-x-4">
                    <button
                        class="border border-[#5E5EDC] text-[#5E5EDC] px-6 py-2 rounded-lg font-semibold hover:bg-gray-100">
                        Add to Cart
                    </button>
                    <a href="{{ route('second-hand-products.index') }}"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100">
                        Back to Products
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('custom_js')
    <script>
        function toggleZoom(image) {
            image.classList.toggle('scale-150');
        }
    </script>
@endsection
