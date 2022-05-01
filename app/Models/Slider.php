<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'paragraph',
        'badge',
        'button',
        'link',
        'image_name',
        'created_at',
        'updated_at',
    ];
}
