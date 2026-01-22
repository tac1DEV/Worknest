<x-layouts.app :title="__('Créer un espace')">
    <div class="min-h-screen ">

        <div class="px-6 py-6 max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-cyan-500">Nouvel espace</h2>
                <span class="px-3 py-1 bg-gray-200 text-gray-600 rounded-full text-sm">
                    <label class="flex items-center cursor-pointer">
                        <span class="mr-2">Disponible</span>
                        <input type="checkbox" form="espace-form" name="disponible" id="disponible"
                            class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-300 peer-checked:bg-cyan-500 rounded-full peer transition-colors">
                            <div
                                class="absolute top-0.5 left-0.5 bg-white w-5 h-5 rounded-full transition-transform peer-checked:translate-x-5">
                            </div>
                        </div>
                    </label>
                </span>
            </div>

            <form id="espace-form" method="POST" action="{{ route('admin.espaces.store') }}" class="space-y-6">
                @csrf

                <div>
                    <input type="text" name="nom" id="nom" placeholder="Nom de l'espace" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-cyan-500 font-medium placeholder-gray-400">
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-cyan-500 mb-3">Description</h3>
                    <div class="space-y-2">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam egestas tempus nulla, a sodales
                            orci
                            efficitur ut. Nunc non ornare magna, eget sagittis purus. Nullam sit amet elementum urna.
                            Donec
                            mi tortor, viverra id fringilla at, facilisis non turpis. Donec imperdiet tellus ut sem
                            dapibus,
                            at tempor dolor condimentum. Integer congue euismod ipsum, a aliquet libero egestas id.
                            Nullam
                            accumsan lectus velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed
                            faucibus risus nec est mattis tincidunt. Integer gravida sagittis diam sed rutrum. Aenean
                            blandit id elit non consectetur. </p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-cyan-500 mb-3">Modifier image</h3>
                    <div
                        class="border-2 border-dashed border-cyan-500 rounded-lg p-8 text-center hover:bg-cyan-50 transition-colors cursor-pointer">
                        <span class="text-cyan-500 text-sm">+ Ajouter une image</span>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-cyan-500 mb-3">Équipement</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="ecran" id="ecran"
                                    class="w-4 h-4 text-cyan-500 border-gray-300 rounded focus:ring-cyan-500">
                                <span class="text-sm text-gray-700">Écran</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="tableau_blanc" id="tableau_blanc"
                                    class="w-4 h-4 text-cyan-500 border-gray-300 rounded focus:ring-cyan-500">
                                <span class="text-sm text-gray-700">Tableau blanc</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="categorie_id"
                            class="block text-cyan-500 font-semibold text-sm mb-2">Catégorie</label>
                        <select name="categorie_id" id="categorie_id" required
                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="capacite" class="block text-cyan-500 font-semibold text-sm mb-2">Nb Chaise</label>
                        <input type="number" min="0" step="1" name="capacite" id="capacite" required
                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700">
                    </div>
                </div>

                <div class="flex space-x-4 pt-4">
                    <button type="button" onclick="window.history.back()"
                        class="flex-1 py-3 bg-white border-2 border-cyan-500 text-cyan-500 rounded-lg font-medium hover:bg-cyan-50 transition-colors">
                        SUPPRIMER CET ESPACE
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-white border-2 border-cyan-500 text-cyan-500 rounded-lg font-medium hover:bg-cyan-50 transition-colors">
                        ENREGISTRER LES MODIFICATIONS
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>