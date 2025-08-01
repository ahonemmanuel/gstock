@php
    use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Route;
@endphp
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tableau de bord de gestion des stocks')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- FontAwesome CSS -->

    <!-- Toastify for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tes styles personnalisés ici -->
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
        /* Cart sidebar transition */
        #cart-sidebar {
            transition: transform 0.3s ease-in-out;
        }

        /* Cart overlay transition */
        #cart-overlay {
            transition: opacity 0.3s ease-in-out;
        }

        /* Quantity input arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }



        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar.collapsed .user-info {
            display: none;
        }

        .main-content {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 80px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar.collapsed {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0 !important;
            }
        }

        .chart-container {
            height: 300px;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-auto">
    <!-- Sidebar ici, inchangé -->
    <div class="sidebar bg-white w-64 shadow-lg flex flex-col h-full fixed">
        <!-- Logo -->
        <div class="p-4 flex items-center justify-between border-b">
            <div class="flex items-center">
                <i class="fas fa-boxes text-primary text-2xl mr-2"></i>
                <span class="logo-text text-xl font-bold text-dark">StockPro</span>
            </div>
            <button id="toggleSidebar" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Informations utilisateur -->
        @php
            $user = Auth::user();
        @endphp

        <div class="p-4 border-b user-info">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white">
                    <i class="fas fa-user"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-dark">{{ $user->name ?? 'Utilisateur' }}</p>
                    <p class="text-xs text-gray-500">{{ $user->role ?? 'Administrateur' }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto">
            <div class="p-2">
                <p class="text-xs uppercase text-gray-500 font-semibold px-3 py-2 sidebar-text">Principal</p>
                <a href="{{route('vendeur.dashboard')}}"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg
                     {{ Route::currentRouteName() === 'vendeur.dashboard' ? 'bg-primary text-primary bg-opacity-10' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span class="sidebar-text">Tableau de bord</span>
                </a>
            </div>

            <div class="p-2">
                <p class="text-xs uppercase text-gray-500 font-semibold px-3 py-2 sidebar-text">Gestion de la vente</p>
                <a href="{{route('vendeur.produits')}}"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg
                    {{ Route::currentRouteName() === 'vendeur.produits' ? 'bg-primary text-primary bg-opacity-10' : 'text-gray-700 hover:bg-gray-100' }}">

                    <i class="fas fa-tags mr-3"></i>
                    <span class="sidebar-text">Catalogue des produits </span>
                </a>
                <a href="{{route('stock-movements.index')}}"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-exchange-alt mr-3"></i>
                    <span class="sidebar-text">Mouvements de stock</span>
                </a>
                <a href="#"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <span class="sidebar-text">Stock faible</span>
                </a>
            </div>

            <div class="p-2">
                <p class="text-xs uppercase text-gray-500 font-semibold px-3 py-2 sidebar-text">Transactions</p>
                <a href="#"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    <span class="sidebar-text">Ventes</span>
                </a>
                <a href="#"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-truck mr-3"></i>
                    <span class="sidebar-text">Réapprovisionnement</span>
                </a>
            </div>

            <div class="p-2">
                <p class="text-xs uppercase text-gray-500 font-semibold px-3 py-2 sidebar-text">Gestion</p>
                <a href="#"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-users mr-3"></i>
                    <span class="sidebar-text">Clients</span>
                </a>
                <a href="#"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-industry mr-3"></i>
                    <span class="sidebar-text">Fournisseurs</span>
                </a>
            </div>

            <div class="p-2">
                <p class="text-xs uppercase text-gray-500 font-semibold px-3 py-2 sidebar-text">Rapports</p>
                <a href="#"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-chart-line mr-3"></i>
                    <span class="sidebar-text">Rapports de ventes</span>
                </a>
                <a href="#"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-chart-pie mr-3"></i>
                    <span class="sidebar-text">Rapports d'inventaire</span>
                </a>
            </div>
        </nav>

        <!-- Menu bas -->
        <div class="p-4 border-t">
            <a href="#"
               class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-cog mr-3"></i>
                <span class="sidebar-text">Paramètres</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="route('logout')"
                   onclick="event.preventDefault();
                                        this.closest('form').submit();"
                   class="flex items-center px-3 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span class="sidebar-text">Déconnexion</span>
                </a>
            </form>
        </div>
    </div>


    <!-- Contenu principal -->
    <div class="main-content flex-1 overflow-y-auto ml-64">
        <!-- En-tête mobile et desktop -->
        <div class="md:hidden bg-white shadow p-4 flex items-center justify-between">
            <button id="mobileToggleSidebar" class="text-gray-500">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-bold text-dark">@yield('entete')</h1>
            <div class="w-8"></div> <!-- Espacement pour l'alignement -->
        </div>
        <!-- ... (ton header mobile et desktop) -->
        <header class="bg-white shadow p-4 hidden md:block">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-dark">@yield('entete')</h1>
                <div class="flex items-center space-x-4">



                    <div class="relative">
                        <form method="GET" action="{{ route('vendeur.produits') }}" class="relative flex-1">
                            @csrf
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Rechercher un produit..."
                                   class="pl-10 pr-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </form>
                    </div>
                    @if (Route::currentRouteName() === 'categories.index')

                        <button onclick="openModal()" class="bg-primary text-white px-4 py-2 rounded-lg">+ Ajouter une
                            catégorie
                        </button>

                    @endif


                    <button class="p-2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- En-tête -->

        <!-- Contenu principal injecté -->
        <main class="p-4">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<!-- Scripts -->
<script>
    // Basculer la barre latérale
    const toggleSidebar = document.getElementById('toggleSidebar');
    const mobileToggleSidebar = document.getElementById('mobileToggleSidebar');
    const sidebar = document.querySelector('.sidebar');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });

    mobileToggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });

    // Fermer la barre latérale en cliquant à l'extérieur sur mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768 && !sidebar.contains(e.target) && e.target !== mobileToggleSidebar) {
            sidebar.classList.remove('show');
        }
    });

    // Simuler le chargement des données
    document.addEventListener('DOMContentLoaded', () => {
        // Ce serait remplacé par de véritables appels API dans une application réelle
        console.log('Tableau de bord chargé');
    });
</script>

</body>
</html>
