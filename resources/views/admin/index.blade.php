@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('entete', 'Tableau de bord ADMIN')

@section('content')
        <!-- Cartes de statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-primary">
                        <i class="fas fa-boxes text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Produits totaux</p>
                        <h3 class="text-2xl font-bold text-dark">1 254</h3>
                    </div>
                </div>
                <div class="mt-4">
                            <span class="text-xs font-medium text-success">
                                <i class="fas fa-arrow-up"></i> 5.2% depuis le mois dernier
                            </span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-success">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Ventes du jour</p>
                        <h3 class="text-2xl font-bold text-dark">3 425 €</h3>
                    </div>
                </div>
                <div class="mt-4">
                            <span class="text-xs font-medium text-success">
                                <i class="fas fa-arrow-up"></i> 12.7% depuis hier
                            </span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-warning">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Articles en stock faible</p>
                        <h3 class="text-2xl font-bold text-dark">24</h3>
                    </div>
                </div>
                <div class="mt-4">
                            <span class="text-xs font-medium text-danger">
                                <i class="fas fa-arrow-up"></i> 3 de plus que la semaine dernière
                            </span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-indigo-500">
                        <i class="fas fa-truck text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Réapprovisionnements en attente</p>
                        <h3 class="text-2xl font-bold text-dark">7</h3>
                    </div>
                </div>
                <div class="mt-4">
                            <span class="text-xs font-medium text-success">
                                <i class="fas fa-arrow-down"></i> 2 de moins que la semaine dernière
                            </span>
                </div>
            </div>
        </div>

        <!-- Ligne des graphiques -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
            <!-- Graphique des ventes -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-dark">Aperçu des ventes</h3>
                    <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option>7 derniers jours</option>
                        <option>30 derniers jours</option>
                        <option selected>90 derniers jours</option>
                    </select>
                </div>
                <div class="chart-container">
                    <!-- Le graphique sera rendu ici -->
                    <div class="flex items-center justify-center h-full bg-gray-50 rounded-lg">
                        <p class="text-gray-500">Le graphique des ventes apparaîtra ici</p>
                    </div>
                </div>
            </div>

            <!-- Graphique des stocks -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-dark">État des stocks</h3>
                    <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option selected>Par catégorie</option>
                        <option>Par fournisseur</option>
                    </select>
                </div>
                <div class="chart-container">
                    <!-- Le graphique sera rendu ici -->
                    <div class="flex items-center justify-center h-full bg-gray-50 rounded-lg">
                        <p class="text-gray-500">Le graphique des stocks apparaîtra ici</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activité récente et stock faible -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
            <!-- Activité récente -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h3 class="text-lg font-semibold text-dark">Activité récente</h3>
                </div>
                <div class="divide-y">
                    <div class="p-4 flex items-start">
                        <div class="p-2 rounded-full bg-blue-100 text-primary mr-3">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-dark">Nouvelle vente complétée</p>
                            <p class="text-xs text-gray-500">Commande #S-2023-0456 pour 125,00 €</p>
                            <p class="text-xs text-gray-400 mt-1">Il y a 2 minutes</p>
                        </div>
                    </div>
                    <div class="p-4 flex items-start">
                        <div class="p-2 rounded-full bg-green-100 text-success mr-3">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-dark">Réapprovisionnement reçu</p>
                            <p class="text-xs text-gray-500">Commande #R-2023-0123 de ABC Suppliers</p>
                            <p class="text-xs text-gray-400 mt-1">Il y a 1 heure</p>
                        </div>
                    </div>
                    <div class="p-4 flex items-start">
                        <div class="p-2 rounded-full bg-yellow-100 text-warning mr-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-dark">Alerte stock faible</p>
                            <p class="text-xs text-gray-500">Le produit "Casque sans fil" est en dessous du seuil minimum</p>
                            <p class="text-xs text-gray-400 mt-1">Il y a 3 heures</p>
                        </div>
                    </div>
                    <div class="p-4 flex items-start">
                        <div class="p-2 rounded-full bg-purple-100 text-indigo-500 mr-3">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-dark">Nouveau client ajouté</p>
                            <p class="text-xs text-gray-500">Jean Dupont (jean@exemple.fr)</p>
                            <p class="text-xs text-gray-400 mt-1">Hier</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t text-center">
                    <a href="#" class="text-primary text-sm font-medium">Voir toute l'activité</a>
                </div>
            </div>

            <!-- Articles en stock faible -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-dark">Articles en stock faible</h3>
                        <button class="text-primary text-sm font-medium">Voir tout</button>
                    </div>
                </div>
                <div class="divide-y">
                    <div class="p-4 flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg mr-3 flex items-center justify-center">
                            <i class="fas fa-box text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-dark">Casque sans fil</p>
                            <p class="text-xs text-gray-500">SKU: WH-2023-BLK</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-danger">2 restants</p>
                            <p class="text-xs text-gray-500">Min: 5</p>
                        </div>
                    </div>
                    <div class="p-4 flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg mr-3 flex items-center justify-center">
                            <i class="fas fa-box text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-dark">Haut-parleur Bluetooth</p>
                            <p class="text-xs text-gray-500">SKU: BS-2023-RED</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-danger">3 restants</p>
                            <p class="text-xs text-gray-500">Min: 10</p>
                        </div>
                    </div>
                    <div class="p-4 flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg mr-3 flex items-center justify-center">
                            <i class="fas fa-box text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-dark">Câble USB-C</p>
                            <p class="text-xs text-gray-500">SKU: UC-2023-1M</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-warning">5 restants</p>
                            <p class="text-xs text-gray-500">Min: 20</p>
                        </div>
                    </div>
                    <div class="p-4 flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg mr-3 flex items-center justify-center">
                            <i class="fas fa-box text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-dark">Montre connectée</p>
                            <p class="text-xs text-gray-500">SKU: SW-2023-PRO</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-warning">4 restants</p>
                            <p class="text-xs text-gray-500">Min: 8</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventes récentes -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b flex items-center justify-between">
                <h3 class="text-lg font-semibold text-dark">Ventes récentes</h3>
                <button class="text-primary text-sm font-medium">Voir toutes les ventes</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vente #</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">S-2023-0456</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jean Dupont</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aujourd'hui, 10:45</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">125,00 €</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Complétée</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-primary hover:text-primary-dark">Voir</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">S-2023-0455</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Marie Dubois</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aujourd'hui, 9:30</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">89,50 €</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Complétée</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-primary hover:text-primary-dark">Voir</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">S-2023-0454</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Michel Martin</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Hier, 16:15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">245,75 €</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">Complétée</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-primary hover:text-primary-dark">Voir</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">S-2023-0453</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sophie Bernard</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Hier, 14:00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">178,20 €</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-warning bg-opacity-10 text-warning">En attente</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-primary hover:text-primary-dark">Voir</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
@endsection
