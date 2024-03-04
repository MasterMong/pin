<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Area extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'address',
        'zip_code',
        'tel',
        'num_person',
        'num_school',
        'num_teacher',
        'num_student',
        'website',
        'latitude',
        'longitude',
        'inspection_area_id',
        'area_type_id',
        'district_id',
        'province_id',
        'region_id',
        'etc',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inspection_area_id' => 'integer',
        'area_type_id' => 'integer',
        'district_id' => 'integer',
        'province_id' => 'integer',
        'region_id' => 'integer',
        'etc' => 'array',
    ];

    public function inspectionArea(): BelongsTo
    {
        return $this->belongsTo(InspectionArea::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function areaType(): BelongsTo
    {
        return $this->belongsTo(AreaType::class);
    }

    public function areaMembers(): HasMany
    {
        return $this->hasMany(AreaMember::class);
    }

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

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function projectActivities(): HasMany
    {
        return $this->hasMany(ProjectActivity::class);
    }

    public function projectInnovations(): HasMany
    {
        return $this->hasMany(ProjectInnovation::class);
    }
}
