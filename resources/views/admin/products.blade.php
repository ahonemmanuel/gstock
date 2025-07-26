@extends('layouts.admin')

@section('title', 'admin gestion des produits')
@section('entete', 'Gestion des Produits')

@section('content')
    <!-- resources/views/products/create-modal.blade.php -->

    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow p-6 w-full max-w-3xl relative">
            <div class="flex justify-between items-center border-b pb-4">
                <h2 class="text-xl font-semibold">Ajouter un produit</h2>
                <button type="button" class="text-gray-500 hover:text-red-500" onclick="document.getElementById('productModal').classList.add('hidden')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Nom du produit *</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>
                    <div>
                        <label>SKU *</label>
                        <input type="text" name="sku" class="form-input" required>
                    </div>

                    <div>
                        <label>Catégorie *</label>
                        <select name="category_id" class="form-input" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Marque</label>
                        <input type="text" name="brand" class="form-input">
                    </div>

                    <div>
                        <label>Prix *</label>
                        <input type="number" name="price" step="0.01" class="form-input" required>
                    </div>

                    <div>
                        <label>Coût</label>
                        <input type="number" name="cost" step="0.01" class="form-input">
                    </div>

                    <div>
                        <label>Taxe</label>
                        <select name="tax_rate" class="form-input">
                            <option value="0">0%</option>
                            <option value="5.5">5.5%</option>
                            <option value="10" selected>10%</option>
                            <option value="20">20%</option>
                        </select>
                    </div>

                    <div>
                        <label>Quantité *</label>
                        <input type="number" name="quantity" class="form-input" required>
                    </div>

                    <div>
                        <label>Seuil d'alerte *</label>
                        <input type="number" name="alert_quantity" class="form-input" required>
                    </div>

                    <div>
                        <label>Unité</label>
                        <select name="unit" class="form-input">
                            <option value="pc">Pièce</option>
                            <option value="kg">Kilogramme</option>
                            <option value="g">Gramme</option>
                            <option value="l">Litre</option>
                            <option value="m">Mètre</option>
                        </select>
                    </div>

                    <div>
                        <label>Image</label>
                        <input type="file" name="image" accept="image/*" class="form-input">
                    </div>
                </div>

                <div class="mt-4">
                    <label>Description</label>
                    <textarea name="description" rows="3" class="form-input w-full"></textarea>
                </div>

                <div class="mt-4">
                    <label>Statut</label>
                    <div class="flex items-center gap-4 mt-1">
                        <label class="flex items-center">
                            <input type="radio" name="status" value="active" checked class="mr-1"> Actif
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="status" value="inactive" class="mr-1"> Inactif
                        </label>
                    </div>
                </div>

                <div class="flex justify-end mt-6 gap-2 border-t pt-4">
                    <button type="button" onclick="document.getElementById('productModal').classList.add('hidden')" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow p-6 w-full max-w-3xl relative">
            <div class="flex justify-between items-center border-b pb-4">
                <h2 class="text-xl font-semibold">Ajouter un produit</h2>
                <button type="button" class="text-gray-500 hover:text-red-500" onclick="document.getElementById('productModal').classList.add('hidden')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom du produit *</label>
                        <input type="text" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SKU *</label>
                        <input type="text" name="sku" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
                        <select name="category_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Sélectionner --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Marque</label>
                        <input type="text" name="brand"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix *</label>
                        <input type="number" name="price" step="0.01" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Coût</label>
                        <input type="number" name="cost" step="0.01"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Taxe</label>
                        <select name="tax_rate"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0">0%</option>
                            <option value="5.5">5.5%</option>
                            <option value="10" selected>10%</option>
                            <option value="20">20%</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantité *</label>
                        <input type="number" name="quantity" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seuil d'alerte *</label>
                        <input type="number" name="alert_quantity" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unité</label>
                        <select name="unit"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="pc">Pièce</option>
                            <option value="kg">Kilogramme</option>
                            <option value="g">Gramme</option>
                            <option value="l">Litre</option>
                            <option value="m">Mètre</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <div class="flex items-center gap-4 mt-1">
                        <label class="flex items-center">
                            <input type="radio" name="status" value="active" checked class="mr-1"> Actif
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="status" value="inactive" class="mr-1"> Inactif
                        </label>
                    </div>
                </div>

                <div class="flex justify-end mt-6 gap-2 border-t pt-4">
                    <button type="button" onclick="document.getElementById('productModal').classList.add('hidden')" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function openProductModal() {
            document.getElementById('productModal').classList.remove('hidden');
        }

        function closeProductModal() {
            document.getElementById('productModal').classList.add('hidden');
        }
    </script>






    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex items-center">
            <h2 class="text-lg font-semibold text-dark mr-4">Liste des produits</h2>
            <span class="text-sm text-gray-500">{{ $products->total() }} produits</span>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
            <button id="filterBtn" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                <i class="fas fa-filter mr-2"></i>
                <span>Filtrer</span>
            </button>
            <a href="{{ route('products.export') }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                <i class="fas fa-file-export mr-2"></i>
                <span>Exporter</span>
            </a>
            <button onclick="openProductModal()" class="flex items-center justify-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                <span>Ajouter un produit</span>
            </button>

        </div>
    </div>

    <!-- Tableau des produits -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/40' }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-dark">{{ $product->name }}</div>
                            <div class="text-xs text-gray-500">{{ $product->category->name ?? 'Non catégorisé' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->sku }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name ?? 'Non catégorisé' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->quantity }}</div>
                            <div class="text-xs {{ $product->quantity <= $product->alert_quantity ? ($product->quantity == 0 ? 'text-danger' : 'text-warning') : 'text-gray-500' }}">Min: {{ $product->alert_quantity }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($product->price, 2) }} €</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->quantity == 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-danger bg-opacity-10 text-danger">Rupture</span>
                            @elseif($product->quantity <= $product->alert_quantity)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-warning bg-opacity-10 text-warning">Stock faible</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Actif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-primary hover:text-primary-dark mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="text-danger hover:text-danger-dark delete-product" data-id="{{ $product->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $products->links() }}
        </div>
    </div>





    <div id="deleteModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog max-w-md" role="document">
            <div class="modal-content">
                <div class="modal-header p-4 border-b">
                    <h5 class="text-lg font-semibold text-dark">Confirmer la suppression</h5>
                    <button type="button" class="close text-gray-400 hover:text-gray-500" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-gray-700">Êtes-vous sûr de vouloir supprimer ce produit? Cette action est irréversible.</p>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteProductId" name="id">
                    </form>
                </div>
                <div class="modal-footer p-4 border-t flex justify-end">
                    <button type="button" class="mr-2 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" data-dismiss="modal">
                        Annuler
                    </button>
                    <button type="button" id="confirmDeleteBtn" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-danger hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-danger focus:border-transparent">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Gestion de la suppression
        document.querySelectorAll('.delete-product').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                document.getElementById('deleteProductId').value = productId;
                // Afficher le modal de suppression
                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                modal.show();
            });
        });

        // Confirmer la suppression
        document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
            const productId = document.getElementById('deleteProductId').value;
            fetch(`/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                });
        });
    </script>

@endsection



