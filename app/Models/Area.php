<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
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
}
