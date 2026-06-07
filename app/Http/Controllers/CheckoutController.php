<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user_id = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $user_id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // Create Order
        $order = Order::create([
            'user_id' => $user_id,
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

        // Save Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Clear Cart
        Cart::where('user_id', $user_id)->delete();

        // Store order ID in session for next steps
        $request->session()->put('order_id', $order->id);

        return redirect()->route('checkout.payment');
    }

    public function payment(Request $request)
    {
        if (!$request->session()->has('order_id')) {
            return redirect()->route('cart.index')->with('error', 'Please go through cart first.');
        }
        return view('user.payment');
    }

    public function processPayment(Request $request)
    {
        if (!$request->session()->has('order_id')) {
            return redirect()->route('cart.index');
        }

        $data = $request->validate([
            'address' => 'required|string',
            'pincode' => 'required|string',
            'payment_mode' => 'required|in:COD,Online'
        ]);

        $orderId = $request->session()->get('order_id');
        $order = Order::find($orderId);
        
        if ($order) {
            $order->update([
                'address' => $data['address'],
                'pincode' => $data['pincode'],
                'payment_mode' => $data['payment_mode']
            ]);
        }

        if ($data['payment_mode'] == 'Online') {
            $request->session()->put('online_order_id', $orderId);
            $request->session()->forget('order_id');
            return redirect()->route('checkout.online');
        } else {
            $request->session()->forget('order_id');
            return redirect()->route('checkout.success');
        }
    }

    public function onlinePayment(Request $request)
    {
        if (!$request->session()->has('online_order_id')) {
            return redirect()->route('home');
        }
        return view('user.online_payment');
    }

    public function success()
    {
        return view('user.order_success');
    }
}
