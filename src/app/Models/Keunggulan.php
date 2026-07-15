<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keunggulan extends Model
{
    use HasFactory;

    protected $table = 'keunggulans';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];
}
