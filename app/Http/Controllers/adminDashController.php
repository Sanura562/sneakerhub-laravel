<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class adminDashController extends Controller
{
    public function adminDashboard()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $latestProducts = Product::orderBy('_id', 'desc')->limit(10)->get();

        return view('admin-dashboard', compact('usersCount', 'productsCount', 'ordersCount', 'latestProducts'));
    }
}