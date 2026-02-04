<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Wrestler;

class Promotion extends Model
{
    use HasFactory;

    public function wrestlers() 
    {
        return $this->hasMany(Wrestler::class);
    }

    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class);
    }
    // protected $casts = [
    //     'wrestlers' => 'array',
    // ];
}
