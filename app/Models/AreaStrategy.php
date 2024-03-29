<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaStrategy extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_id',
        'area_goal_id',
        'budget_year_id',
        'detail',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'area_id' => 'integer',
        'area_goal_id' => 'integer',
        'budget_year_id' => 'integer',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function areaGoal(): BelongsTo
    {
        return $this->belongsTo(AreaGoal::class);
    }

    public function budgetYear(): BelongsTo
    {
        return $this->belongsTo(BudgetYear::class);
    }

    public function areaTargets(): HasMany
    {
        return $this->hasMany(AreaTarget::class);
    }

    public function activity(): HasMany
    {
        return  $this->hasMany(Activity::class);
    }
}
