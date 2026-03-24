<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Nouveau Matériel</h2>

                <form action="{{ route('equipements.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <x-input-label for="designation" value="Désignation (Ex: PC Portable HP G8)" />
                            <x-text-input id="designation" name="designation" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="categorie" value="Catégorie" />
                            <select name="categorie" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Informatique">Equipements</option>
                                <option value="Périphérique">Périphérique</option>
                                <option value="Consommable">Consommable </option>
                                <option value="Réseau">Réseau</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- <div>
                                <x-input-label for="quantite_en_stock" value="Stock Initial" />
                                <x-text-input id="quantite_en_stock" name="quantite_en_stock" type="number" class="mt-1 block w-full" value="0" required />
                            </div> -->
                            <div>
                                <x-input-label for="seuil_alerte" value="Seuil d'Alerte" />
                                <x-text-input id="seuil_alerte" name="seuil_alerte" type="number" class="mt-1 block w-full" value="5" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('equipements.index') }}" class="mr-4 text-gray-600 underline">Annuler</a>
                            <x-primary-button>Enregistrer le matériel</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>