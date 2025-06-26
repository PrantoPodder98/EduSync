@extends('frontend.layouts.master')

@section('content')
    <h1 class="text-3xl font-bold text-[#5E5EDC] my-8 text-center">Second-Hand Marketplace Section</h1>
    <main class="flex justify-center px-6 pb-12">
        <div class="w-full max-w-4xl bg-white p-10 rounded-2xl shadow-lg border">
            <h1 class="text-2xl font-bold text-center text-[#5E5EDC] mb-8">Add A New Second-hand Product</h1>

            <!-- Form Grid -->
            <form class="space-y-6" method="POST" action="{{ route('second-hand-products.store') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Name" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Brand <span class="text-red-500">*</span></label>
                        <input type="text" name="brand" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Brand Name" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Item Type <span class="text-red-500">*</span></label>
                        <select name="item_type" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Type</option>
                            <option>Books</option>
                            <option>Phone</option>
                            <option>Laptop</option>
                            <option>Dress</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Item State <span class="text-red-500">*</span></label>
                        <select name="item_state" class="w-full border rounded px-3 py-2 text-sm" required>
                            <option value="">Select Item State</option>
                            <option>Fully Functioning</option>
                            <option>Repaired</option>
                            <option>Not Used yet</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Price <span class="text-red-500">*</span></label>
                        <input type="number" name="price" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Price" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" class="w-full border rounded px-3 py-2 h-24" placeholder="Enter Description" required></textarea>
                </div>

                <!-- Upload -->
                <div>
                    <label class="block text-sm font-medium mb-2">Upload Photos <span class="text-red-500">*</span></label>
                    <input type="file" name="images[]" multiple accept="image/*" required
                        class="w-full border border-dashed border-[#5E5EDC] rounded-lg p-4 text-sm text-gray-500" />
                    <small class="text-xs text-gray-500 block mt-1">Supported: JPG, JPEG, PNG (Max 2MB each)</small>
                </div>

                <hr>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">User Name <span class="text-red-500">*</span></label>
                        <input type="text" name="user_name" class="w-full border rounded px-3 py-2"
                            value="{{ auth()->user()->name }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">User Location <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="user_location" class="w-full border rounded px-3 py-2"
                            placeholder="Enter Location" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">User Contact <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="user_contact" class="w-full border rounded px-3 py-2"
                            placeholder="Contact" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Payment Option <span
                                class="text-red-500">*</span></label>
                        <select name="user_payment_option" id="paymentOption" required
                            class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">Select Payment Option</option>
                            <option value="Cash on delivery">Cash on delivery</option>
                            <option value="bKash">bKash</option>
                        </select>
                    </div>
                    <div id="bKashNumberField" style="display: none;">
                        <label class="block text-sm font-medium mb-1">User bKash Number <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="user_bKash_number" class="w-full border rounded px-3 py-2"
                            placeholder="User bKash Number">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#5E5EDC] hover:bg-[#4a4adc] text-white font-medium py-3 rounded-xl mt-6">
                    Add New Product
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
                    bkashField.style.display = '';
                    bkashField.querySelector('input').setAttribute('required', 'required');
                } else {
                    bkashField.style.display = 'none';
                    bkashField.querySelector('input').removeAttribute('required');
                }
            });
        });
    </script>
@endsection
