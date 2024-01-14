<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;

class Area extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'code',
        'area_type_id',
        'name',
        'region_id',
        'inspection_id',
        'address',
        'district_id',
        'province_id',
        'zip_code',
        'tel',
        'num_school',
        'num_teacher',
        'num_student',
        'num_person',
        'website',
        'latitude',
        'longtitude',
        'etc',
    ];

    protected $allowedSorts = [
        'name'
    ];

    protected $allowedFilters = [
        'name'        => Like::class,
    ];

    public function scopeByInspection($query, $inspection_id)
    {
        return $query->where('inspection_id', $inspection_id);
    }

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function vision() : HasOne {
        return $this->hasOne(AreaVision::class);
    }

    // public function hasVision() : bool {
    //     return $this->vision()->exists();
    // }

    function type(): BelongsTo {
        return $this->belongsTo(AreaType::class, 'area_type_id', 'id');
    }
}
