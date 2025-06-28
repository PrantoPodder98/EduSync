  <header class="flex justify-between items-center px-16 py-6 bg-white shadow border-b">
      <a href="{{ route('dashboard') }}">
          <div class="flex items-center space-x-4">
              <img src="{{ asset('asset/frontend_asset') }}/images/edusync-logo.png" alt="EduSync Logo" class="h-6" />
              <span class="text-2xl font-bold text-indigo-600">EduSync</span>
          </div>
      </a>
      <nav class="space-x-8">
          <a href="{{ route('lost-found') }}" class="text-gray-700 hover:text-indigo-600">Lost & Found</a>
          <a href="{{ route('second-hand-products.index') }}" class="text-gray-700 hover:text-indigo-600">Second-Hand
              Marketplace</a>
          <a href="{{ route('rental-notice.index') }}" class="text-gray-700 hover:text-indigo-600">Rental
              Accommodation</a>
          <a href="{{ route('rent-items.index') }}" class="text-gray-700 hover:text-indigo-600">Rent Items</a>

      </nav>

      <div class="relative inline-block">
        <button onclick="toggleDropdown()" class="focus:outline-none">
            <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-lg">
                    {{ substr(auth()->user()->name, 0, 1) }}{{ substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1) }}
                </span>
            </div>
        </button>

        <!-- Profile Dropdown Menu -->
        <div id="profileDropdownMenu" class="hidden absolute right-0 mt-3 w-64 glass-effect rounded-xl shadow-2xl z-20 border border-white/20">
            <!-- User Info Header -->
            <div class="px-6 py-4 border-b border-gray-200/50">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}{{ substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <ul class="py-2">
                <!-- Profile -->
                <li>
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 hover:bg-purple-50 transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-gray-700 group-hover:text-purple-700 font-medium">Profile</span>
                    </a>
                </li>

                <!-- My Orders -->
                <li>
                    <a href="{{ route('orders.index') }}" class="flex items-center px-6 py-3 hover:bg-blue-50 transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="text-gray-700 group-hover:text-blue-700 font-medium">My Orders</span>
                    </a>
                </li>

                <!-- My Products with Submenu -->
                <li class="relative group">
                    <a href="#" class="flex items-center justify-between px-6 py-3 hover:bg-green-50 transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="text-gray-700 group-hover:text-green-700 font-medium">My Products</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    
                    <!-- Submenu -->
                    <ul class="submenu absolute right-full top-0 mt-0 mr-2 w-56 glass-effect rounded-lg shadow-xl z-30 border border-white/20">
                        <li>
                            <a href="{{ route('second-hand-products.myProducts') }}" class="flex items-center px-4 py-3 hover:bg-orange-50 transition-all duration-200 group">
                                <svg class="w-4 h-4 mr-3 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span class="text-gray-700 group-hover:text-orange-700 font-medium">Second Hand Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rent-items.myRentItems') }}" class="flex items-center px-4 py-3 hover:bg-indigo-50 transition-all duration-200 group">
                                <svg class="w-4 h-4 mr-3 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 group-hover:text-indigo-700 font-medium">Rent Items</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Cart with Submenu -->
                <li class="relative group">
                    <a href="#" class="flex items-center justify-between px-6 py-3 hover:bg-yellow-50 transition-all duration-200 border-b border-gray-200/50">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6m-10 0V9a2 2 0 012-2h6a2 2 0 012 2v4.01" />
                            </svg>
                            <span class="text-gray-700 group-hover:text-yellow-700 font-medium">My Cart</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    
                    <!-- Cart Submenu -->
                    <ul class="submenu absolute right-full top-0 mt-0 mr-2 w-56 glass-effect rounded-lg shadow-xl z-30 border border-white/20">
                        <li>
                            <a href="{{ route('cart.index') }}" class="flex items-center px-4 py-3 hover:bg-yellow-50 transition-all duration-200 group">
                                <svg class="w-4 h-4 mr-3 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span class="text-gray-700 group-hover:text-yellow-700 font-medium">Second-Hand Cart</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rent.cart.index') }}" class="flex items-center px-4 py-3 hover:bg-teal-50 transition-all duration-200 group">
                                <svg class="w-4 h-4 mr-3 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 group-hover:text-teal-700 font-medium">Rent Item Cart</span>
                            </a>
                        </li>
                    </ul>
                </li>

               
                <!-- Rental Accommodation with Submenu -->
                <li class="relative group">
                    <a href="#" class="flex items-center justify-between px-6 py-3 hover:bg-purple-50 transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-700 group-hover:text-purple-700 font-medium">Rental Accommodation</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul class="submenu absolute right-full top-0 mt-0 mr-2 w-56 glass-effect rounded-lg shadow-xl z-30 border border-white/20">
                        <li>
                            <a href="{{ route('myRentalNotices') }}" class="flex items-center px-4 py-3 hover:bg-purple-50 transition-all duration-200 group">
                                <svg class="w-4 h-4 mr-3 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 group-hover:text-purple-700 font-medium">Rental Notice List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('myReservations') }}" class="flex items-center px-4 py-3 hover:bg-pink-50 transition-all duration-200 group">
                                <svg class="w-4 h-4 mr-3 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 group-hover:text-pink-700 font-medium">My Reservation</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="pt-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-6 py-3 hover:bg-red-50 transition-all duration-200 group">
                            <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="text-gray-700 group-hover:text-red-700 font-medium">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
  </header>
