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
          <a href="#" class="text-gray-700 hover:text-indigo-600">Tutoring</a>
          <a href="#" class="text-gray-700 hover:text-indigo-600">Jobs</a>
          <a href="#" class="text-gray-700 hover:text-indigo-600">Community</a>
      </nav>
      <div class="relative">
          <button id="profileDropdownButton" class="focus:outline-none">
              <img src="{{ asset('asset/frontend_asset') }}/images/profile-icon.png" alt="Profile"
                  class="w-8 h-8 rounded-full" />
          </button>

          <div id="profileDropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-20">
              <ul class="py-1 text-sm text-gray-700">
                  <li>
                      <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                  </li>
                  <li>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                      </form>
                  </li>
                  <!-- Add this to your navbar -->
                  <li>
                      @auth
                          <a href="{{ route('cart.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Second-Hand Cart
                              {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6">
                                  </path>
                              </svg> --}}
                              {{-- @if (auth()->user()->cartItems()->sum('quantity') > 0)
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                {{ auth()->user()->cartItems()->sum('quantity') }}
            </span>
        @endif --}}
                          </a>
                      @endauth
                  </li>

              </ul>
          </div>
      </div>
  </header>
