<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVideo extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'video_path'];

    public function userPosts()
    {
        return $this->belongsTo(UserPost::class);
    }

    public function postCats()
    {
        return $this->belongsTo(PostCat::class);
    }
}
