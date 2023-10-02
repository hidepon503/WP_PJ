<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cat_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function cats()
    {
        return $this->belongsToMany(Cat::class, 'user_cats')
                    ->withPivot(['started_at', 'ended_at', 'relationship_type'])
                    ->withTimestamps();
    }
    
    public function favoriteCats()
    {
        return $this->belongsToMany(Cat::class, 'favorites');
    }

    public function userPosts()
    {
        return $this->hasMany(UserPost::class);
    }

    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

}
