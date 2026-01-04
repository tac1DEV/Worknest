<x-layouts.app :title="__('Espaces')">
    <a href="{{ route('admin.espaces.create') }}">Ajouter un nouvel espace</a>
    <table>
        <thead>
            <tr>
                <th>Nom de l'espace</th>
                <th>Disponible</th>
                <th>Surface</th>
                <th>Écran</th>
                <th>Tableau blanc</th>
                <th>Actions</th>
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
                    <td class="flex">
                        <a href="{{ route('admin.espaces.edit', $espace) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.espaces.destroy', $espace) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layouts.app>