@extends('layouts.app')

@section('title', 'phoneKART - Contact Us')

@section('content')
<!-- Header Section -->
<section class="relative bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 overflow-hidden py-16">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contact <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">Us</span></h1>
        <p class="text-xl text-white/90 max-w-2xl mx-auto">Have questions or need assistance? We're here to help.</p>
    </div>
</section>

<!-- Content Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Contact Information -->
        <div class="lg:col-span-1">
            <h2 class="text-3xl font-bold text-slate-800 mb-8">Get in Touch</h2>
            
            <div class="space-y-8">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center border border-blue-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                    <div class="ml-6 flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-slate-800">Our Office</h3>
                        <p class="text-slate-600 mt-1 break-words">123 Tech Avenue, Silicon Valley<br>California, CA 94025</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center border border-indigo-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="ml-6 flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-slate-800">Email Us</h3>
                        <p class="text-slate-600 mt-1 break-words">support@phonekart.com<br>sales@phonekart.com</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-lg flex items-center justify-center border border-cyan-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                    </div>
                    <div class="ml-6 flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-slate-800">Call Us</h3>
                        <p class="text-slate-600 mt-1 break-words">+1 (555) 123-4567<br>Mon-Fri, 9am-6pm EST</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md border border-slate-200 p-6 md:p-8 w-full">
            <h3 class="text-2xl font-bold text-slate-800 mb-6">Send us a message</h3>
            
            <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-5 w-full">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 w-full">
                    <div class="w-full">
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2.5 rounded-md bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all duration-200 hover:border-slate-400 shadow-sm block" placeholder="John Doe" required>
                    </div>
                    <div class="w-full">
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2.5 rounded-md bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all duration-200 hover:border-slate-400 shadow-sm block" placeholder="john@example.com" required>
                    </div>
                </div>
                
                <div class="w-full">
                    <label for="subject" class="block text-sm font-semibold text-slate-700 mb-1.5">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-2.5 rounded-md bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all duration-200 hover:border-slate-400 shadow-sm block" placeholder="How can we help you?" required>
                </div>
                
                <div class="w-full">
                    <label for="message" class="block text-sm font-semibold text-slate-700 mb-1.5">Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full px-4 py-2.5 rounded-md bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all duration-200 hover:border-slate-400 shadow-sm resize-none block" placeholder="Write your message here..." required></textarea>
                </div>
                
                <button id="contactBtn" type="submit" class="w-full px-8 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-md shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 transition-all duration-200 mt-2 flex items-center justify-center gap-2">
                    Send Message
                </button>
            </form>
        </div>
        
    </div>
</section>

<!-- Map Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="bg-white p-2 md:p-4 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100">
        <div class="w-full h-[400px] md:h-[500px] rounded-2xl overflow-hidden relative">
            <div class="absolute inset-0 bg-slate-100 animate-pulse flex items-center justify-center -z-10">
                <span class="text-slate-400 font-medium">Loading Map...</span>
            </div>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.63929062107!2d-122.08374688469247!3d37.4219998798255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fba02425dad8f%3A0x6c296c66619367e0!2sGoogleplex!5e0!3m2!1sen!2sus!4v1624467383210!5m2!1sen!2sus" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
                class="relative z-10 w-full h-full"
            ></iframe>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#contactForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            subject: {
                required: true,
                maxlength: 255
            },
            message: {
                required: true
            }
        },
        messages: {
            name: "Please enter your full name",
            email: "Please enter a valid email address",
            subject: "Please enter a subject",
            message: "Please enter your message"
        },
        errorElement: 'span',
        errorClass: 'text-sm text-rose-500 mt-1 block',
        submitHandler: function(form) {
            let $btn = $('#contactBtn');
            let originalText = $btn.text().trim();
            
            $btn.prop('disabled', true)
                .html('<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending...')
                .removeClass('hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/30')
                .addClass('opacity-70 cursor-not-allowed');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        form.reset();
                    }
                },
                error: function(xhr) {
                    let msg = 'An error occurred while sending your message.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        msg = Object.values(xhr.responseJSON.errors)[0][0];
                    }
                    toastr.error(msg);
                },
                complete: function() {
                    $btn.prop('disabled', false)
                        .text(originalText)
                        .addClass('hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/30')
                        .removeClass('opacity-70 cursor-not-allowed');
                }
            });
            return false;
        }
    });
});
</script>
@endsection
