@extends('frontend.layouts.master')

@section('content')
    <div class="container mx-auto mt-20 mb-60">
        <h1 class="text-3xl font-bold text-[#5E5EDC] mb-8 text-center">My Reservations</h1>

        <div class="overflow-x-auto">
            <table id="reservations-table" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Reservation
                            Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property
                            Details</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact
                            Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment
                            Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property
                            Owner</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Reservation
                            Fee (BDT)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 mb-20">
                    @foreach ($reservations as $index => $reservation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-blue-600 font-semibold">{{ $reservation->reservation_code }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($reservation->rentalNotice)
                                    <div class="flex items-center space-x-3">
                                        @if ($reservation->rentalNotice->images && $reservation->rentalNotice->images->isNotEmpty())
                                            <img src="{{ asset($reservation->rentalNotice->images->first()->url) }}"
                                                class="w-16 h-16 rounded-lg object-cover" alt="Property Image">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v1H8V5z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-gray-800 font-semibold text-sm">
                                                {{ Str::limit($reservation->rentalNotice->title, 30) }}</p>
                                            <p class="text-gray-600 text-xs">{{ $reservation->rentalNotice->property_type }}
                                            </p>
                                            <p class="text-gray-600 text-xs">{{ $reservation->rentalNotice->area }},
                                                {{ $reservation->rentalNotice->division }}</p>
                                            <p class="text-green-600 text-xs font-semibold">
                                                BDT
                                                {{ number_format($reservation->rentalNotice->rent_amount) }}/{{ $reservation->rentalNotice->rent_type }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-600">Property not available</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-gray-800 font-semibold text-sm">{{ $reservation->first_name }}
                                        {{ $reservation->last_name }}</p>
                                    <p class="text-gray-600 text-xs">{{ $reservation->email }}</p>
                                    <p class="text-gray-600 text-xs">{{ $reservation->phone_number }}</p>
                                    @if ($reservation->company_name)
                                        <p class="text-gray-600 text-xs">{{ $reservation->company_name }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($reservation->payment_method == 'bKash')
                                    <span class="text-pink-600 font-semibold">bKash</span>
                                    @if (isset($reservation->payment_details['bkash_number']))
                                        <br>
                                        <span class="text-gray-600 text-sm">Number:
                                            {{ $reservation->payment_details['bkash_number'] }}</span>
                                    @endif
                                @else
                                    <span
                                        class="text-gray-600 font-semibold">{{ ucfirst($reservation->payment_method) }}</span>
                                @endif
                                <br>
                                @php
                                    $paymentStatusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-green-100 text-green-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                    ];
                                    $paymentStatus = strtolower($reservation->payment_status ?? 'pending');
                                    $paymentColorClass =
                                        $paymentStatusColors[$paymentStatus] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $paymentColorClass }}">
                                    {{ ucfirst($reservation->payment_status ?? 'Pending') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($reservation->rentalNotice)
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ asset('asset/frontend_asset/images/profile-icon.png') }}"
                                            class="w-10 h-10 rounded-full" alt="Owner">
                                        <div>
                                            <p class="text-gray-800 font-semibold">
                                                {{ $reservation->rentalNotice->contact_name ?? 'N/A' }}</p>
                                            <p class="text-gray-600 text-sm">
                                                {{ $reservation->rentalNotice->contact_number ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-600">N/A</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $status = strtolower($reservation->status ?? 'pending');
                                    $colorClass = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                                    {{ ucfirst($reservation->status ?? 'Pending') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">BDT
                                {{ number_format($reservation->reservation_fee) }}/-</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('rental.reservation.success', $reservation->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Reservation
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($reservations->isEmpty())
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Reservations Found</h3>
                <p class="text-gray-600 mb-4">You haven't made any property reservations yet.</p>
                <a href="{{ route('rental-notice.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#5E5EDC] text-white font-semibold rounded-lg hover:bg-[#4A4AB8] transition duration-200">
                    Browse Properties
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if ($reservations->hasPages())
            <div class="mt-8">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#reservations-table').DataTable({
                // responsive: true,
                searching: true,
                paging: true,
                pageLength: 10,
                order: [
                    [6, 'desc']
                ], // Sort by date column (index 6) in descending order
                columnDefs: [{
                        orderable: false,
                        targets: [2, 3, 5]
                    }, // Disable sorting for property details, contact info, and owner columns
                ]
            });
        });
    </script>
@endsection
