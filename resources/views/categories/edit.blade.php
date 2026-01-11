<x-layouts.app :title="__('Modifier une catégorie')">
    <div class="min-h-screen">
        <div class="px-6 py-6 max-w-2xl mx-auto">
            <div class="my-6">
                <a href="{{ route('admin.categories.index') }}" class="text-cyan-500 text-sm hover:underline">
                    ← Retour à la liste
                </a>
            </div>
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-cyan-500">Modifier la catégorie</h2>
            </div>

            <form id="category-form" method="POST" action="{{ route('admin.categories.update', $category) }}"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="nom_categorie" class="block text-gray-700 font-semibold mb-2">Nom de la
                        catégorie</label>
                    <input type="text" name="nom_categorie" id="nom_categorie" value="{{ $category->nom_categorie }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700">
                </div>

                <div>
                    <label for="prix" class="block text-gray-700 font-semibold mb-2">Prix (€/heure)</label>
                    <div class="relative">
                        <input type="number" min="0" step="1" name="prix" id="prix" value="{{ $category->prix }}"
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700">
                        <span class="absolute right-4 top-3 text-gray-500 font-medium">€</span>
                    </div>
                </div>

                <div class="flex space-x-4 pt-4">
                    <button type="button"
                        onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')) document.getElementById('delete-form').submit()"
                        class="flex-1 py-3 bg-white border-2 border-red-500 text-red-500 text-center rounded-lg font-medium hover:bg-red-50 transition-colors">
                        SUPPRIMER
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-cyan-500 text-white text-center rounded-lg font-medium hover:bg-cyan-600 transition-colors">
                        ENREGISTRER
                    </button>
                </div>
            </form>

            <form id="delete-form" method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                class="hidden">
                @csrf
                @method('DELETE')
            </form>

        </div>
    </div>
</x-layouts.app>