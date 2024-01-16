<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelateItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'budget_year_id',
        'label',
        'ref',
        'parent_item_ref',
        'req_value'
    ];
}
