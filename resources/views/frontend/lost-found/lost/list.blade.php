@extends('frontend.layouts.master')

@section('content')
    <section class="px-8 my-20 text-center">
        <h1 class="text-3xl text-[#5E5EDC] font-bold mb-2">Lost & found Section</h1>
        <h2 class="text-2xl text-[#5E5EDC] font-semibold mb-8">lost Items</h2>

        <!-- Search + Report -->
        <div class="flex justify-center items-center space-x-8 mb-12">
            <!-- Search bar -->
            <form method="GET" action="{{ route('lost-items.index') }}"
                class="flex items-center w-[400px] border border-green-500 rounded-full px-4 py-2">
                <img src="{{ asset('asset/frontend_asset/images/filter-icon.png') }}" alt="Filter" class="w-4 h-4 mr-3" />
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by item name/location/description" class="flex-1 outline-none text-sm" />
                <button type="submit" class="hover:opacity-75 transition-opacity">
                    <img src="{{ asset('asset/frontend_asset/images/search-icon.png') }}" alt="Search"
                        class="w-4 h-4 ml-3" />
                </button>
            </form>

            <!-- Report Button -->
            <a href="{{ route('lost-items.create') }}"
                class="flex items-center bg-[#709EF2] text-white px-6 py-3 rounded-xl shadow hover:bg-blue-600 transition-colors duration-200">
                <span class="mr-2 text-lg font-medium">Report lost Item</span>
                <img src="{{ asset('asset/frontend_asset/images/report-icon.png') }}" alt="Report Icon" class="w-6 h-6" />
            </a>
        </div>

        <!-- Items Grid -->
        <div class="flex justify-center flex-wrap gap-6 px-4">
            @forelse($lostItems as $item)
                <div class="group w-80 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 text-left transform hover:-translate-y-2 transition-all duration-300 cursor-pointer"
                    onclick="openModal('{{ $item->id }}')">

                    <!-- Item Header -->
                    <div class="flex items-center space-x-4 mb-4">
                        @if (isset($item->image->url))
                            <img src="{{ asset($item->image->url) }}" alt="{{ $item->item_name }}"
                                class="w-12 h-12 rounded-lg object-cover border-2 border-gray-200" />
                        @else
                            <div
                                class="w-12 h-12 rounded-lg bg-gradient-to-r from-sky-400 to-blue-400 flex items-center justify-center">
                                <span
                                    class="text-white font-bold text-lg">{{ strtoupper(substr($item->item_name, 0, 2)) }}</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <p class="font-bold text-lg group-hover:text-sky-600 transition-colors">
                                {{ $item->item_name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($item->lost_date)->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-sm text-gray-700 mb-4 line-clamp-2">{{ Str::limit($item->description, 80) }}</p>

                    <!-- Location -->
                    <div class="flex items-center mb-3">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm text-gray-600">{{ $item->location }}</p>
                    </div>

                    <!-- Posted by -->
                    <div class="flex items-center mb-4">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm text-gray-600">Posted by: <span
                                class="font-semibold text-sky-600">{{ $item->user_name ?? 'Anonymous' }}</span></p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <button
                            class="flex-1 bg-gradient-to-r from-[#A680F2] to-sky-500 text-white text-sm px-4 py-2 rounded-full hover:from-sky-600 hover:to-sky-700 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center"
                            onclick="event.stopPropagation(); openModal('{{ $item->id }}')">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            View Details
                        </button>

                        @auth
                            @if (auth()->id() === $item->user_id)
                                <button
                                    class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all transform hover:scale-105 shadow-lg"
                                    onclick="event.stopPropagation(); openDeleteModal('{{ $item->id }}')">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-.935-6.072-2.458M7.5 14.25L5.106 5.272M6.25 17.25L4.106 8.272M22.25 12c0 5.523-4.477 10-10 10S2.25 17.523 2.25 12 6.727 2.25 12.25 2.25s10 4.477 10 10z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No items lost</h3>
                    <p class="text-gray-500 mb-6">
                        @if (request('search'))
                            No items match your search for "{{ request('search') }}"
                        @else
                            Be the first to report a lost item!
                        @endif
                    </p>
                    @if (request('search'))
                        <a href="{{ route('lost-items.index') }}"
                            class="text-sky-600 hover:text-sky-800 font-medium">Clear search</a>
                    @endif
                </div>
            @endforelse
        </div>

        @if ($lostItems->hasPages())
            @include('frontend.components.custom-pagination', ['paginator' => $lostItems])
        @endif

        <!-- Back Button -->
        <div class="mt-14">
            <a href="{{ route('lost-found') }}"
                class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                ← Back to Lost & lost
            </a>
        </div>
    </section>

    <!-- Detail Modal -->
    <div id="modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl p-8 max-w-lg w-full mx-4 transform scale-95 transition-transform duration-300 max-h-[90vh] overflow-y-auto"
            id="modalContent">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Item Details</h2>
                <button onclick="closeModal()"
                    class="text-gray-500 hover:text-gray-700 text-3xl font-light">&times;</button>
            </div>

            <div class="space-y-6">
                <!-- Item Image and Basic Info -->
                <div class="flex items-start space-x-4">
                    <div id="modalImageContainer"
                        class="w-45 h-45 rounded-lg bg-gray-200 flex items-center justify-center overflow-hidden">
                        <img id="modalImage" src="" alt="" class="w-full h-full object-cover hidden">
                        <span id="modalInitials" class="text-2xl font-bold text-gray-600"></span>
                    </div>
                    <div class="flex-1">
                        <h3 id="modalItemName" class="text-xl font-bold text-gray-800 mb-1"></h3>
                        <p id="modalDate" class="text-sm text-gray-500 mb-2"></p>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span id="modalLocation"></span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h4 class="font-semibold text-gray-800 mb-2">Description</h4>
                    <p id="modalDescription" class="text-gray-600 leading-relaxed"></p>
                </div>

                <!-- Posted By -->
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm text-gray-600">Posted by: <span id="modalUsername"
                            class="font-semibold text-sky-600"></span></p>
                </div>

                <!-- Contact Information -->
                <div class="bg-sky-50 rounded-lg p-4 border border-sky-100">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <h4 class="font-semibold text-sky-800">Contact Information</h4>
                    </div>
                    <p id="modalContact" class="text-lg font-bold text-sky-700"></p>
                </div>
            </div>

            <div class="mt-8 flex space-x-3">
                <button onclick="closeModal()"
                    class="flex-1 px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 font-medium transition-colors">
                    Close
                </button>
                <a id="modalCallButton" href=""
                    class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition-colors text-center">
                    📞 Call Now
                </a>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @auth
        <div id="deleteModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
            <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 transform scale-95 transition-transform duration-300"
                id="deleteModalContent">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Delete lost Item</h3>
                    <p class="text-gray-600 mb-8">Are you sure you want to delete this item? This action cannot be undone and
                        will permanently remove the item from the system.</p>

                    <div class="flex space-x-4">
                        <button onclick="closeDeleteModal()"
                            class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium transition-colors">
                            Cancel
                        </button>
                        <form id="deleteForm" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-colors">
                                Delete Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection

@section('custom_js')
    <script>
        // Global variables
        let currentDeleteTarget = null;
        const itemsData = @json($lostItems->keyBy('id'));

        // Modal functions
        function openModal(itemId) {
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');
            const item = itemsData[itemId];

            if (!item) return;

            // Update modal content
            updateModalContent(item);

            // Show modal with animation
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');

            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function openDeleteModal(itemId) {
            currentDeleteTarget = itemId;
            const deleteModal = document.getElementById('deleteModal');
            const deleteModalContent = document.getElementById('deleteModalContent');
            const deleteForm = document.getElementById('deleteForm');

            // Update form action
            deleteForm.action = `/lost-items/${itemId}`;

            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                deleteModal.classList.remove('opacity-0');
                deleteModalContent.classList.remove('scale-95');
                deleteModalContent.classList.add('scale-100');
            }, 10);
        }

        function closeDeleteModal() {
            const deleteModal = document.getElementById('deleteModal');
            const deleteModalContent = document.getElementById('deleteModalContent');

            deleteModal.classList.add('opacity-0');
            deleteModalContent.classList.remove('scale-100');
            deleteModalContent.classList.add('scale-95');

            setTimeout(() => {
                deleteModal.classList.add('hidden');
                currentDeleteTarget = null;
            }, 300);
        }

        function updateModalContent(item) {
            // Update basic info
            document.getElementById('modalItemName').textContent = item.item_name;
            document.getElementById('modalDate').textContent = new Date(item.lost_date).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
            document.getElementById('modalLocation').textContent = item.location;
            document.getElementById('modalDescription').textContent = item.description;
            document.getElementById('modalUsername').textContent = item.user_name || 'Anonymous';
            document.getElementById('modalContact').textContent = item.contact_number || 'No contact provided';

            // Update image or initials
            const modalImage = document.getElementById('modalImage');
            const modalInitials = document.getElementById('modalInitials');

            if (item.image) {
                modalImage.src = `${item.image.url}`;
                modalImage.alt = item.item_name;
                modalImage.classList.remove('hidden');
                modalInitials.classList.add('hidden');
            } else {
                modalImage.classList.add('hidden');
                modalInitials.textContent = item.item_name.substring(0, 2).toUpperCase();
                modalInitials.classList.remove('hidden');
            }

            // Update call button
            const callButton = document.getElementById('modalCallButton');
            if (item.contact_number) {
                callButton.href = `tel:${item.contact_number}`;
                callButton.classList.remove('hidden');
            } else {
                callButton.classList.add('hidden');
            }
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('modal');
            const deleteModal = document.getElementById('deleteModal');

            if (event.target === modal) {
                closeModal();
            }
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
                closeDeleteModal();
            }
        });

        // Search form enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('form[action*="lost-items"]');
            const searchInput = searchForm.querySelector('input[name="search"]');

            // Auto-submit on Enter key
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    searchForm.submit();
                }
            });
        });
    </script>
@endsection
