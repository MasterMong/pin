<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

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
        'school_count',
        'member_count',
        'website',
        'latitude',
        'longtitude',
        'etc',
    ];

    protected $allowedSorts = [
        'name'
    ];

    public function scopeByInspection($query, $inspection_id)
    {
        return $query->where('inspection_id', $inspection_id);
    }

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
}
