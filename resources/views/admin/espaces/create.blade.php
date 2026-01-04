<x-layouts.app :title="__('Créer un espace')">
    <form method="POST" action="{{ route('admin.espaces.store') }}">
        @csrf
        <div>
            <label for="nom">Nom de l'espace:</label>
            <input type="text" name="nom" id="nom">
            <label for="disponible">Disponible:</label>
            <input type="checkbox" name="disponible" id="disponible">
            <label for="categories_id">Catégorie :</label>
            <input type="number" min="0" step="1" name="categories_id" id="categories_id" />
            <label for="surface">Surface:</label>
            <input type="number" min="0" step="1" name="surface" id="surface">
            <label for="ecran">Écran:</label>
            <input type="checkbox" name="ecran" id="ecran">
            <label for="tableau_blanc">Tableau blanc:</label>
            <input type="checkbox" name="tableau_blanc" id="tableau_blanc">
        </div>
        <div>
            <button type="submit">
                Save
            </button>
        </div>
    </form>
</x-layouts.app>