@extends('frontend.layouts.master')

@section('content')

    <!-- Hero Section -->
    <section
        class="flex justify-between items-center px-16 py-20 bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
        <div class="max-w-xl">
            <h1 class="text-5xl font-bold leading-tight mb-6">Your Complete Campus Life Solution</h1>
            <p class="text-lg mb-6">Connect, trade, and thrive in your campus community with EduSync’s all-in-one
                platform.</p>
            <a href="#"
                class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded shadow hover:bg-gray-100 transition">Get
                Started</a>
        </div>
        <div>
            <img src="{{ asset('asset/frontend_asset') }}/images/hero-image.jpg" alt="Students Illustration" class="w-[450px]" />
        </div>
    </section>

    <!-- Features Section -->
    <section class="px-16 py-20 bg-white">
        <h2 class="text-3xl font-bold text-center mb-12">Everything You Need in One Place</h2>
        <div class="grid grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <img src="{{ asset('asset/frontend_asset') }}/images/icon1.png" alt="Marketplace" class="w-10 mb-4">
                <h3 class="font-bold mb-2">Campus Marketplace</h3>
                <p>Buy and sell textbooks, electronics, and more conveniently for student campus economy.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <img src="{{ asset('asset/frontend_asset') }}/images/icon2.png" alt="Housing" class="w-10 mb-4">
                <h3 class="font-bold mb-2">Student Housing</h3>
                <p>Find or rent student accommodations, roommates, and housing options nearby.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <img src="{{ asset('asset/frontend_asset') }}/images/icon3.png" alt="Tutoring" class="w-10 mb-4">
                <h3 class="font-bold mb-2">Tutoring Network</h3>
                <p>Connect with qualified peers or offer your expertise to help others.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <img src="{{ asset('asset/frontend_asset') }}/images/icon4.png" alt="Jobs" class="w-10 mb-4">
                <h3 class="font-bold mb-2">Job Board</h3>
                <p>Discover on- and off-campus jobs, internships, and career opportunities.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <img src="{{ asset('asset/frontend_asset') }}/images/icon5.png" alt="Events" class="w-10 mb-4">
                <h3 class="font-bold mb-2">Campus Events</h3>
                <p>Stay updated with future campus events, clubs, and socials.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <img src="{{ asset('asset/frontend_asset') }}/images/icon6.png" alt="Secure" class="w-10 mb-4">
                <h3 class="font-bold mb-2">Secure Platform</h3>
                <p>All transactions are protected and secure for peace of mind.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="px-16 py-20 bg-indigo-600 text-white grid grid-cols-4 text-center">
        <div>
            <p class="text-3xl font-bold">50K+</p><span>Active Users</span>
        </div>
        <div>
            <p class="text-3xl font-bold">100K+</p><span>Transactions</span>
        </div>
        <div>
            <p class="text-3xl font-bold">5K+</p><span>Verified Tutors</span>
        </div>
        <div>
            <p class="text-3xl font-bold">50+</p><span>Universities</span>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="px-16 py-20 bg-white">
        <h2 class="text-3xl font-bold text-center mb-12">What Students Say</h2>
        <div class="grid grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <p class="mb-4">“EduSync made it super easy to find a tutor and manage my classes.”</p>
                <strong>Sarah Johnson</strong><br><span class="text-sm text-gray-500">Computer Science</span>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <p class="mb-4">“The marketplace is convenient and reasonably priced. I’ve sold and bought so many
                    things!”</p>
                <strong>Michael Chen</strong><br><span class="text-sm text-gray-500">Business</span>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <p class="mb-4">“I loved the community support and campus event section. Everything in one place.”</p>
                <strong>Emily Rodriguez</strong><br><span class="text-sm text-gray-500">Psychology</span>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="px-16 py-20 bg-gray-100 text-center">
        <h2 class="text-3xl font-bold mb-4">Join Your Campus Community Today</h2>
        <p class="mb-6">Connect with fellow students, access resources, and make the most of your campus life with
            EduSync.</p>
        <div class="space-x-4">
            <a href="#" class="bg-indigo-600 text-white px-6 py-3 rounded shadow hover:bg-indigo-700">Sign Up
                Now</a>
            <a href="#"
                class="border border-indigo-600 text-indigo-600 px-6 py-3 rounded hover:bg-indigo-50">Learn More</a>
        </div>
    </section>

@endsection
