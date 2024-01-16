<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function items () : HasMany {
        return $this->hasMany(RelateItem::class);
    }
}
