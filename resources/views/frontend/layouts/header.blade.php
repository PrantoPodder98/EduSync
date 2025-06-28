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
          <a href="{{ route('rental-notice.index')}}" class="text-gray-700 hover:text-indigo-600">Rental
              Accommodation</a>
          <a href="{{ route('rent-items.index')}}" class="text-gray-700 hover:text-indigo-600">Rent Items</a>
          {{-- <a href="#" class="text-gray-700 hover:text-indigo-600">Community</a> --}}
      </nav>
      <div class="relative">
          <button id="profileDropdownButton" class="focus:outline-none">
              <img src="{{ asset('asset/frontend_asset') }}/images/profile-icon.png" alt="Profile"  
                  class="w-8 h-8 rounded-full" />
          </button>

          <div id="profileDropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-20">
                <div class="px-4 py-2 border-b">
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>
              <ul class="py-1 text-sm text-gray-700">
                  <li>
                      <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                  </li>
                  <li>
                      <a href="{{ route('orders.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                          My Orders
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('second-hand-products.myProducts') }}"
                          class="block px-4 py-2 hover:bg-gray-100">
                          My Products
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('cart.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                          Second-Hand Cart
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('rent.cart.index') }}" class="block px-4 py-2 hover:bg-gray-100 border-b">
                          Rent Item Cart
                      </a>
                  </li>
                  <li>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                      </form>
                  </li>

              </ul>
          </div>
      </div>
  </header>
