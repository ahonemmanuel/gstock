@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('entete', 'Tableau de bord ADMIN')

@section('content')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#6B7280',
                        success: '#10B981',
                        danger: '#EF4444',
                        warning: '#F59E0B',
                        info: '#3B82F6',
                        dark: '#1F2937',
                    }
                }
            }
        }
    </script>
    <style>
        .modal {
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateY(-20px);
            opacity: 0;
            pointer-events: none;
        }
        .modal.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }
        .dropdown-menu {
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
        }
        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
    </style>


        <!-- Zone de contenu principal -->

            <!-- Filtres et statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm font-medium text-gray-500">Total des catégories</p>
                    <h3 class="text-2xl font-bold text-dark">24</h3>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm font-medium text-gray-500">Catégories actives</p>
                    <h3 class="text-2xl font-bold text-dark">18</h3>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm font-medium text-gray-500">Produits par catégorie (moy.)</p>
                    <h3 class="text-2xl font-bold text-dark">52</h3>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm font-medium text-gray-500">Catégories sans produits</p>
                    <h3 class="text-2xl font-bold text-dark">2</h3>
                </div>
            </div>

            <!-- Tableau des catégories -->
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="p-4 border-b flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-dark">Liste des catégories</h3>
                        <p class="text-sm text-gray-500">24 catégories trouvées</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="relative">
                            <button id="filterDropdownBtn" class="flex items-center px-3 py-2 border rounded-lg text-sm focus:outline-none">
                                <i class="fas fa-filter mr-2 text-gray-500"></i>
                                <span>Filtrer</span>
                            </button>
                            <div id="filterDropdown" class="dropdown-menu absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg z-10 border">
                                <div class="p-3">
                                    <p class="text-xs font-semibold text-gray-500 mb-2">STATUT</p>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                            <span class="ml-2 text-sm">Actives</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                            <span class="ml-2 text-sm">Inactives</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-3 border-t">
                                    <p class="text-xs font-semibold text-gray-500 mb-2">TRIER PAR</p>
                                    <select class="w-full border rounded-lg px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                                        <option>Nom (A-Z)</option>
                                        <option>Nom (Z-A)</option>
                                        <option>Nombre de produits (croissant)</option>
                                        <option>Nombre de produits (décroissant)</option>
                                        <option>Date de création (récent)</option>
                                        <option>Date de création (ancien)</option>
                                    </select>
                                </div>
                                <div class="p-3 border-t flex justify-between">
                                    <button class="text-sm text-gray-500 hover:text-gray-700">Réinitialiser</button>
                                    <button class="text-sm text-white bg-primary px-3 py-1 rounded-lg">Appliquer</button>
                                </div>
                            </div>
                        </div>
                        <button class="p-2 text-gray-500 hover:text-gray-700 border rounded-lg">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produits</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Créé le</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-laptop text-blue-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-dark">Électronique</div>
                                        <div class="text-xs text-gray-500">ELEC</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Appareils électroniques et gadgets technologiques</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">142</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Active</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/03/2022</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="action-menu-btn inline-flex justify-center w-8 h-8 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                        <div class="py-1">
                                            <a href="#" class="edit-category block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir les produits</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Désactiver</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-home text-green-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-dark">Maison</div>
                                        <div class="text-xs text-gray-500">HOME</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Meubles et articles de décoration pour la maison</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">87</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Active</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22/04/2022</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="action-menu-btn inline-flex justify-center w-8 h-8 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                        <div class="py-1">
                                            <a href="#" class="edit-category block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir les produits</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Désactiver</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-tshirt text-yellow-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-dark">Vêtements</div>
                                        <div class="text-xs text-gray-500">CLOTH</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Vêtements pour hommes, femmes et enfants</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">156</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Active</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/05/2022</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="action-menu-btn inline-flex justify-center w-8 h-8 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                        <div class="py-1">
                                            <a href="#" class="edit-category block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir les produits</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Désactiver</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-utensils text-red-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-dark">Cuisine</div>
                                        <div class="text-xs text-gray-500">KITCH</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Ustensiles et appareils de cuisine</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">73</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-danger bg-opacity-10 text-danger">Inactive</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05/06/2022</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="action-menu-btn inline-flex justify-center w-8 h-8 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                        <div class="py-1">
                                            <a href="#" class="edit-category block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir les produits</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Activer</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-book text-purple-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-dark">Livres</div>
                                        <div class="text-xs text-gray-500">BOOK</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Livres de tous genres et formats</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary bg-opacity-10 text-secondary">Vide</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18/07/2022</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="action-menu-btn inline-flex justify-center w-8 h-8 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                        <div class="py-1">
                                            <a href="#" class="edit-category block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir les produits</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Désactiver</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">5</span> sur <span class="font-medium">24</span> catégories
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border rounded-lg text-sm disabled:opacity-50" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 border rounded-lg text-sm bg-primary text-white">1</button>
                        <button class="px-3 py-1 border rounded-lg text-sm hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border rounded-lg text-sm hover:bg-gray-100">3</button>
                        <button class="px-3 py-1 border rounded-lg text-sm hover:bg-gray-100">4</button>
                        <button class="px-3 py-1 border rounded-lg text-sm hover:bg-gray-100">5</button>
                        <button class="px-3 py-1 border rounded-lg text-sm hover:bg-gray-100">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>



    <!-- Modal Ajouter/Modifier Catégorie -->
    <div id="categoryModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-4 border-b flex items-center justify-between">
                <h3 class="text-lg font-semibold text-dark" id="modalTitle">Ajouter une catégorie</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="categoryForm" class="p-4">
                <div class="mb-4">
                    <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie</label>
                    <input type="text" id="categoryName" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Ex: Électronique" required>
                </div>
                <div class="mb-4">
                    <label for="categoryCode" class="block text-sm font-medium text-gray-700 mb-1">Code</label>
                    <input type="text" id="categoryCode" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Ex: ELEC" required>
                </div>
                <div class="mb-4">
                    <label for="categoryIcon" class="block text-sm font-medium text-gray-700 mb-1">Icône</label>
                    <div class="grid grid-cols-5 gap-2">
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-laptop">
                            <i class="fas fa-laptop text-blue-500"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-home">
                            <i class="fas fa-home text-green-500"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-tshirt">
                            <i class="fas fa-tshirt text-yellow-500"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-utensils">
                            <i class="fas fa-utensils text-red-500"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-book">
                            <i class="fas fa-book text-purple-500"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-mobile">
                            <i class="fas fa-mobile text-blue-400"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-headphones">
                            <i class="fas fa-headphones text-gray-500"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-gamepad">
                            <i class="fas fa-gamepad text-indigo-500"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-car">
                            <i class="fas fa-car text-gray-700"></i>
                        </button>
                        <button type="button" class="icon-btn p-2 border rounded-lg hover:bg-gray-100" data-icon="fas fa-bicycle">
                            <i class="fas fa-bicycle text-green-600"></i>
                        </button>
                    </div>
                    <input type="hidden" id="selectedIcon" value="fas fa-laptop">
                </div>
                <div class="mb-4">
                    <label for="categoryColor" class="block text-sm font-medium text-gray-700 mb-1">Couleur</label>
                    <div class="grid grid-cols-5 gap-2">
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-blue-100" data-color="bg-blue-100" data-text="text-blue-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-green-100" data-color="bg-green-100" data-text="text-green-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-yellow-100" data-color="bg-yellow-100" data-text="text-yellow-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-red-100" data-color="bg-red-100" data-text="text-red-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-purple-100" data-color="bg-purple-100" data-text="text-purple-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-pink-100" data-color="bg-pink-100" data-text="text-pink-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-indigo-100" data-color="bg-indigo-100" data-text="text-indigo-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-gray-100" data-color="bg-gray-100" data-text="text-gray-500"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-blue-200" data-color="bg-blue-200" data-text="text-blue-600"></button>
                        <button type="button" class="color-btn p-2 border rounded-lg hover:bg-gray-100 bg-green-200" data-color="bg-green-200" data-text="text-green-600"></button>
                    </div>
                    <input type="hidden" id="selectedColor" value="bg-blue-100">
                    <input type="hidden" id="selectedTextColor" value="text-blue-500">
                </div>
                <div class="mb-4">
                    <label for="categoryDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="categoryDescription" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Description de la catégorie..."></textarea>
                </div>
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" id="categoryStatus" class="rounded text-primary focus:ring-primary" checked>
                        <span class="ml-2 text-sm text-gray-700">Catégorie active</span>
                    </label>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" id="cancelModal" class="px-4 py-2 border rounded-lg text-sm font-medium hover:bg-gray-50">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold text-dark">Confirmer la suppression</h3>
            </div>
            <div class="p-4">
                <p class="text-gray-700 mb-4">Êtes-vous sûr de vouloir supprimer cette catégorie? Cette action est irréversible.</p>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" id="cancelDelete" class="px-4 py-2 border rounded-lg text-sm font-medium hover:bg-gray-50">Annuler</button>
                    <button type="button" id="confirmDelete" class="px-4 py-2 bg-danger text-white rounded-lg text-sm font-medium hover:bg-danger-dark">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Gestion des menus d'actions
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des menus déroulants d'actions
            const actionButtons = document.querySelectorAll('.action-menu-btn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const menu = this.nextElementSibling;
                    document.querySelectorAll('.action-menu').forEach(m => {
                        if (m !== menu) m.classList.add('hidden');
                    });
                    menu.classList.toggle('hidden');
                });
            });

            // Fermer les menus quand on clique ailleurs
            document.addEventListener('click', function() {
                document.querySelectorAll('.action-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            });

            // Gestion du menu déroulant de filtre
            const filterDropdownBtn = document.getElementById('filterDropdownBtn');
            const filterDropdown = document.getElementById('filterDropdown');

            filterDropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                filterDropdown.classList.toggle('show');
            });

            // Fermer le menu déroulant de filtre quand on clique ailleurs
            document.addEventListener('click', function() {
                filterDropdown.classList.remove('show');
            });

            // Gestion de la modal
            const addCategoryBtn = document.getElementById('addCategoryBtn');
            const categoryModal = document.getElementById('categoryModal');
            const closeModal = document.getElementById('closeModal');
            const cancelModal = document.getElementById('cancelModal');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const confirmDelete = document.getElementById('confirmDelete');
            const modalTitle = document.getElementById('modalTitle');
            const categoryForm = document.getElementById('categoryForm');

            // Ouvrir modal pour ajouter
            addCategoryBtn.addEventListener('click', function() {
                modalTitle.textContent = 'Ajouter une catégorie';
                categoryForm.reset();
                document.getElementById('selectedIcon').value = 'fas fa-laptop';
                document.getElementById('selectedColor').value = 'bg-blue-100';
                document.getElementById('selectedTextColor').value = 'text-blue-500';
                categoryModal.classList.add('active');
            });

            // Ouvrir modal pour modifier
            const editButtons = document.querySelectorAll('.edit-category');
            editButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    modalTitle.textContent = 'Modifier la catégorie';

                    // Remplir le formulaire avec les données de la ligne (simulation)
                    const row = this.closest('tr');
                    const name = row.querySelector('td:nth-child(1) .text-sm').textContent;
                    const code = row.querySelector('td:nth-child(1) .text-xs').textContent;
                    const description = row.querySelector('td:nth-child(2)').textContent;
                    const isActive = !row.querySelector('td:nth-child(4) span').textContent.includes('Inactive');

                    document.getElementById('categoryName').value = name;
                    document.getElementById('categoryCode').value = code;
                    document.getElementById('categoryDescription').value = description;
                    document.getElementById('categoryStatus').checked = isActive;

                    // Simuler la sélection de l'icône et de la couleur
                    const iconContainer = row.querySelector('td:nth-child(1) div.flex-shrink-0');
                    const iconClass = iconContainer.querySelector('i').className.split(' ').filter(c => c.startsWith('fa-'))[0];
                    const iconColor = iconContainer.querySelector('i').className.split(' ').filter(c => c.startsWith('text-') && !c.startsWith('fa-'))[0];
                    const bgColor = iconContainer.className.split(' ').filter(c => c.startsWith('bg-') && !c.startsWith('flex-'))[0];

                    document.getElementById('selectedIcon').value = `fas ${iconClass}`;
                    document.getElementById('selectedColor').value = bgColor;
                    document.getElementById('selectedTextColor').value = iconColor;

                    categoryModal.classList.add('active');
                });
            });

            // Sélection d'icône
            const iconButtons = document.querySelectorAll('.icon-btn');
            iconButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('selectedIcon').value = this.dataset.icon;
                });
            });

            // Sélection de couleur
            const colorButtons = document.querySelectorAll('.color-btn');
            colorButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('selectedColor').value = this.dataset.color;
                    document.getElementById('selectedTextColor').value = this.dataset.text;
                });
            });

            // Fermer modal
            function closeCategoryModal() {
                categoryModal.classList.remove('active');
            }

            closeModal.addEventListener('click', closeCategoryModal);
            cancelModal.addEventListener('click', closeCategoryModal);

            // Gestion de la soumission du formulaire
            categoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Ici, vous ajouteriez le code pour sauvegarder la catégorie
                alert('Catégorie enregistrée avec succès!');
                closeCategoryModal();
            });

            // Gestion de la modal de suppression
            document.querySelectorAll('.action-menu a.text-red-600').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    deleteModal.classList.add('active');
                });
            });

            function closeDeleteModal() {
                deleteModal.classList.remove('active');
            }

            cancelDelete.addEventListener('click', closeDeleteModal);
            confirmDelete.addEventListener('click', function() {
                // Ici, vous ajouteriez le code pour supprimer la catégorie
                alert('Catégorie supprimée avec succès!');
                closeDeleteModal();
            });
        });
    </script>
@endsection
