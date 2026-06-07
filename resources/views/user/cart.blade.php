@extends('layouts.app')

@section('title', 'KART - Your Cart')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Shopping <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">Cart</span></h1>
        <p class="text-white/80 max-w-2xl mx-auto">Review your items and proceed to checkout.</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if($cartItems->count() > 0)
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <!-- Cart Items -->
            <div class="w-full lg:flex-1 space-y-4">
                @foreach($cartItems as $item)
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 flex flex-col sm:flex-row items-center gap-6 group">
                        <!-- Image -->
                        <div class="w-24 h-24 sm:w-32 sm:h-32 flex-shrink-0 bg-slate-50 rounded-xl p-3 flex items-center justify-center overflow-hidden">
                            @if($item->product->image)
                                <img src="{{ asset('image/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="max-w-full max-h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-300">
                            @else
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        
                        <!-- Details -->
                        <div class="flex-1 w-full flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-slate-800 line-clamp-2">{{ $item->product->name }}</h3>
                                <p class="text-sm font-medium text-slate-500">Unit Price: <span class="text-slate-700">₹{{ number_format($item->product->price, 2) }}</span></p>
                            </div>
                            
                            <!-- Qty & Total -->
                            <div class="flex items-center gap-6 sm:gap-10">
                                <div class="flex flex-col items-start sm:items-center gap-1">
                                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Qty</label>
                                    <input type="number" 
                                           class="qty-input w-20 px-3 py-2 text-center rounded-lg border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all" 
                                           value="{{ $item->quantity }}" 
                                           min="1" 
                                           data-cart-id="{{ $item->id }}">
                                </div>
                                <div class="flex flex-col items-end gap-1 min-w-[100px]">
                                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total</label>
                                    <div class="text-lg font-black text-blue-600 item-total" data-cart-id="{{ $item->id }}">₹{{ number_format($item->product->price * $item->quantity, 2) }}</div>
                                </div>
                                
                                <a href="{{ route('cart.remove', $item->id) }}" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-colors" title="Remove Item">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Order Summary -->
            <div class="w-full lg:w-96 flex-shrink-0">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 md:sticky md:top-24">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center text-slate-600">
                            <span>Subtotal</span>
                            <span class="font-medium" id="grand-total-sub">₹{{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600">
                            <span>Shipping</span>
                            <span class="font-medium text-emerald-600">Free</span>
                        </div>
                        <div class="border-t border-slate-100 pt-4 mt-4 flex justify-between items-center">
                            <span class="text-base font-bold text-slate-800">Grand Total</span>
                            <span class="text-2xl font-black text-blue-600" id="grand-total">₹{{ number_format($grandTotal, 2) }}</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('checkout.place') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                            Proceed to Checkout
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="py-16 text-center bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-50 mb-6">
                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Your cart is empty</h3>
            <p class="text-slate-500 mb-8 max-w-md mx-auto">Looks like you haven't added anything to your cart yet. Browse our products to find something you'll love.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qtyInputs = document.querySelectorAll('.qty-input');
    
    qtyInputs.forEach(input => {
        input.addEventListener('change', function() {
            const cartId = this.getAttribute('data-cart-id');
            const qty = this.value;
            
            if(qty < 1) {
                this.value = 1;
                return;
            }

            // Optional: add a small loading state to the total
            const itemTotalEl = document.querySelector(`.item-total[data-cart-id="${cartId}"]`);
            if(itemTotalEl) itemTotalEl.style.opacity = '0.5';

            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    cart_id: cartId,
                    qty: qty
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Format numbers with commas and 2 decimals
                    const formatCurrency = (amount) => {
                        return '₹' + new Intl.NumberFormat('en-IN', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }).format(amount);
                    };

                    // Update Item Total
                    if(itemTotalEl) {
                        itemTotalEl.textContent = formatCurrency(data.item_total);
                        itemTotalEl.style.opacity = '1';
                    }

                    // Update Grand Total
                    const grandTotalEl = document.getElementById('grand-total');
                    const grandTotalSubEl = document.getElementById('grand-total-sub');
                    if(grandTotalEl) grandTotalEl.textContent = formatCurrency(data.grand_total);
                    if(grandTotalSubEl) grandTotalSubEl.textContent = formatCurrency(data.grand_total);
                    
                    toastr.success('Cart updated successfully');
                } else {
                    toastr.error('Failed to update cart');
                    if(itemTotalEl) itemTotalEl.style.opacity = '1';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('An error occurred');
                if(itemTotalEl) itemTotalEl.style.opacity = '1';
            });
        });
    });
});
</script>
@endsection
