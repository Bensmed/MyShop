<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processing extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_address',
        'client_wilaya',
        'client_commune',
        'client_phone',
        'amount',
        'status',
        'order_details',
        'created_at',
        'updated_at',
    ];
}
