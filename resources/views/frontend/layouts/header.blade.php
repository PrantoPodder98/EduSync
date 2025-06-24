  <header class="flex justify-between items-center px-16 py-6 bg-white shadow">

      <div class="text-2xl font-bold text-indigo-600">EduSync</div>
      <nav class="space-x-8">
          <a href="#" class="text-gray-700 hover:text-indigo-600">Marketplace</a>
          <a href="#" class="text-gray-700 hover:text-indigo-600">Housing</a>
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
              </ul>
          </div>
      </div>

  </header>
