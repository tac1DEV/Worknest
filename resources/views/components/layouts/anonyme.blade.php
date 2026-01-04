<x-layouts.anonyme.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.anonyme.sidebar>