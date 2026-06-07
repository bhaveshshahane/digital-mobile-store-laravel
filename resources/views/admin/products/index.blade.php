@extends('layouts.admin')

@section('title', 'Admin - Products')
@section('header', 'Products')

@section('styles')
<style>
.table-box { background:#fff; padding:20px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
table { width:100%; border-collapse:collapse; }
table th, table td { padding:12px; text-align:left; border-bottom:1px solid #ddd; }
table th { background:#f4f6f9; color:#333; }
.product-img { width:60px; height:60px; object-fit:contain; border-radius:8px; border:1px solid #ddd; }
.action-btn { padding:6px 12px; text-decoration:none; color:#fff; border-radius:5px; font-size:14px; margin-right:5px; display:inline-block; }
.btn-edit { background:#007bff; }
.btn-delete { background:#dc3545; border:none; cursor:pointer; }
.add-btn { display:inline-block; margin-bottom:15px; padding:10px 20px; background:#28a745; color:#fff; text-decoration:none; border-radius:8px; font-weight:bold; }
</style>
@endsection

@section('content')
<div class="table-box">
    <a href="{{ route('admin.products.create') }}" class="add-btn">+ Add New Product</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('image/'.$product->image) }}" class="product-img">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>₹{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn btn-edit">Edit</a>
                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        <button type="submit" class="action-btn btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
