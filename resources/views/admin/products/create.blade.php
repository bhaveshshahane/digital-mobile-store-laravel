@extends('layouts.admin')

@section('title', 'Admin - Add Product')
@section('header', 'Add Product')

@section('styles')
<style>
.form-box { background:#fff; padding:25px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.08); }
.input-group { margin-bottom:15px; }
.input-group label { display:block; margin-bottom:6px; font-size:14px; font-weight:500; }
.input-group input, .input-group textarea, .input-group select { width:100%; padding:10px; border:1px solid #ccc; border-radius:8px; outline:none; transition:0.3s; }
.input-group input:focus, .input-group textarea:focus, .input-group select:focus { border-color:#ff2e93; }
textarea { height:80px; resize:none; }
.row { display:grid; grid-template-columns:1fr 1fr; gap:15px; }
button { width:100%; padding:12px; background:linear-gradient(to right,#ff2e63,#ff6a88); color:#fff; border:none; border-radius:8px; font-weight:bold; cursor:pointer; margin-top:10px; transition:0.3s; }
button:hover { opacity:0.9; }
.preview { margin-top:10px; width:120px; height:120px; object-fit:cover; border-radius:8px; display:none; border:1px solid #ddd; }
</style>
@endsection

@section('content')
<div class="form-box">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="input-group">
            <label>Product Name</label>
            <input type="text" name="name" required value="{{ old('name') }}">
        </div>

        <div class="input-group">
            <label>Description</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div class="row">
            <div class="input-group">
                <label>Price</label>
                <input type="number" name="price" min="1" step="0.01" required value="{{ old('price') }}">
            </div>
            <div class="input-group">
                <label>Stock</label>
                <input type="number" name="stock" min="0" required value="{{ old('stock') }}">
            </div>
        </div>

        <div class="input-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label>Product Image</label>
            <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
            <img id="imgPreview" class="preview">
        </div>

        <button type="submit">Add Product</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
function previewImage(event){
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('imgPreview');
        output.src = reader.result;
        output.style.display = "block";
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
