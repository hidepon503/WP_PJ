<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'image_path'];

    public function userPosts()
    {
        return $this->belongsTo(UserPost::class);
    }

    public function postCats()
    {
        return $this->belongsTo(PostCat::class);
    }
}
