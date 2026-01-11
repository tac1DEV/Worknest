<x-layouts.app :title="$espace->nom">
    <div class="min-h-screen">
        <div class="px-6 py-6">
            <div class="my-6">
                <a href="{{ route('espaces.index') }}" class="text-cyan-500 text-sm hover:underline">
                    ← Retour à la liste
                </a>
            </div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-cyan-500">{{ $espace->nom }}</h2>
            </div>
            <img src="{{$url}}" alt="image placeholder" class="w-64">
            <div class="my-6">
                <h3 class="text-lg font-semibold text-cyan-500 mb-3">Description</h3>
                <div class="space-y-1">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam egestas tempus nulla, a sodales orci
                        efficitur ut. Nunc non ornare magna, eget sagittis purus. Nullam sit amet elementum urna. Donec
                        mi tortor, viverra id fringilla at, facilisis non turpis. Donec imperdiet tellus ut sem dapibus,
                        at tempor dolor condimentum. Integer congue euismod ipsum, a aliquet libero egestas id. Nullam
                        accumsan lectus velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed
                        faucibus risus nec est mattis tincidunt. Integer gravida sagittis diam sed rutrum. Aenean
                        blandit id elit non consectetur. </p>
                </div>

                <div class="flex justify-between mt-4 text-sm">
                    <div>
                        <div class="text-cyan-500 font-semibold">Prix</div>
                        <div class="text-gray-700">{{ $espace->categorie->prix ?? '-' }}€</div>
                    </div>
                    <div>
                        <div class="text-cyan-500 font-semibold">Nb Chaise</div>
                        <div class="text-gray-700">{{ $espace->capacite }}</div>
                    </div>
                    <div>
                        <div class="text-cyan-500 font-semibold">Surface</div>
                        <div class="text-gray-700">-</div>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-cyan-500 mb-3">Équipement</h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full {{ $espace->ecran ? 'bg-cyan-500' : 'bg-gray-300' }}"></div>
                        <span class="text-sm text-gray-700">Écran</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full {{ $espace->tableau_blanc ? 'bg-cyan-500' : 'bg-gray-300' }}">
                        </div>
                        <span class="text-sm text-gray-700">Tableau blanc</span>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('schedule.index', $espace) }}"
                    class="block w-full py-3 bg-white border-2 border-cyan-500 text-cyan-500 text-center rounded-lg font-medium hover:bg-cyan-50 transition-colors">
                    VOIR PLANNING
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>