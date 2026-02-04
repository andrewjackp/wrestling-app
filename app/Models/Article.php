<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function promotion()
    {
        return $this->belongsTo(\App\Models\Promotion::class);
    }
}
