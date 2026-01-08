<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'start',
        'end',
        'color',
        'user_id',
        'espace_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function espace(): BelongsTo
    {
        return $this->belongsTo(Espace::class);
    }
}
