<x-layouts.app :title="__('Créer une catégorie')">
    <div class="min-h-screen">

        <div class="px-6 py-6 max-w-2xl mx-auto">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-cyan-500">Nouvelle catégorie</h2>
            </div>

            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="nom_categorie" class="block text-gray-700 font-semibold mb-2">Nom de la
                        catégorie</label>
                    <input type="text" name="nom_categorie" id="nom_categorie" required
                        placeholder="Ex: Salle de réunion standard"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700 placeholder-gray-400">
                </div>

                <div>
                    <label for="prix" class="block text-gray-700 font-semibold mb-2">Prix (€/heure)</label>
                    <div class="relative">
                        <input type="number" min="0" step="1" name="prix" id="prix" required placeholder="20"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700 placeholder-gray-400">
                        <span class="absolute right-4 top-3 text-gray-500 font-medium">€</span>
                    </div>
                </div>

                <div class="flex space-x-4 pt-4">
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex-1 py-3 bg-white border-2 border-gray-300 text-gray-700 text-center rounded-lg font-medium hover:bg-gray-50 transition-colors">
                        ANNULER
                    </a>
                    <button type="submit"
                        class="flex-1 py-3 bg-cyan-500 text-white text-center rounded-lg font-medium hover:bg-cyan-600 transition-colors">
                        ENREGISTRER
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>