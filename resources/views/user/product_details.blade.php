@extends('layouts.app')

@section('title', $product->name . ' - phoneKART')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 py-8 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex text-white/80 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                {{-- <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                </li> --}}
                <li>
                    <div class="flex items-center">
                        {{-- <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> --}}
                        <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Products</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-white">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-12">
        <div class="flex flex-col md:flex-row">
            <!-- Product Image -->
            <div class="w-full md:w-1/2 p-8 md:p-12 bg-slate-50 flex items-center justify-center relative">
                @if($product->stock <= 0)
                    <div class="absolute top-6 left-6 bg-rose-500 text-white text-xs uppercase tracking-wider font-bold px-3 py-1.5 rounded-lg shadow-sm z-10">
                        Out of Stock
                    </div>
                @else
                    <div class="absolute top-6 left-6 bg-emerald-500 text-white text-xs uppercase tracking-wider font-bold px-3 py-1.5 rounded-lg shadow-sm z-10">
                        In Stock: {{ $product->stock }}
                    </div>
                @endif
                
                <button onclick="shareProduct()" class="absolute top-6 right-6 p-2.5 bg-white text-slate-600 hover:text-blue-600 rounded-xl shadow-sm hover:shadow transition-all duration-200 z-10" title="Share Product">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                </button>

                @if($product->image)
                    <img src="{{ asset('image/'.$product->image) }}" alt="{{ $product->name }}" class="max-w-full max-h-[400px] object-contain mix-blend-multiply hover:scale-105 transition-transform duration-500">
                @else
                    <svg class="w-32 h-32 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                @endif
            </div>

            <!-- Product Info -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col">
                <div class="mb-2 text-blue-600 font-bold uppercase tracking-wider text-sm">{{ $product->category->name ?? 'Uncategorized' }}</div>
                <h1 class="text-3xl md:text-4xl font-black text-slate-800 mb-4">{{ $product->name }}</h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="text-3xl font-black text-blue-600">₹{{ number_format($product->price, 2) }}</div>
                    
                    <div class="flex items-center gap-1 bg-amber-50 text-amber-600 px-3 py-1 rounded-lg">
                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="font-bold">{{ number_format($product->averageRating(), 1) }}</span>
                        <span class="text-xs text-amber-500/70 ml-1">({{ $product->reviews->count() }} reviews)</span>
                    </div>
                </div>

                <div class="prose prose-slate prose-sm mb-8">
                    @if($product->description)
                        {!! $product->description !!}
                    @else
                        <p>No description available for this product.</p>
                    @endif
                </div>

                <div class="mt-auto">
                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form" @guest onsubmit="event.preventDefault(); toastr.error('Please login first to add items to your cart.');" @endguest>
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        @if($product->stock <= 0)
                            <button type="button" disabled class="w-full py-4 bg-slate-100 text-slate-400 font-bold text-lg rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Out of Stock</span>
                            </button>
                        @else
                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-cyan-500 text-white hover:from-blue-700 hover:to-cyan-600 font-bold text-lg rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 group/btn">
                                <svg class="w-6 h-6 transition-transform group-hover/btn:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span>Add to Cart</span>
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Review List -->
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                Customer Reviews
                <span class="bg-blue-100 text-blue-700 text-sm py-1 px-3 rounded-full">{{ $product->reviews->count() }}</span>
            </h2>

            <div class="space-y-6" id="review-list">
                @forelse($product->reviews as $review)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->fname) }}&background=eff6ff&color=2563eb" alt="{{ $review->user->fname }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                                <div>
                                    <h4 class="font-bold text-slate-800">{{ $review->user->fname }} {{ $review->user->lname }}</h4>
                                    <p class="text-xs text-slate-500">{{ $review->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex text-amber-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                        </div>
                        @if($review->comment)
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 border-dashed text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <h4 class="text-lg font-bold text-slate-800">No reviews yet</h4>
                        <p class="text-slate-500 text-sm">Be the first to review this product!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Write Review Form -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 sticky top-24">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Write a Review</h3>
                
                @auth
                    @if($product->reviews->where('user_id', auth()->id())->count() > 0)
                        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-100 flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-sm font-medium">You have already reviewed this product. Thank you for your feedback!</p>
                        </div>
                    @else
                        <form action="{{ route('reviews.store', $product->id) }}" method="POST" id="review-form">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Rating</label>
                                <div class="flex items-center gap-2 star-rating cursor-pointer">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg data-rating="{{ $i }}" class="w-8 h-8 text-slate-300 hover:text-amber-400 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating-input" required>
                            </div>
                            
                            <div class="mb-5">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Comment (Optional)</label>
                                <textarea name="comment" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all resize-none" placeholder="Share your experience..."></textarea>
                            </div>
                            
                            <button type="submit" class="w-full py-3 bg-slate-800 text-white font-bold rounded-xl shadow-md hover:bg-slate-700 transition-colors">
                                Submit Review
                            </button>
                        </form>
                    @endif
                @else
                    <div class="bg-blue-50 p-5 rounded-xl border border-blue-100 text-center">
                        <p class="text-sm text-blue-800 font-medium mb-4">You must be logged in to leave a review.</p>
                        <a href="{{ route('login') }}" class="inline-block w-full py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                            Log In to Review
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function shareProduct() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $product->name }} on phoneKART',
                text: 'Check out this amazing product on phoneKART!',
                url: window.location.href,
            })
            .catch((error) => console.log('Error sharing', error));
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                toastr.success('Product link copied to clipboard!');
            });
        }
    }

    // Star Rating Logic
    const stars = document.querySelectorAll('.star-rating svg');
    const ratingInput = document.getElementById('rating-input');

    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            highlightStars(rating);
        });

        star.addEventListener('mouseout', function() {
            const currentRating = ratingInput.value || 0;
            highlightStars(currentRating);
        });

        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            highlightStars(rating);
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-rating') <= rating) {
                star.classList.remove('text-slate-300');
                star.classList.add('text-amber-400');
            } else {
                star.classList.add('text-slate-300');
                star.classList.remove('text-amber-400');
            }
        });
    }

    $(document).ready(function() {
        $('#review-form').validate({
            rules: {
                rating: {
                    required: true,
                    min: 1,
                    max: 5
                },
                comment: {
                    maxlength: 1000
                }
            },
            messages: {
                rating: {
                    required: "Please select a rating."
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-rose-500 text-xs mt-1 block');
                if (element.attr("name") == "rating") {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                const submitBtn = $(form).find('button[type="submit"]');
                const originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Submitting...');

                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: $(form).serialize(),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            
                            // Remove "No reviews yet" if present
                            $('#review-list .border-dashed').remove();

                            // Build new review HTML
                            const starsHtml = Array.from({length: 5}, (_, i) => i + 1).map(i => `
                                <svg class="w-5 h-5 ${i <= response.review.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            `).join('');

                            const reviewHtml = `
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-200">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(response.review.user_fname)}&background=eff6ff&color=2563eb" alt="${response.review.user_fname}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                                            <div>
                                                <h4 class="font-bold text-slate-800">${response.review.user_name}</h4>
                                                <p class="text-xs text-slate-500">${response.review.date}</p>
                                            </div>
                                        </div>
                                        <div class="flex text-amber-400">
                                            ${starsHtml}
                                        </div>
                                    </div>
                                    ${response.review.comment ? '<p class="text-slate-600 text-sm leading-relaxed">' + response.review.comment.replace(/</g, "&lt;").replace(/>/g, "&gt;") + '</p>' : ''}
                                </div>
                            `;

                            // Prepend review
                            $('#review-list').prepend(reviewHtml);

                            // Update count badge
                            const countBadge = $('.bg-blue-100.text-blue-700.rounded-full');
                            countBadge.text(parseInt(countBadge.text() || 0) + 1);

                            // Replace form with success message
                            $(form).replaceWith(`
                                <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-100 flex items-start gap-3">
                                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-sm font-medium">You have already reviewed this product. Thank you for your feedback!</p>
                                </div>
                            `);
                        } else {
                            toastr.error(response.message || "An error occurred.");
                            submitBtn.prop('disabled', false).text(originalText);
                        }
                    },
                    error: function(xhr) {
                        const errorMsg = xhr.responseJSON?.message || "Something went wrong.";
                        toastr.error(errorMsg);
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                });
            }
        });
    });
</script>
@endsection
