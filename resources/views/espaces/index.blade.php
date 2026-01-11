@if(!auth()->check())
    <x-layouts.anonyme :title="__('Espaces')">
        <div class="min-h-screen">
            <div class="px-6 py-6">
                <h2 class="text-2xl font-bold text-cyan-500 mb-4">Réserver un espace</h2>
        <x-layouts.filter></x-layouts.filter>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 max-w-7xl mt-5">
                    @foreach($espacesUsers as $espace)
                        <a href="{{ route('espaces.show', $espace->id) }}" class="block">
                            <div class="bg-white border-2 border-cyan-500 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                <div class="aspect-square bg-gray-100 flex items-center justify-center">                                  
                                    <img src="{{$url}}" alt="image placeholder" class="w-20">
                                </div>
                                <div class="p-3">
                                    <div class="flex justify-between items-center text-xs text-gray-600 mb-2">
                                        <div>
                                            <div class="font-semibold text-cyan-500">Prix</div>
                                            <div>{{ $espace->categorie->prix }}€</div>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-cyan-500">Nb Chaise</div>
                                            <div>{{ $espace->capacite }}</div>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-cyan-500">Surface</div>
                                            <div>-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </x-layouts.anonyme>
@else
    <x-layouts.app :title="__('Espaces')">
        <div class="min-h-screen">
            <div class="px-6 py-6">
                <h2 class="text-2xl font-bold text-cyan-500 mb-4">Réserver un espace</h2>
                
 
        <x-layouts.filter></x-layouts.filter>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 max-w-7xl mt-5">
                    @foreach($espacesUsers as $espace)
                        <a href="{{ route('espaces.show', $espace->id) }}" class="block">
                            <div class="bg-white border-2 border-cyan-500 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                <div class="aspect-square bg-gray-100 flex items-center justify-center">                                  
                                    <img src="{{$url}}" alt="image placeholder">
                                </div>
                                <div class="p-3">
                                    <div class="flex justify-between items-center text-xs text-gray-600 mb-2">
                                        <div>
                                            <div class="font-semibold text-cyan-500">Prix</div>
                                            <div>{{ $espace->categorie->prix }}€</div>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-cyan-500">Nb Chaise</div>
                                            <div>{{ $espace->capacite }}</div>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-cyan-500">Surface</div>
                                            <div>-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </x-layouts.app>
@endif