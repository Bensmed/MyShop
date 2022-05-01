<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_name',
        'price',
        'sale_price',
        'on_sale',
        'category_id',
        'in_stock',
        'created_at',
        'updated_at',
    ];


    /**
     * Relationship with Category table
     */
    public function category()
    {

        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
