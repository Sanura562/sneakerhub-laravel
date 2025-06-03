<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'User_ID',
        'CartID',
        'TotalAmount',
        'Status',
        'ShippingAddress',
        'OrderDate',
        'items',
        'PaymentMethod'
    ];
}