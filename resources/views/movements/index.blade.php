<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Historique des Entrées / Sorties</h2>
            <a href="{{ route('movements.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-bold">Enregistrer un Flux</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 uppercase text-xs font-bold text-gray-600 border-b">
                            <th class="p-4">Date</th>
                            <th class="p-4">Matériel</th>
                            <th class="p-4">Type</th>
                            <th class="p-4">Qté</th>
                            <th class="p-4">Bénéficiaire (Direction)</th>
                            <th class="p-4">Support (Auteur)</th>
                            <th class="p-4">Référence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movements as $mvt)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4 text-sm">{{ \Carbon\Carbon::parse($mvt->date_mouvement)->format('d/m/Y') }}</td>
                            <td class="p-4 font-semibold">{{ $mvt->equipment->designation }}</td>
                            <td class="p-4 text-xs font-bold uppercase">
                                <span class="{{ $mvt->type == 'entree' ? 'text-green-700 bg-green-50' : 'text-red-700 bg-red-50' }} px-2 py-1 rounded">
                                    {{ $mvt->type }}
                                </span>
                            </td>
                            <td class="p-4 font-bold">{{ $mvt->quantite }}</td>
                            <td class="p-4 text-gray-600">{{ $mvt->direction_concernee ?? 'N/A' }}</td>
                            <td class="p-4 italic text-sm text-indigo-600">{{ $mvt->user->name }}</td>
                            <td class="p-4 text-gray-400 text-xs">{{ $mvt->motif_ou_reference }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>