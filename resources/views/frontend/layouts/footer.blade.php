<footer class="bg-gray-900 text-gray-400 px-16 py-12">
    <div class="grid grid-cols-4 gap-12">
        <div>
            <h4 class="text-white text-xl font-semibold mb-2">EduSync</h4>
            <p>All-in-one student solution for modern campus life.</p>
        </div>
        <div>
            <h5 class="text-white font-semibold mb-2">Features</h5>
            <ul>
                <li>
                    <a href="{{ route('lost-found') }}" class="hover:text-white">Lost & Found</a>
                </li>
                <li>
                    <a href="{{ route('second-hand-products.index') }}" class="hover:text-white">Second-Hand
                        Marketplace</a>
                </li>
                <li>
                    <a href="{{ route('rental-notice.index') }}" class="hover:text-white">Rental
                        Accommodation</a>
                </li>
                <li>
                    <a href="{{ route('rent-items.index') }}" class="hover:text-white">Rent Items</a>
                </li>
            </ul>
        </div>
        <div>
            <h5 class="text-white font-semibold mb-2">Support</h5>
            <ul>
                <li><a href="#" class="hover:text-white">Help Center</a></li>
                <li><a href="#" class="hover:text-white">Community Guidelines</a></li>
            </ul>
        </div>
        <div>
            <h5 class="text-white font-semibold mb-2">Connect</h5>
            <div class="flex space-x-4 mt-2">
                <img src="{{ asset('asset/frontend_asset') }}/images/facebook.png" class="w-6" alt="Facebook" />
                <img src="{{ asset('asset/frontend_asset') }}/images/twitter.png" class="w-6" alt="Twitter" />
                <img src="{{ asset('asset/frontend_asset') }}/images/instagram.png" class="w-6" alt="Instagram" />
                <img src="{{ asset('asset/frontend_asset') }}/images/linkedin.png" class="w-6" alt="LinkedIn" />
            </div>
        </div>
    </div>
    <div class="text-center text-sm text-gray-500 mt-10">© 2025 EduSync. All rights reserved.</div>
</footer>
