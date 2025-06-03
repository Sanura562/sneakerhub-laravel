<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items',
        'address',
        'total',
        'payment_method',
        'status'
    ];
}