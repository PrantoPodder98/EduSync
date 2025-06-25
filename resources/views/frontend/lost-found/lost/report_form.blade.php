@extends('frontend.layouts.master')
@section('content')
    <!-- Heading -->
    <section class="text-center mt-12">
        <h2 class="text-xl text-blue-700 font-semibold">Lost & found Section</h2>
        <h1 class="text-4xl text-blue-700 font-bold mt-2">Report lost Item</h1>
    </section>

    <!-- Form Section -->
    <section class="flex justify-center mt-10 mb-16">
        <form class="w-[600px] border shadow px-8 py-10 rounded-md bg-white space-y-6" action="{{ route('lost-items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf   
            <!-- Item -->
            <div class="flex items-center">
                <label class="w-40 text-gray-700 font-medium">Item :</label>
                <input type="text" placeholder="Enter item name" name="item_name" required
                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Location -->
            <div class="flex items-center">
                <label class="w-40 text-gray-700 font-medium">Location :</label>
                <input type="text" placeholder="Enter lost location" name="location" required
                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Date -->
            <div class="flex items-center">
                <label class="w-40 text-gray-700 font-medium">Date :</label>
                <input type="date" name="lost_date" required
                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Description -->
            <div class="flex items-start">
                <label class="w-40 text-gray-700 font-medium pt-2">Item Description :</label>
                <textarea rows="3" placeholder="Describe the item..." name="description" 
                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>

            <!-- Upload -->
            <div class="flex items-center relative">
                <label class="w-40 text-gray-700 font-medium">Upload Photo :</label>
                <input type="file" class="flex-1 border border-gray-300 rounded px-3 py-2"  name="image"/>
            </div>

            <hr>

            <!-- User Name -->
            <div class="flex items-center">
                <label class="w-40 text-gray-700 font-medium">User Name :</label>
                <input type="text" placeholder="Enter user name" name="user_name" 
                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Contact Number -->
            <div class="flex items-center">
                <label class="w-40 text-gray-700 font-medium">Contact Number :</label>
                <input type="number" placeholder="Enter user contact number" name="contact_number" required
                    class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Reset Button -->
            <div class="text-center pt-4">
                <a href="{{ route('lost-items.index') }}"
                    class="bg-red-600 text-white px-6 py-2 rounded hover:bg-blue-700 mr-4">Back</a>

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-purple-700">Submit</button>
            </div>
        </form>
    </section>
@endsection

