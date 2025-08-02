@extends('layouts.vendeur')

@section('content')

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong>Erreur :</strong> {{ session('error') }}
        </div>
    @endif

    <div class="tab-content p-6" id="products-tab">
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h2 class="text-xl font-semibold mb-4 md:mb-0">Catalogue produits</h2>
                <div class="flex space-x-2">
                    <form method="GET" action="{{ route('vendeur.produits') }}" class="relative flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Rechercher un produit..."
                               class="pl-10 pr-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </form>
                    <div class="relative">
                        <select name="category" onchange="this.form.submit()"
                                class="appearance-none pl-3 pr-8 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Toutes catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                    </div>
                    <button type="button" onclick="document.querySelector('form').submit()"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-filter mr-2"></i>Filtrer
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if($products->isEmpty())
                <div class="text-center py-10">
                    <i class="fas fa-box-open text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Aucun produit trouvé</p>
                    @if(request()->has('search') || request()->has('category'))
                        <a href="{{ route('vendeur.produits') }}" class="text-blue-600 hover:underline mt-2 inline-block">
                            Réinitialiser les filtres
                        </a>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="product-card bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                            <div class="bg-gray-100 h-40 flex items-center justify-center relative">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                @else
                                    <i class="{{ $product->category->icon ?? 'fas fa-box' }} text-4xl text-gray-400"></i>
                                @endif
                                <!-- Promotion non présente dans votre table products - à ajouter si nécessaire -->
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                        <p class="text-gray-500 text-sm truncate">{{ $product->description }}</p>
                                    </div>
                                    <!-- Statut de stock adapté à votre structure -->
                                    <span class="@if($product->quantity > $product->alert_quantity) bg-green-100 text-green-800 @elseif($product->quantity > 0) bg-yellow-100 text-yellow-800 @else bg-red-100 text-red-800 @endif px-2 py-1 rounded-full text-xs">
                                    @if($product->quantity > $product->alert_quantity)
                                            En stock
                                        @elseif($product->quantity > 0)
                                            Stock bas
                                        @else
                                            Rupture
                                        @endif
                                </span>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <div>
                                        <span class="font-bold text-lg">{{ number_format($product->price, 2) }} Fcfa</span>
                                    </div>

                                    @if($product->quantity > 0)
                                        <button onclick="addToCart({{ $product->id }})"
                                                class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 text-sm transition duration-300">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    @else
                                        <button disabled
                                                class="bg-gray-400 text-white px-3 py-1 rounded-lg text-sm cursor-not-allowed opacity-60"
                                                title="Rupture de stock">
                                            <i class="fas fa-ban mr-1"></i> Indisponible
                                        </button>
                                    @endif


                                </div>
                                <!-- Informations supplémentaires -->
                                <div class="mt-2 text-sm text-gray-600">
                                    <p>SKU: {{ $product->sku }}</p>
                                    <p>Quantité: {{ $product->quantity }} {{ $product->unit }}</p>
                                    @if($product->brand)
                                        <p>Marque: {{ $product->brand }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>


        <div class="fixed inset-y-0 right-0 w-80 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50" id="cart-sidebar">
            <div class="p-4 h-full flex flex-col">
                <div class="flex justify-between items-center border-b pb-4">
                    <h3 class="text-lg font-semibold">Panier</h3>
                    <button onclick="closeCart()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="flex-grow overflow-y-auto py-4" id="cart-items-container">
                    <!-- Cart items will be loaded here via AJAX -->
                    <div class="text-center py-10 text-gray-500">
                        <i class="fas fa-shopping-cart text-4xl mb-4"></i>
                        <p>Votre panier est vide</p>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between mb-2">
                        <span>Total:</span>
                        <span class="font-semibold" id="cart-total">0.00 Fcfa</span>
                    </div>
                    <button onclick="checkout()" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        enregostrer la commande
                    </button>
                </div>
            </div>
        </div>

        <div class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="cart-overlay" onclick="closeCart()"></div>

        <button onclick="openCart()" class="fixed right-6 bottom-6 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 z-30">
            <i class="fas fa-shopping-cart"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center" id="cart-count">0</span>
        </button>




            <script>
                function addToCart(productId) {
                    fetch('{{ route("vendeur.cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                updateCartCount(data.cart_count);
                                loadCartItems();
                                // Show success notification
                                Toastify({
                                    text: "Produit ajouté au panier",
                                    duration: 3000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#4CAF50",
                                }).showToast();
                            }
                        });
                }


                function openCart() {
                    document.getElementById('cart-sidebar').classList.remove('translate-x-full');
                    document.getElementById('cart-overlay').classList.remove('hidden');
                    loadCartItems();
                }

                function closeCart() {
                    document.getElementById('cart-sidebar').classList.add('translate-x-full');
                    document.getElementById('cart-overlay').classList.add('hidden');
                }

                function loadCartItems() {
                    fetch('{{ route("vendeur.cart.view") }}')
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('cart-items-container').innerHTML = html;
                            updateCartTotal();
                        });
                }

                function updateCartCount(count) {
                    document.getElementById('cart-count').textContent = count;
                }

                function updateCartTotal() {
                    // This would be better implemented with actual data from the server
                    let total = 0;
                    document.querySelectorAll('.cart-item').forEach(item => {
                        const price = parseFloat(item.dataset.price);
                        const quantity = parseInt(item.querySelector('.item-quantity').value);
                        total += price * quantity;
                    });

                    document.getElementById('cart-total').textContent = `${total.toFixed(2)} Fcfa`;
                }



                function checkout() {
                    fetch('{{ route("vendeur.cart.checkout") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => {
                            if (response.redirected) {
                                window.location.href = response.url;
                            }
                        });
                }



                // Initialize cart count on page load
                document.addEventListener('DOMContentLoaded', function() {
                    fetch('{{ route("vendeur.cart.view") }}')
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const itemCount = doc.querySelectorAll('.cart-item').length;
                            updateCartCount(itemCount);
                        });
                });



            </script>

    @endsection
