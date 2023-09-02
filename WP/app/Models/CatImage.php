<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cat_id',
    ];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
}
