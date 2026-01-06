<x-layouts.app :title="$espace->nom">
    <a href="{{ route('espaces.index') }}">Retour vers la liste</a>
    <div>
        <label for="nom">Nom de l'espace:</label>
        <p>{{ $espace->nom }}</p>
        <label for="categories_id">Catégorie :</label>
        <p>{{ $espace->categories_id }}</p>
        <label for="capacite">Capacité:</label>
        <p>{{ $espace->capacite }}</p>
        <label for="ecran">Écran:</label>
        <p>{{$espace->ecran ? 'oui' : 'non'}}</p>
        <label for="tableau_blanc">Tableau blanc:</label>
        <p>{{$espace->tableau_blanc ? 'oui' : 'non'}}</p>
    </div>
    <a href="{{ route('reservations.calendar', $espace->id) }}">Voir planning</a>
</x-layouts.app>