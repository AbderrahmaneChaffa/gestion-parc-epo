<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1e293b">

    <title>{{ config('app.name', 'Gestion de Stock - EPO') }}</title>

    <!-- Fonts: Geist Pro (Premium Professional Font) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=geist:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Logo & Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo/logo_epo.png') }}" type="image/png">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>

    @yield('content')
</head>

<body class="font-sans antialiased bg-gradient-to-br from-white via-cyan-50 to-sky-50 dark:from-slate-900 dark:via-cyan-900/20 dark:to-slate-800">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Header -->
        @isset($header)
        <header class="sticky top-16 z-30 bg-gradient-to-r from-white to-cyan-50/50 dark:from-slate-800 dark:to-cyan-900/20 border-b border-cyan-200/50 dark:border-slate-700 backdrop-blur-md bg-opacity-90 dark:bg-opacity-90 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-6">
                    {{ $header }}
                </div>
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer (Optional) -->
        <footer class="bg-gradient-to-r from-cyan-900 to-teal-900 border-t border-cyan-700 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <!-- Section Info -->
                    <div>
                        <h4 class="font-bold text-white mb-3 text-sm uppercase tracking-wide">À Propos</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Système de gestion de stock centralisé pour la traçabilité des équipements informatiques du Port d'Oran.
                        </p>
                    </div>

                    <!-- Section Links -->
                    <div>
                        <h4 class="font-bold text-white mb-3 text-sm uppercase tracking-wide">Navigation</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('dashboard') }}" class="text-cyan-300 hover:text-cyan-100 text-sm transition">Tableau de Bord</a></li>
                            <li><a href="{{ route('equipements.index') }}" class="text-cyan-300 hover:text-cyan-100 text-sm transition">Équipements</a></li>
                            <li><a href="{{ route('movements.create') }}" class="text-cyan-300 hover:text-cyan-100 text-sm transition">Nouveau Mouvement</a></li>
                        </ul>
                    </div>

                    <!-- Section Contact -->
                    <div>
                        <h4 class="font-bold text-white mb-3 text-sm uppercase tracking-wide">Direction</h4>
                        <p class="text-slate-400 text-sm">
                            Direction de Digitalisation et Numération<br>
                            Port d'Oran — Algérie
                        </p>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="border-t border-cyan-700 pt-6 flex items-center justify-between">
                    <p class="text-cyan-300 text-xs">© {{ now()->year }} Gestion de Stock EPO. Tous droits réservés.</p>
                    <p class="text-cyan-300 text-xs">Système de Traçabilité v1.0</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>