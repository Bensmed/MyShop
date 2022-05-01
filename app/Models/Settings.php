<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_title',
        'website_description',

        'primary_color',
        'hover_color',
        'transparent_color',

        'email',
        'address',
        'phone1',
        'phone2',

        'logo',
        'favicon',

        'facebook',
        'twitter',
        'instagram',

        'currency',
        'created_at',
        'updated_at',
    ];
}
