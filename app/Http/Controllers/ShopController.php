<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        
        $query = Product::with(['category', 'reviews']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('min')) {
            $query->where('price', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('price', '<=', $request->max);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('user.products', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);
        
        // Fetch related products from same category (excluding current)
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->take(4)
                                  ->get();
                                  
        return view('user.product_details', compact('product', 'relatedProducts'));
    }
}
