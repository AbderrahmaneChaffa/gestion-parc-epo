<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Equipements</h2>
            <a href="{{ route('equipements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm">Ajouter un matériel</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3">Désignation</th>
                            <th class="p-3">Catégorie</th>
                            <th class="p-3 text-center">Stock Actuel</th>
                            <th class="p-3 text-center">Seuil Alerte</th>
                            <th class="p-3">Créé par</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipements as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-bold">{{ $item->designation }}</td>
                            <td class="p-3 text-sm text-gray-600">{{ $item->categorie }}</td>
                            <td class="p-3 text-center">
                                <span class="px-3 py-1 rounded-full text-sm {{ $item->quantite_en_stock <= $item->seuil_alerte ? 'bg-red-100 text-red-700 font-bold' : 'bg-green-100 text-green-700' }}">
                                    {{ $item->quantite_en_stock }}
                                </span>
                            </td>
                            <td class="p-3 text-center text-gray-500 font-mono">{{ $item->seuil_alerte }}</td>
                            <td class="p-3 text-xs italic">{{ $item->user->name }}</td>
                            <td class="p-3 flex space-x-2">
                                <a href="{{ route('equipements.edit', $item) }}" class="text-blue-600 hover:underline">Modifier</a>
                                <form action="{{ route('equipements.destroy', $item) }}" method="POST" onsubmit="return confirm('Supprimer ce matériel ?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>