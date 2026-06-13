@extends('layouts.app')

@section('title', 'phoneKART - My Orders')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">My <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">Orders</span></h1>
        <p class="text-white/80 max-w-2xl mx-auto">View and track all your past purchases.</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative -mt-8">
    <div class="bg-white p-6 sm:p-10 rounded-3xl shadow-xl shadow-blue-900/10 border border-slate-100">
        @if($orders->isEmpty())
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-400 mb-6 border-8 border-slate-50/50">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">No Orders Yet</h3>
                <p class="text-slate-500 mb-6">You haven't placed any orders with us.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-200">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <!-- Order Header -->
                        <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-sm text-slate-500 font-medium">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <p class="text-xs text-slate-400">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                            <div class="text-left sm:text-right">
                                <p class="text-sm text-slate-500 font-medium mb-1">Total Amount</p>
                                <p class="text-lg font-bold text-blue-600">₹{{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                        
                        <!-- Order Details & Items -->
                        <div class="px-6 py-6 flex flex-col md:flex-row gap-8">
                            <div class="flex-1 space-y-4">
                                @foreach($order->items as $item)
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center p-2 border border-slate-100 flex-shrink-0 shadow-sm">
                                            @if($item->product->image)
                                                <img src="{{ asset('image/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="max-w-full max-h-full object-contain">
                                            @else
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-slate-800 line-clamp-1">{{ $item->product->name }}</h4>
                                            <div class="flex items-center gap-3 mt-1 text-sm">
                                                <span class="text-slate-500">Qty: {{ $item->qty }}</span>
                                                <span class="text-slate-300">|</span>
                                                <span class="font-medium text-slate-700">₹{{ number_format($item->price, 2) }} each</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="w-full md:w-64 bg-slate-50 rounded-xl p-5 border border-slate-100 h-fit flex-shrink-0">
                                <h4 class="font-semibold text-slate-800 mb-3 text-sm uppercase tracking-wider">Shipping Details</h4>
                                <p class="text-sm text-slate-600 mb-4">{{ $order->address }}<br>PIN: {{ $order->pincode }}</p>
                                
                                <h4 class="font-semibold text-slate-800 mb-2 text-sm uppercase tracking-wider">Payment Method</h4>
                                <p class="text-sm text-slate-600 flex items-center gap-1.5">
                                    @if($order->payment_mode == 'Online')
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    @else
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    @endif
                                    {{ $order->payment_mode == 'Online' ? 'Card Payment' : 'Cash on Delivery' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
