@extends('layouts.app')

@section('title', 'phoneKART - Payment Details')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-600 to-cyan-600 py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Shipping & <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-100">Payment</span></h1>
        <p class="text-white/80 max-w-2xl mx-auto">Enter your details to complete your order.</p>
    </div>
</section>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Delivery Information</h2>
        
        <form method="POST" action="{{ route('checkout.process') }}" class="space-y-6" id="paymentForm">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Shipping Address <span class="text-rose-500">*</span></label>
                <textarea name="address" rows="3" placeholder="Enter Full Address" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pincode / Zip Code <span class="text-rose-500">*</span></label>
                <input type="number" name="pincode" placeholder="e.g. 400001" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Payment Method <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <select name="payment_mode" required id="paymentMode" class="w-full pl-4 pr-10 py-3 rounded-xl border border-slate-300 bg-slate-50 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none appearance-none transition-all cursor-pointer">
                        <option value="">Select Payment Mode</option>
                        <option value="COD">Cash On Delivery (COD)</option>
                        <option value="Online">Online Payment (Card/Netbanking)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
            
            <div class="pt-4 border-t border-slate-100">
                <button type="submit" id="payBtn" class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                    Confirm Order
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById("paymentMode").addEventListener("change", function(){
    const btn = document.getElementById("payBtn");
    if(this.value == "Online"){
        btn.innerHTML = `Proceed to Payment <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>`;
    } else {
        btn.innerHTML = `Confirm Order <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
    }
});

$(document).ready(function() {
    $('#paymentForm').validate({
        rules: {
            address: { required: true, minlength: 10 },
            pincode: { required: true, minlength: 4, digits: true },
            payment_mode: { required: true }
        },
        messages: {
            address: { required: "Please enter your shipping address", minlength: "Address must be at least 10 characters long" },
            pincode: { required: "Please enter your pincode", minlength: "Pincode must be at least 4 digits", digits: "Pincode can only contain numbers" },
            payment_mode: "Please select a payment method"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('text-rose-500 text-sm mt-1 block font-medium');
            if(element.prop('name') === 'payment_mode') {
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
            const btn = $('#payBtn');
            const originalText = btn.html();
            btn.html('<svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...');
            btn.prop('disabled', true);

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        toastr.error('Something went wrong. Please try again.');
                        btn.html(originalText);
                        btn.prop('disabled', false);
                    }
                },
                error: function(xhr) {
                    btn.html(originalText);
                    btn.prop('disabled', false);
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            toastr.error(errors[field][0]);
                        }
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                }
            });
            return false;
        }
    });
});
</script>
@endsection
