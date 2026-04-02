<x-app-layout>
    <!-- HEADER PROFESSIONNEL -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white leading-tight">
                    Tableau de Bord — Gestion du Stock
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 flex items-center gap-2">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                    Direction de Digitalisation et Numérisation — Port d'Oran
                </p>
            </div>
            <div class="text-right">
                <!-- <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">DONNÉES EN TEMPS RÉEL</p> -->
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">
                    {{ now()->timezone('Africa/Algiers')->format('H:i') }}
                </p>
                <p class="text-xs text-blue-600 dark:text-blue-200 mt-1">{{ now()->timezone('Africa/Algiers')->locale('fr_FR')->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    </x-slot>

    <!-- CONTENU PRINCIPAL -->
    <div class="min-h-screen bg-gradient-to-br from-white via-cyan-50 to-sky-50 dark:from-slate-900 dark:via-cyan-900/20 dark:to-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ALERTE STOCK CRITIQUE - DESIGN AMÉLIORÉ -->
            @if($alertesStock->isNotEmpty())
            <div id="alert-stock" class="mb-8 rounded-xl border border-red-200 dark:border-red-800 bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-950/40 dark:to-orange-950/40 p-6 shadow-lg backdrop-blur-sm animate-in fade-in slide-in-from-top">
                <div class="flex gap-5">
                    <!-- Icône d'alerte -->
                    <div class="flex-shrink-0">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-200 dark:bg-red-900/40">
                            <svg class="h-6 w-6 text-red-700 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4v2m0 4v2M7.08 6.47L5.6 5M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-900 dark:text-red-200">Alerte Stock Critique</h3>
                        <p class="mt-1 text-sm text-red-800 dark:text-red-300">
                            {{ $alertesStock->count() }} équipements en rupture imminente — Action recommandée
                        </p>
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($alertesStock as $item)
                            <div class="flex items-center justify-between rounded-lg bg-white dark:bg-slate-800 p-3 border border-red-100 dark:border-red-900/50">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $item->designation }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">{{ $item->categorie ?? 'N/A' }}</p>
                                </div>
                                <div class="ml-3 flex flex-col items-end">
                                    <p class="text-2xl font-bold text-red-700 dark:text-red-400">{{ $item->quantite_en_stock }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">unités</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bouton fermeture -->
                    <button onclick="document.getElementById('alert-stock').remove()" class="flex-shrink-0 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif

            <!-- KPI CARDS - 4 COLONNES RESPONSIVES -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <!-- KPI 1: Total Équipements -->
                <div class="group relative rounded-xl bg-white dark:bg-slate-800 p-6 shadow-md hover:shadow-xl dark:shadow-slate-900/50 transition-all duration-300 border border-cyan-200 dark:border-slate-700 overflow-hidden">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-cyan-100 dark:bg-cyan-900/20 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-cyan-100 dark:bg-cyan-900/40 group-hover:bg-cyan-200 dark:group-hover:bg-cyan-900/60 transition">
                                <svg class="h-6 w-6 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9-4v4m0 0v4m0-4h4m-4 0H9" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full bg-cyan-100 dark:bg-cyan-900/40 px-2 py-1 text-xs font-semibold text-cyan-700 dark:text-cyan-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"></span>
                                Principal
                            </span>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Total Références</p>
                        <p class="mt-3 text-4xl font-bold text-gray-900 dark:text-white">{{ $totalEquipements }}</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Catalogue complet du parc IT</p>
                        <div class="mt-4 h-1 w-full rounded-full bg-gray-200 dark:bg-slate-700 overflow-hidden">
                            <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-cyan-500 to-cyan-600"></div>
                        </div>
                    </div>
                </div>

                <!-- KPI 2: Mouvements Aujourd'hui -->
                <div class="group relative rounded-xl bg-white dark:bg-slate-800 p-6 shadow-md hover:shadow-xl dark:shadow-slate-900/50 transition-all duration-300 border border-gray-100 dark:border-slate-700 overflow-hidden">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-green-100 dark:bg-green-900/20 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/40 group-hover:bg-green-200 dark:group-hover:bg-green-900/60 transition">
                                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-7" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 dark:bg-green-900/40 px-2 py-1 text-xs font-semibold text-green-700 dark:text-green-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                Aujourd'hui
                            </span>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Mouvements</p>
                        <p class="mt-3 text-4xl font-bold text-gray-900 dark:text-white">{{ $totalMouvementsAujourdhui }}</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Entrées et sorties enregistrées</p>
                        <div class="mt-4 h-1 w-full rounded-full bg-gray-200 dark:bg-slate-700 overflow-hidden">
                            <div class="h-full w-1/2 rounded-full bg-gradient-to-r from-green-500 to-emerald-600"></div>
                        </div>
                    </div>
                </div>

                <!-- KPI 3: Entrées du Jour -->
                <div class="group relative rounded-xl bg-white dark:bg-slate-800 p-6 shadow-md hover:shadow-xl dark:shadow-slate-900/50 transition-all duration-300 border border-orange-200 dark:border-slate-700 overflow-hidden">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-orange-100 dark:bg-orange-900/20 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-orange-100 dark:bg-orange-900/40 group-hover:bg-orange-200 dark:group-hover:bg-orange-900/60 transition">
                                <svg class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full bg-orange-100 dark:bg-orange-900/40 px-2 py-1 text-xs font-semibold text-orange-700 dark:text-orange-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                Réception
                            </span>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Entrées (Jour)</p>
                        <p class="mt-3 text-4xl font-bold text-gray-900 dark:text-white">{{ $mouvementsEntree ?? 0 }}</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Réceptions confirmées</p>
                        <div class="mt-4 h-1 w-full rounded-full bg-gray-200 dark:bg-slate-700 overflow-hidden">
                            <div class="h-full w-2/3 rounded-full bg-gradient-to-r from-orange-500 to-amber-600"></div>
                        </div>
                    </div>
                </div>

                <!-- KPI 4: Sorties du Jour -->
                <div class="group relative rounded-xl bg-white dark:bg-slate-800 p-6 shadow-md hover:shadow-xl dark:shadow-slate-900/50 transition-all duration-300 border border-teal-200 dark:border-slate-700 overflow-hidden">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-teal-100 dark:bg-teal-900/20 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-teal-100 dark:bg-teal-900/40 group-hover:bg-teal-200 dark:group-hover:bg-teal-900/60 transition">
                                <svg class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full bg-teal-100 dark:bg-teal-900/40 px-2 py-1 text-xs font-semibold text-teal-700 dark:text-teal-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span>
                                Distribution
                            </span>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Sorties (Jour)</p>
                        <p class="mt-3 text-4xl font-bold text-gray-900 dark:text-white">{{ $mouvementsSortie ?? 0 }}</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Distributions confirmées</p>
                        <div class="mt-4 h-1 w-full rounded-full bg-gray-200 dark:bg-slate-700 overflow-hidden">
                            <div class="h-full w-1/3 rounded-full bg-gradient-to-r from-teal-500 to-cyan-600"></div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TABLEAU DES MOUVEMENTS PROFESSIONNEL -->
            <div class="rounded-xl bg-white dark:bg-slate-800 shadow-lg dark:shadow-slate-900/50 overflow-hidden border border-cyan-200 dark:border-slate-700">

                <!-- EN-TÊTE TABLEAU -->
                <div class="border-b border-cyan-200 dark:border-slate-700 bg-gradient-to-r from-white to-cyan-50 dark:from-slate-900 dark:to-cyan-900/20 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <!-- <h3 class="text-xl font-bold text-gray-900 dark:text-white">Suivi en Temps Réel</h3> -->
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Historique des mouvements d'équipements informatiques</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="hidden sm:flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-slate-800 border border-cyan-300 dark:border-cyan-700">
                                <span class="flex h-2.5 w-2.5 items-center justify-center rounded-full bg-cyan-500">
                                    <span class="h-full w-full animate-pulse rounded-full bg-cyan-500"></span>
                                </span>
                                <!-- <span class="text-xs font-semibold text-cyan-700 dark:text-cyan-300">Temps Réel</span> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONTENU TABLEAU -->
                <div class="overflow-x-auto">
                    @forelse($derniersMouvements as $mvt)
                    @if($loop->first)
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/50">
                                <th class="px-8 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Date/Heure</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Équipement</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Catégorie</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Type</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Quantité</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Direction</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Responsable</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                            @endif

                            <tr class="hover:bg-blue-50 dark:hover:bg-slate-700/50 transition-colors group">
                                <!-- Date/Heure -->
                                <td class="px-8 py-4 whitespace-nowrap text-sm">
                                    <div class="font-semibold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($mvt->date_mouvement)->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($mvt->date_mouvement)->format('H:i') }}</div>
                                </td>

                                <!-- Équipement -->
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $mvt->equipement?->designation ?? '—' }}</span>
                                </td>

                                <!-- Catégorie -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-blue-100 dark:bg-blue-900/40 px-3 py-1 text-xs font-semibold text-blue-700 dark:text-blue-300">
                                        {{ $mvt->equipement?->categorie ?? '—' }}
                                    </span>
                                </td>

                                <!-- Type -->
                                <td class="px-6 py-4 text-center">
                                    @php($isEntree = $mvt->type === 'entree')
                                    <span class="inline-flex items-center gap-2 rounded-lg {{ $isEntree ? 'bg-emerald-100 dark:bg-emerald-900/40' : 'bg-red-100 dark:bg-red-900/40' }} px-3 py-1.5">
                                        <span class="h-2 w-2 rounded-full {{ $isEntree ? 'bg-emerald-600 dark:bg-emerald-400' : 'bg-red-600 dark:bg-red-400' }}"></span>
                                        <span class="text-xs font-bold uppercase {{ $isEntree ? 'text-emerald-700 dark:text-emerald-300' : 'text-red-700 dark:text-red-300' }}">
                                            {{ $isEntree ? 'Entrée' : 'Sortie' }}
                                        </span>
                                    </span>
                                </td>

                                <!-- Quantité -->
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-gray-100 dark:bg-slate-700 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/40 transition">
                                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $mvt->quantite }}</span>
                                    </div>
                                </td>

                                <!-- Direction -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $mvt->direction_concernee ?? '—' }}</span>
                                </td>

                                <!-- Responsable -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center text-white text-xs font-bold ring-2 ring-white dark:ring-slate-800">
                                            {{ substr($mvt->user?->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $mvt->user?->name ?? '—' }}</span>
                                    </div>
                                </td>
                            </tr>

                            @if($loop->last)
                        </tbody>
                    </table>
                    @endif
                    @empty
                    <div class="flex flex-col items-center justify-center px-8 py-20">
                        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 dark:bg-slate-700">
                            <svg class="h-10 w-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aucun mouvement récent</h3>
                        <!-- <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Les mouvements d'équipements apparaîtront ici en temps réel</p> -->
                    </div>
                    @endforelse
                </div>

                <!-- PIED DE PAGE TABLEAU -->
                <div class="border-t border-cyan-200 dark:border-slate-700 bg-cyan-50 dark:bg-slate-900/50 px-8 py-4 flex items-center justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400">
                        Total affichés: <span class="font-bold text-gray-900 dark:text-gray-100">{{ count($derniersMouvements ?? []) }}</span> mouvements
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        Dernière synchronisation: {{ now()->timezone('Africa/Algiers')->format('H:i:s') }}
                    </span>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>