<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'des'
    ];

    function areas() : HasMany {
        return $this->hasMany(Area::class);
    }
}
