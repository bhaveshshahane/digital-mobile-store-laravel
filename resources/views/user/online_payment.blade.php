@extends('layouts.app')

@section('title', 'Online Payment')

@section('styles')
<style>
.container { width:400px; margin:50px auto; background:#fff; padding:30px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); text-align:center; }
.spinner { border:4px solid #f3f3f3; border-top:4px solid #ff2e93; border-radius:50%; width:40px; height:40px; animation:spin 2s linear infinite; margin:20px auto; }
@keyframes spin { 0% { transform:rotate(0deg); } 100% { transform:rotate(360deg); } }
#successMsg { display:none; color:green; font-weight:bold; font-size:18px; }
#redirectMsg { display:none; margin-top:10px; font-size:14px; color:#555; }
</style>
@endsection

@section('content')
<div class="container">
    <h2>Processing Payment...</h2>
    <p>Please wait, do not close or refresh this page.</p>

    <div class="spinner" id="spinner"></div>

    <div id="successMsg">✅ Payment Successful!</div>
    <div id="redirectMsg">Redirecting...</div>
</div>
@endsection

@section('scripts')
<script>
setTimeout(function(){
    document.getElementById("spinner").style.display = "none";
    document.getElementById("successMsg").style.display = "block";
    document.getElementById("redirectMsg").style.display = "block";
    
    setTimeout(function(){
        window.location = "{{ route('checkout.success') }}";
    }, 2000);
}, 3000);
</script>
@endsection
