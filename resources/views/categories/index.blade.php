<x-layouts.app :title="__('Categories')">
    <div class="min-h-screen">
        <div class="px-6 py-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-cyan-500">Gestion des catégories</h2>
                <a href="{{ route('admin.categories.create') }}"
                    class="px-4 py-2 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors">
                    Ajouter
                </a>
            </div>

            <div class="space-y-4">
                @foreach($categories as $category)
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-cyan-500 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $category->nom_categorie }}</h3>
                                    <div>
                                        <div class="flex space-x-2 lg:flex-row flex-col">
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="px-3 py-1 border-2 border-cyan-500 text-cyan-500 rounded text-sm font-medium hover:bg-cyan-50 transition-colors">
                                                Modifier
                                            </a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Êtes-vous sûr ?')"
                                                    class="px-3 py-1 border-2 border-red-500 text-red-500 rounded text-sm font-medium hover:bg-red-50 transition-colors">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="text-sm text-gray-500">Prix: <span
                                class="font-semibold text-cyan-500">{{ $category->prix }} €</span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>