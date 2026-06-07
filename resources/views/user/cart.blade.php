@extends('layouts.app')

@section('title', 'Your Cart')

@section('styles')
<style>
.container { padding:40px; }
table { width:100%; background:#fff; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); border-collapse:collapse; }
th, td { padding:15px; text-align:center; border-bottom:1px solid #eee; }
.product-img { width:80px; height:80px; object-fit:contain; }
input[type="number"] { width:60px; padding:5px; border:1px solid #ccc; border-radius:4px; }
.btn { background:#ff2e93; color:#fff; padding:6px 12px; border:none; border-radius:6px; cursor:pointer; }
.remove { background:red; text-decoration:none; display:inline-block; }
.total-box { margin-top:20px; text-align:right; font-size:22px; font-weight:bold; }
.place-btn { margin-top:20px; padding:12px 25px; font-size:18px; background:green; color:#fff; border:none; border-radius:8px; cursor:pointer; }
</style>
@endsection

@section('content')
<div class="container">
    <h2>Your Shopping Cart</h2>

    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        
        @forelse($cartItems as $item)
        <tr>
            <td>
                @if($item->product->image)
                    <img src="{{ asset('image/'.$item->product->image) }}" class="product-img">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $item->product->name }}</td>
            <td>₹{{ $item->product->price }}</td>
            <td>
                <form action="{{ route('cart.update') }}" method="POST" style="display:inline-flex; align-items:center; gap:5px;">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                    <input type="number" name="qty" value="{{ $item->quantity }}" min="1">
                    <button type="submit" class="btn">Update</button>
                </form>
            </td>
            <td>₹{{ $item->product->price * $item->quantity }}</td>
            <td>
                <a href="{{ route('cart.remove', $item->id) }}" class="btn remove">Remove</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Your cart is empty.</td>
        </tr>
        @endforelse
    </table>

    <div class="total-box">
        Grand Total : ₹{{ $grandTotal }}
    </div>

    @if($cartItems->count() > 0)
    <form action="{{ route('checkout.place') }}" method="POST" style="text-align:right;">
        @csrf
        <button type="submit" class="place-btn">Proceed to Payment</button>
    </form>
    @endif
</div>
@endsection
