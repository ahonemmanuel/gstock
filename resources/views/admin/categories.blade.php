@extends('layouts.admin')

@section('title', 'Tableau de bord des categories')
@section('entete', 'Tableau de bord ADMIN CATEGORIE')

@section('content')
    <!-- Modale de création de catégorie -->
    <div
        id="createCategoryModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
        x-data="{ iconClass: 'fas fa-box' }"
    >
        <div class="bg-white rounded-lg shadow p-6 w-full max-w-3xl relative">
            <h2 class="text-2xl font-bold mb-6">Créer une nouvelle catégorie</h2>

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Code</label>
                    <input type="text" name="code" id="code" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>

                <div class="mb-4">
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icône (choisissez une icône)</label>
                    <select
                        name="icon"
                        id="icon"
                        x-model="iconClass"
                        class="w-full px-3 py-2 border rounded-lg"
                        required
                    >
                        <option value="fas fa-box">Box <i class="fas fa-box"></i></option>
                        <option value="fas fa-car">Car <i class="fas fa-car"></i></option>
                        <option value="fas fa-heart">Heart <i class="fas fa-heart"></i></option>
                        <option value="fas fa-camera">Camera <i class="fas fa-camera"></i></option>
                        <option value="fas fa-coffee">Coffee <i class="fas fa-coffee"></i></option>
                        <!-- Ajoute d’autres icônes que tu veux proposer -->
                    </select>

                    <div class="mt-2">
                        <span>Aperçu : </span>
                        <i :class="iconClass" class="text-2xl"></i>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Couleur de fond (ex. #3B82F6)</label>
                    <input type="color" name="color" id="color" class="w-16 h-10 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="text_color" class="block text-sm font-medium text-gray-700 mb-1">Couleur du texte</label>
                    <input type="color" name="text_color" id="text_color" class="w-16 h-10 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" class="form-checkbox" value="1" checked>
                        <span class="ml-2 text-gray-700">Activer la catégorie</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg mr-2">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">Créer</button>
                </div>
            </form>

            <!-- Bouton de fermeture -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        </div>
    </div>


    <!-- Script JS -->
    <script>
        function openModal() {
            document.getElementById('createCategoryModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createCategoryModal').classList.add('hidden');
        }
    </script>













        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm font-medium text-gray-500">Total des catégories</p>
                <h3 class="text-2xl font-bold text-dark">{{ $total }}</h3>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm font-medium text-gray-500">Catégories actives</p>
                <h3 class="text-2xl font-bold text-dark">{{ $actives }}</h3>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm font-medium text-gray-500">Produits par catégorie (moy.)</p>
                <h3 class="text-2xl font-bold text-dark">{{ $averageProducts }}</h3>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm font-medium text-gray-500">Catégories sans produits</p>
                <h3 class="text-2xl font-bold text-dark">{{ $empty }}</h3>
            </div>
        </div>

        <!-- Tableau -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-dark">Liste des catégories</h3>
                    <p class="text-sm text-gray-500">{{ $categories->total() }} catégories trouvées</p>
                </div>
                <!-- Filtrage et export peuvent être implémentés ensuite -->
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Créé le</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-lg flex items-center justify-center" style="background-color: {{ $category->color }}">
                                        <i class="{{ $category->icon }} text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-dark">{{ $category->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $category->code }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $category->description }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->code }}</td>
                            <td class="px-6 py-4">
                                @if($category->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Active</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-danger bg-opacity-10 text-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <!-- Actions -->
                                <div class="relative inline-block text-left">
                                    <button type="button" class="action-menu-btn inline-flex justify-center w-8 h-8 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <!-- Menu déroulant -->
                                    <div class="action-menu hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-10">
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir les produits</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $category->is_active ? 'Désactiver' : 'Activer' }}</a>
                                            <form action="{{route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Aucune catégorie trouvée.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t">
                {{ $categories->links() }}
            </div>
        </div>




    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.action-menu-btn');

            buttons.forEach((btn) => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const currentMenu = this.nextElementSibling;

                    // Fermer tous les autres menus
                    document.querySelectorAll('.action-menu').forEach(menu => {
                        if (menu !== currentMenu) {
                            menu.classList.add('hidden');
                        }
                    });

                    // Toggle le menu actuel
                    currentMenu.classList.toggle('hidden');
                });
            });

            // Fermer le menu si on clique ailleurs
            window.addEventListener('click', function (e) {
                if (!e.target.closest('.action-menu-btn') && !e.target.closest('.action-menu')) {
                    document.querySelectorAll('.action-menu').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });
        });
    </script>







@endsection
