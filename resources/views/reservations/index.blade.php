<x-layouts.app :title="__('Reservations')">
    <a href="{{ route('reservations.create') }}">Réserver un espace</a>
    <table>
        <thead>
            <tr>
                <th>Début de la réservation</th>
                <th>Fin de la réservation</th>
                <th>Utilisateur</th>
                <th>Espace</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date_debut }}</td>
                    <td>{{ $reservation->date_fin }}</td>
                    <td>{{ $reservation->users_id }}</td>
                    <td>{{ $reservation->espaces_id }}</td>
                    <td class="flex">
                        <a href="{{ route('reservations.edit', $reservation) }}">Edit</a>
                        <form method="POST" action="{{ route('reservations.destroy', $reservation) }}">
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