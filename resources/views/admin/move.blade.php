@extends('layouts.admin')

@section('title', 'Tableau de bord des mouvements')
@section('entete', 'Tableau de bord ADMIN pour les mouvements')

@section('content')

        <!-- Copier le contenu HTML fourni ici -->
        <!-- Remplacer les parties statiques par du code dynamique -->

        <!-- Exemple de remplacement pour le tableau -->
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($movements as $movement)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">{{ $movement->reference }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $movement->movement_date->format('Y-m-d H:i') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <div class="flex items-center">
                        <i class="fas {{ $movement->type_icon }} mr-2 {{ $movement->type_color }}"></i>
                        {{ ucfirst($movement->type) }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $movement->product->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $movement->type_color }}">{{ $movement->display_quantity }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @if($movement->type === 'transfert')
                        {{ $movement->source_location }} → {{ $movement->destination_location }}
                    @else
                        {{ $movement->source_location ?? $movement->destination_location }}
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $movement->responsible }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <form action="{{ route('stock-movements.destroy', $movement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-danger hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

        <!-- Pagination -->
        <div class="p-4 border-t flex items-center justify-between">
            <div class="text-sm text-gray-500">
                Affichage de {{ $movements->firstItem() }} à {{ $movements->lastItem() }} sur {{ $movements->total() }} entrées
            </div>
            <div class="flex space-x-2">
                {{ $movements->links() }}
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            // Scripts JavaScript adaptés
            // Utiliser des variables Blade pour les URLs
            const storeUrl = "{{ route('stock-movements.store') }}";
            const csrfToken = "{{ csrf_token() }}";

            // Le reste du script avec des modifications pour l'ajout dynamique
        </script>
@endsection
