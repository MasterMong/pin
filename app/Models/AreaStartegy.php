<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaStartegy extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_goal_id',
        'area_id',
        'budget_year_id',
        'detail',
    ];
}
