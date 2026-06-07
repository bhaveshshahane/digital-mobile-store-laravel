@extends('layouts.app')

@section('title', 'phoneKART - About Us')

@section('content')
<!-- Header Section -->
<section class="relative bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 overflow-hidden py-16">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">About <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">phoneKART</span></h1>
        <p class="text-xl text-white/90 max-w-2xl mx-auto">Your ultimate destination for the latest smartphones and cutting-edge mobile technology.</p>
    </div>
</section>

<!-- Content Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col md:flex-row gap-12 items-center">
        <div class="md:w-1/2">
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-2xl blur-xl opacity-30"></div>
                <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="About Us" class="relative z-10 rounded-2xl shadow-2xl object-cover h-[400px] w-full">
            </div>
        </div>
        <div class="md:w-1/2">
            <h2 class="text-3xl font-bold text-slate-800 mb-6">Our Mission</h2>
            <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                At phoneKART, we believe that staying connected shouldn't be a luxury. Founded in 2026, our mission is to provide technology enthusiasts and everyday users with access to the highest quality mobile devices at unbeatable prices.
            </p>
            <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                We partner directly with leading global manufacturers to bring you an extensive, curated selection of smartphones, from budget-friendly options to premium flagship devices. Every device we sell comes with a guarantee of authenticity and unparalleled customer support.
            </p>
            <div class="grid grid-cols-2 gap-6 mt-8">
                <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                    <h4 class="text-4xl font-bold text-blue-600 mb-2">50K+</h4>
                    <p class="text-slate-700 font-medium">Happy Customers</p>
                </div>
                <div class="bg-cyan-50 rounded-xl p-6 border border-cyan-100">
                    <h4 class="text-4xl font-bold text-cyan-600 mb-2">100%</h4>
                    <p class="text-slate-700 font-medium">Genuine Products</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="bg-slate-50 py-16 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-800">Why Choose Us</h2>
            <p class="text-slate-500 mt-4 max-w-2xl mx-auto">We don't just sell phones; we provide a complete technological experience.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Trusted Warranty</h3>
                <p class="text-slate-600">All our devices come with a comprehensive 1-year manufacturer warranty and our own 30-day money-back guarantee.</p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Lightning Fast Delivery</h3>
                <p class="text-slate-600">Order before 2 PM and get your device delivered the very next day. Free shipping on all major orders.</p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Expert Support</h3>
                <p class="text-slate-600">Our dedicated team of tech experts is available 24/7 to help you choose the right phone and troubleshoot issues.</p>
            </div>
        </div>
    </div>
</section>
@endsection
