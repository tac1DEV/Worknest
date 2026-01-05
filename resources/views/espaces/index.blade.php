@if(!auth()->check())
<x-layouts.anonyme :title="__('Espaces')">
    <table>
        <thead>
            <tr>
                <th>Nom de l'espace</th>
                <th>Disponible</th>
                <th>Surface</th>
                <th>Écran</th>
                <th>Tableau blanc</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            @foreach($espaces as $espace)
                <tr>
                    <td>{{ $espace->nom }}</td>
                    <td>{{ $espace->disponible }}</td>
                    <td>{{ $espace->surface }}</td>
                    <td>{{ $espace->ecran }}</td>
                    <td>{{ $espace->tableau_blanc }}</td>
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
                <th>Disponible</th>
                <th>Surface</th>
                <th>Écran</th>
                <th>Tableau blanc</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            @foreach($espaces as $espace)
                <tr>
                    <td>{{ $espace->nom }}</td>
                    <td>{{ $espace->disponible }}</td>
                    <td>{{ $espace->surface }}</td>
                    <td>{{ $espace->ecran }}</td>
                    <td>{{ $espace->tableau_blanc }}</td>
                    <td>
                        <a href="{{ route('espaces.show', $espace->id) }}">Voir détails</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </x-layouts.app>
@endif