<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetYear extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function areaAttachments(): HasMany
    {
        return $this->hasMany(AreaAttachment::class);
    }

    public function areaVisions(): HasMany
    {
        return $this->hasMany(AreaVision::class);
    }

    public function areaMissions(): HasMany
    {
        return $this->hasMany(AreaMission::class);
    }

    public function areaGoals(): HasMany
    {
        return $this->hasMany(AreaGoal::class);
    }

    public function areaStrategies(): HasMany
    {
        return $this->hasMany(AreaStrategy::class);
    }

    public function areaTargets(): HasMany
    {
        return $this->hasMany(AreaTarget::class);
    }

    public function areaPaOfManagers(): HasMany
    {
        return $this->hasMany(AreaPaOfManager::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function activityInnovations(): HasMany
    {
        return $this->hasMany(ActivityInnovation::class);
    }

    public function relateGroups(): HasMany
    {
        return $this->hasMany(RelateGroup::class);
    }

    public function relateTypes(): HasMany
    {
        return $this->hasMany(RelateType::class);
    }

    public function relateItems(): HasMany
    {
        return $this->hasMany(RelateItem::class);
    }

    public function relateItemTargetValues(): HasMany
    {
        return $this->hasMany(RelateItemTargetValue::class);
    }
}
