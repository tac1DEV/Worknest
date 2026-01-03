<x-layouts.app :title="__('Réserver un espace')">
    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div>
            <label for="date_debut">Début de la réservation :</label>
            <input type="datetime-local" id="date_debut" name="date_debut" />
            <label for="date_fin">Fin de la réservation :</label>
            <input type="datetime-local" id="date_fin" name="date_fin" />
            <label for="utilisateurs_id">Utilisateur :</label>
            <input type="number" min="0" step="1" name="utilisateurs_id" id="utilisateurs_id" />
            <label for="espaces_id">Espace :</label>
            <input type="number" min="0" step="1" name="espaces_id" id="espaces_id" />
        </div>
        <div>
            <button type="submit">
                Save
            </button>
        </div>
    </form>
</x-layouts.app>