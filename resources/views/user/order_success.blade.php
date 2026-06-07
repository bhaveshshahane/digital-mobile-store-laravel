@extends('layouts.app')

@section('title', 'Order Success')

@section('styles')
<style>
.container { width:400px; margin:50px auto; background:#fff; padding:40px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); text-align:center; }
.icon { font-size:50px; color:green; margin-bottom:10px; }
h2 { margin-bottom:10px; }
.btn { display:inline-block; margin-top:20px; padding:10px 20px; background:#ff2e93; color:#fff; text-decoration:none; border-radius:8px; font-weight:bold; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="icon">✅</div>
    <h2>Order Placed Successfully!</h2>
    <p>Thank you for shopping with phoneKART. Your order will be delivered soon.</p>
    
    <a href="{{ route('products.index') }}" class="btn">Continue Shopping</a>
</div>
@endsection
