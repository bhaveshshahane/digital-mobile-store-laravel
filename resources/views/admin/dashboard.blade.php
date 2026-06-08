@extends('layouts.admin')

@section('title', 'Admin - Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Total Users -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10 flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Total Users</p>
                <h3 class="text-3xl font-black text-slate-800">{{ $total_users }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-cyan-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10 flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Total Products</p>
                <h3 class="text-3xl font-black text-slate-800">{{ $total_products }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10 flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Total Orders</p>
                <h3 class="text-3xl font-black text-slate-800">{{ $total_orders }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Total Sales -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10 flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Total Sales</p>
                <h3 class="text-3xl font-black text-emerald-600">₹{{ number_format($total_sales, 2) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

</div>

<!-- Quick Actions & Analytics -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col h-80">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-bold text-slate-800">Sales Analytics (Last 7 Days)</h4>
        </div>
        <div class="flex-1 w-full relative">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center h-64">
        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-400">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </div>
        <h4 class="text-lg font-bold text-slate-800 mb-1">Quick Actions</h4>
        <p class="text-slate-500 text-sm mb-4">Manage your store efficiently.</p>
        <div class="flex gap-3">
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 text-white text-sm font-semibold rounded-lg hover:shadow-lg transition-all shadow-blue-500/20">Add Product</a>
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-200 transition-all">View Orders</a>
        </div>
    </div>
</div>

<!-- Out of Stock Products -->
@if(isset($out_of_stock_products) && $out_of_stock_products->count() > 0)
<div class="mt-6 bg-white rounded-2xl shadow-sm border border-rose-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-rose-100 bg-rose-50 flex justify-between items-center">
        <h4 class="text-lg font-bold text-rose-700 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            Out of Stock Alerts
        </h4>
        <span class="px-3 py-1 bg-rose-200 text-rose-800 rounded-full text-xs font-bold">{{ $out_of_stock_products->count() }} items</span>
    </div>
    <div class="divide-y divide-slate-100 max-h-80 overflow-y-auto">
        @foreach($out_of_stock_products as $product)
            <a href="{{ route('admin.products.edit', $product->id) }}" class="flex items-center gap-4 p-4 hover:bg-slate-50 transition-colors group">
                @if($product->image)
                    <img src="{{ asset('image/'.$product->image) }}" class="w-12 h-12 object-contain rounded-lg border border-slate-200 bg-white shadow-sm p-1">
                @else
                    <div class="w-12 h-12 rounded-lg border border-slate-200 bg-slate-100 flex items-center justify-center text-slate-400 text-xs shadow-sm">No Img</div>
                @endif
                <div class="flex-1">
                    <h5 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $product->name }}</h5>
                    <p class="text-sm text-slate-500">{{ $product->category->name ?? 'N/A' }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-slate-800">₹{{ number_format($product->price, 2) }}</p>
                    <p class="text-xs font-semibold text-rose-500">Stock: {{ $product->stock }}</p>
                </div>
                <div class="ml-2 text-slate-300 group-hover:text-blue-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        let gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)'); 
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0.0)'); 

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartDates ?? []) !!},
                datasets: [{
                    label: 'Daily Sales (₹)',
                    data: {!! json_encode($chartTotals ?? []) !!},
                    borderColor: '#2563eb',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { size: 13, family: "'Poppins', sans-serif" },
                        bodyFont: { size: 14, family: "'Poppins', sans-serif", weight: 'bold' },
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return '₹' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { font: { family: "'Poppins', sans-serif", size: 12 }, color: '#64748b' }
                    },
                    y: {
                        grid: { borderDash: [4, 4], color: '#f1f5f9', drawBorder: false },
                        ticks: { 
                            font: { family: "'Poppins', sans-serif", size: 12 }, 
                            color: '#64748b',
                            callback: function(value) { return '₹' + value; }
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
