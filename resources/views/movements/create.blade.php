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
                        <div>
                            <x-input-label for="date_mouvement" value="Date effective" />
                            <x-text-input id="date_mouvement" name="date_mouvement" type="date" class="block mt-1 w-full" :value="old('date_mouvement', date('Y-m-d'))" required />


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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t pt-6">

                            <div>
                                <x-input-label for="motif_ou_reference" value="Motif" />
                                <span class="text-xs text-gray-500 italic">Cliquez sur un tag pour l'ajouter</span>
                                <textarea id="motif_ou_reference" name="motif_ou_reference" rows="3"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('motif_ou_reference') }}</textarea>

                            </div>
                            <div>

                                <div class="mt-2 flex flex-wrap gap-2">
                                    <button type="button" onclick="fillMotif(this)" class="text-xs bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 py-1 px-2 rounded transition">
                                        Nouvelle acquisition / Achat
                                    </button>
                                    <!-- <button type="button" onclick="fillMotif(this)" class="text-xs bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 py-1 px-2 rounded transition">
                                        Remplacement suite à une panne
                                    </button> -->
                                    <button type="button" onclick="fillMotif(this)" class="text-xs bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 py-1 px-2 rounded transition">
                                        Utiliser pour une panne
                                    </button>
                                    <button type="button" onclick="fillMotif(this)" class="text-xs bg-green-50 hover:bg-green-100 text-green-700 border border-green-200 py-1 px-2 rounded transition">
                                        Besoin d'un utilisateur
                                    </button>
                                    <button type="button" onclick="fillMotif(this)" class="text-xs bg-yellow-50 hover:bg-yellow-100 text-yellow-700 border border-yellow-200 py-1 px-2 rounded transition">
                                        Besoin d'un traveaux DDN
                                    </button>
                                    <!-- <button type="button" onclick="fillMotif(this)" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 py-1 px-2 rounded transition">
                                        Mise au rebut / Obsolescence
                                    </button> -->
                                </div>
                                <script>
                                    function fillMotif(button) {
                                        const textarea = document.getElementById('motif_ou_reference');
                                        const textToAdd = button.innerText.trim();

                                        // Si le champ contient déjà du texte, on saute une ligne avant d'ajouter le motif
                                        if (textarea.value.trim() !== '') {
                                            textarea.value += '\n' + textToAdd;
                                        } else {
                                            textarea.value = textToAdd;
                                        }

                                        // On remet le focus sur le champ pour permettre au support d'ajouter une référence manuelle (ex: N° de bon)
                                        textarea.focus();
                                    }
                                </script>
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