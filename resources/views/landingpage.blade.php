@if(!auth()->check())
<x-layouts.anonyme :title="__('Worknest - Espaces de coworking')">
    <div>
        <section>
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                        WORK<span class="text-cyan-500">NEST</span>
                    </h1>
                </div>

                <div class="text-center space-y-8">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight max-w-4xl mx-auto">
                        Réservez votre espace de coworking en toute simplicité
                    </h2>

                    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed max-w-3xl mx-auto">
                        <strong class="text-cyan-500">WorkNest</strong> est une plateforme SaaS qui vous permet de
                        réserver facilement
                        un espace de coworking parmi <strong class="text-cyan-500">25 lieux disponibles partout en
                            France</strong> :
                        salles de réunion, bureaux privatifs et zones créatives adaptées à tous vos besoins.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4 pt-8">
                        <a href="{{ url('/espaces') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold
                                  border-2 border-cyan-500 text-cyan-500
                                  hover:bg-cyan-50
                                  rounded-lg transition-colors">
                            Voir les espaces disponibles
                        </a>
                        <a href="{{ url('/register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold
                                  bg-cyan-500 text-white
                                  hover:bg-cyan-600
                                  rounded-lg transition-colors">
                            Je veux réserver
                        </a>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mt-20">
                    <div
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors">
                        <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">25 lieux en France</h3>
                        <p class="text-gray-600 text-sm">Des espaces partout dans le pays pour travailler près de chez
                            vous</p>
                    </div>

                    <div
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors">
                        <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Réservation rapide</h3>
                        <p class="text-gray-600 text-sm">Réservez en quelques clics et confirmez instantanément</p>
                    </div>

                    <div
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors">
                        <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Espaces équipés</h3>
                        <p class="text-gray-600 text-sm">Wifi, écrans, tableaux blancs et tout le nécessaire</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.anonyme>
@else
<x-layouts.app :title="__('Worknest - Espaces de coworking')">
     <div>
        <section>
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                        WORK<span class="text-cyan-500">NEST</span>
                    </h1>
                </div>

                <div class="text-center space-y-8">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight max-w-4xl mx-auto">
                        Réservez votre espace de coworking en toute simplicité
                    </h2>

                    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed max-w-3xl mx-auto">
                        <strong class="text-cyan-500">WorkNest</strong> est une plateforme SaaS qui vous permet de
                        réserver facilement
                        un espace de coworking parmi <strong class="text-cyan-500">25 lieux disponibles partout en
                            France</strong> :
                        salles de réunion, bureaux privatifs et zones créatives adaptées à tous vos besoins.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4 pt-8">
                        <a href="{{ url('/espaces') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold
                                  border-2 border-cyan-500 text-cyan-500
                                  hover:bg-cyan-50
                                  rounded-lg transition-colors">
                            Voir les espaces disponibles
                        </a>
                        <a href="{{ url('/register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold
                                  bg-cyan-500 text-white
                                  hover:bg-cyan-600
                                  rounded-lg transition-colors">
                            Je veux réserver
                        </a>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mt-20">
                    <div
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors">
                        <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">25 lieux en France</h3>
                        <p class="text-gray-600 text-sm">Des espaces partout dans le pays pour travailler près de chez
                            vous</p>
                    </div>

                    <div
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors">
                        <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Réservation rapide</h3>
                        <p class="text-gray-600 text-sm">Réservez en quelques clics et confirmez instantanément</p>
                    </div>

                    <div
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors">
                        <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Espaces équipés</h3>
                        <p class="text-gray-600 text-sm">Wifi, écrans, tableaux blancs et tout le nécessaire</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
@endif