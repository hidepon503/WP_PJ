<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'body',
        'image',
    ];

    public function cat()
    {
        return $this->belongsTo('App\Models\Cat');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
        public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function videos()
    {
        return $this->hasMany(PostVideo::class);
    }
}
