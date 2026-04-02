<x-app-layout>
    <!-- Header Section -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-1000 leading-tight">
                    Suivi des Mouvements
                </h2>
                <p class="text-sm text-gray-400 mt-2 flex items-center gap-2">
                    <span class="inline-block h-2 w-2 rounded-full bg-cyan-500"></span>
                    Historique complet des entrées et sorties d'équipements
                </p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-200 font-medium">TOTAL MOUVEMENTS</p>
                <p class="text-2xl font-bold text-cyan-600 mt-1">{{ $totalMouvements ?? 0 }}</p>
            </div>
        </div>
    </x-slot>

    <!-- Main Content -->
    <div class="min-h-screen bg-gradient-to-br from-white via-cyan-50 to-sky-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Entrées -->
                <div class="bg-white rounded-xl border border-orange-200 shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Total Entrées</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalEntrees ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Équipements reçus</p>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-orange-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Sorties -->
                <div class="bg-white rounded-xl border border-teal-200 shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Total Sorties</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalSorties ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Équipements distribués</p>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-teal-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Mouvements Aujourd'hui -->
                <div class="bg-white rounded-xl border border-cyan-200 shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Aujourd'hui</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $mouvementsAujourdhui ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Mouvements enregistrés</p>
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-cyan-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-2 5H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-5">Filtres et Recherche</h3>

                <form method="GET" action="{{ route('movements.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <!-- Search -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase">Rechercher</label>
                            <div class="relative">
                                <input type="text" name="search" placeholder="Équipement, direction..."
                                    value="{{ request('search') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-sm outline-none transition" />
                                <svg class="absolute right-3 top-3.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Type Filter -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase">Type</label>
                            <select name="type" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-sm outline-none transition bg-white">
                                <option value="">Tous les types</option>
                                <option value="entree" {{ request('type') === 'entree' ? 'selected' : '' }}>Entrées</option>
                                <option value="sortie" {{ request('type') === 'sortie' ? 'selected' : '' }}>Sorties</option>
                            </select>
                        </div>

                        <!-- Direction Filter -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase">Direction</label>
                            <select name="direction" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-sm outline-none transition bg-white">
                                <option value="">Toutes directions</option>
                                @foreach($directions ?? [] as $dir)
                                <option value="{{ $dir }}" {{ request('direction') === $dir ? 'selected' : '' }}>{{ $dir }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date Range -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase">Période</label>
                            <select name="period" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-sm outline-none transition bg-white">
                                <option value="">Toutes les dates</option>
                                <option value="today" {{ request('period') === 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                                <option value="week" {{ request('period') === 'week' ? 'selected' : '' }}>Cette semaine</option>
                                <option value="month" {{ request('period') === 'month' ? 'selected' : '' }}>Ce mois</option>
                            </select>
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase">Catégorie</label>
                            <select name="category" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-sm outline-none transition bg-white">
                                <option value="">Toutes catégories</option>
                                @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-gray-200">
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-medium text-sm transition">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtrer
                        </button>
                        <a href="{{ route('movements.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium text-sm transition">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Réinitialiser
                        </a>
                    </div>

                    <!-- Active Filters -->
                    @php
                    $activeFilters = array_filter([
                    'search' => request('search'),
                    'type' => request('type'),
                    'direction' => request('direction'),
                    'period' => request('period'),
                    'category' => request('category')
                    ]);
                    @endphp

                    @if(count($activeFilters) > 0)
                    <div class="flex flex-wrap gap-2 pt-4">
                        @if(request('search'))
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-100 text-cyan-700 text-xs font-medium">
                            Recherche: {{ request('search') }}
                            <a href="{{ route('movements.index', array_filter(request()->query(), function($k) { return $k !== 'search'; }, ARRAY_FILTER_USE_KEY)) }}" class="hover:text-cyan-900">×</a>
                        </span>
                        @endif
                        @if(request('type'))
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-medium">
                            Type: {{ request('type') === 'entree' ? 'Entrée' : 'Sortie' }}
                            <a href="{{ route('movements.index', array_filter(request()->query(), function($k) { return $k !== 'type'; }, ARRAY_FILTER_USE_KEY)) }}" class="hover:text-orange-900">×</a>
                        </span>
                        @endif
                    </div>
                    @endif
                </form>
            </div>

            <!-- Main Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Table Header -->
                <div class="border-b border-gray-200 bg-gradient-to-r from-white to-gray-50 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Tous les Mouvements</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $mouvements->total() ?? 0 }} mouvements au total</p>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-cyan-300">
                            <span class="flex h-2 w-2 rounded-full bg-cyan-500">
                                <span class="animate-ping absolute h-2 w-2 rounded-full bg-cyan-500 opacity-75"></span>
                            </span>
                            <span class="text-xs font-semibold text-cyan-700">En direct</span>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    @forelse($mouvements as $mvt)
                    @if($loop->first)
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-8 py-4 text-left font-bold text-gray-700 uppercase tracking-wide text-xs">Date/Heure</th>
                                <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide text-xs">Équipement</th>
                                <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide text-xs">Catégorie</th>
                                <th class="px-6 py-4 text-center font-bold text-gray-700 uppercase tracking-wide text-xs">Type</th>
                                <th class="px-6 py-4 text-center font-bold text-gray-700 uppercase tracking-wide text-xs">Quantité</th>
                                <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide text-xs">Direction</th>
                                <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide text-xs">Responsable</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @endif

                            <tr class="hover:bg-cyan-50 transition-colors group">
                                <!-- Date/Heure -->
                                <td class="px-8 py-4 whitespace-nowrap">
                                    <div class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($mvt->date_mouvement)->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($mvt->date_mouvement)->format('H:i') }}</div>
                                </td>

                                <!-- Équipement -->
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-900">{{ $mvt->equipement?->designation ?? '—' }}</span>
                                </td>

                                <!-- Catégorie -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ $mvt->equipement?->categorie ?? '—' }}
                                    </span>
                                </td>

                                <!-- Type -->
                                <td class="px-6 py-4 text-center">
                                    @php($isEntree = $mvt->type === 'entree')
                                    <span class="inline-flex items-center gap-2 rounded-lg {{ $isEntree ? 'bg-orange-100' : 'bg-teal-100' }} px-3 py-1.5">
                                        <span class="h-2 w-2 rounded-full {{ $isEntree ? 'bg-orange-600' : 'bg-teal-600' }}"></span>
                                        <span class="text-xs font-bold uppercase {{ $isEntree ? 'text-orange-700' : 'text-teal-700' }}">
                                            {{ $isEntree ? 'Entrée' : 'Sortie' }}
                                        </span>
                                    </span>
                                </td>

                                <!-- Quantité -->
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-100 group-hover:bg-cyan-100 transition">
                                        <span class="font-bold text-gray-900">{{ $mvt->quantite }}</span>
                                    </div>
                                </td>

                                <!-- Direction -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700">{{ $mvt->direction_concernee ?? '—' }}</span>
                                </td>

                                <!-- Responsable -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white text-xs font-bold ring-2 ring-white">
                                            {{ substr($mvt->user?->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $mvt->user?->name ?? '—' }}</span>
                                    </div>
                                </td>
                            </tr>

                            @if($loop->last)
                        </tbody>
                    </table>
                    @endif
                    @empty
                    <div class="flex flex-col items-center justify-center px-8 py-20">
                        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Aucun mouvement trouvé</h3>
                        <p class="mt-2 text-sm text-gray-600">Essayez d&apos;ajuster vos filtres ou votre recherche</p>
                    </div>
                    @endforelse
                </div>

                <!-- Table Footer -->
                <div class="border-t border-gray-200 bg-gray-50 px-8 py-4 flex items-center justify-between">
                    <span class="text-sm text-gray-700">
                        Affichage: <span class="font-bold">{{ $mouvements->count() }}</span> sur <span class="font-bold">{{ $mouvements->total() }}</span>
                    </span>
                    <span class="text-xs text-gray-500">Dernière mise à jour: {{ now()->format('H:i:s') }}</span>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $mouvements->links('pagination::tailwind') }}
            </div>

        </div>
    </div>

</x-app-layout>