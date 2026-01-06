<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Espace extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'disponible',
        'capacite',
        'ecran',
        'tableau_blanc'
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

}
