<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Enregistrer une Entrée ou Sortie</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('movements.store') }}" method="POST" id="mvtForm">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="equipement_id" value="Matériel concerné" />
                            <select name="equipement_id" id="equipement_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required>
                                <option value="">-- Choisir un équipement --</option>
                                @foreach($equipements as $item)
                                <option value="{{ $item->id }}" data-stock="{{ $item->quantite_en_stock }}" {{ old('equipement_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->designation }} (En stock : {{ $item->quantite_en_stock }})
                                </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('equipement_id')" class="mt-2" />
                        </div>

                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="type" value="entree" class="hidden peer" {{ old('type', 'entree') == 'entree' ? 'checked' : '' }}>
                                <div class="p-4 border-2 rounded-lg text-center font-bold uppercase transition peer-checked:border-green-600 peer-checked:bg-green-50 peer-checked:text-green-700 border-gray-200 text-gray-400">
                                    📥 Entrée (Stock +)
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="type" value="sortie" class="hidden peer" {{ old('type') == 'sortie' ? 'checked' : '' }}>
                                <div class="p-4 border-2 rounded-lg text-center font-bold uppercase transition peer-checked:border-red-600 peer-checked:bg-red-50 peer-checked:text-red-700 border-gray-200 text-gray-400">
                                    📤 Sortie (Stock -)
                                </div>
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="quantite" value="Quantité à mouvementer" />
                                <x-text-input id="quantite" name="quantite" type="number" class="block mt-1 w-full" :value="old('quantite')" required min="1" />
                                <x-input-error :messages="$errors->get('quantite')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="direction_concernee" value="Direction bénéficiaire / Provenance" />
                                <x-text-input id="direction_concernee" name="direction_concernee" type="text" class="block mt-1 w-full" :value="old('direction_concernee')" placeholder="Ex: RH, Finances, Capitainerie..." />
                                <x-input-error :messages="$errors->get('direction_concernee')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="date_mouvement" value="Date effective" />
                                <x-text-input id="date_mouvement" name="date_mouvement" type="date" class="block mt-1 w-full" :value="old('date_mouvement', date('Y-m-d'))" required />
                            </div>

                            <div>
                                <x-input-label for="motif_ou_reference" value="Motif ou N° Référence (Bon de commande...)" />
                                <x-text-input id="motif_ou_reference" name="motif_ou_reference" type="text" class="block mt-1 w-full" :value="old('motif_ou_reference')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t pt-6">
                            <span class="text-sm text-gray-500 italic">L'action sera signée par : <b>{{ auth()->user()->name }}</b></span>
                            <div class="flex gap-4">
                                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline py-2">Annuler</a>
                                <x-primary-button class="bg-indigo-600">
                                    Valider le Mouvement
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>