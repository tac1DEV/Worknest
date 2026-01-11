<x-layouts.app :title="__('Reservations')">
    <div class="min-h-screen">
        <div class="px-6 py-6">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-2 border-green-500 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-cyan-500">Mes réservations</h2>
                <a href="{{ route('espaces.index') }}" class="px-4 py-2 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors">
                    + Réserver
                </a>
            </div>

            @forelse($schedules as $schedule)
                <div class="bg-white border-2 border-gray-200 rounded-lg p-4 mb-4 hover:border-cyan-500 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="w-16 h-16 bg-cyan-100 rounded-lg flex items-center justify-center mr-4">                                    
                                    <img src="{{$url}}" alt="image placeholder" class="w-20">
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $schedule->title }}</h3>
                                    <p class="text-sm text-gray-500">Espace {{ $schedule->espace->nom }}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3 text-sm mb-4">
                                <div>
                                    <span class="text-gray-500">Début:</span>
                                    <span class="ml-2 font-medium text-gray-800">{{ $schedule->start }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Fin:</span>
                                    <span class="ml-2 font-medium text-gray-800">{{ $schedule->end }}</span>
                                </div>
                            </div>

                            <div class="flex space-x-3">
                                <a href="{{ route('schedule.index', $schedule->espace_id) }}" class="px-4 py-2 border-2 border-cyan-500 text-cyan-500 rounded-lg text-sm font-medium hover:bg-cyan-50 transition-colors">
                                    Modifier
                                </a>
                                <a href="{{ route('reservation.facture', $schedule->id) }}" class="px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                                    Voir facture
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white border-2 border-gray-200 rounded-lg p-12 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 text-lg mb-4">Aucune réservation pour le moment</p>
                    <a href="{{ route('espaces.index') }}" class="inline-block px-6 py-3 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors">
                        Réserver un espace
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>