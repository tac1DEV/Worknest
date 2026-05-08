<flux:modal.trigger name="filters">
    <flux:button icon="sliders-horizontal">Filtres</flux:button>
</flux:modal.trigger>

<flux:modal name="filters" flyout variant="default" position="left" class="md:w-lg">
    <form action="{{ route('apply.filters') }}" method="GET" class="space-y-4">

        <div>
            <label class="block font-medium">Capacité :</label>
            <select name="filter[capacite]" class="border rounded p-2 w-full">
                <option value="">-- Choisir --</option>
                <option value="50">50 personnes</option>
                <option value="75">75 personnes</option>
                <option value="100">100 personnes</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Prix exact :</label>
            <select name="filter[categorie.prix]" class="border rounded p-2 w-full">
                <option value="">-- Choisir --</option>
                <option value="10">10 € </option>
                <option value="45">45 € </option>
                <option value="100">100 €</option>
            </select>
        </div>

        <div class="flex gap-8">
            <div>
                <label class="block font-medium">Écran :</label>
                <input type="hidden" name="filter[ecran]" value="">
                <input type="checkbox" name="filter[ecran]" value="1">
            </div>

            <div>
                <label class="block font-medium">Tableau Blanc :</label>
                <input type="hidden" name="filter[tableau_blanc]" value="">
                <input type="checkbox" name="filter[tableau_blanc]" value="1">
            </div>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Appliquer les filtres
        </button>
    </form>
</flux:modal>