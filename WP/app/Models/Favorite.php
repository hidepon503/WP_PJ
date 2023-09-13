<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // このテーブルのカラムは、$fillable または $guarded を使用して大量代入から保護する必要があります
    protected $fillable = ['user_id', 'cat_id'];

    /**
     * このお気に入りが関連づけられているユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * このお気に入りが関連づけられている猫
     */
    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
}
