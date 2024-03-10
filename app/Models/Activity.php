<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

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
        'duration',
        'date_start',
        'date_end',
        'q1',
        'q2',
        'q3',
        'q4',
        'process',
        'target_area',
        'relate_items',
        'area_strategy_id',
        'is_pa_of_manager',
        'progress',
        'problem',
        'suggestions',
        'beneficiary',
        'is_success',
        'galleries',
        'urls',
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
        'relate_items' => 'array',
        'area_strategy_id' => 'integer',
        'is_pa_of_manager' => 'boolean',
        'beneficiary' => 'array',
        'is_success' => 'boolean',
        'galleries' => 'array',
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

    public function activityInnovations(): HasMany
    {
        return $this->hasMany(ActivityInnovation::class);
    }

    public function scopeByField($query, $field)
    {
        return $query->where($field, true);
    }
}
