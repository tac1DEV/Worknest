<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date_debut',
        'date_fin',
        'utilisateurs_id',
        'espaces_id',
    ];

}
