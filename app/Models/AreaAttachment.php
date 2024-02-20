<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AreaAttachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_id',
        'area_attachment_type_id',
        'budget_year_id',
        'attr',
        'area_attachment_types_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'area_id' => 'integer',
        'area_attachment_type_id' => 'integer',
        'budget_year_id' => 'integer',
        'attr' => 'array',
        'area_attachment_types_id' => 'integer',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function areaAttachmentTypes(): BelongsTo
    {
        return $this->belongsTo(AreaAttachmentTypes::class);
    }

    public function budgetYear(): BelongsTo
    {
        return $this->belongsTo(BudgetYear::class);
    }

    public function areaAttachmentType(): BelongsTo
    {
        return $this->belongsTo(\App\Models\AreaAttachmentTypes::class);
    }
}
