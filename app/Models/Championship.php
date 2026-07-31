<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'promotion_id', 'current_holder_id', 'won_date'];

    protected $casts = ['won_date' => 'date'];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function holder()
    {
        return $this->belongsTo(Wrestler::class, 'current_holder_id');
    }
}
