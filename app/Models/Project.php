<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        'relate_items',
        'handler_name',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'area_id' => 'integer',
        'budget_year_id' => 'integer',
        'budget' => 'float',
        'area_strategy_id' => 'integer',
        'is_pa_of_manager' => 'boolean',
        'relate_items' => 'array',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function budgetYear(): BelongsTo
    {
        return $this->belongsTo(BudgetYear::class);
    }

    public function areaStrategy(): BelongsTo
    {
        return $this->belongsTo(AreaStrategy::class);
    }
}
