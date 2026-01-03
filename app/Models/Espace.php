<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Espace extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'disponible',
        'categories_id',
        'surface',
        'ecran',
        'tableau_blanc'
    ];
}
