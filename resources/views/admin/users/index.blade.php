@extends('layouts.admin')

@section('title', 'Admin - Users')
@section('header', 'Users')

@section('styles')
<style>
.table-box { background:#fff; padding:20px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
table { width:100%; border-collapse:collapse; }
table th, table td { padding:12px; text-align:left; border-bottom:1px solid #ddd; }
table th { background:#f4f6f9; color:#333; }
</style>
@endsection

@section('content')
<div class="table-box">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->fname }}</td>
                <td>{{ $user->lname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at ? $user->created_at->format('d M, Y') : 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">No Users Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
