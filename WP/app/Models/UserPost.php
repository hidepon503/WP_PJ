<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
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
        public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    public function postVideos()
    {
        return $this->hasMany(PostVideo::class);
    }

    public function getFirstMedia()
    {
        // この投稿に関連する最初の画像を取得
        $firstImage = $this->images->first();
        if ($firstImage) {
            $this->media_path = $firstImage->image_path;
            $this->media_type = 'image';
            return;
        }
    
        // この投稿に関連する最初の動画を取得
        $firstVideo = $this->videos->first();
        if ($firstVideo) {
            $this->media_path = $firstVideo->video_path;
            $this->media_type = 'video';
            return;
        }
    }
}
