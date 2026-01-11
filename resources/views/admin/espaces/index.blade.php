<x-layouts.app :title="__('Espaces')">
    <div class="min-h-screen">

        <div class="px-6 py-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-cyan-500">Gestion des espaces</h2>
                <a href="{{ route('admin.espaces.create') }}"
                    class="px-4 py-2 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors text-sm md:text-base">
                    Ajouter
                </a>
            </div>

            <div class="space-y-4">
                @foreach($espaces as $espace)
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-cyan-500 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h3 class="text-sm font-semibold text-gray-800 mb-2">{{ $espace->nom }}</h3>
                                    <div class="flex space-x-2 ml-4 lg:flex-row flex-col">
                                        <a href="{{ route('admin.espaces.edit', $espace) }}"
                                            class="px-3 py-1 h-fit border-2 border-cyan-500 text-cyan-500 rounded text-sm font-medium hover:bg-cyan-50 transition-colors">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('admin.espaces.destroy', $espace) }}"
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
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <span class="text-gray-500">Disponible:</span>
                                        <span
                                            class="ml-2 font-medium {{ $espace->disponible ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $espace->disponible ? 'Oui' : 'Non' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Capacité:</span>
                                        <span class="ml-2 font-medium text-gray-800">{{ $espace->capacite }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Écran:</span>
                                        <span
                                            class="ml-2 font-medium {{ $espace->ecran ? 'text-green-600' : 'text-gray-400' }}">
                                            {{ $espace->ecran ? 'Oui' : 'Non' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Tableau blanc:</span>
                                        <span
                                            class="ml-2 font-medium {{ $espace->tableau_blanc ? 'text-green-600' : 'text-gray-400' }}">
                                            {{ $espace->tableau_blanc ? 'Oui' : 'Non' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>