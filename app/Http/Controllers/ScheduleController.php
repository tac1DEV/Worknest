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

    public function store(Request $request)
    {
        Schedule::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'color' => $request->color,
            'espace_id' => $request->espace_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => true]);
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
}
