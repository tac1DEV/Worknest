<x-layouts.app :title="__('Modifier un espace')">
    <form method="POST" action="{{ route('admin.espaces.update', $espace) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom de l'espace:</label>
            <input type="text" name="nom" id="nom" value="{{ $espace->nom }}" />
            <label for="disponible">Disponible:</label>
            <input type="checkbox" name="disponible" id="disponible" {{$espace->disponible ? 'checked' : ''}}>
            <label for="categories_id">Catégorie :</label>
            <input type="number" min="0" step="1" name="categories_id" id="categories_id"
                value="{{ $espace->categories_id }}" />
            <label for="capacite">Capacité:</label>
            <input type="number" min="0" step="1" name="capacite" id="capacite" value="{{ $espace->capacite }}">
            <label for="ecran">Écran:</label>
            <input type="checkbox" name="ecran" id="ecran" {{$espace->ecran ? 'checked' : ''}}>
            <label for="tableau_blanc">Tableau blanc:</label>
            <input type="checkbox" name="tableau_blanc" id="tableau_blanc" {{$espace->tableau_blanc ? 'checked' : ''}}>
        </div>
        <div>
            <button type="submit">
                Save
            </button>
        </div>
    </form>
</x-layouts.app>