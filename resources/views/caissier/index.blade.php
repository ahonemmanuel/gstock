@extends('layouts.caissier')

@section('title', 'Tableau de bord des categories')
@section('entete', 'Tableau de bord ADMIN CATEGORIE')

@section('content')

    <main class="p-6">
        <!-- Stats cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Ventes aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800">1,248 €</p>
                        <p class="text-green-500 text-sm flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> 12% vs hier
                        </p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Clients aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800">42</p>
                        <p class="text-green-500 text-sm flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> 8% vs hier
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Produits en alerte</p>
                        <p class="text-2xl font-bold text-gray-800">7</p>
                        <p class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> À réapprovisionner
                        </p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Objectif mensuel</p>
                        <p class="text-2xl font-bold text-gray-800">78%</p>
                        <p class="text-blue-500 text-sm flex items-center">
                            <i class="fas fa-chart-line mr-1"></i> 22,500/30,000 €
                        </p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-bullseye text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent sales and alerts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Recent sales -->
            <div class="bg-white rounded-lg shadow col-span-2">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Dernières ventes</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N°</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1254</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jean Dupont</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">89,50 €</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10:24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1253</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Marie Lambert</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">145,20 €</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">09:47</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1252</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Client anonyme</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">32,90 €</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">09:15</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1251</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Thomas Leroy</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">210,75 €</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">08:56</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1250</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sophie Bernard</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">56,30 €</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">08:32</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Stock alerts -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Alertes de stock</h2>
                </div>
                <div class="p-4 space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-red-100 p-2 rounded-full">
                            <i class="fas fa-box-open text-red-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Produit en rupture</p>
                            <p class="text-sm text-gray-500">Chaussures Nike Air Max - Taille 42</p>
                            <p class="text-xs text-red-500 mt-1">Stock: 0</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-yellow-100 p-2 rounded-full">
                            <i class="fas fa-exclamation text-yellow-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Stock critique</p>
                            <p class="text-sm text-gray-500">Sac à dos The North Face</p>
                            <p class="text-xs text-yellow-500 mt-1">Stock: 2 (seuil: 5)</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-yellow-100 p-2 rounded-full">
                            <i class="fas fa-exclamation text-yellow-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Stock critique</p>
                            <p class="text-sm text-gray-500">Veste Columbia pour homme</p>
                            <p class="text-xs text-yellow-500 mt-1">Stock: 3 (seuil: 5)</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Nouvelle commande</p>
                            <p class="text-sm text-gray-500">Commande #4562 en attente de réception</p>
                            <p class="text-xs text-blue-500 mt-1">Livraison prévue: 15/06</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t border-gray-200">
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        Voir toutes les alertes
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick actions and popular products -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Quick actions -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Actions rapides</h2>
                </div>
                <div class="p-4 grid grid-cols-2 gap-4">
                    <button class="bg-blue-100 hover:bg-blue-200 text-blue-800 py-3 px-4 rounded-lg flex flex-col items-center justify-center transition duration-150 ease-in-out">
                        <i class="fas fa-cash-register text-2xl mb-2"></i>
                        <span class="text-sm font-medium">Nouvelle vente</span>
                    </button>
                    <button class="bg-green-100 hover:bg-green-200 text-green-800 py-3 px-4 rounded-lg flex flex-col items-center justify-center transition duration-150 ease-in-out">
                        <i class="fas fa-user-plus text-2xl mb-2"></i>
                        <span class="text-sm font-medium">Nouveau client</span>
                    </button>
                    <button class="bg-purple-100 hover:bg-purple-200 text-purple-800 py-3 px-4 rounded-lg flex flex-col items-center justify-center transition duration-150 ease-in-out">
                        <i class="fas fa-boxes text-2xl mb-2"></i>
                        <span class="text-sm font-medium">Vérifier stock</span>
                    </button>
                    <button class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 py-3 px-4 rounded-lg flex flex-col items-center justify-center transition duration-150 ease-in-out">
                        <i class="fas fa-exchange-alt text-2xl mb-2"></i>
                        <span class="text-sm font-medium">Retour produit</span>
                    </button>
                </div>
            </div>

            <!-- Popular products -->
            <div class="bg-white rounded-lg shadow col-span-2">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Produits populaires</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                    <div class="product-card bg-white border border-gray-200 rounded-lg overflow-hidden transition duration-300 ease-in-out">
                        <img src="https://via.placeholder.com/300x200?text=Chaussures" alt="Product" class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="text-sm font-medium text-gray-900">Chaussures de running</h3>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm font-bold text-gray-800">89,99 €</span>
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">En stock</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-card bg-white border border-gray-200 rounded-lg overflow-hidden transition duration-300 ease-in-out">
                        <img src="https://via.placeholder.com/300x200?text=Sac" alt="Product" class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="text-sm font-medium text-gray-900">Sac à dos sport</h3>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm font-bold text-gray-800">45,50 €</span>
                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Stock bas</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-card bg-white border border-gray-200 rounded-lg overflow-hidden transition duration-300 ease-in-out">
                        <img src="https://via.placeholder.com/300x200?text=Veste" alt="Product" class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="text-sm font-medium text-gray-900">Veste imperméable</h3>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm font-bold text-gray-800">129,99 €</span>
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">En stock</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>


        // Product card hover effect
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
    </script>
@endsection
