@extends('layouts.admin')

@section('title', 'Admin - Enquiries')
@section('header', 'All Enquiries')

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
        <table id="inquiriesTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-sm">
                    <th class="py-4 px-4 font-semibold border-b border-slate-200 rounded-tl-lg">ID</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Name</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Email</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Subject</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200">Message</th>
                    <th class="py-4 px-4 font-semibold border-b border-slate-200 rounded-tr-lg">Date</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($inquiries as $inquiry)
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                    <td class="py-3 px-4 text-slate-500 font-medium">#{{ $inquiry->id }}</td>
                    <td class="py-3 px-4 font-bold text-slate-800">{{ $inquiry->name }}</td>
                    <td class="py-3 px-4 text-blue-600">
                        <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                    </td>
                    <td class="py-3 px-4 font-medium text-slate-700 max-w-xs truncate" title="{{ $inquiry->subject }}">{{ $inquiry->subject }}</td>
                    <td class="py-3 px-4 text-slate-500 max-w-md truncate" title="{{ $inquiry->message }}">{{ $inquiry->message }}</td>
                    <td class="py-3 px-4 text-slate-500 font-medium">{{ $inquiry->created_at ? $inquiry->created_at->format('M d, Y h:i A') : 'N/A' }}</td>
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
        $('#inquiriesTable').DataTable({
            responsive: true,
            order: [[0, 'desc']], // Sort by ID descending
            language: {
                search: "Search Enquiries:",
                lengthMenu: "Show _MENU_ entries"
            }
        });
    });
</script>
@endsection
