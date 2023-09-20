<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCat extends Model
{
    use HasFactory;

    protected $table = 'user_cats';

    protected $fillable = [
        'user_id',
        'cat_id',
        'started_at',
        'ended_at',
        'relation_id'
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function cat()
    {
        return $this->belongsTo('App\Models\Cat');
    }

    public function relation()
    {
        return $this->belongsTo('App\Models\Relation');
    }
}