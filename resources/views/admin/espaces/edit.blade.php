<x-layouts.app :title="__('Modifier un espace')">
    <div class="min-h-screen">
        <div class="px-6 py-6 max-w-2xl mx-auto">

            <form id="espace-form" method="POST" action="{{ route('admin.espaces.update', $espace) }}"
                class="space-y-6">
                @csrf
                @method('PUT')

            <div class="flex items-center justify-between mb-6">
                <div>
                    <input type="text" name="nom" id="nom" value="{{ $espace->nom }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-cyan-500 font-medium placeholder-gray-400 text-sm">
                </div>
                <span class="px-3 py-1 text-gray-600  text-sm">
                    <label class="flex items-center cursor-pointer">
                        <span class="mr-2">Disponible</span>
                        <input type="checkbox" form="espace-form" name="disponible" id="disponible" {{ $espace->disponible ? 'checked' : '' }} class="sr-only peer">
                        <div
                            class="peer-checked:bg-cyan-500 relative w-9 h-5 bg-neutral-quaternary peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-soft dark:peer-focus:ring-brand-soft rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand">
                        </div>

                    </label>
                </span>
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
                                <input type="checkbox" name="ecran" id="ecran" {{ $espace->ecran ? 'checked' : '' }}
                                    class="w-4 h-4 text-cyan-500 border-gray-300 rounded focus:ring-cyan-500">
                                <span class="text-sm text-gray-700">Écran</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="tableau_blanc" id="tableau_blanc" {{ $espace->tableau_blanc ? 'checked' : '' }}
                                    class="w-4 h-4 text-cyan-500 border-gray-300 rounded focus:ring-cyan-500">
                                <span class="text-sm text-gray-700">Tableau blanc</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="capacite" class="block text-cyan-500 font-semibold text-sm mb-2">Nb Chaise</label>
                        <input type="number" min="0" step="1" name="capacite" id="capacite"
                            value="{{ $espace->capacite }}" required
                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700">
                    </div>
                    <div>
                        <label class="block text-cyan-500 font-semibold text-sm mb-2">Surface</label>
                        <input type="number" min="0" step="1" placeholder="m²"
                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:border-cyan-500 focus:outline-none text-gray-700">
                    </div>
                </div>

                <div class="flex space-x-4 pt-4">
                    <button type="button"
                        onclick="if(confirm('Êtes-vous sûr ?')) document.getElementById('delete-form').submit()"
                        class="flex-1 py-3 bg-white border-2 border-red-500 text-red-500 rounded-lg font-medium hover:bg-red-50 transition-colors">
                        SUPPRIMER CET ESPACE
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-white border-2 border-cyan-500 text-cyan-500 rounded-lg font-medium hover:bg-cyan-50 transition-colors">
                        ENREGISTRER LES MODIFICATIONS
                    </button>
                </div>
            </form>

            <form id="delete-form" method="POST" action="{{ route('admin.espaces.destroy', $espace) }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</x-layouts.app>