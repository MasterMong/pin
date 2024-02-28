<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaGoal extends Model
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
        'area_vision_id',
        'detail',
        'area_mission_id',
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
        'area_vision_id' => 'integer',
        'area_mission_id' => 'integer',
    ];

    public function scopeByYear(Builder $query, int $budget_year_id)
    {
        $query->where('budget_year_id', $budget_year_id);
    }
    public function scopeByAreaAndYear(Builder $query, int $area_id, int $budget_year_id)
    {
        $query->where('area_id', $area_id)->where('budget_year_id', $budget_year_id);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function budgetYear(): BelongsTo
    {
        return $this->belongsTo(BudgetYear::class);
    }

    public function areaMission(): BelongsTo
    {
        return $this->belongsTo(AreaMission::class);
    }

    public function areaVision(): BelongsTo
    {
        return $this->belongsTo(AreaVision::class);
    }

    public function areaStrategies(): HasMany
    {
        return $this->hasMany(AreaStrategy::class);
    }
}
