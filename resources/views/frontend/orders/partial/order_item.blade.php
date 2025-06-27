<a href="{{ $type == 'Second-Hand' ? route('second-hand-products.show', $product->id) : route('rent-items.show', $product->id) }}">
    <div class="flex items-center space-x-2 mb-1">
        <img src="{{ asset($product->images->first()->url ?? 'asset/frontend_asset/images/default.jpg') }}"
            alt="{{ $product->name }}"
            class="w-12 h-12 object-cover rounded">
        <div>
            <span class="text-gray-800">{{ $product->name }}</span>
            <br>
            <small class="text-gray-500">{{ $type }} Item</small>
        </div>
    </div>
</a>
