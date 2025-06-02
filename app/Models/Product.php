<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model as Eloquent;



class Product extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
    'ProductID',
    'Name',
    'Description',
    'Price',
    'StockQuantity',
    'Brand',
    'Category',
    'Discount_Price',
    'img_url'
    
];
}