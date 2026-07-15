<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';

    protected $fillable = [
        'image',
        'caption',
        'kategori',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
