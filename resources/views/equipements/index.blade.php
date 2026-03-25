<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Equipements</h2>
            <a href="{{ route('equipements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm">Ajouter un matériel</a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3 ">
                <form action="{{ route('equipements.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="Rechercher une désignation ou catégorie..."
                        class="w-full md:w-1/3 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                        Rechercher
                    </button>

                    @if($search)
                    <a href="{{ route('equipements.index') }}" class="bg-red-100 text-red-700 px-4 py-2 rounded-md hover:bg-red-200 transition">
                        Effacer
                    </a>
                    @endif
                </form>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- @if($alertesStock->isNotEmpty())
                <div id="alert-stock" class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-300" role="alert">

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 me-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 11h4m-2-7a9 9 0 110 18 9 9 0 010-18z" />
                            </svg>

                            <h3 class="font-semibold text-red-800">
                                ⚠ Stock critique détecté
                            </h3>
                        </div>

                        <button onclick="document.getElementById('alert-stock').remove()"
                            class="text-red-600 hover:text-red-900">
                            ✕
                        </button>
                    </div>

                    <div class="mt-3 mb-3">
                        Les équipements suivants sont presque en rupture :
                    </div>

                    <ul class="list-disc ml-6">
                        @foreach($alertesStock as $item)
                        <li>
                            <b>{{ $item->designation }}</b>
                            (reste : <span class="font-semibold text-red-700">{{ $item->quantite_en_stock }}</span>)
                        </li>
                        @endforeach
                    </ul>

                </div>
                @endif -->
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3">#</th>
                            <th class="p-3">Désignation</th>
                            <th class="p-3">Catégorie</th>
                            <th class="p-3 text-center">Stock Actuel</th>
                            <th class="p-3 text-center">Seuil Alerte</th>
                            <th class="p-3">Créé par</th>
                            <th class="p-3">Derniere mise a jour</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipements as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-bold">{{ $loop->iteration }}</td>
                            <td class="p-3 font-bold">{{ $item->designation }}</td>
                            <td class="p-3 text-sm text-gray-600">{{ $item->categorie }}</td>
                            <td class="p-3 text-center">
                                <span class="px-3 py-1 rounded-full text-sm {{ $item->quantite_en_stock <= $item->seuil_alerte ? 'bg-red-100 text-red-700 font-bold' : 'bg-green-100 text-green-700' }}">
                                    {{ $item->quantite_en_stock }}
                                </span>
                            </td>
                            <td class="p-3 text-center text-gray-500 font-mono">{{ $item->seuil_alerte }}</td>
                            <td class="p-3 text-xs italic">{{ $item->user->name }}</td>
                            <td class="p-3 text-xs text-gray-400">{{ $item->updated_at->diffForHumans() }}</td>
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

                <div class="mt-4">
                    {{ $equipements->appends(['search' => $search])->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>