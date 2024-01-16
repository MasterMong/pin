<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelateType extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'name',
        'budget_year_id',
        'relate_group_id',
        'is_parent',
        'is_single',
        'parent_name'
    ];
}
