<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg border-t-4 border-yellow-400">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Modifier : {{ $equipement->designation }}</h2>

                <form action="{{ route('equipements.update', $equipement) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">
                        <div>
                            <x-input-label value="Désignation" />
                            <x-text-input name="designation" type="text" class="block w-full mt-1" value="{{ $equipement->designation }}" required />
                        </div>

                        <div>
                            <x-input-label value="Catégorie" />
                            <select name="categorie" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Informatique" {{ $equipement->categorie == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                                <option value="Périphérique" {{ $equipement->categorie == 'Périphérique' ? 'selected' : '' }}>Périphérique</option>
                                <option value="Consommable" {{ $equipement->categorie == 'Consommable' ? 'selected' : '' }}>Consommable</option>
                                <option value="Réseau" {{ $equipement->categorie == 'Réseau' ? 'selected' : '' }}>Réseau</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Seuil d'Alerte" />
                            <x-text-input name="seuil_alerte" type="number" class="block w-full mt-1" value="{{ $equipement->seuil_alerte }}" required />
                        </div>

                        <div class="bg-gray-50 p-4 rounded text-sm text-gray-600">
                            <strong>Note :</strong> La quantité en stock (actuellement : <b>{{ $equipement->quantite_en_stock }}</b>) ne peut être modifiée qu'à travers l'historique des <b>Mouvements</b> pour garantir la traçabilité.
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>Mettre à jour</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>