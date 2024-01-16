<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RelateGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'budget_year_id',
        'label',
        'order'
    ];

    function types() : HasMany {
        return $this->hasMany(RelateType::class);
    }
}
