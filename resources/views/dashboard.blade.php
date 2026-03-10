<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord - Gestion de Stock DDN - EPO') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total Références</p>
                    <p class="text-3xl font-bold">{{ $totalEquipements }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Mouvements (Aujourd'hui)</p>
                    <p class="text-3xl font-bold">{{ $totalMouvementsAujourdhui }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Derniers Flux de Matériel</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-sm uppercase">
                                <th class="p-3 border">Date</th>
                                <th class="p-3 border">Matériel</th>
                                <th class="p-3 border">Type</th>
                                <th class="p-3 border">Quantité</th>
                                <th class="p-3 border">Direction</th>
                                <th class="p-3 border">Par (Support)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($derniersMouvements as $mvt)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border">{{ $mvt->date_mouvement }}</td>
                                <td class="p-3 border font-semibold">{{ $mvt->equipment->designation }}</td>
                                <td class="p-3 border">
                                    <span class="{{ $mvt->type == 'entree' ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }} px-2 py-1 rounded text-xs font-bold uppercase">
                                        {{ $mvt->type }}
                                    </span>
                                </td>
                                <td class="p-3 border font-bold">{{ $mvt->quantite }}</td>
                                <td class="p-3 border">{{ $mvt->direction_concernee ?? '-' }}</td>
                                <td class="p-3 border text-sm text-gray-600 italic">{{ $mvt->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($alertesStock->isNotEmpty())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let items = "";
            @foreach($alertesStock as $item)
            items += "<li><b>{{ $item->designation }}</b> (Reste: {{ $item->quantite_en_stock }})</li>";
            @endforeach

            Swal.fire({
                title: 'Attention : Stock Critique !',
                html: '<ul class="text-left">' + items + '</ul>',
                icon: 'warning',
                confirmButtonText: 'Prendre note',
                confirmButtonColor: '#d33'
            });
        });
    </script>
    @endif
</x-app-layout>