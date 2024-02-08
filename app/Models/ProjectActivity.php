<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ProjectActivity extends Model
{
    use HasFactory, AsSource, Filterable;
    protected $fillable = [
        'area_id',
        'project_id',
        'name',
        'process',
        'do_date',
        'target_area',
        'result',
        'count_beneficiary',
        'is_success',
        'unsuccess_reason'
    ];

    public function project() :BelongsTo {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
