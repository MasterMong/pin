<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelateItemTargetValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'budget_year_id',
        'relate_item_id',
        'value'
    ];
}
