<nav x-data="{ open: false, userOpen: false }" class="sticky top-0 z-40 bg-gradient-to-r from-cyan-800 via-teal-800 to-cyan-800 border-b border-cyan-700 shadow-lg backdrop-blur-xl bg-opacity-95">
    <!-- Main Navigation Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Left Section: Logo & Navigation Links -->
            <div class="flex items-center gap-10">
                <!-- Logo -->
                <div class="shrink-0 flex items-center group">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity duration-200">
                        <img
                            src="{{ asset('storage/Logo/logo_epo.png') }}"
                            alt="Logo EPO"
                            class="block h-12 w-auto drop-shadow-md group-hover:drop-shadow-lg transition-all">
                        <div class="hidden sm:flex flex-col">
                            <span class="text-white font-bold text-sm">EPO</span>
                            <span class="text-cyan-200 text-xs font-medium">Stock Tracker</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center gap-1">
                    <!-- Dashboard Link -->
                    <a href="{{ route('dashboard') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('dashboard') ? 'text-white bg-cyan-600/30 border border-cyan-400/50' : 'text-cyan-100 hover:text-white hover:bg-cyan-700/50' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4l4 2m-4-2l-4-2" />
                            </svg>
                            <span>Tableau de Bord</span>
                        </div>
                        @if(request()->routeIs('dashboard'))
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-300 to-cyan-400 rounded-full"></div>
                        @endif
                    </a>

                    <!-- Equipements Link -->
                    <a href="{{ route('equipements.index') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('equipements.*') ? 'text-white bg-cyan-600/30 border border-cyan-400/50' : 'text-cyan-100 hover:text-white hover:bg-cyan-700/50' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <span>Équipements</span>
                        </div>
                        @if(request()->routeIs('equipements.*'))
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-300 to-cyan-400 rounded-full"></div>
                        @endif
                    </a>
                    <!-- Movements Link -->
                    <a href="{{ route('movements.index') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('movements.index') ? 'text-white bg-cyan-600/30 border border-cyan-400/50' : 'text-cyan-100 hover:text-white hover:bg-cyan-700/50' }}">
                        <div class="flex items-center gap-2">
                            <!-- <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg> -->
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20V7m0 13-4-4m4 4 4-4m4-12v13m0-13 4 4m-4-4-4 4" />
                            </svg>

                            <span>Movements</span>
                        </div>
                        @if(request()->routeIs('movements.index'))
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-300 to-cyan-400 rounded-full"></div>
                        @endif
                    </a>
                    <a href="{{ route('movements.create') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('movements.create') ? 'text-white bg-cyan-600/30 border border-cyan-400/50' : 'text-cyan-100 hover:text-white hover:bg-cyan-700/50' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Nouveau Mouvement</span>
                        </div>
                        @if(request()->routeIs('movements.create'))
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-300 to-cyan-400 rounded-full"></div>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Right Section: User Menu & Mobile Button -->
            <div class="flex items-center gap-4">
                <!-- Desktop User Dropdown -->
                <div class="hidden sm:block relative" @click.away="userOpen = false">
                    <button @click="userOpen = !userOpen" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-cyan-600 bg-cyan-700 hover:bg-cyan-600 text-white text-sm font-medium transition-all duration-300 hover:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-cyan-900 group">
                        <div class="h-7 w-7 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white text-xs font-bold ring-2 ring-cyan-700 group-hover:ring-orange-400">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg :class="{'rotate-180': userOpen}" class="w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </button>

                    <!-- User Dropdown Menu -->
                    <div x-show="userOpen" x-transition class="absolute right-0 mt-2 w-56 rounded-xl bg-white border border-cyan-200 shadow-2xl overflow-hidden z-50">
                        <!-- User Info Header -->
                        <div class="px-4 py-4 bg-gradient-to-r from-cyan-600 to-teal-600">
                            <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-blue-100 mt-1">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 transition-colors duration-200 flex items-center gap-3 group">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Paramètres du Profil</span>
                            </a>

                            <div class="border-t border-cyan-200 my-2"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200 flex items-center gap-3 group">
                                    <svg class="w-4 h-4 text-red-600 group-hover:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="lg:hidden inline-flex items-center justify-center p-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-200">
                    <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open}" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="{'block': open, 'hidden': !open}" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden lg:hidden bg-cyan-700 border-t border-cyan-600 backdrop-blur">
        <div class="px-4 py-4 space-y-2">
            <!-- Mobile Dashboard Link -->
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg text-base font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-cyan-600 text-white' : 'text-cyan-100 hover:bg-cyan-600 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4l4 2m-4-2l-4-2" />
                    </svg>
                    <span>Tableau de Bord</span>
                </div>
            </a>

            <!-- Mobile Equipements Link -->
            <a href="{{ route('equipements.index') }}" class="block px-4 py-3 rounded-lg text-base font-medium transition-all duration-200 {{ request()->routeIs('equipements.*') ? 'bg-cyan-600 text-white' : 'text-cyan-100 hover:bg-cyan-600 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <span>Équipements</span>
                </div>
            </a>

            <!-- Mobile Movements Link -->
            <a href="{{ route('movements.create') }}" class="block px-4 py-3 rounded-lg text-base font-medium transition-all duration-200 {{ request()->routeIs('movements.*') ? 'bg-cyan-600 text-white' : 'text-cyan-100 hover:bg-cyan-600 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Nouveau Mouvement</span>
                </div>
            </a>
        </div>

        <!-- Mobile User Section -->
        <div class="px-4 py-4 border-t border-cyan-600 space-y-3 bg-cyan-600/50">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white text-sm font-bold">
                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
                <div>
                    <div class="font-semibold text-white text-sm">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-cyan-100 hover:bg-cyan-500 hover:text-white transition-all duration-200">
                {{ __('Paramètres du Profil') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-red-300 hover:bg-red-600/50 hover:text-red-100 transition-all duration-200">
                    {{ __('Déconnexion') }}
                </button>
            </form>
        </div>
    </div>
</nav>