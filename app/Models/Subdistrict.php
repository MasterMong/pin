<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name_in_thai',
        'name_in_english',
        'zip_code',
        'latitude',
        'longitude',
        'province_id',
        'district_id'
    ];
}
