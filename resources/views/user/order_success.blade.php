@extends('layouts.app')

@section('title', 'KART - Order Success')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Order <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">Confirmed</span></h1>
        <p class="text-white/80 max-w-2xl mx-auto">Your order has been placed successfully!</p>
    </div>
</section>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-center relative -mt-8">
    <div class="bg-white p-10 rounded-3xl shadow-xl shadow-blue-900/10 border border-slate-100">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-tr from-blue-600 to-cyan-500 text-white mb-6 shadow-lg shadow-blue-500/30 transform -translate-y-4">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <h2 class="text-3xl font-bold text-slate-800 mb-4">Thank You!</h2>
        
        @if(session('success_order_id'))
            <div class="mb-6 inline-block bg-gradient-to-r from-slate-50 to-blue-50/30 border border-blue-100 px-8 py-4 rounded-2xl shadow-sm">
                <span class="text-sm text-slate-500 uppercase tracking-widest font-semibold block mb-1">Order Number</span>
                <span class="text-2xl font-mono font-bold text-blue-600">#{{ str_pad(session('success_order_id'), 6, '0', STR_PAD_LEFT) }}</span>
            </div>
        @endif
        
        <p class="text-slate-600 mb-8 max-w-md mx-auto leading-relaxed">We've received your order and are processing it right away. A detailed receipt has been sent to your registered email address.</p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-200">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection
