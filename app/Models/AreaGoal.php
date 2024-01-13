<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaGoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'budget_year_id',
        'detail',
    ];

    public function scopeByYear(Builder $query, int $budget_year_id) {
        $query->where('budget_year_id', $budget_year_id);
    }
    public function scopeByAreaAndYear(Builder $query, int $area_id, int $budget_year_id) {
        $query->where('area_id', $area_id)->where('budget_year_id', $budget_year_id);
    }
    public function area(): BelongsTo {
        return $this->belongsTo(Area::class);
    }

    public function mission(): BelongsTo {
        return $this->belongsTo(AreaMission::class);
    }

    public function startegy(): HasMany {
        return $this->hasMany(AreaStartegy::class);
    }
}
