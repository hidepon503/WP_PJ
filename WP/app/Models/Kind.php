<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public function cats()
    {
        return $this->hasMany('App\Models\Cat');
    }
}
