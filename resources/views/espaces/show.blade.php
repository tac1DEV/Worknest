<x-layouts.app :title="$espace->nom">
    <a href="{{ route('espaces.index') }}">Retour vers la liste</a>
    <div>
        <label for="nom">Nom de l'espace:</label>
        <p>{{ $espace->nom }}</p>
        <label for="categories_id">Catégorie :</label>
        <p>{{ $espace->categories_id }}</p>
        <label for="surface">Surface:</label>
        <p>{{ $espace->surface }}</p>
        <label for="ecran">Écran:</label>
        <p>{{$espace->ecran == 0 ? 'oui' : 'non'}}</p>
        <label for="tableau_blanc">Tableau blanc:</label>
        <p>{{$espace->tableau_blanc == 0 ? 'oui' : 'non'}}</p>
    </div>
    <a href="{{ route('reservations.calendar', $espace->id) }}">Voir planning</a>
 </x-layouts.app>