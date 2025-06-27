@extends('frontend.layouts.master')

@section('content')
    <div class="container mx-auto mt-20 mb-60">
        <h1 class="text-3xl font-bold text-[#5E5EDC] mb-8 text-center">My Orders</h1>

        <div class="overflow-x-auto">
            <table id="orders-table" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order
                            Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order
                            Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment
                            Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner
                            Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                            (BDT)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 mb-20">
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- @foreach ($order->orderItems as $item)
                                    <a href="{{ route('second-hand-products.show', $item->secondHandProduct->id) }}">
                                        <div class="flex items-center space-x-2">
                                            <img src="{{ asset($item->secondHandProduct->images->first()->url ?? 'asset/frontend_asset/images/default.jpg') }}"
                                                alt="{{ $item->secondHandProduct->name }}"
                                                class="w-12 h-12 object-cover rounded">
                                            <span class="text-gray-800">{{ $item->secondHandProduct->name }}</span>
                                        </div>
                                    </a>
                                @endforeach --}}
                                @foreach ($order->orderItems as $item)
                                    @php
                                        $product = $item->secondHandProduct;
                                        $type = 'Second-Hand';
                                    @endphp
                                    @include(
                                        'frontend.orders.partial.order_item',
                                        compact('product', 'type'))
                                @endforeach

                                @foreach ($order->rentOrderItems as $item)
                                    @php
                                        $product = $item->rentItem;
                                        $type = 'Rent';
                                    @endphp
                                    @include(
                                        'frontend.orders.partial.order_item',
                                        compact('product', 'type'))
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($order->payment_method == 'bKash')
                                    <span class="text-pink-600 font-semibold">bKash</span>
                                    <br>
                                    <span class="text-gray-600 text-sm">Number: {{ $order->bkash_number }}</span>
                                @else
                                    <span class="text-gray-600 font-semibold">{{ ucfirst($order->payment_method) }}</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('asset/frontend_asset/images/profile-icon.png') }}"
                                        class="w-10 h-10 rounded-full" alt="Owner">
                                    {{-- @php
                                        $firstItem = $order->orderItems->first();
                                        $product = $firstItem ? $firstItem->secondHandProduct : null;
                                    @endphp --}}
                                    @php
                                        if ($order->orderItems->isNotEmpty()) {
                                            $firstProduct = $order->orderItems->first()->secondHandProduct;
                                        } elseif ($order->rentOrderItems->isNotEmpty()) {
                                            $firstProduct = $order->rentOrderItems->first()->rentItem;
                                        } else {
                                            $firstProduct = null;
                                        }
                                    @endphp
                                    <div>
                                        <p class="text-gray-800 font-semibold">{{ $firstProduct->user_name ?? 'N/A' }}</p>
                                        <p class="text-gray-600 text-sm">{{ $firstProduct->user_contact ?? 'N/A' }}</p>
                                        <p class="text-gray-600 text-sm">{{ $firstProduct->user_location ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'processing' => 'bg-blue-100 text-blue-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $status = strtolower($order->status);
                                    $colorClass = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($order->total_amount) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#orders-table').DataTable({
                // responsive: true,
                searching: true,
                paging: true,
                pageLength: 10,
            });
        });
    </script>
@endsection
