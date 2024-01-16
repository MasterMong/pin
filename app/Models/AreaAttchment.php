<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaAttchment extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'area_attchment_type_id',
        'budget_year_id',
        'attchment_id',
        'attr'
    ];
}
