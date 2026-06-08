<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['product', 'user'])->latest()->get();
        $products = Product::orderBy('name')->get();

        return view('admin.reviews.index', compact('reviews', 'products'));
    }
}
