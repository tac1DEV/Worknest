<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function apply(Request $request)
    {
        // Rediriger vers une URL construite avec les filtres
        $filters = $request->input('filter', []);

        $filters = array_filter($filters, function ($value) {
            // On garde seulement les valeurs non vides et non nulles
            return $value !== null && $value !== '';
        });

        // Exemple : construire l'URL vers index avec filtres en query string
        $queryString = http_build_query(['filter' => $filters]);

        return redirect('/espaces?' . $queryString);
    }
}
