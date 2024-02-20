<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Area extends Model
{
    use HasFactory;

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
}
