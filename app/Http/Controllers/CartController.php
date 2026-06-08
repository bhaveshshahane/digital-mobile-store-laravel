<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $grandTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('user.cart', compact('cartItems', 'grandTotal'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $product = \App\Models\Product::find($request->product_id);
        
        if (!$product || $product->stock <= 0) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Product is out of stock!']);
            }
            return back()->with('error', 'Product is out of stock!');
        }

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($cart) {
            if ($cart->quantity + 1 > $product->stock) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Cannot add more. Only ' . $product->stock . ' items in stock.']);
                }
                return back()->with('error', 'Cannot add more. Only ' . $product->stock . ' items in stock.');
            }
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            $cartCount = Cart::where('user_id', Auth::id())->count();
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cart_count' => $cartCount
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = Cart::with('product')->where('id', $request->cart_id)->where('user_id', Auth::id())->first();

        if (!$cart) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Cart item not found.']);
            }
            return redirect()->route('cart.index')->with('error', 'Cart item not found.');
        }

        if ($request->qty > $cart->product->stock) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Only ' . $cart->product->stock . ' items available in stock.',
                    'current_qty' => $cart->quantity
                ]);
            }
            return back()->with('error', 'Only ' . $cart->product->stock . ' items available in stock.');
        }

        $cart->update(['quantity' => $request->qty]);

        if ($request->ajax() || $request->wantsJson()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            $grandTotal = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
            $itemTotal = $cart->product->price * $request->qty;

            return response()->json([
                'success' => true,
                'item_total' => $itemTotal,
                'grand_total' => $grandTotal
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
