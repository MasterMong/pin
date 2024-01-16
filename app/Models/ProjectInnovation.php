<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInnovation extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'project_id',
        'project_activity_id',
        'attachment_id',
        'name',
        'type',
        'url',
        'detail',
        'use',
        'problem',
        'suggess'
    ];
}
