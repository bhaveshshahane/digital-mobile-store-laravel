@extends('layouts.app')

@section('title', 'phoneKART - Login')

@section('content')
<div class="min-h-[calc(100vh-70px)] flex justify-center items-center px-4">
    <div class="w-full max-w-sm bg-white p-8 rounded-2xl shadow-lg border border-slate-200 text-center">
        <h2 class="text-2xl font-bold mb-2 text-slate-800">Welcome Back</h2>
        <p class="text-sm text-slate-500 mb-6">Enter your details to proceed</p>

        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4 text-left">
                <label class="block text-sm font-semibold text-slate-600 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm outline-none transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
            </div>

            <div class="mb-5 text-left">
                <label class="block text-sm font-semibold text-slate-600 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm outline-none transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
            </div>

            <button id="loginBtn" type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-blue-500 text-white text-base font-bold rounded-lg mt-2 transition-all duration-300 hover:shadow-[0_4px_12px_rgba(59,130,246,0.3)] hover:-translate-y-0.5 flex items-center justify-center gap-2">Login</button>
        </form>

        <div class="mt-6 text-sm text-slate-500">
            Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:text-blue-500 transition-colors duration-300">Sign Up</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 4
            }
        },
        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter your password"
            }
        },
        errorElement: 'span',
        errorClass: 'text-sm text-rose-500 mt-1 block',
        submitHandler: function(form) {
            let $btn = $('#loginBtn');
            let originalText = $btn.text();
            
            $btn.prop('disabled', true)
                .html('<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Loading...')
                .removeClass('hover:-translate-y-0.5 hover:shadow-[0_4px_12px_rgba(59,130,246,0.3)]')
                .addClass('opacity-70 cursor-not-allowed');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    let msg = 'An error occurred during login.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    toastr.error(msg);
                    
                    $btn.prop('disabled', false)
                        .text(originalText)
                        .addClass('hover:-translate-y-0.5 hover:shadow-[0_4px_12px_rgba(59,130,246,0.3)]')
                        .removeClass('opacity-70 cursor-not-allowed');
                }
            });
            return false;
        }
    });
});
</script>
@endsection
