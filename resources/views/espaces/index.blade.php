@if(!auth()->check())
<x-layouts.anonyme :title="__('Espaces')">
    <table>
        <thead>
            <tr>
                <th>Nom de l'espace</th>
                <th>Surface</th>
                <th>Écran</th>
                <th>Tableau blanc</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            @foreach($espacesUsers as $espace)
                <tr>
                    <td>{{ $espace->nom }}</td>
                    <td>{{ $espace->surface ? 'oui' : 'non'}}</td>
                    <td>{{ $espace->ecran ? 'oui' : 'non'}}</td>
                    <td>{{ $espace->tableau_blanc ? 'oui' : 'non'}}</td>
                    <td>
                        <a href="{{ route('espaces.show', $espace->id) }}">Voir détails</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </x-layouts.anonyme>
@else
<x-layouts.app :title="__('Espaces')">
    <table>
        <thead>
            <tr>
                <th>Nom de l'espace</th>
                <th>Surface</th>
                <th>Écran</th>
                <th>Tableau blanc</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            @foreach($espacesUsers as $espace)
                <tr>
                    <td>{{ $espace->nom }}</td>
                    <td>{{ $espace->surface ? 'oui' : 'non'}}</td>
                    <td>{{ $espace->ecran ? 'oui' : 'non'}}</td>
                    <td>{{ $espace->tableau_blanc ? 'oui' : 'non'}}</td>
                    <td>
                        <a href="{{ route('espaces.show', $espace->id) }}">Voir détails</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </x-layouts.app>
@endif