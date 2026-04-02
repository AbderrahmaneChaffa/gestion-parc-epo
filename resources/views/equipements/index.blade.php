<x-app-layout>
    <!-- HEADER AVEC STATISTIQUES RAPIDES -->
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-1000 leading-tight">
                    Équipements Informatiques
                </h2>
                <p class="text-sm text-gray-400 mt-2">Gestion complète du parc IT du Port d'Oran</p>
            </div>
            <a href="{{ route('equipements.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-2.5 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Ajouter un Équipement
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- STATISTIQUES RAPIDES -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Total Équipements</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $equipements->total() }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-600">En Stock Bon</p>
                            <p class="text-3xl font-bold text-green-600 mt-2">{{ $enstockBon }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Stock Critique</p>
                            <p class="text-3xl font-bold text-red-600 mt-2" id="stock-critique-count">{{$enstockcritique}}</p>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-red-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M7.08 6.47L5.6 5M19.4 19l-1.48-1.48m0 0l-1.48-1.48m1.48 1.48L20.88 20" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Catégories</p>
                            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $equipements->groupBy('categorie')->count() }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-indigo-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ALERTE STOCK CRITIQUE -->
            @if($alertesStock->count() > 0)
            <div id="alert-stock" class="mb-8 p-5 rounded-lg border-l-4 border-red-500 bg-gradient-to-r from-red-50 to-orange-50 shadow-md animate-in fade-in">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-200">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M7.08 6.47L5.6 5" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-red-900">Alerte: Stock Critique</h3>
                        <p class="text-sm text-red-800 mt-1">{{ $alertesStock->count() }} équipements en quantité critique. Action recommandée.</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach($alertesStock as $item)
                            <span class="inline-flex items-center gap-2 bg-white px-3 py-1.5 rounded-full text-xs border border-red-200">
                                <span class="font-semibold text-gray-900">{{ $item->designation }}</span>
                                <span class="text-red-700 font-bold">{{ $item->quantite_en_stock }} unités</span>
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <button onclick="document.getElementById('alert-stock').remove()" class="flex-shrink-0 text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif

            <!-- TABLEAU PROFESSIONNEL -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">

                <!-- EN-TÊTE AVEC FILTRES -->
                <div class="border-b border-gray-100 bg-gradient-to-r from-slate-50 to-blue-50 px-6 py-6">
                    <div class="flex flex-col gap-6">
                        <!-- Titre et boutons -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Inventaire</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $equipements->total() }} équipements au total</p>
                            </div>
                            <div class="hidden sm:flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200">
                                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                <span class="text-xs font-semibold text-green-700">Données à jour</span>
                            </div>
                        </div>

                        <!-- BARRES DE RECHERCHE ET FILTRES -->
                        <form action="{{ route('equipements.index') }}" method="GET" class="space-y-4">
                            <!-- Ligne 1: Recherche principale -->
                            <div class="flex flex-col md:flex-row gap-3">
                                <div class="flex-1 relative">
                                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="Rechercher par désignation, référence..."
                                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>

                                <!-- Filtre catégorie -->
                                <select name="categorie" class="px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                                    <option value="">Toutes les catégories</option>

                                    @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('categorie') === $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                    @endforeach
                                </select>

                                <!-- Filtre stock -->

                                <!-- Boutons d'action -->
                                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Filtrer
                                </button>

                                @if($search || request('categorie') )
                                <a href="{{ route('equipements.index') }}" class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-lg font-semibold transition">
                                    Réinitialiser
                                </a>
                                @endif
                            </div>

                            <!-- Affichage des filtres actifs -->
                            @if($search || request('categorie'))
                            <div class="flex flex-wrap gap-2">
                                @if($search)
                                <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                    Recherche: "{{ $search }}"
                                    <a href="{{ route('equipements.index', array_merge(request()->query(), ['search' => null])) }}" class="hover:text-blue-900">×</a>
                                </span>
                                @endif
                                @if(request('categorie'))
                                <span class="inline-flex items-center gap-2 bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium">
                                    Catégorie: {{ request('categorie') }}
                                    <a href="{{ route('equipements.index', array_merge(request()->query(), ['categorie' => null])) }}" class="hover:text-purple-900">×</a>
                                </span>
                                @endif

                            </div>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- TABLEAU -->
                <div class="overflow-x-auto">
                    @forelse($equipements as $item)
                    @if($loop->first)
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">#</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Désignation</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Stock Actuel</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Seuil Alerte</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Responsable</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Mis à jour</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @endif

                            <tr class="hover:bg-blue-50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-gray-900">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-gray-900">{{ $item->designation }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">
                                        {{ $item->categorie }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                    $is_critical = $item->quantite_en_stock <= $item->seuil_alerte;
                                        @endphp
                                        <span class="inline-flex items-center rounded-full px-3 py-1.5 text-sm font-bold {{ $is_critical ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                            {{ $item->quantite_en_stock }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-xs font-mono text-gray-600">{{ $item->seuil_alerte }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($item->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-700">{{ $item->user->name ?? '—' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-xs text-gray-500">{{ $item->updated_at->diffForHumans() }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('equipements.edit', $item) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-xs font-semibold transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Éditer
                                        </a>
                                        <form action="{{ route('equipements.destroy', $item) }}" method="POST" onsubmit="return confirm('Supprimer ce matériel ?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-xs font-semibold transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @if($loop->last)
                        </tbody>
                    </table>
                    @endif
                    @empty
                    <div class="flex flex-col items-center justify-center px-6 py-20">
                        <div class="mb-6 h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Aucun équipement trouvé</h3>
                        <p class="text-sm text-gray-600 mt-2">Ajustez vos filtres ou ajoutez un nouvel équipement</p>
                    </div>
                    @endforelse
                </div>

                <!-- PIED DE PAGE -->
                <div class="border-t border-gray-100 bg-gray-50 px-6 py-4 flex items-center justify-between text-sm">
                    <span class="text-gray-600">
                        Affichage: <span class="font-bold text-gray-900">{{ $equipements->count() }}</span> / {{ $equipements->total() }}
                    </span>
                    <span class="text-xs text-gray-500">
                        Mis à jour: {{ now()->format('H:i:s') }}
                    </span>
                </div>

                <!-- PAGINATION -->
                <div class="border-t border-gray-100 px-6 py-6">
                    {{ $equipements->appends(['search' => $search, 'categorie' => request('categorie'), 'stock_status' => request('stock_status')])->links('pagination::tailwind') }}
                </div>
            </div>

        </div>
    </div>

</x-app-layout>