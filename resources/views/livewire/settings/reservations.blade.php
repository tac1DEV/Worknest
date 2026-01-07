<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Schedule;

new #[Title('Mes réservations')] class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function reservations()
    {
        return Schedule::where('end', '>', now())->get();
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Réservations prévues')" :subheading="__('Vérifiez vos prochaines réservations.')">
        <i>Vous pouvez annuler ou modifier votre réservations jusqu'à 48 heures avant le début de celle-ci ; passé ce
            délai, aucune modification n’est possible.</i>
        <table class="w-4/5 mt-4 border border-gray-200 rounded-lg shadow-md overflow-hidden text-center">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700">Début</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700">Fin</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700">Couleur</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->reservations() as $reservation)
                    <tr class="bg-white hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-3 text-gray-800">{{  date('d-m-Y',strtotime($reservation->start)) }}</td>
                        <td class="px-6 py-3 text-gray-800">{{  date('d-m-Y',strtotime($reservation->end)) }}</td>
                        <td class="px-6 py-3">
                            <span class="inline-block w-8 h-8 rounded-full mx-auto"
                                style="background-color: {{ $reservation->color }}"></span>
                        </td>
                        <td class="px-6 py-3 flex justify-center gap-4">
                            <a href="{{ route('reservations.edit', $reservation) }}" class="text-blue-600 hover:underline">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('reservations.destroy', $reservation) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Confirmer l’annulation ?')">
                                    Annuler
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </x-settings.layout>
</section>