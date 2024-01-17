<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'budget_year_id',
        'name',
        'code',
        'objective',
        'indicator',
        'duration',
        'date_start',
        'date_end',
        'budget',
        'area_strategy_id',
        'is_pa_of_manager',
        'problem',
        'suggestions',
        'progress',
        'relate_type_id',
        'relate_item_id',
        'handler_name'
    ];
}
