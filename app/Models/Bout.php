<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bout extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'match_type', 'promotion_id', 'event_id'];

    public function wrestlers()
    {
        return $this->belongsToMany(Wrestler::class, 'bout_wrestlers');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
