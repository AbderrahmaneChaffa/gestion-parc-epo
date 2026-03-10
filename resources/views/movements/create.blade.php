<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6">Enregistrer un Flux de Matériel</h2>

            <form action="{{ route('movements.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Équipement</label>
                        <select name="equipment_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500" required>
                            @foreach($equipments as $item)
                            <option value="{{ $item->id }}">{{ $item->designation }} (Stock actuel: {{ $item->quantite_en_stock }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="type" value="entree" class="text-green-600" checked>
                            <span class="ml-2 font-bold text-green-600 uppercase">Entrée (Achat / Retour)</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="type" value="sortie" class="text-red-600">
                            <span class="ml-2 font-bold text-red-600 uppercase">Sortie (Attribution)</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700">Quantité</label>
                            <input type="number" name="quantite" min="1" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700">Direction bénéficiaire (si sortie)</label>
                            <input type="text" name="direction_concernee" placeholder="Ex: RH, Finances..." class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700">Date du mouvement</label>
                            <input type="date" name="date_mouvement" value="{{ date('Y-m-d') }}" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700">Référence / Motif</label>
                            <input type="text" name="motif_ou_reference" placeholder="N° Bon de commande ou Nom agent" class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">
                        Valider le Mouvement
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>