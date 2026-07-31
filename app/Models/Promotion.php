<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo'];

    public function wrestlers()
    {
        return $this->hasMany(Wrestler::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function bouts()
    {
        return $this->hasMany(Bout::class);
    }

    public function championships()
    {
        return $this->hasMany(Championship::class);
    }
}
