<x-layouts.app :title="__('Modifier une catégorie')">
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="nom_categorie">Nom catégorie:</label>
            <input type="text" name="nom_categorie" id="nom_categorie" value="{{ $category->nom_categorie }}" />
            <label for="nom_categorie">Prix:</label>
            <input type="number" min="0" step="1" name="prix" id="prix" value="{{ $category->prix }}" />
        </div>
        <div>
            <button type="submit">
                Save
            </button>
        </div>
    </form>
</x-layouts.app>