<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaTarget extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'area_startegy_id',
        'budget_year_id',
        'name',
        'indicator',
        'unit',
        'target_value',
    ];
}
