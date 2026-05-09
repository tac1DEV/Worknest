<x-layouts::app :title="__('Espaces')">
    <div class="min-h-screen bg-white dark:bg-gray-950">
        <div class="space-y-4">

            <div class="bg-white dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700
                                    rounded-lg p-4 hover:border-cyan-500 transition-colors">

                <div class="flex items-start justify-between">

                    <div class="flex-1">

                        <div class="flex justify-between">

                            <h3 class="text-sm font-semibold text-gray-800 dark:text-white mb-2">
                                {{ $espace->nom }}
                            </h3>

                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">

                            <div>
                                <span class="text-gray-500 dark:text-gray-400">Disponible:</span>
                                <span
                                    class="ml-2 font-medium
                                                {{ $espace->disponible ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $espace->disponible ? 'Oui' : 'Non' }}
                                </span>
                            </div>

                            <div>
                                <span class="text-gray-500 dark:text-gray-400">Capacité:</span>
                                <span class="ml-2 font-medium text-gray-800 dark:text-gray-200">
                                    {{ $espace->capacite }}
                                </span>
                            </div>

                            <div>
                                <span class="text-gray-500 dark:text-gray-400">Écran:</span>
                                <span
                                    class="ml-2 font-medium
                                                {{ $espace->ecran ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500' }}">
                                    {{ $espace->ecran ? 'Oui' : 'Non' }}
                                </span>
                            </div>

                            <div>
                                <span class="text-gray-500 dark:text-gray-400">Tableau blanc:</span>
                                <span
                                    class="ml-2 font-medium
                                                {{ $espace->tableau_blanc ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500' }}">
                                    {{ $espace->tableau_blanc ? 'Oui' : 'Non' }}
                                </span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <a href="{{ route('schedule.index', $espace->id) }}"
            class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition">
            Réserver un créneau
        </a>
    </div>
</x-layouts::app>