@extends('layouts.admin')

@section('title', 'Product Reviews - Admin Panel')
@section('header', 'Product Reviews')

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* Custom DataTables Styling */
    .dataTables_wrapper .dataTables_length select {
        border-radius: 0.5rem;
        border-color: #cbd5e1;
        padding: 0.25rem 2rem 0.25rem 0.5rem;
        background-color: #f8fafc;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 0.5rem;
        border: 1px solid #cbd5e1;
        padding: 0.35rem 0.75rem;
        background-color: #f8fafc;
        outline: none;
        margin-left: 0.5rem;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }
    .dataTables_wrapper .dataTables_info {
        color: #64748b;
        font-size: 0.875rem;
        padding-top: 1.5rem;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 1rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.5rem;
        border: 1px solid transparent;
        margin: 0 2px;
        background: transparent;
        color: #475569 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb !important;
        font-weight: 600;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #1e293b !important;
    }
    table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;
    }
    table.dataTable thead th {
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        background: #f8fafc;
        padding: 1rem;
    }
</style>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <!-- Header & Product Filter -->
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-800">All Reviews</h3>
            <p class="text-sm text-slate-500 mt-1">View and manage all customer product reviews.</p>
        </div>
        <div class="w-full sm:w-72">
            <label class="sr-only">Filter by Product</label>
            <div class="relative mt-1">
                <select id="productFilter" class="w-full pl-10 pr-10 px-2.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none appearance-none transition-all cursor-pointer font-medium shadow-sm">
                    <option value="">All Products</option>
                    @foreach($products as $product)
                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                {{-- <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-3 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </div> --}}
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="p-6 overflow-x-auto">
        <table id="reviewsTable" class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($reviews as $review)
                    <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 font-medium text-slate-900">#{{ str_pad($review->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center p-1 border border-slate-200">
                                    @if($review->product->image)
                                        <img src="{{ asset('image/'.$review->product->image) }}" class="max-w-full max-h-full object-contain">
                                    @else
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <a href="{{ route('products.show', $review->product->id) }}" target="_blank" class="font-bold text-slate-800 hover:text-blue-600 truncate max-w-[200px]" title="{{ $review->product->name }}">
                                    {{ $review->product->name }}
                                </a>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->fname) }}&background=eff6ff&color=2563eb" alt="Avatar" class="w-8 h-8 rounded-full border border-slate-200">
                                <div class="font-semibold text-slate-700">{{ $review->user->fname }} {{ $review->user->lname }}</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-1 bg-amber-50 px-2.5 py-1 rounded-md w-fit">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="font-bold text-amber-600">{{ $review->rating }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">
                            <div class="truncate max-w-[250px]" title="{{ $review->comment }}">
                                {{ $review->comment ?: '-' }}
                            </div>
                        </td>
                        <td class="p-4 text-slate-500 text-xs font-medium">
                            {{ $review->created_at->format('M d, Y h:i A') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#reviewsTable').DataTable({
            "order": [[ 5, "desc" ]], // Sort by date descending by default
            "pageLength": 10,
            "columnDefs": [
                { "orderable": false, "targets": [4] } // Disable sorting on Comment
            ],
            "language": {
                "search": "",
                "searchPlaceholder": "Search reviews...",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ reviews",
                "infoEmpty": "No reviews found",
                "infoFiltered": "(filtered from _MAX_ total reviews)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Prev"
                }
            }
        });

        // Custom Product Filter Logic
        $('#productFilter').on('change', function() {
            var selectedProduct = $(this).val();
            // Assuming the Product Name is in the 2nd column (index 1)
            // Use regex true, smart false to ensure exact/partial match as needed
            if (selectedProduct) {
                table.column(1).search('^' + $.fn.dataTable.util.escapeRegex(selectedProduct) + '$', true, false).draw();
            } else {
                table.column(1).search('').draw();
            }
        });
    });
</script>
@endsection
