<x-layouts.app :title="__('Reservations')">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('espaces.index') }}">Réserver un espace</a>
    @forelse($schedules as $schedule)
        <table>
            <thead>
                <tr>
                    <th>Début de la réservation</th>
                    <th>Fin de la réservation</th>
                    <th>Utilisateur</th>
                    <th>Espace</th>
                    <th>Modifier</th>
                    <th>Facture</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $schedule->start }}</td>
                    <td>{{ $schedule->end }}</td>
                    <td>{{ $schedule->user_id }}</td>
                    <td>{{ $schedule->espace_id }}</td>
                    <td>
                        <a href="{{ route('schedule.index', $schedule->espace_id) }}">Modifier la réservation</a>
                    </td>
                    <td>
                        <a href="{{ route('reservation.facture', $schedule->id) }}">Voir la facture</a>
                    </td>
                </tr>

            </tbody>
    </table> @empty
        <p> Aucune réservation pour le moment</p>

    @endforelse

</x-layouts.app>