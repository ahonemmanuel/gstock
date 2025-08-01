@extends('layouts.vendeur')

@section('title', 'Tableau de bord des categories')
@section('entete', 'Tableau de bord ADMIN CATEGORIE')

@section('content')

    <!-- Dashboard Tab -->
    <div class="tab-content active p-6" id="dashboard-tab">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Paniers en cours</p>
                        <h3 class="text-2xl font-bold">5</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Ventes aujourd'hui</p>
                        <h3 class="text-2xl font-bold">12</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Nouveaux clients</p>
                        <h3 class="text-2xl font-bold">3</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Produits en stock bas</p>
                        <h3 class="text-2xl font-bold">7</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Derniers paniers préparés</h2>
                    <a href="#" class="text-blue-600 text-sm">Voir tout</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                        <tr class="text-left text-gray-500 text-sm border-b">
                            <th class="pb-2">N° Panier</th>
                            <th class="pb-2">Client</th>
                            <th class="pb-2">Date</th>
                            <th class="pb-2">Montant</th>
                            <th class="pb-2">Statut</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">#4587</td>
                            <td>Marie Lambert</td>
                            <td>10:45 Aujourd'hui</td>
                            <td>€124.50</td>
                            <td><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En attente</span></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">#4586</td>
                            <td>Pierre Dubois</td>
                            <td>09:30 Aujourd'hui</td>
                            <td>€89.99</td>
                            <td><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Finalisé</span></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">#4585</td>
                            <td>Client anonyme</td>
                            <td>Hier</td>
                            <td>€56.75</td>
                            <td><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Finalisé</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Produits populaires</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded mr-3 flex items-center justify-center">
                            <i class="fas fa-wine-bottle text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium">Vin rouge</p>
                            <p class="text-sm text-gray-500">5 ventes aujourd'hui</p>
                        </div>
                        <span class="text-blue-600 font-medium">€12.99</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded mr-3 flex items-center justify-center">
                            <i class="fas fa-cheese text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium">Fromage</p>
                            <p class="text-sm text-gray-500">4 ventes aujourd'hui</p>
                        </div>
                        <span class="text-blue-600 font-medium">€8.50</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded mr-3 flex items-center justify-center">
                            <i class="fas fa-bread-slice text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium">Pain artisanal</p>
                            <p class="text-sm text-gray-500">7 ventes aujourd'hui</p>
                        </div>
                        <span class="text-blue-600 font-medium">€3.20</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded mr-3 flex items-center justify-center">
                            <i class="fas fa-coffee text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium">Café bio</p>
                            <p class="text-sm text-gray-500">3 ventes aujourd'hui</p>
                        </div>
                        <span class="text-blue-600 font-medium">€6.90</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
