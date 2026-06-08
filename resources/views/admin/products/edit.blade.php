@extends('layouts.admin')

@section('title', 'Admin - Edit Product')
@section('header', 'Edit Product')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
    <form id="editProductForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Product Name <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="e.g. iPhone 15 Pro Max"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700">
                <span class="text-xs text-rose-500 mt-1 hidden error-msg" id="error-name"></span>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Price (₹) <span class="text-rose-500">*</span></label>
                <input type="number" name="price" min="1" step="0.01" value="{{ old('price', $product->price) }}" placeholder="0.00"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700">
                <span class="text-xs text-rose-500 mt-1 hidden error-msg" id="error-price"></span>
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Stock Quantity <span class="text-rose-500">*</span></label>
                <input type="number" name="stock" min="0" value="{{ old('stock', $product->stock) }}" placeholder="e.g. 50"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700">
                <span class="text-xs text-rose-500 mt-1 hidden error-msg" id="error-stock"></span>
            </div>

            <!-- Category -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Category <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <select name="category_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 appearance-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                <span class="text-xs text-rose-500 mt-1 hidden error-msg" id="error-category_id"></span>
            </div>

            <!-- Description -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="4" placeholder="Briefly describe the product features..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 resize-none">{{ old('description', $product->description) }}</textarea>
                <span class="text-xs text-rose-500 mt-1 hidden error-msg" id="error-description"></span>
            </div>

            <!-- Product Image -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Product Image (Leave blank to keep current)</label>
                <div class="flex items-start gap-6">
                    <div class="flex-1">
                        <label for="imageUpload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-slate-500"><span class="font-semibold text-blue-600">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-slate-500">PNG, JPG, JPEG up to 2MB</p>
                            </div>
                            <input id="imageUpload" type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event)" />
                        </label>
                        <span class="text-xs text-rose-500 mt-1 hidden error-msg" id="error-image"></span>
                    </div>
                    
                    <div id="imagePreviewContainer" class="{{ !$product->image ? 'hidden' : '' }} w-32 h-32 rounded-xl border border-slate-200 bg-slate-50 overflow-hidden flex-shrink-0 relative shadow-sm">
                        <img id="imgPreview" src="{{ $product->image ? asset('image/'.$product->image) : '' }}" class="w-full h-full object-contain p-2">
                        <button type="button" onclick="clearImage()" class="absolute top-1 right-1 bg-white rounded-full p-1 shadow text-slate-400 hover:text-rose-500 transition-colors" title="Reset Image">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-slate-600 hover:bg-slate-100 transition-colors">Cancel</a>
            <button type="submit" id="submitBtn" class="px-8 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <span>Update Product</span>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const originalImage = "{{ $product->image ? asset('image/'.$product->image) : '' }}";

    function previewImage(event){
        const file = event.target.files[0];
        if(!file) return;
        
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('imgPreview');
            const container = document.getElementById('imagePreviewContainer');
            output.src = reader.result;
            container.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }

    function clearImage() {
        document.getElementById('imageUpload').value = '';
        const output = document.getElementById('imgPreview');
        const container = document.getElementById('imagePreviewContainer');
        
        if (originalImage) {
            output.src = originalImage;
        } else {
            output.src = '';
            container.classList.add('hidden');
        }
    }

    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        };

        $('#editProductForm').validate({
            rules: {
                name: "required",
                price: {
                    required: true,
                    number: true,
                    min: 1
                },
                stock: {
                    required: true,
                    digits: true,
                    min: 0
                },
                category_id: "required"
            },
            messages: {
                name: "Please enter the product name",
                price: {
                    required: "Please enter the price",
                    number: "Please enter a valid number",
                    min: "Price must be at least ₹1"
                },
                stock: {
                    required: "Please enter the stock quantity",
                    digits: "Please enter a valid whole number",
                    min: "Stock cannot be negative"
                },
                category_id: "Please select a category"
            },
            errorElement: 'span',
            errorClass: 'text-xs text-rose-500 mt-1 block',
            submitHandler: function(form) {
                let $btn = $('#submitBtn');
                let originalContent = $btn.html();
                let formData = new FormData(form);

                // Reset server errors
                $('.error-msg').text('').addClass('hidden');
                
                $btn.html('<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span>Updating...</span>');
                $btn.prop('disabled', true);

                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if(response.success) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        $btn.html(originalContent);
                        $btn.prop('disabled', false);
                        
                        if (xhr.status === 422) {
                            toastr.error('Please fix the errors below.');
                            let errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                $(`#error-${field}`).text(errors[field][0]).removeClass('hidden');
                            }
                        } else {
                            toastr.error('Something went wrong. Please try again.');
                        }
                    }
                });
                return false; // Prevent normal form submission
            }
        });
    });
</script>
@endsection
