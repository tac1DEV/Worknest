<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    protected $fillable = [
        'nom',
        'disponible',
        'categories_id',
        'surface',
        'ecran',
        'tableau_blanc'
    ];
}
