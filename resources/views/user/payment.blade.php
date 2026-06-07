@extends('layouts.app')

@section('title', 'Payment')

@section('styles')
<style>
.container { width:400px; margin:50px auto; background:#fff; padding:30px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
h2 { text-align:center; margin-bottom:20px; }
input, textarea, select { width:100%; padding:10px; margin-bottom:15px; border-radius:6px; border:1px solid #ccc; font-family:inherit; }
button { width:100%; padding:12px; background:#ff2e93; color:#fff; border:none; border-radius:8px; font-size:16px; cursor:pointer; }
</style>
@endsection

@section('content')
<div class="container">
    <h2>Payment Details</h2>

    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        
        <textarea name="address" placeholder="Enter Full Address" required></textarea>
        
        <input type="number" name="pincode" placeholder="Enter Pincode" required>
        
        <select name="payment_mode" required id="paymentMode">
            <option value="">Select Payment Mode</option>
            <option value="COD">Cash On Delivery</option>
            <option value="Online">Online Payment</option>
        </select>
        
        <button type="submit" id="payBtn">Confirm Order</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById("paymentMode").addEventListener("change", function(){
    if(this.value == "Online"){
        document.getElementById("payBtn").innerText = "Proceed to Payment";
    } else {
        document.getElementById("payBtn").innerText = "Confirm Order";
    }
});
</script>
@endsection
