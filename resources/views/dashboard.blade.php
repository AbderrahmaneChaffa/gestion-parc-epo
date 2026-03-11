<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord — Gestion du stock DDN - EPO') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total des références</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalEquipements }}</p>
                    <p class="text-sm text-gray-500 mt-1">Catalogue global du parc</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Mouvements (aujourd'hui)</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalMouvementsAujourdhui }}</p>
                    <p class="text-sm text-gray-500 mt-1">Entrées et sorties enregistrées</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold">Derniers flux de matériel</h3>
                        <span class="text-sm text-gray-500">Suivi en temps réel</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-xs uppercase text-gray-600">
                                    <th class="p-3 border">Date</th>
                                    <th class="p-3 border">Matériel</th>
                                    <th class="p-3 border">Categorie</th>
                                    <th class="p-3 border">Type</th>
                                    <th class="p-3 border">Quantité</th>
                                    <th class="p-3 border">Pour</th>
                                    <th class="p-3 border">Par (support)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($derniersMouvements as $mvt)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border whitespace-nowrap">{{ $mvt->date_mouvement }}</td>
                                    <td class="p-3 border font-semibold">{{ $mvt->equipement?->designation ?? '-' }}</td>
                                    <td class="p-3 border font-semibold">{{ $mvt->equipement?->categorie ?? '-' }}</td>

                                    <td class="p-3 border">
                                        @php($isEntree = $mvt->type === 'entree')
                                        <span class="{{ $isEntree ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} px-2 py-1 rounded text-xs font-bold uppercase">
                                            {{ $isEntree ? 'Entrée' : 'Sortie' }}
                                        </span>
                                    </td>
                                    <td class="p-3 border font-bold">{{ $mvt->quantite }}</td>
                                    <td class="p-3 border">{{ $mvt->direction_concernee ?? '-' }}</td>
                                    <td class="p-3 border text-sm text-gray-600 italic">{{ $mvt->user?->name ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="p-6 border text-center text-gray-500" colspan="6">
                                        Aucun mouvement récent.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($alertesStock->isNotEmpty())

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let stocks = @json($alertesStock);

            let items = stocks.map(item =>
                `<li><b>${item.designation}</b> (reste : ${item.quantite_en_stock})</li>`
            ).join('');

            Swal.fire({
                title: 'Attention : stock critique',
                html: `<ul style="text-align:left">${items}</ul>`,
                icon: 'warning',
                confirmButtonText: 'Prendre note',
                confirmButtonColor: '#d33'
            });

        });
    </script>
    @endif
</x-app-layout>