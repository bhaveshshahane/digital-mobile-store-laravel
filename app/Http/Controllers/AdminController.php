<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $total_products = Product::count();
        $total_orders = Order::count();
        $total_sales = Order::sum('total_amount');

        return view('admin.dashboard', compact('total_users', 'total_products', 'total_orders', 'total_sales'));
    }
}
