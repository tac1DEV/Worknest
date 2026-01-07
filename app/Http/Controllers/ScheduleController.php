<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedule.index');
    }

    public function store(Request $request)
    {
        $item = new Schedule();
        $item->title = $request->title;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->color = $request->color;
        $item->save();

        return redirect()->route("schedule.index");
    }

    public function getEvents()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
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
}
