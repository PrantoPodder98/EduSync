@extends('frontend.layouts.master')

@section('content')
    <h1 class="text-3xl font-bold text-[#5E5EDC] my-8 text-center">Edit Second-Hand Product</h1>
    <main class="flex justify-center px-6 pb-12">
        <div class="w-full max-w-4xl bg-white p-10 rounded-2xl shadow-lg border">
            <h1 class="text-2xl font-bold text-center text-[#5E5EDC] mb-8">Update Product Details</h1>

            <!-- Edit Form -->
            <form class="space-y-6" method="POST" action="{{ route('second-hand-products.update', $secondHandProduct->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $secondHandProduct->name) }}"
                            class="w-full border rounded px-3 py-2" placeholder="Enter Name" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Brand <span class="text-red-500">*</span></label>
                        <input type="text" name="brand" value="{{ old('brand', $secondHandProduct->brand) }}"
                            class="w-full border rounded px-3 py-2" placeholder="Enter Brand Name" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Item Type <span class="text-red-500">*</span></label>
                        <select name="item_type" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Type</option>
                            <option {{ old('item_type', $secondHandProduct->item_type) == 'Books' ? 'selected' : '' }}>
                                Books</option>
                            <option {{ old('item_type', $secondHandProduct->item_type) == 'Phone' ? 'selected' : '' }}>
                                Phone</option>
                            <option {{ old('item_type', $secondHandProduct->item_type) == 'Laptop' ? 'selected' : '' }}>
                                Laptop</option>
                            <option {{ old('item_type', $secondHandProduct->item_type) == 'Dress' ? 'selected' : '' }}>
                                Dress</option>
                            <option {{ old('item_type', $secondHandProduct->item_type) == 'Others' ? 'selected' : '' }}>
                                Others</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Item State <span class="text-red-500">*</span></label>
                        <select name="item_state" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Item State</option>
                            <option
                                {{ old('item_state', $secondHandProduct->item_state) == 'Fully Functioning' ? 'selected' : '' }}>
                                Fully functioning</option>
                            <option {{ old('item_state', $secondHandProduct->item_state) == 'Repaired' ? 'selected' : '' }}>
                                Repaired</option>
                            <option
                                {{ old('item_state', $secondHandProduct->item_state) == 'Not Used yet' ? 'selected' : '' }}>
                                Not Used yet</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Price <span class="text-red-500">*</span></label>
                        <input type="number" name="price" value="{{ old('price', $secondHandProduct->price) }}"
                            class="w-full border rounded px-3 py-2" placeholder="Enter Price" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" class="w-full border rounded px-3 py-2 h-24" placeholder="Enter Description" required>{{ old('description', $secondHandProduct->description) }}</textarea>
                </div>

                <!-- Option to Upload Additional Photos -->
                <div>
                    <label class="block text-sm font-medium mb-2">Upload Additional Photos</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                        class="w-full border border-dashed border-[#5E5EDC] rounded-lg p-4 text-sm text-gray-500" />
                    <small class="text-xs text-gray-500 block mt-1">Supported: JPG, JPEG, PNG (Max 2MB each)</small>
                </div>
                <!-- Display Current Images -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold mb-4 text-center">Current Images</h2>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($secondHandProduct->images as $image)
                            <div class="relative">
                                <img src="{{ asset($image->url) }}" alt="Product Image"
                                    class="w-20 h-20 object-cover rounded">
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">User Name <span class="text-red-500">*</span></label>
                        <input type="text" name="user_name" value="{{ old('user_name', auth()->user()->name) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">User Location <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="user_location"
                            value="{{ old('user_location', $secondHandProduct->user_location) }}"
                            class="w-full border rounded px-3 py-2" placeholder="Enter Location" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">User Contact <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="user_contact"
                            value="{{ old('user_contact', $secondHandProduct->user_contact) }}"
                            class="w-full border rounded px-3 py-2" placeholder="Contact" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Payment Option <span
                                class="text-red-500">*</span></label>
                        <select name="user_payment_option" id="paymentOption" required
                            class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">Select Payment Option</option>
                            <option value="Cash on Delivery"
                                {{ old('user_payment_option', $secondHandProduct->user_payment_option) == 'Cash on delivery' ? 'selected' : '' }}>
                                Cash on delivery</option>
                            <option value="bKash"
                                {{ old('user_payment_option', $secondHandProduct->user_payment_option) == 'bKash' ? 'selected' : '' }}>
                                bKash</option>
                        </select>
                    </div>
                    <div id="bKashNumberField"
                        style="display: {{ old('user_payment_option', $secondHandProduct->user_payment_option) == 'bKash' ? 'block' : 'none' }};">
                        <label class="block text-sm font-medium mb-1">User bKash Number <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="user_bKash_number"
                            value="{{ old('user_bKash_number', $secondHandProduct->user_bKash_number) }}"
                            class="w-full border rounded px-3 py-2" placeholder="User bKash Number"
                            {{ old('user_payment_option', $secondHandProduct->user_payment_option) == 'bKash' ? 'required' : '' }}>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#5E5EDC] hover:bg-[#4a4adc] text-white font-medium py-3 rounded-xl mt-6">
                    Update Product
                </button>

                <a href="{{ route('second-hand-products.index') }}"
                    class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-3 rounded-xl mt-4 text-center block">
                    Back to Marketplace
                </a>
            </form>
        </div>
    </main>
@endsection

@section('custom_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentOption = document.getElementById('paymentOption');
            const bkashField = document.getElementById('bKashNumberField');

            paymentOption.addEventListener('change', function() {
                if (this.value === 'bKash') {
                    bkashField.style.display = 'block';
                    bkashField.querySelector('input').setAttribute('required', 'required');
                } else {
                    bkashField.style.display = 'none';
                    bkashField.querySelector('input').removeAttribute('required');
                }
            });
        });
    </script>
@endsection
