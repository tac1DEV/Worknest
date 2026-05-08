<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />
        <flux:spacer />
        <flux:brand href="#" name="Worknest" class="max-lg:hidden dark:hidden" />
        <flux:brand href="#" name="Worknest" class="max-lg:hidden! hidden dark:flex" />
        <flux:spacer />
        <a href="{{ route('login') }}"
            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
            Log in
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Register
            </a>
        @endif
    </flux:header>
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
        <a href="{{  route('home') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>
        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Onglets')" class="grid">
                <flux:navlist.item icon="home" :href=" route('home')" :current="request()->routeIs('home')"
                    wire:navigate>{{ __('Page d\'accueil') }}</flux:navlist.item>
                <flux:navlist.item icon="clipboard-list" :href=" route('espaces.index')"
                    :current="request()->routeIs('espaces.index')" wire:navigate>{{ __('Espaces') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="shield-check" :href=" route('rgpd')" :current="request()->routeIs('rgpd')"
                wire:navigate>{{ __('Protection des données') }}</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>
    {{ $slot }}

    @fluxScripts
</body>

</html>