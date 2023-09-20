<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_id',
        'date',
        'hospital',
        'treatment',
        'medicine',
        'fee',
        'memo',
    ];

    public function cat()
    {
        return $this->belongsTo('App\Models\Cat');
    }

    public function disease()
    {
        return $this->belongsToMany('App\Models\Disease');
    }
}
