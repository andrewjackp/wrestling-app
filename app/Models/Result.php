<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'bout_id',
        'winner_id',
        'finish_type',
        'duration',
        'notes',
    ];

    public function bout()
    {
        return $this->belongsTo(Bout::class);
    }

    public function winner()
    {
        return $this->belongsTo(Wrestler::class, 'winner_id');
    }

    public function hasWinner(Wrestler $wrestler): bool
    {
        return $this->wrestlers()->where('wrestlers.id', $wrestler->id)->exists();
    }
}
