<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaGoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_mision_id',
        'area_id',
        'detail',
    ];
}
