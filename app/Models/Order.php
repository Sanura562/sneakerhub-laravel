<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
    'Order_ID',
    'User_ID',
    'CartID',
    'TotalAmount',
    'Status',
    'ShippingAddress',
    'OrderDate'
];
}