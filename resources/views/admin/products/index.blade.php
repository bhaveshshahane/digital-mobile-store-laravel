@extends('layouts.admin')

@section('title', 'Admin - Products')
@section('header', 'All Products')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
<div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <h3 class="text-xl font-bold text-slate-800"></h3>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add New Product
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 overflow-x-auto">
        <table id="productsTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-sm">
                    <th class="py-4 px-4 font-semibold border-b border-slate-200 rounded-tl-lg">ID</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Image</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Name</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Category</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Price</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Stock</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200 rounded-tr-lg text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($products as $product)
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                    <td class="py-3 px-4 text-slate-500 font-medium">#{{ $product->id }}</td>
                    <td class="py-3 px-4">
                        @if($product->image)
                            <img src="{{ asset('image/'.$product->image) }}" class="w-14 h-14 object-contain rounded-xl border border-slate-200 bg-white shadow-sm p-1.5 transition-transform hover:scale-110">
                        @else
                            <div class="w-14 h-14 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-400 text-xs shadow-sm">No Img</div>
                        @endif
                    </td>
                    <td class="py-3 px-4 font-bold text-slate-800">{{ $product->name }}</td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-lg text-xs font-semibold shadow-sm">{{ $product->category->name ?? 'N/A' }}</span>
                    </td>
                    <td class="py-3 px-4 font-black text-emerald-600">₹{{ number_format($product->price, 2) }}</td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 {{ $product->stock > 0 ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-rose-50 text-rose-600 border-rose-100' }} border rounded-lg text-xs font-bold shadow-sm">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition-colors shadow-sm" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="m-0 inline-block delete-form">
                                @csrf
                                <button type="button" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-lg transition-colors shadow-sm delete-btn" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        };

        let table = $('#productsTable').DataTable({
            responsive: true,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries"
            },
            columnDefs: [
                { orderable: false, targets: [1, 6] } // Disable sorting on Image and Action columns
            ]
        });

        // Handle delete button click using event delegation (so it works on paginated rows)
        $('#productsTable').on('click', '.delete-btn', function(e) {
            e.preventDefault();
            let btn = $(this);
            let form = btn.closest('.delete-form');
            let tr = btn.closest('tr');
            let url = form.attr('action');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this product deletion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl shadow-md font-semibold px-5 py-2.5',
                    cancelButton: 'rounded-xl font-semibold px-5 py-2.5'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let originalHtml = btn.html();
                    btn.html('<svg class="animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>');
                    btn.prop('disabled', true);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: form.serialize(),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            if(response.success) {
                                // Remove the row directly from DataTable without reloading the page
                                table.row(tr).remove().draw(false);
                                toastr.success(response.message);
                            }
                        },
                        error: function() {
                            btn.html(originalHtml);
                            btn.prop('disabled', false);
                            toastr.error('Something went wrong. Please try again.');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
