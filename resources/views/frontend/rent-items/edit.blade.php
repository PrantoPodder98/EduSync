@extends('frontend.layouts.master')

@section('content')
    <h1 class="text-3xl font-bold text-[#5E5EDC] my-8 text-center">Rent Items Section</h1>
    <main class="flex justify-center px-6 pb-12">
        <div class="w-full max-w-4xl bg-white p-10 rounded-2xl shadow-lg border">
            <h1 class="text-2xl font-bold text-center text-[#5E5EDC] mb-8">Edit Rent Item Product</h1>

            <!-- Form Grid -->
            <form class="space-y-6" method="POST" action="{{ route('rent-items.update', $rentItem->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Name" value="{{ old('name', $rentItem->name) }}" required>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Brand <span class="text-red-500">*</span></label>
                        <input type="text" name="brand" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Brand Name" value="{{ old('brand', $rentItem->brand) }}" required>
                        @error('brand')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Item Type <span class="text-red-500">*</span></label>
                        <select name="item_type" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Type</option>
                            <option {{ old('item_type', $rentItem->item_type) == 'Books' ? 'selected' : '' }}>Books</option>
                            <option {{ old('item_type', $rentItem->item_type) == 'Phone' ? 'selected' : '' }}>Phone</option>
                            <option {{ old('item_type', $rentItem->item_type) == 'Laptop' ? 'selected' : '' }}>Laptop
                            </option>
                            <option {{ old('item_type', $rentItem->item_type) == 'Dress' ? 'selected' : '' }}>Dress</option>
                            <option {{ old('item_type', $rentItem->item_type) == 'Others' ? 'selected' : '' }}>Others
                            </option>
                        </select>
                        @error('item_type')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Item State <span class="text-red-500">*</span></label>
                        <select name="item_state" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Item State</option>
                            <option
                                {{ old('item_state', $rentItem->item_state) == 'Fully Functioning' ? 'selected' : '' }}>
                                Fully Functioning</option>
                            <option {{ old('item_state', $rentItem->item_state) == 'Repaired' ? 'selected' : '' }}>Repaired
                            </option>
                            <option {{ old('item_state', $rentItem->item_state) == 'Not Used yet' ? 'selected' : '' }}>Not
                                Used yet</option>
                        </select>
                        @error('item_state')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Price <span class="text-red-500">*</span></label>
                        <input type="number" name="price" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Price" value="{{ old('price', $rentItem->price) }}" required>
                        @error('price')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Rent Type <span class="text-red-500">*</span></label>
                        <select name="rent_type" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Rent Type</option>
                            <option value="daily"
                                {{ old('rent_type', $rentItem->rent_type) == 'daily' ? 'selected' : '' }}>Daily</option>
                            <option value="monthly"
                                {{ old('rent_type', $rentItem->rent_type) == 'monthly' ? 'selected' : '' }}>Monthly
                            </option>
                        </select>
                        @error('rent_type')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Rent Duration <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="rent_duration" class="w-full border rounded px-3 py-2" required
                            placeholder="Enter Duration" value="{{ old('rent_duration', $rentItem->rent_duration) }}">
                        @error('rent_duration')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" class="w-full border rounded px-3 py-2 h-24" placeholder="Enter Description" required>{{ old('description', $rentItem->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Upload New Images -->
                <div>
                    <label class="block text-sm font-medium mb-2">Upload New Photos (Optional)</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                        class="w-full border border-dashed border-[#5E5EDC] rounded-lg p-4 text-sm text-gray-500" />
                    <small class="text-xs text-gray-500 block mt-1">Supported: JPG, JPEG, PNG (Max 2MB each)</small>
                    @error('images')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Current Images Display -->
                @if ($rentItem->images && $rentItem->images->count() > 0)
                    <div>
                        <label class="block text-sm font-medium mb-2">Current Images</label>
                        <div class="grid grid-cols-4 gap-4 mb-4">
                            @foreach ($rentItem->images as $image)
                                <div class="relative group">
                                    <img src="{{ asset($image->url) }}" alt="Product Image"
                                        class="w-full h-24 object-cover rounded-lg border">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <hr>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">User Name <span class="text-red-500">*</span></label>
                        <input type="text" name="user_name" class="w-full border rounded px-3 py-2"
                            value="{{ old('user_name', $rentItem->user_name) }}" required>
                        @error('user_name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">User Location <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="user_location" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Location" value="{{ old('user_location', $rentItem->user_location) }}"
                            required>
                        @error('user_location')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">User Contact <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="user_contact" class="w-full border rounded px-3 py-2"
                            placeholder="Contact" value="{{ old('user_contact', $rentItem->user_contact) }}" required>
                        @error('user_contact')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Payment Option <span
                                class="text-red-500">*</span></label>
                        <select name="user_payment_option" id="paymentOption" required
                            class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">Select Payment Option</option>
                            <option value="Cash on delivery"
                                {{ old('user_payment_option', $rentItem->user_payment_option) == 'Cash on delivery' ? 'selected' : '' }}>
                                Cash on delivery</option>
                            <option value="bKash"
                                {{ old('user_payment_option', $rentItem->user_payment_option) == 'bKash' ? 'selected' : '' }}>
                                bKash</option>
                        </select>
                        @error('user_payment_option')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div id="bKashNumberField"
                        style="display: {{ old('user_payment_option', $rentItem->user_payment_option) == 'bKash' ? 'block' : 'none' }};">
                        <label class="block text-sm font-medium mb-1">User bKash Number <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="user_bKash_number" class="w-full border rounded px-3 py-2"
                            placeholder="User bKash Number"
                            value="{{ old('user_bKash_number', $rentItem->user_bKash_number) }}">
                        @error('user_bKash_number')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#5E5EDC] hover:bg-[#4a4adc] text-white font-medium py-3 rounded-xl mt-6">
                    Update Rent Item
                </button>

                <a href="{{ route('rent-items.index') }}"
                    class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-3 rounded-xl mt-4 text-center block">
                    Back to Rent Items List
                </a>
            </form>
        </div>
    </main>

    <!-- Hidden form for image deletion -->
    <form id="deleteImageForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
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
