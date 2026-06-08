@extends('layouts.app')

@section('title', 'phoneKART - Products')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">Collection</span></h1>
        <p class="text-white/80 max-w-2xl mx-auto">Discover the latest and greatest in mobile technology.</p>
    </div>
</section>

<div class="px-4 sm:px-6 lg:px-8 py-10 flex flex-col md:flex-row gap-8 items-start">
    <!-- Sidebar -->
    <aside class="w-full md:w-72 flex-shrink-0 bg-white p-6 rounded-2xl shadow-sm border border-slate-200 md:sticky md:top-24">
        <div class="flex items-center gap-2 mb-6 border-b border-slate-100 pb-4">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            <h2 class="text-lg font-bold text-slate-800">Filters</h2>
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Category</label>
                <div class="relative">
                    <select name="category" class="w-full pl-4 pr-10 py-2.5 rounded-lg border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none appearance-none transition-all cursor-pointer">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Price Range</label>
                <div class="flex items-center gap-2">
                    <input type="number" name="min" placeholder="Min ₹" value="{{ request('min') }}" class="w-full px-3 py-2.5 rounded-lg border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400 text-sm">
                    <span class="text-slate-400">-</span>
                    <input type="number" name="max" placeholder="Max ₹" value="{{ request('max') }}" class="w-full px-3 py-2.5 rounded-lg border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400 text-sm">
                </div>
            </div>

            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div class="pt-2">
                <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-lg shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                    Apply Filters
                </button>
                <a href="{{ route('products.index') }}" class="block text-center mt-3 text-sm font-medium text-slate-500 hover:text-rose-500 transition-colors">
                    Clear All
                </a>
            </div>
        </form>
    </aside>

    <!-- Product Grid -->
    <div class="flex-1 w-full">
        @if(request('search') || request('category') || request('min') || request('max'))
            <div class="mb-6 flex items-center justify-between">
                <p class="text-slate-600 font-medium">Showing results for your filters</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <a href="{{ route('products.show', $product->id) }}" class="block relative">
                        <div class="h-48 bg-slate-50 rounded-xl mb-4 p-4 overflow-hidden flex items-center justify-center group-hover:bg-blue-50/50 transition-colors duration-300 relative">
                            <button type="button" onclick="shareProductUrl(event, '{{ route('products.show', $product->id) }}', '{{ addslashes($product->name) }}')" class="absolute top-2 left-2 p-1.5 bg-white text-slate-500 hover:text-blue-600 rounded-md shadow-sm opacity-0 group-hover:opacity-100 transition-all duration-300 z-10" title="Share Product">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            </button>
                            
                            @if($product->image)
                                <img src="{{ asset('image/'.$product->image) }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain mix-blend-multiply transition-transform duration-500 group-hover:scale-110">
                            @else
                                <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                            
                            @if($product->stock <= 0)
                                <div class="absolute top-2 right-2 bg-rose-500 text-white text-[10px] uppercase tracking-wider font-bold px-2.5 py-1 rounded-md shadow-sm">
                                    Out of Stock
                                </div>
                            @else
                                <div class="absolute top-2 right-2 bg-emerald-500 text-white text-[10px] uppercase tracking-wider font-bold px-2.5 py-1 rounded-md shadow-sm">
                                    In Stock: {{ $product->stock }}
                                </div>
                            @endif
                        </div>
                        
                        <h4 class="text-lg font-bold text-slate-800 line-clamp-1 mb-1 group-hover:text-blue-600 transition-colors" title="{{ $product->name }}">{{ $product->name }}</h4>
                        <div class="flex items-center gap-1 mb-2">
                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="text-sm font-bold text-slate-700">{{ number_format($product->averageRating(), 1) }}</span>
                            <span class="text-xs text-slate-400">({{ $product->reviews->count() }})</span>
                        </div>
                    </a>
                    <div class="text-xl font-black text-blue-600 mb-4">₹{{ number_format($product->price, 2) }}</div>
                    
                    <form action="{{ route('cart.add') }}" method="POST" class="mt-auto add-to-cart-form" @guest onsubmit="event.preventDefault(); toastr.error('Please login first to add items to your cart.');" @endguest>
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if($product->stock <= 0)
                            <button type="button" disabled class="w-full py-2.5 bg-slate-100 text-slate-400 font-bold rounded-lg cursor-not-allowed flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Out of Stock</span>
                            </button>
                        @else
                            <button type="submit" class="w-full py-2.5 bg-slate-100 text-blue-600 hover:bg-gradient-to-r hover:from-blue-600 hover:to-cyan-500 hover:text-white font-bold rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                                <svg class="w-5 h-5 transition-transform group-hover/btn:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span>Add to Cart</span>
                            </button>
                        @endif
                    </form>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-100 border-dashed">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">No Products Found</h3>
                    <p class="text-slate-500 mb-6">We couldn't find any products matching your current filters.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-800 text-white font-medium rounded-lg hover:bg-slate-700 transition-colors">
                        Clear Filters
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function shareProductUrl(e, url, title) {
        e.preventDefault();
        e.stopPropagation();
        
        if (navigator.share) {
            navigator.share({
                title: title + ' on phoneKART',
                text: 'Check out this amazing product on phoneKART!',
                url: url,
            })
            .catch((error) => console.log('Error sharing', error));
        } else {
            navigator.clipboard.writeText(url).then(() => {
                toastr.success('Product link copied to clipboard!');
            });
        }
    }
</script>
@endsection
