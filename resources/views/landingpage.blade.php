<x-layouts.anonyme :title="__('Worknest - Espaces de coworking')">
    <!-- WorkNest est un SaaS qui vous permet de  réserver un espace de coworking parmi nos 25 espaces de coworking disponibles en France (salles de réunion, bureaux, zones créatives).
                            <a
                            href="{{ url('/espaces') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >Voir les espaces disponibles</a>
                            <a
                            href="{{ url('/register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >Je veux réserver</a> -->
    <section class="min-h-screen flex px-6">
        <div class="text-center lg:space-y-24 w-full">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-[#EDEDEC] leading-snug">
                Réservez votre espace de coworking en toute simplicité
            </h2>

            <p class="text-left text-xl text-gray-700 dark:text-[#bdbdbd]
                  leading-loose max-w-3xl mx-auto">
                <strong>WorkNest</strong> est une plateforme SaaS qui vous permet de réserver facilement
                un espace de coworking parmi <strong>25 lieux disponibles partout en France</strong> :
                salles de réunion, bureaux privatifs et zones créatives adaptées à tous vos besoins.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6 pt-4">
                <a href="{{ url('/espaces') }}" class="inline-flex items-center justify-center px-8 py-3 text-sm font-medium
                       border border-gray-300 dark:border-[#3E3E3A]
                       text-gray-900 dark:text-[#EDEDEC]
                       hover:border-gray-400 dark:hover:border-[#62605b]
                       rounded-md transition-colors">
                    Voir les espaces disponibles
                </a>

                <a href="{{ url('/register') }}" class="inline-flex items-center justify-center px-8 py-3 text-sm font-medium
                       bg-gray-900 text-white dark:bg-[#EDEDEC] dark:text-[#0f0f0f]
                       hover:bg-gray-800 dark:hover:bg-white
                       rounded-md transition-colors">
                    Je veux réserver
                </a>
            </div>
        </div>
    </section>


</x-layouts.anonyme>