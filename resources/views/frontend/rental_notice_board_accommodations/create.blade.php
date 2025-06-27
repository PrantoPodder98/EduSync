@extends('frontend.layouts.master')



@section('content')
    <h1 class="text-3xl font-bold text-[#5E5EDC] mt-6 text-center">Rental Notice Board For Accommodation</h1>

    <main class="flex justify-center px-6 py-12">
        <div class="w-full max-w-5xl bg-white p-10 rounded-2xl shadow-lg border">
            <h1 class="text-2xl font-bold text-center text-[#5E5EDC] mb-8">Add A New Accommodation</h1>

            <form action="{{ route('rental-notice.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <label class="block text-sm font-medium text-blue-600">Property Details</label>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" class="w-full border rounded px-3 py-2" required
                            value="{{ old('title') }}" placeholder="Enter Title">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Property Type <span
                                class="text-red-500">*</span></label>
                        <select name="property_type" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Type</option>
                            @foreach (['Flat', 'Hostel', 'Mess', 'Shared', 'House', 'Single'] as $type)
                                <option value="{{ $type }}" {{ old('property_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}</option>
                            @endforeach
                        </select>
                        @error('property_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Unit Number</label>
                        <input type="text" name="unit_no" class="w-full border rounded px-3 py-2"
                            value="{{ old('unit_no') }}" placeholder="Optional Unit Number">
                        @error('unit_no')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <label class="block text-sm font-medium text-blue-600">Location Details</label>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Division <span class="text-red-500">*</span></label>
                        <select name="division" class="w-full border rounded px-3 py-2" required>
                            <option value="">Select Division</option>
                            @foreach (['Dhaka', 'Chattogram', 'Khulna', 'Rajshahi', 'Barishal', 'Sylhet', 'Rangpur', 'Mymensingh'] as $division)
                                <option value="{{ $division }}" {{ old('division') == $division ? 'selected' : '' }}>
                                    {{ $division }}
                                </option>
                            @endforeach
                        </select>
                        @error('division')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Area <span class="text-red-500">*</span></label>
                        <input type="text" name="area" class="w-full border rounded px-3 py-2" required
                            value="{{ old('area') }}" placeholder="Enter Area">
                        @error('area')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" class="w-full border rounded px-3 py-2" required
                            value="{{ old('address') }}" placeholder="Enter Address">
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Map Link</label>
                    <input type="text" name="map_link" class="w-full border rounded px-3 py-2"
                        value="{{ old('map_link') }}" placeholder="Enter Google Map Link">
                    @error('map_link')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <label class="block text-sm font-medium text-blue-600">Rent Details</label>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Rent Type <span class="text-red-500">*</span></label>
                        <select name="rent_type" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="monthly" {{ old('rent_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="daily" {{ old('rent_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                        </select>
                        @error('rent_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Rent Amount <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="rent_amount" class="w-full border rounded px-3 py-2" required
                            value="{{ old('rent_amount') }}" placeholder="e.g. 10000">
                        @error('rent_amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Advance Amount</label>
                        <input type="number" name="advance_amount" class="w-full border rounded px-3 py-2"
                            value="{{ old('advance_amount') }}" placeholder="e.g. 20000">
                        @error('advance_amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Utility Bill</label>
                        <input type="number" name="utility_bill" class="w-full border rounded px-3 py-2"
                            value="{{ old('utility_bill') }}" placeholder="e.g. 500">
                        @error('utility_bill')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <label class="block text-sm font-medium text-blue-600">Property Features</label>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Bedrooms <span class="text-red-500">*</span></label>
                        <input type="number" name="bedrooms" class="w-full border rounded px-3 py-2" min="0"
                            max="10" required value="{{ old('bedrooms', 1) }}">
                        @error('bedrooms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Bathrooms <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="bathrooms" class="w-full border rounded px-3 py-2" min="0"
                            max="10" required value="{{ old('bathrooms', 1) }}">
                        @error('bathrooms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Balcony</label>
                        <input type="number" name="balcony" class="w-full border rounded px-3 py-2" min="0"
                            max="10" value="{{ old('balcony', 0) }}">
                        @error('balcony')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Size (sqft)</label>
                        <input type="number" name="size_sqft" class="w-full border rounded px-3 py-2"
                            value="{{ old('size_sqft') }}" placeholder="e.g. 1200">
                        @error('size_sqft')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <label class="block text-sm font-medium text-blue-600">Contact Information</label>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Contact Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="contact_name" class="w-full border rounded px-3 py-2" required
                            value="{{ old('contact_name') }}" placeholder="Full Name">
                        @error('contact_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Contact Number <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="contact_number" class="w-full border rounded px-3 py-2" required
                            value="{{ old('contact_number') }}" placeholder="e.g. 017XXXXXXXX">
                        @error('contact_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <label class="block text-sm font-medium text-blue-600">Full Details</label>
                <div>
                    <label class="block text-sm font-medium mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="10" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror


                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Upload Photos</label>
                    <input type="file" name="images[]" multiple
                        class="w-full text-sm border border-dashed border-[#5E5EDC] rounded-lg px-4 py-6 bg-gray-50">
                    @error('images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <label class="block text-sm font-medium text-blue-600">Payment Details</label>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Bank Name</label>
                        <input type="text" name="bank_name" class="w-full border rounded px-3 py-2"
                            value="{{ old('bank_name') }}" placeholder="e.g. City Bank">
                        @error('bank_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Account Number</label>
                        <input type="text" name="bank_account_number" class="w-full border rounded px-3 py-2"
                            value="{{ old('bank_account_number') }}" placeholder="e.g. 1234567890">
                        @error('bank_account_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Routing Number</label>
                        <input type="text" name="bank_routing_number" class="w-full border rounded px-3 py-2"
                            value="{{ old('bank_routing_number') }}" placeholder="e.g. 987654321">
                        @error('bank_routing_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Bkash Number</label>
                    <input type="text" name="bkash_number" class="w-full border rounded px-3 py-2"
                        value="{{ old('bkash_number') }}" placeholder="e.g. 017XXXXXXXX">
                    @error('bkash_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#5E5EDC] hover:bg-[#4a4adc] text-white font-medium py-3 rounded-xl mt-6">
                    Add New Property
                </button>

                <a href="{{ route('rental-notice.index') }}"
                   class="inline-block w-full mt-4 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-center">
                    Back to List
                </a>

            </form>
        </div>
    </main>
@endsection

@section('custom_js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
