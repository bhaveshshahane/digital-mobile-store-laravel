<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product = Product::findOrFail($productId);
        
        // Prevent duplicate reviews
        $existingReview = Review::where('product_id', $productId)
                                ->where('user_id', Auth::id())
                                ->first();
                                
        if ($existingReview) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'You have already reviewed this product.']);
            }
            return back()->with('error', 'You have already reviewed this product.');
        }

        $review = Review::create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Thank you for your review!',
                'review' => [
                    'user_name' => Auth::user()->fname . ' ' . Auth::user()->lname,
                    'user_fname' => Auth::user()->fname,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'date' => $review->created_at->format('M d, Y')
                ]
            ]);
        }

        return back()->with('success', 'Thank you for your review!');
    }
}
