<x-layouts.app :title="__('Categories')">
    <a href="{{ route('categories.create') }}">Ajouter une nouvelle catégorie</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->nom_categorie }}</td>
                    <td>{{ $category->prix }}</td>
                    <td class="flex">
                        <a href="{{ route('categories.edit', $category) }}">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', $category) }}">
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