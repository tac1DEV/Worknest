<?php

namespace App\Http\Controllers;
use App\Models\Espace;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index($espaceId)
    {
        $espace = Espace::findOrFail($espaceId);
        return view('schedule.index', compact('espace'));
    }

    public function liste()
    {
        $user = Auth::id();
        $schedules = Schedule::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('schedule.liste', compact('schedules'));
    }

    public function store(Request $request)
    {
        $espace = Espace::findOrFail($request->espace_id);

        $schedule = Schedule::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'color' => $request->color,
            'espace_id' => $request->espace_id,
            'user_id' => Auth::id(),
        ]);

        $schedule->load('espace.categorie'); // charge la catégorie pour le calcul
        $prix = $this->calculerPrix($schedule);

        return response()->json([
            'title' => $request->title,
            'start' => Carbon::parse($request->start)->format('d/m/Y'),
            'end' => Carbon::parse($request->end)->format('d/m/Y'),
            'espace' => $espace->nom,
            'prix' => $prix,
        ]);
    }


    public function getEvents(Request $request)
    {
        return Schedule::where('espace_id', $request->espace_id)
            ->get([
                'id',
                'title',
                'start',
                'end',
                'color',
                'user_id'
            ]);
    }


    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update([
            'start' => Carbon::parse($request->input('start_date'))->setTimezone('UTC'),
            'end' => Carbon::parse($request->input('end_date'))->setTimezone('UTC'),
        ]);

        return response()->json(['message' => 'Réservation modifié avec succès.']);
    }

    public function deleteEvent($id)
    {
        $schedule = Schedule::findOrFail($id);
        if ($schedule->user_id !== auth()->id()) {
            abort(403);
        }
        $schedule->delete();

        return response()->json(['message' => 'Réservation supprimée avec succès.']);
    }

    public function calendar(Schedule $schedule, Espace $espace)
    {
        return view('reservations.calendar', compact('reservation', 'espace'));
    }

    public function calculerPrix($schedule)
    {
        // Calculer la durée en jours
        $start = Carbon::parse($schedule->start)->startOfDay();
        $end = Carbon::parse($schedule->end)->startOfDay();
        $days = $start->diffInDays($end);

        // Prix basé sur la catégorie de l'espace
        $prixParJour = $schedule->espace->categorie->prix;
        $total = $days * $prixParJour;

        return $total;
    }
}
