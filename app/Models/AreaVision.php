<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaVision extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'budget_year_id',
        'detail',
    ];
}
