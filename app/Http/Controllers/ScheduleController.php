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
        return redirect()->route("schedule.index");

        // return response()->json(['success' => true]);
    }

    // public function getEvents($id)
    // {
    //     $userId = Auth::id();
    //     $espace = Espace::findOrFail($id);
    //     $schedules = Schedule::where([
    //         'user_id' => $userId,
    //         'espace_id' => $espace
    //     ]);
    //     // dd($userId); //2
    //     dd($espace); //2
    //     return response()->json($schedules);
    // }
    public function getEvents(Request $request)
    {
        return Schedule::where('espace_id', $request->espace_id)
            ->get([
                'id',
                'title',
                'start',
                'end',
                'color'
            ]);
    }


    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update([
            'start' => Carbon::parse($request->input('start_date'))->setTimezone('UTC'),
            'end' => Carbon::parse($request->input('end_date'))->setTimezone('UTC'),
        ]);

        return response()->json(['message' => 'Event moved successfully']);
    }

    public function deleteEvent($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }

    public function calendar(Schedule $schedule, Espace $espace)
    {
        return view('reservations.calendar', compact('reservation', 'espace'));
    }
}
