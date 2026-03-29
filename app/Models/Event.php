<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_id',
        'name',
        'event_date',
        'venue',
        'city',
        'country',
        'description',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function bouts()
    {
        return $this->hasMany(Bout::class);
    }
}