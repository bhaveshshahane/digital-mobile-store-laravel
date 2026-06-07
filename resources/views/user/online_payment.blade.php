@extends('layouts.app')

@section('title', 'phoneKART - Secure Checkout')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Secure <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">Checkout</span></h1>
        <p class="text-white/80 max-w-2xl mx-auto">Enter your payment details to complete the purchase.</p>
    </div>
</section>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative -mt-8">
    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/10 border border-slate-100 relative overflow-hidden">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-4 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800">Online Payment</h2>
            <p class="text-slate-500 mt-2">Demo Payment Gateway</p>
        </div>

        <form method="POST" action="{{ route('checkout.online.process') }}" class="space-y-6" id="paymentForm">
            @csrf
            
            <!-- Card Number -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Card Number</label>
                <div class="relative">
                    <input type="text" name="card_number" placeholder="0000 0000 0000 0000" maxlength="19" required class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all tracking-widest font-mono">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Expiry Date -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Expiry Date</label>
                    <input type="text" name="expiry_date" placeholder="MM/YY" maxlength="5" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all font-mono text-center">
                </div>
                <!-- CVV -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">CVV</label>
                    <input type="password" name="cvv" placeholder="•••" maxlength="4" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all font-mono text-center tracking-[0.5em]">
                </div>
            </div>

            <!-- Cardholder Name -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Cardholder Name</label>
                <input type="text" name="cardholder_name" placeholder="e.g. John Doe" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all uppercase">
            </div>

            <!-- Fake Processing State Overlay -->
            <div id="processingState" style="display:none;" class="absolute inset-0 bg-white/90 backdrop-blur-sm z-10 flex-col items-center justify-center rounded-3xl">
                <div class="w-16 h-16 border-4 border-slate-200 border-t-blue-600 rounded-full animate-spin mb-4"></div>
                <h3 class="text-xl font-bold text-slate-800">Processing Payment...</h3>
                <p class="text-sm text-slate-500 mt-2">Please do not close this window.</p>
            </div>

            <button type="submit" id="submitBtn" class="w-full py-4 mt-8 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                Pay Now
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-xs text-slate-400 flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Payments are securely processed. This is a demo gateway.
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $.validator.addMethod("expiryFormat", function(value, element) {
        return this.optional(element) || /^(0[1-9]|1[0-2])\/?([0-9]{2})$/.test(value);
    }, "Please enter a valid expiry date (MM/YY)");

    $('#paymentForm').validate({
        rules: {
            card_number: { required: true, minlength: 19 },
            expiry_date: { required: true, expiryFormat: true },
            cvv: { required: true, minlength: 3, digits: true },
            cardholder_name: { required: true, minlength: 3 }
        },
        messages: {
            card_number: { required: "Please enter your card number", minlength: "Card number is too short" },
            expiry_date: { required: "Please enter expiry date" },
            cvv: { required: "Please enter CVV", minlength: "CVV must be at least 3 digits", digits: "CVV must be numbers only" },
            cardholder_name: { required: "Please enter cardholder name", minlength: "Name must be at least 3 characters" }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('text-rose-500 text-sm mt-1 block font-medium');
            if (element.prop('name') === 'card_number') {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass('border-rose-500 focus:ring-rose-500/20 focus:border-rose-500').removeClass('border-slate-300 focus:ring-blue-500/20 focus:border-blue-500');
        },
        unhighlight: function(element) {
            $(element).removeClass('border-rose-500 focus:ring-rose-500/20 focus:border-rose-500').addClass('border-slate-300 focus:ring-blue-500/20 focus:border-blue-500');
        },
        submitHandler: function(form) {
            document.getElementById('processingState').style.display = 'flex';
            document.getElementById('submitBtn').disabled = true;

            setTimeout(() => {
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            window.location.href = "{{ route('home') }}";
                        }
                    },
                    error: function() {
                        toastr.error('Payment processing failed. Please try again.');
                        document.getElementById('processingState').style.display = 'none';
                        document.getElementById('submitBtn').disabled = false;
                    }
                });
            }, 2000);
            return false;
        }
    });
    
    // Auto-formatting for card inputs
    $('input[name="card_number"]').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        var formattedValue = '';
        for(var i=0; i<value.length; i++){
            if(i>0 && i%4===0){ formattedValue += ' '; }
            formattedValue += value[i];
        }
        $(this).val(formattedValue);
    });
    
    $('input[name="expiry_date"]').on('input', function(e) {
        if(e.originalEvent && e.originalEvent.inputType === 'deleteContentBackward') return;
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 2) {
            $(this).val(value.substring(0, 2) + '/' + value.substring(2, 4));
        } else {
            $(this).val(value);
        }
    });
});
</script>
@endsection
