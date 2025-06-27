@extends('frontend.layouts.master')

@section('content')
    <section class="px-8 my-14 text-center">
        <h1 class="text-3xl font-bold text-[#5E5EDC] mb-6">Second-Hand Marketplace Section</h1>

        <div class="flex justify-end mb-8">
            <div class="flex space-x-4 items-start">
                <form action="{{ route('second-hand-products.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for products..."
                        class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 focus:outline-none">Search</button>
                </form>
                <a href="{{ route('second-hand-products.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none">
                    Add
                </a>
            </div>
        </div>

        @if ($secondHandProducts->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($secondHandProducts as $product)
                    <div class="border rounded-lg shadow p-4">
                        <a href="{{ route('second-hand-products.show', $product->id) }}">
                            <img src="{{ $product->images->first()?->url ? asset($product->images->first()->url) : asset('asset/frontend_asset/images/default.jpg') }}"
                                alt="{{ $product->item_name ?? '' }}" class="w-full h-40 object-cover rounded mb-4">
                            <h3 class="font-semibold text-lg">{{ $product->name ?? '' }}</h3>
                            <div class="flex items-center justify-between mt-2">
                                <span
                                    class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                    BDT {{ number_format($product->price ?? 0) }}
                                </span>
                                <div class="flex flex-col items-end text-xs text-gray-700">
                                    <span class="flex items-center mb-1">
                                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2.003 9.25C2.003 5.798 5.134 3 9 3s6.997 2.798 6.997 6.25c0 3.452-3.131 6.25-6.997 6.25s-6.997-2.798-6.997-6.25z" />
                                        </svg>
                                        <span class="font-semibold">Brand:</span>&nbsp;{{ $product->brand ?? 'N/A' }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v10H4V5zm2 2v2h2V7H6zm0 4v2h2v-2H6zm4-4v2h2V7h-2zm0 4v2h2v-2h-2z" />
                                        </svg>
                                        <span class="font-semibold">Type:</span>&nbsp;{{ $product->item_type ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $secondHandProducts->links('frontend.components.custom-pagination') }}
            </div>
        @else
            <div class="text-center py-24">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-.935-6.072-2.458M7.5 14.25L5.106 5.272M6.25 17.25L4.106 8.272M22.25 12c0 5.523-4.477 10-10 10S2.25 17.523 2.25 12 6.727 2.25 12.25 2.25s10 4.477 10 10z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No items found</h3>
                <p class="text-gray-500 mb-6">
                    @if (request('search'))
                        No items match your search for "{{ request('search') }}"
                    @else
                        Be the first to add a second hand product!
                    @endif
                </p>
                @if (request('search'))
                    <a href="{{ route('second-hand-products.index') }}" class="text-sky-600 hover:text-sky-800 font-medium">Clear
                        search</a>
                @endif
            </div>
        @endif
    </section>
@endsection
