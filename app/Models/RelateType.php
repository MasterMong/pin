<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelateType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'name',
        'budget_year_id',
        'relate_group_id',
        'is_parent',
        'is_single',
        'parent_name',
        'order',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'budget_year_id' => 'integer',
        'relate_group_id' => 'integer',
        'is_parent' => 'boolean',
        'is_single' => 'boolean',
    ];

    public function budgetYear(): BelongsTo
    {
        return $this->belongsTo(BudgetYear::class);
    }

    public function relateGroup(): BelongsTo
    {
        return $this->belongsTo(RelateGroup::class);
    }
}
