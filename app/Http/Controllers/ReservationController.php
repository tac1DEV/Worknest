<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Espace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $reservations = Schedule::where('user_id', $user)->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Reservation::create([
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
            'users_id' => $request->input('users_id'),
            'espaces_id' => $request->input('espaces_id'),
        ]);

        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
            'utilisateurs_id' => $request->input('utilisateurs_id'),
            'espaces_id' => $request->input('espaces_id'),
        ]);
        return redirect()->route('reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }

    public function calendar(Reservation $reservation, Espace $espace)
    {
        return view('reservations.calendar', compact('reservation', 'espace'));
    }
}
