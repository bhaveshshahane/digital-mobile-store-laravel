<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background: #2563eb; color: white; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        .table th { background: #f8fafc; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; color: #777; }
        .total-row { font-weight: bold; font-size: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>phoneKART</h2>
            <p>Order Confirmation</p>
        </div>
        
        <div class="content">
            <p>Hi {{ $order->user->fname }},</p>
            <p>Thank you for your order! We've received it and it is now being processed.</p>
            
            <h3>Order Details (ID: #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }})</h3>
            <p><strong>Payment Mode:</strong> {{ $order->payment_mode }}</p>
            <p><strong>Shipping Address:</strong><br>
            {{ $order->address }}<br>
            Pincode: {{ $order->pincode }}</p>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($item->price * $item->qty, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;">Grand Total:</td>
                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <p>Thank you for shopping with phoneKART!</p>
            <p>If you have any questions, reply to this email.</p>
        </div>
    </div>
</body>
</html>
