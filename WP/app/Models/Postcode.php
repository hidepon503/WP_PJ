<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    use HasFactory;

    protected $fillable = ['postcode', 'prefecture', 'city', 'town'];
    
    // テーブル名を明示的に指定する場合（この例では不要です）
    // protected $table = 'postcodes';

    // timestampカラムがテーブルにない場合、以下の行を追加します。
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function admins()
    {
        return $this->hasMany('App\Models\Admin');
    }
}
