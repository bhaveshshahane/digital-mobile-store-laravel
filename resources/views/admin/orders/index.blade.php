@extends('layouts.admin')

@section('title', 'Admin - Orders')
@section('header', 'Orders')

@section('styles')
<style>
.table-box { background:#fff; padding:20px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
table { width:100%; border-collapse:collapse; }
table th, table td { padding:12px; text-align:left; border-bottom:1px solid #ddd; }
table th { background:#f4f6f9; color:#333; }
.status { padding:5px 10px; border-radius:20px; font-size:12px; font-weight:bold; }
.status-pending { background:#ffc107; color:#333; }
.status-completed { background:#28a745; color:#fff; }
</style>
@endsection

@section('content')
<div class="table-box">
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Total Amount</th>
                <th>Payment Mode</th>
                <th>Address</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->fname ?? 'Unknown' }} {{ $order->user->lname ?? '' }}</td>
                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                <td>{{ $order->payment_mode ?? 'N/A' }}</td>
                <td>{{ $order->address ?? 'N/A' }} (Pin: {{ $order->pincode ?? 'N/A' }})</td>
                <td>
                    <span class="status {{ $order->status === 'pending' ? 'status-pending' : 'status-completed' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->created_at ? $order->created_at->format('d M, Y') : 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;">No Orders Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
