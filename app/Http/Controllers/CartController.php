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

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => 1
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

        Cart::where('id', $request->cart_id)->where('user_id', Auth::id())->update(['quantity' => $request->qty]);

        if ($request->ajax() || $request->wantsJson()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            $grandTotal = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
            $item = Cart::with('product')->find($request->cart_id);
            $itemTotal = $item->product->price * $item->quantity;

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
