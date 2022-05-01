<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'paragraph',
        'button',
        'link',
        'image_name',
        'type',
        'created_at',
        'updated_at',
    ];
}
