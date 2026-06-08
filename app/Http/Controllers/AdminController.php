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

        // Chart Data: Last 7 days sales
        $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        $chartDates = [];
        $chartTotals = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $dateStr = now()->subDays($i)->format('Y-m-d');
            $chartDates[] = now()->subDays($i)->format('M d');
            
            $sale = $salesData->firstWhere('date', $dateStr);
            $chartTotals[] = $sale ? $sale->total : 0;
        }

        $out_of_stock_products = Product::where('stock', '<=', 0)->get();

        $top_reviewed_products = Product::withCount('reviews')
            ->orderByDesc('reviews_count')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('total_users', 'total_products', 'total_orders', 'total_sales', 'chartDates', 'chartTotals', 'out_of_stock_products', 'top_reviewed_products'));
    }
}
