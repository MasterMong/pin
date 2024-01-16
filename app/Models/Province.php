<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Province extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'code',
        'name_in_thai',
        'name_in_english',
        'region_id'
    ];
}
