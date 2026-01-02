<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    protected $fillable = [
        'nom',
        'status',
        'surface',
        'ecran',
        'tableau_blanc'
    ];
}
