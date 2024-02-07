<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Project extends Model
{
    use HasFactory, AsSource, Filterable;
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
        'handler_name',
        'relate_items'
    ];

    protected $casts = [
        'relate_items' => 'array'
    ];

    public function strategy() :HasOne {
        return $this->hasOne(AreaStrategy::class, 'id', 'area_strategy_id');
    }
}
