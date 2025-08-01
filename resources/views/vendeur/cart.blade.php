<div>
    @if($cart && $cart->items->count() > 0)
        @foreach($cart->items as $item)
            <div class="cart-item border-b py-4" data-price="{{ $item->product->price }}">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h4 class="font-semibold">{{ $item->product->name }}</h4>
                        <p class="text-gray-600 text-sm">€{{ number_format($item->product->price, 2) }} x {{ $item->quantity }}</p>
                    </div>
                    <span class="font-semibold">€{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <button onclick="updateItemQuantity({{ $item->id }}, parseInt(this.nextElementSibling.value) - 1)"
                                class="bg-gray-200 px-2 py-1 rounded-l" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                            -
                        </button>
                        <input type="number" value="{{ $item->quantity }}" min="1"
                               class="item-quantity w-12 text-center border-t border-b"
                               onchange="updateItemQuantity({{ $item->id }}, parseInt(this.value))">
                        <button onclick="updateItemQuantity({{ $item->id }}, parseInt(this.previousElementSibling.value) + 1)"
                                class="bg-gray-200 px-2 py-1 rounded-r">
                            +
                        </button>
                    </div>
                    <button onclick="removeItem({{ $item->id }})" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-10 text-gray-500">
            <i class="fas fa-shopping-cart text-4xl mb-4"></i>
            <p>Votre panier est vide</p>
        </div>
    @endif
</div>
