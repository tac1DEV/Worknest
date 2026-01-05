<?php

namespace App\Http\Controllers;

use App\Models\Espace;
use Illuminate\Http\Request;

class EspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espaces = Espace::all();
        $espacesUsers = Espace::where('disponible', true)->get();
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return view('espaces.index', compact('espacesUsers'));
        }
        return view('admin.espaces.index', compact('espaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.espaces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Espace::create([
            'nom' => $request->input('nom'),
            'disponible' => $request->has('disponible'),
            'categories_id' => $request->input('categories_id'),
            'surface' => $request->input('surface'),
            'ecran' => $request->has('ecran'),
            'tableau_blanc' => $request->has('tableau_blanc')
        ]);

        return redirect()->route('admin.espaces.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Espace $espace)
    {
        return view('espaces.show', compact('espace'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espace $espace)
    {
        return view('admin.espaces.edit', compact('espace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Espace $espace)
    {
        $espace->update([
            'nom' => $request->input('nom'),
            'disponible' => $request->has('disponible'),
            'categories_id' => $request->input('categories_id'),
            'surface' => $request->input('surface'),
            'ecran' => $request->has('ecran'),
            'tableau_blanc' => $request->has('tableau_blanc')
        ]);
        return redirect()->route('admin.espaces.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espace $espace)
    {
        $espace->delete();
        return redirect()->route('espaces.index');
    }

}
