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

        <div class="flex justify-center flex-wrap gap-6 px-10">
        <!-- Enhanced Card 1 -->
        <div class="group w-60 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-4 text-left transform hover:-translate-y-2 transition-all duration-300 cursor-pointer" onclick="openModal('modal1')">
            <div class="flex items-center space-x-3 mb-3">
                <img src="https://via.placeholder.com/32x32/A680F2/ffffff?text=LW" alt="profile-icon" class="w-8 h-8 rounded bg-gradient-to-r from-purple-400 to-pink-400">
                <div>
                    <p class="font-semibold text-sm group-hover:text-purple-600 transition-colors">Luxury Watch</p>
                    <p class="text-xs text-gray-500">Jan 15, 2025</p>
                </div>
            </div>
            <p class="text-sm font-semibold mb-1 group-hover:text-purple-600 transition-colors">Premium Timepiece Collection</p>
            <div class="flex items-center mb-2">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Location: New York, NY</p>
            </div>
            <div class="flex items-start mb-4">
                <svg class="w-3 h-3 mr-1 mt-0.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-600">
                    Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
            </div>
            <div class="flex items-center mb-3">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Posted by: <span class="font-semibold text-purple-600">John_Collector</span></p>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 bg-gradient-to-r from-[#A680F2] to-purple-500 text-white text-xs px-3 py-2 rounded-full hover:from-purple-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center" onclick="event.stopPropagation(); openModal('modal1')">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                    Contact: 01795087285
                </button>
                <button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all transform hover:scale-105 shadow-lg" onclick="event.stopPropagation(); openDeleteModal('modal1')">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Enhanced Card 2 -->
        <div class="group w-60 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-4 text-left transform hover:-translate-y-2 transition-all duration-300 cursor-pointer" onclick="openModal('modal2')">
            <div class="flex items-center space-x-3 mb-3">
                <img src="https://via.placeholder.com/32x32/3B82F6/ffffff?text=VC" alt="profile-icon" class="w-8 h-8 rounded bg-gradient-to-r from-blue-400 to-teal-400">
                <div>
                    <p class="font-semibold text-sm group-hover:text-blue-600 transition-colors">Vintage Camera</p>
                    <p class="text-xs text-gray-500">Jan 20, 2025</p>
                </div>
            </div>
            <p class="text-sm font-semibold mb-1 group-hover:text-blue-600 transition-colors">Classic Photography Equipment</p>
            <div class="flex items-center mb-2">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Location: Los Angeles, CA</p>
            </div>
            <div class="flex items-start mb-4">
                <svg class="w-3 h-3 mr-1 mt-0.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-600">
                    Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
            </div>
            <div class="flex items-center mb-3">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Posted by: <span class="font-semibold text-blue-600">Sarah_Photo</span></p>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 bg-gradient-to-r from-[#A680F2] to-purple-500 text-white text-xs px-3 py-2 rounded-full hover:from-purple-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center" onclick="event.stopPropagation(); openModal('modal2')">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                    Contact: 01795087286
                </button>
                <button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all transform hover:scale-105 shadow-lg" onclick="event.stopPropagation(); openDeleteModal('modal2')">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Enhanced Card 3 -->
        <div class="group w-60 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-4 text-left transform hover:-translate-y-2 transition-all duration-300 cursor-pointer" onclick="openModal('modal3')">
            <div class="flex items-center space-x-3 mb-3">
                <img src="https://via.placeholder.com/32x32/10B981/ffffff?text=GS" alt="profile-icon" class="w-8 h-8 rounded bg-gradient-to-r from-green-400 to-emerald-400">
                <div>
                    <p class="font-semibold text-sm group-hover:text-green-600 transition-colors">Gaming Setup</p>
                    <p class="text-xs text-gray-500">Jan 22, 2025</p>
                </div>
            </div>
            <p class="text-sm font-semibold mb-1 group-hover:text-green-600 transition-colors">Professional Gaming Rig</p>
            <div class="flex items-center mb-2">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Location: Austin, TX</p>
            </div>
            <div class="flex items-start mb-4">
                <svg class="w-3 h-3 mr-1 mt-0.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-600">
                    Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
            </div>
            <div class="flex items-center mb-3">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Posted by: <span class="font-semibold text-green-600">Mike_Gamer</span></p>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 bg-gradient-to-r from-[#A680F2] to-purple-500 text-white text-xs px-3 py-2 rounded-full hover:from-purple-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center" onclick="event.stopPropagation(); openModal('modal3')">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                    Contact: 01795087287
                </button>
                <button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all transform hover:scale-105 shadow-lg" onclick="event.stopPropagation(); openDeleteModal('modal3')">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Enhanced Card 4 -->
        <div class="group w-60 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-4 text-left transform hover:-translate-y-2 transition-all duration-300 cursor-pointer" onclick="openModal('modal4')">
            <div class="flex items-center space-x-3 mb-3">
                <img src="https://via.placeholder.com/32x32/F97316/ffffff?text=AC" alt="profile-icon" class="w-8 h-8 rounded bg-gradient-to-r from-orange-400 to-red-400">
                <div>
                    <p class="font-semibold text-sm group-hover:text-orange-600 transition-colors">Art Collection</p>
                    <p class="text-xs text-gray-500">Jan 25, 2025</p>
                </div>
            </div>
            <p class="text-sm font-semibold mb-1 group-hover:text-orange-600 transition-colors">Modern Abstract Painting</p>
            <div class="flex items-center mb-2">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Location: Miami, FL</p>
            </div>
            <div class="flex items-start mb-4">
                <svg class="w-3 h-3 mr-1 mt-0.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-600">
                    Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
            </div>
            <div class="flex items-center mb-3">
                <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-gray-500">Posted by: <span class="font-semibold text-orange-600">Artist_Pro</span></p>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 bg-gradient-to-r from-[#A680F2] to-purple-500 text-white text-xs px-3 py-2 rounded-full hover:from-purple-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center" onclick="event.stopPropagation(); openModal('modal4')">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                    Contact: 01795087288
                </button>
                <button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all transform hover:scale-105 shadow-lg" onclick="event.stopPropagation(); openDeleteModal('modal4')">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 transform scale-95 transition-transform duration-300" id="modalContent">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Item Details</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            
            <div class="mb-4">
                <div class="flex items-center space-x-3 mb-3">
                    <img id="modalProfileIcon" src="" alt="profile-icon" class="w-50 h-50 rounded">
                    <div>
                        <p class="font-semibold text-sm" id="modalItemName">Item Name</p>
                        <p class="text-xs text-gray-500" id="modalDate">Date</p>
                    </div>
                </div>
                <p class="text-sm font-semibold mb-2" id="modalTitle">Title</p>
                <div class="flex items-center mb-2">
                    <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-xs text-gray-500" id="modalLocation">Location</p>
                </div>
                <div class="flex items-start mb-3">
                    <svg class="w-3 h-3 mr-1 mt-0.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-xs text-gray-600" id="modalDescription">Description</p>
                </div>
                <div class="flex items-center mb-4">
                    <svg class="w-3 h-3 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-xs text-gray-500">Posted by: <span class="font-semibold text-purple-600" id="modalUsername">Username</span></p>
                </div>
                <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                    <p class="text-sm font-semibold text-purple-600" id="modalContact">Contact</p>
                </div>
            </div>
            
            <button onclick="closeModal()" class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-sm font-semibold transition-colors">
                Close
            </button>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300" id="deleteModalContent">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Item</h3>
            <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this item? This action cannot be undone.</p>
            
            <div class="flex space-x-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 text-sm font-medium transition-colors">
                    Cancel
                </button>
                <button onclick="confirmDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition-colors">
                    Delete
                </button>
            </div>
        </div>
    </div>
    </div>


        <div class="my-10">
            <a href="{{ route('lost-found') }}"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 my-20">Back</a>
        </div>

    </section>
@endsection


@section('custom_js')


    <script>
let currentDeleteTarget = null;

// Modal functions
function openModal(modalId) {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modalContent');
    
    // Get card data based on modalId
    const cardData = getCardData(modalId);
    updateModalContent(cardData);
    
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

function openDeleteModal(modalId) {
    currentDeleteTarget = modalId;
    const deleteModal = document.getElementById('deleteModal');
    const deleteModalContent = document.getElementById('deleteModalContent');
    
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

function confirmDelete() {
    if (currentDeleteTarget) {
        // Find and remove the card
        const cardToDelete = document.querySelector(`[onclick*="${currentDeleteTarget}"]`);
        if (cardToDelete) {
            cardToDelete.style.transform = 'scale(0)';
            cardToDelete.style.opacity = '0';
            setTimeout(() => {
                cardToDelete.remove();
            }, 300);
        }
    }
    closeDeleteModal();
}

function getCardData(modalId) {
    const cardDataMap = {
        'modal1': {
            profileIcon: 'https://via.placeholder.com/32x32/A680F2/ffffff?text=LW',
            itemName: 'Luxury Watch',
            date: 'Jan 15, 2025',
            title: 'Premium Timepiece Collection',
            location: 'Location: New York, NY',
            description: 'Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor',
            username: 'John_Collector',
            contact: 'Contact: 01795087285'
        },
        'modal2': {
            profileIcon: 'https://via.placeholder.com/32x32/3B82F6/ffffff?text=VC',
            itemName: 'Vintage Camera',
            date: 'Jan 20, 2025',
            title: 'Classic Photography Equipment',
            location: 'Location: Los Angeles, CA',
            description: 'Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor',
            username: 'Sarah_Photo',
            contact: 'Contact: 01795087286'
        },
        'modal3': {
            profileIcon: 'https://via.placeholder.com/32x32/10B981/ffffff?text=GS',
            itemName: 'Gaming Setup',
            date: 'Jan 22, 2025',
            title: 'Professional Gaming Rig',
            location: 'Location: Austin, TX',
            description: 'Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor',
            username: 'Mike_Gamer',
            contact: 'Contact: 01795087287'
        },
        'modal4': {
            profileIcon: 'https://via.placeholder.com/32x32/F97316/ffffff?text=AC',
            itemName: 'Art Collection',
            date: 'Jan 25, 2025',
            title: 'Modern Abstract Painting',
            location: 'Location: Miami, FL',
            description: 'Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor',
            username: 'Artist_Pro',
            contact: 'Contact: 01795087288'
        }
    };
    
    return cardDataMap[modalId] || {};
}

function updateModalContent(data) {
    document.getElementById('modalProfileIcon').src = data.profileIcon;
    document.getElementById('modalItemName').textContent = data.itemName;
    document.getElementById('modalDate').textContent = data.date;
    document.getElementById('modalTitle').textContent = data.title;
    document.getElementById('modalLocation').textContent = data.location;
    document.getElementById('modalDescription').textContent = data.description;
    document.getElementById('modalUsername').textContent = data.username;
    document.getElementById('modalContact').textContent = data.contact;
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
</script>
@endsection
