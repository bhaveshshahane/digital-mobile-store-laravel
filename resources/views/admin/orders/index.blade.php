@extends('layouts.admin')

@section('title', 'Admin - Orders')
@section('header', 'All Orders')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
/* Custom datatables tailwind tweaks */
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    padding: 0.35rem 0.75rem;
    outline: none;
    margin-left: 0.5rem;
}
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
}
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    padding: 0.25rem 1.5rem 0.25rem 0.5rem;
    outline: none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, 
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: linear-gradient(to right, #2563eb, #06b6d4) !important;
    color: white !important;
    border: none !important;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    border-radius: 0.5rem;
    margin: 0 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f8fafc !important;
    color: #1e293b !important;
    border-color: #e2e8f0 !important;
}
table.dataTable.no-footer {
    border-bottom: 1px solid #e2e8f0;
}
table.dataTable thead th, table.dataTable thead td {
    border-bottom: 1px solid #e2e8f0;
}
.dataTables_wrapper {
    font-family: 'Poppins', sans-serif;
    color: #475569;
}
</style>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 overflow-x-auto">
        <table id="ordersTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-sm">
                    <th class="py-4 px-4 font-semibold border-b border-slate-200 rounded-tl-lg">Order ID</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Customer</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Total Amount</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Payment</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Address</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Status</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200 rounded-tr-lg">Date</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($orders as $order)
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                    <td class="py-3 px-4 text-slate-500 font-medium">#{{ $order->id }}</td>
                    <td class="py-3 px-4 font-bold text-slate-800">{{ $order->user->fname ?? 'Unknown' }} {{ $order->user->lname ?? '' }}</td>
                    <td class="py-3 px-4 font-black text-emerald-600">₹{{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 bg-slate-100 text-slate-700 border border-slate-200 rounded-lg text-xs font-semibold shadow-sm uppercase tracking-wider">
                            {{ $order->payment_mode ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-slate-500 max-w-xs truncate" title="{{ $order->address ?? 'N/A' }} (Pin: {{ $order->pincode ?? 'N/A' }})">
                        {{ $order->address ?? 'N/A' }} (Pin: {{ $order->pincode ?? 'N/A' }})
                    </td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 {{ $order->status === 'pending' ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-emerald-50 text-emerald-600 border-emerald-200' }} border rounded-lg text-xs font-bold shadow-sm flex items-center w-max gap-1">
                            @if($order->status === 'pending')
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @else
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @endif
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-slate-500 font-medium">{{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            responsive: true,
            order: [[0, 'desc']], // Sort by Order ID descending by default
            language: {
                search: "Search Orders:",
                lengthMenu: "Show _MENU_ orders"
            }
        });
    });
</script>
@endsection
