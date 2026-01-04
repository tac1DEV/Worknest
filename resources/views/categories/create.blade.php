<x-layouts.app :title="__('Créer une catégorie')">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div>
            <label for="nom_categorie">Nom catégorie:</label>
            <input type="text" name="nom_categorie" id="nom_categorie" />
            <label for="nom_categorie">Prix:</label>
            <input type="number" min="0" step="1" name="prix" id="prix" />
        </div>
        <div>
            <button type="submit">
                Save
            </button>
        </div>
    </form>
</x-layouts.app>