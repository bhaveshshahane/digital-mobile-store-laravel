@extends('layouts.admin')

@section('title', 'Admin - Dashboard')
@section('header', 'Dashboard')

@section('styles')
<style>
.dashboard-cards { display:flex; gap:20px; flex-wrap:wrap; }
.card {
    flex:1; min-width:200px; background:#fff; padding:25px; border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05); border-left:5px solid #ff2e93;
}
.card h3 { color:#777; font-size:16px; margin-bottom:10px; font-weight:500; }
.card h1 { color:#333; font-size:32px; }
</style>
@endsection

@section('content')
<div class="dashboard-cards">
    <div class="card">
        <h3>Total Users</h3>
        <h1>{{ $total_users }}</h1>
    </div>

    <div class="card">
        <h3>Total Products</h3>
        <h1>{{ $total_products }}</h1>
    </div>

    <div class="card">
        <h3>Total Orders</h3>
        <h1>{{ $total_orders }}</h1>
    </div>

    <div class="card">
        <h3>Total Sales</h3>
        <h1>₹{{ number_format($total_sales, 2) }}</h1>
    </div>
</div>
@endsection
