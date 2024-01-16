<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachment_id',
        'name',
        'member_type_id'
    ];
}
