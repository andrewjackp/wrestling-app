<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wrestler extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'promotion_id',
        'image',
        'hometown',
        'height',
        'weight',
        'bio',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function bouts()
    {
        return $this->belongsToMany(Bout::class, 'bout_wrestlers');
    }

    public function championships()
    {
        return $this->hasMany(Championship::class, 'current_holder_id');
    }
}
